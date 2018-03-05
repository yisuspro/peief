<?php
/**
*
*@autor jesus andres castellanos aguilar
*
* controlador encargado de todos los procesos referente a los roles
* 
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class Roles extends CI_Controller
{
    /**
    * metodo cnstructor donde se cargan todos los helpers, librerias y modelos necesarios en el controlador
    *@library 
    *@model  role()|logueo()
    *@helper login_rules() |url() |form ()
    * 
    */
    function __construct() {
        parent::__construct ();
        $this->load->model('Role');
        $this->load->model('Permits');
        $this->load->model('Logueo');
        $this->load->helper('login_rules');
        $this->load->helper('url');
        $this->load->helper('form');
    }
    
    /**
    * funcion para mostrar la  vista principal donde se istan los roles.
    *
    * @return view ()
    */
    public function index(){
        $data['title']='Roles';
        $this->load->view('private/heads/head_1',$data);
        $this->load->view('private/heads/head_2');
        $this->load->view('private/heads/menus');
        $this->load->view('private/roles', $data);    
        $this->load->view('private/footers/foot_1');
        $this->load->view('private/footers/foot_2'); 
    }
    
    /**
    * funcion el envio de datos para dibujar la tabla de roles.
    *
    * @return json_encode ()
    */
    public function listarRoles(){
        $draw = intval($this->input->get("draw"));          //trae las varibles draw, start, length para la creacion de la tabla
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $data =$this->Role->listar();                       //utiliza el metodo listar() del modelo role() para traer los datos de todos los usuarios 
        foreach($data->result() as $r) {                    //ciclo para la creacion de las filas y columnas de la tabla de datos incluye los botones de acciones
            $dato[] = array(
                $r->ROLE_name,
                $r->ROLE_shortname,
                $r->ROLE_description,
                '<input type="button" class="btn btn-warning edit" title="Editar rol" id="'.$r->ROLE_PK.'" value="editar" ><input type="button" class="btn btn-danger remove" title="Eliminar rol" id="'.$r->ROLE_PK.'" value="eliminar" ><input type="button" class="btn btn-info asignar" title="asignar permisos" id="'.$r->ROLE_PK.'" value="permisos">',
            );
        }
        $output = array(                                    //creacion del vector de salida
            "draw" => $draw,                                //envio la variable de dibujo de la tabla                    
            "recordsTotal" =>$data->num_rows(),             //envia el numero de filas  para saber cuantos usuarios son en total
            "recordsFiltered" => $data->num_rows(),         //envio el numero de filas para el calculo de la paginacion de la tabla
            "data" => $dato                               //envia todos los datos de la tabla
        );
        echo json_encode($output);                          //envio del vector de salida con los parametros correspondientes
        exit;                                               //salida del proceso
    }
    
    /**
    * funcion para eliminar el  rol.
    *
    * @return json_encode() |set_status_header()
    */
    public function eliminarRoles($pk){
        if($res = $this->Role->eliminar($pk)){                                  //realiza la verificacion y eliminacion del rol
            echo json_encode(array('msg'=> 'rol eliminado exitosamente' ));     //si el rol fue eliminado correctamenre envia el mensaje de confirmacion
        }else{                                                                  //si no fue posible eliminarlo
            echo json_encode($res);                                             //envio de la respueta
            $this->output->set_status_header(403);                              //envio del status de error en este caso 403
        }
        
    }
    
    /**
    *funcion para redirecionar a la visa de editar y envio de la informacion de los roles.
    *@param  int $doc
    *@return  view()
    */
    public function editarRol($doc){
        $data=$this->Role->datosRol($doc);                                         //verifica por medio del metodo datosUsiarios() del modelo users() si el usuario existe ytae todos los datos pertinentes al usuario 
        foreach($data->result() as $r) {                                           //ciclop para  convertir los datos en un arreglo
            $dato = array();                                                       //creacion del vector que contendra los datos del usuario
            $dato['ROLE_PK'] = $r->ROLE_PK;
            $dato['ROLE_name'] = $r->ROLE_name;
            $dato['ROLE_shortname']= $r->ROLE_shortname;
            $dato['ROLE_description']= $r->ROLE_description;
            
        }
        $this->load->view('private/view_ajax/editar_rol_ajax',$dato);               //envio de la vista y los datos para la edicion de los usuarios
    }
    
    /**
    *funcion para la modificacion de  la informacion de los roles.
    *@param  int $doc
    *@return  json_encode() | echo "error" | set_status_header()
    */
    public function modificarRol($doc){
        $this->form_validation->set_error_delimiters('','');                        //quita los delimtadores de error
        $rules=getRulesAddRol();                                                    //utiliza las reglas de agregar rol para validar los campos del formulario
        $this->form_validation->set_rules($rules);                                  //ejecuta las reglas del fromulario 
        if($this->form_validation->run() === FALSE){                                //si se incumple algunade las regla
            $errors = array(                                                        //creacion del vector de los errores
                'ROLE_name'         => form_error('ROLE_name'),
                'ROLE_shortname'    => form_error('ROLE_shortname'),
                'ROLE_description'  => form_error('ROLE_description'),
                
            );
            echo json_encode($errors);                                              //envio del vector de errores
            $this->output->set_status_header(402);                                  //envio del estatus del error en este caso 402
        }else{                                                                      //si las reglas fueron cumplidas
            $name           = $this->input->post('ROLE_name');                      //obtencion de todos los datos del formulario                    
            $shortname      = $this->input->post('ROLE_shortname');
            $description    = $this->input->post('ROLE_description');
            $data= array(                                                           //creacion del vector de los nuevos datos del rol
                'ROLE_name'                     =>  $name,
                'ROLE_shortname'                =>  $shortname,
                'ROLE_description'              =>  $description,
                'ROLE_date_update'=>date("Y-m-d H:i:s"),
                'ROLE_PK_update'=>$this->session->userdata('id'),
                
            );
            if(!$this->Role->modificarRol($doc,$data)){                             //utilizacion del metodo modificarRol() del modelo role() para la modificacion del rol  enviando el id y los datos pertinentes
                echo "error";                                                       // en caso de  fallar envia un mensaje de error
            }
            echo json_encode(array('msg'=> 'Rol modificado' ));                     // si fue modificado con exito envia el mensaje correspondiente
        }
    }
    
    /**
    * funcion para mostrar la  vista de asigar roles.
    *
    * @return view ()
    */
    public function asignarPermiso($PK){
        $data['id'] =$PK;
        $data['tabla']=$this->Permits->listar();
        $this->load->view('private/view_ajax/asignacion_permisos_ajax',$data);
    }
    
    /**
    * funcion para agregar roles a la base de datos.
    *
    * @return json_encode() |set_status_header() |echo "error"
    */
    public function agregarRoles(){
        $this->form_validation->set_error_delimiters('','');                        //quita los delimtadores de error
        $rules=getRulesAddRol();                                                    //utiliza las reglas de agregar role para validar los campos del formulario
        $this->form_validation->set_rules($rules);                                  //ejecuta las reglas del fromulario 
        if($this->form_validation->run() === FALSE){                                //si se incumple algunade las regla
            $errors = array(                                                        //creacion del vector de los errores
                'ROLE_name'       => form_error('ROLE_name'),
                'ROLE_shortname'    => form_error('ROLE_shortname'),
                'ROLE_description'=> form_error('ROLE_description'),
                
            );
            echo json_encode($errors);                                              //envio del vector de errores
            $this->output->set_status_header(402);                                  //envio del estatus del error en este caso 402
        }else{                                                                      //si las reglas fueron cumplidas
            $name           = $this->input->post('ROLE_name');                      //obtencion de todos los datos del formulario                    
            $shortname      = $this->input->post('ROLE_shortname');
            $description    = $this->input->post('ROLE_description');
            $data= array(                                                           //creacion del vector de los nuevos datos del role
                'ROLE_name'                     =>  $name,
                'ROLE_shortname'                =>  $shortname,
                'ROLE_description'              =>  $description,
                'ROLE_date_create'=>date("Y-m-d H:i:s"),
                'ROLE_date_update'=>date("Y-m-d H:i:s"),
                'ROLE_PK_create'=>$this->session->userdata('id'),
                'ROLE_PK_update'=>$this->session->userdata('id'),
                
            );
            if(!$this->Role->agregarRol($data)){                                    //utilizacion del metodo modificarRol() del modelo Role() para la modificacion del usuario  enviando el id y los datos pertinentes
                echo "error";                                                       // en caso de  fallar envia un mensaje de error
            }
            echo json_encode(array('msg'=> 'Rol modificado' ));                     //si fue modificado con exito envia el mensaje correspondiente
        }       
    }
   
    
    /**
    * funcion para asignar los roles a un usuario.
    * @param int $usuario,$rol
    * @return true | false
    */
    public function asignarRolUsuario($usuario,$rol){
        if ($this->Role->consultarRolUsuario($usuario,$rol)){ //verifica si el permiso ya fue asignado
            $this->output->set_status_header(402);            //envia el error en caso de existir
        }else{
            $data= array(
                'USRL_FK_users'            =>  $usuario,      //crea el vector con los datos
                'USRL_FK_roles'            =>  $rol,
            );
            if ($this->Role->asignarRol($data)){              //envia y valida la insercion del nuevo permiso en el rol 
                return true;
            }
            return false;  
        }
    }
    
    /**
    * funcion para eliminar el rol asignado a un usuario.
    * @param int $pk
    * @return json_encode() |set_status_header()
    */
    public function eliminarRolUsuario($pk,$role){
        if($res = $this->Role->eliminarRolUsuario($pk,$role)){                               //realiza la verificacion y eliminacion del rol
            echo json_encode(array('msg'=> 'permiso eliminado exitosamente' )); //si el rol fue eliminado correctamenre envia el mensaje de confirmacion
        }else{                                                                  //si no fue posible eliminarlo
            echo json_encode($res);                                             //envio de la respueta
            $this->output->set_status_header(403);                              //envio del status de error en este caso 403
        }
        
    }
    
}
