<?php

/**
*
*@autor jesus andres castellanos aguilar
*
* controlador encargado de todos los procesos referente a los usuarios
* 
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class Learning_units extends CI_Controller{
    
    /**
    * metodo cnstructor donde se cargan todos los helpers, librerias y modelos necesarios en el controlador
    *@library 
    *@model  Learning_unity()|logueo()
    *@helper login_rules() |url() |form ()
    * 
    */
    function __construct() {
        parent::__construct ();
        $this->load->model(['Learning_unit','Logueo','Focu','Users','Role']);
        $this->load->helper(['login_rules','url','form']);
    }
    
    /**
    * funcion para mostrar la  vista principal el cual es perfil.
    *
    * @return view ()
    */
    public function index(){
        $data['focus']=$this->Focu->listar();
        $data['title']='Unidades de aprendizaje';
        $this->load->view('private/heads/head_1',$data);
        $this->load->view('private/heads/head_2');
        $this->load->view('private/heads/menus');
        $this->load->view('private/Learning_units', $data);    
        $this->load->view('private/footers/foot_1');
        $this->load->view('private/footers/foot_2');
        
    }

    /**
    * funcion el envio de datos para dibujar la tabla de roles.
    *
    * @return json_encode()
    */
     public function listarUnidades(){
        $draw = intval($this->input->get("draw"));          //trae las varibles draw, start, length para la creacion de la tabla
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $data =$this->Learning_unit->listar();                                          //utiliza el metodo listar() del modelo learning_units() para traer los datos de todos las unidades
        $output = array(                                    //creacion del vector de salida
            "draw" => $draw,                                //envio la variable de dibujo de la tabla                    
            "recordsTotal" =>$data->num_rows(),             //envia el numero de filas  para saber cuantos usuarios son en total
            "recordsFiltered" => $data->num_rows(),         //envio el numero de filas para el calculo de la paginacion de la tabla
            "data" => $data->result_array()                                 //envia todos los datos de la tabla
        );
        echo json_encode($output);                          //envio del vector de salida con los parametros correspondientes
        exit;                                               //salida del proceso
    }
    
    /**
    * funcion para eliminar la unidad pedagogica.
    *
    * @return json_encode() |set_status_header()
    */
    public function eliminarUnidades($pk){
        if($res = $this->Learning_unit->eliminar($pk)){                         //realiza la verificacion y eliminacion de la unidad pedagogica
            echo json_encode(array('msg'=> 'permiso eliminado exitosamente' )); //si el rol fue eliminado correctamenre envia el mensaje de confirmacion
        }else{                                                                  //si no fue posible eliminarlo
            echo json_encode($res);                                             //envio de la respueta
            $this->output->set_status_header(403);                              //envio del status de error en este caso 403
        }
        
    }
    
    /**
    *funcion para redirecionar a la visa de editar y envio de la informacion de las unidades pedagogicas.
    *@param  int $doc
    *@return  view()
    */
    public function editarUnidades($doc){                                        
        $dato['data']=$this->Learning_unit->datosUnidad($doc)->result_array()[0];   //verifica por medio del metodo datosUnidad() del modelo Learning_unit() si la unidad existe y trae todos los datos pertinentes al usuario   
        $dato['focus']  = $this->Focu->listar();//trae los datos de enfoques para agregar a la  unidad
        $this->load->view('private/view_ajax/editar_unidad_pedagogica_ajax',$dato);//envio de la vista y los datos para la edicion de los usuarios
    }
    
    /**
    *funcion para la modificacion de  la informacion de los roles.
    *@param  int $doc
    *@return  json_encode() | echo "error" | set_status_header()
    */
    public function modificarUnidades($doc){
        $this->form_validation->set_error_delimiters('','');                        //quita los delimtadores de error
        $rules=getRulesAddUnidad();                                                 //utiliza las reglas de agregar unidad para validar los campos del formulario
        $this->form_validation->set_rules($rules);                                  //ejecuta las reglas del fromulario 
        if($this->form_validation->run() === FALSE){                                //si se incumple algunade las regla
            $errors = array(                                                        //creacion del vector de los errores
                'LNUT_name'       => form_error('LNUT_name'),
                'LNUT_description'=> form_error('LNUT_description'),
            );
            echo json_encode($errors);                                              //envio del vector de errores
            $this->output->set_status_header(402);                                  //envio del estatus del error en este caso 402
        }else{                                                                      //si las reglas fueron cumplidas
            //obtencion de todos los datos del formulario                    
            $data= array(                                                           //creacion del vector de los nuevos datos de la unidada
                'LNUT_name'         =>  $this->input->post('LNUT_name'),
                'LNUT_FK_focus'     =>  $this->input->post('LNUT_FK_focus'),
                'LNUT_description'  =>  $this->input->post('LNUT_description'),
                'LNUT_date_update'  =>  date("Y-m-d H:i:s"),
                'LNUT_PK_update'    =>  $this->session->userdata('id'),
                
            );
            if(!$this->Learning_unit->modificarUnidad($doc,$data)){                 //utilizacion del metodo modificarUnidad() del modelo learning_unit() para la modificacion de la unidad  enviando el id y los datos pertinentes
                echo "error";                                                       // en caso de  fallar envia un mensaje de error
            }
            echo json_encode(array('msg'=> 'Unididad modificada' ));                // si fue modificado con exito envia el mensaje correspondiente
        }
    }
   
    /**
    * funcion para agregar unidades de aprendizaje a la base de datos.
    *
    * @return json_encode() |set_status_header() |echo "error"
    */
    public function agregarUnidad(){
        $this->form_validation->set_error_delimiters('','');                        //quita los delimtadores de error
        $rules=getRulesAddUnidad();                                                 //utiliza las reglas de agregar unidad para validar los campos del formulario
        $this->form_validation->set_rules($rules);                                  //ejecuta las reglas del fromulario 
        if($this->form_validation->run() === FALSE){                                //si se incumple algunade las regla
            $errors = array(                                                        //creacion del vector de los errores
                'LNUT_name'       => form_error('LNUT_name'),
                'LNUT_description'=> form_error('LNUT_description'),
            );
            echo json_encode($errors);                                              //envio del vector de errores
            $this->output->set_status_header(402);                                  //envio del estatus del error en este caso 402
        }else{                                                                      //si las reglas fueron cumplidas
             //obtencion de todos los datos del formulario                    
            $data= array(                                                           //creacion del vector de los nuevos datos de la unidad
                'LNUT_name'       =>  $this->input->post('LNUT_name'),
                'LNUT_FK_focus'   =>  $this->input->post('LNUT_FK_focus'),
                'LNUT_description'=>  $this->input->post('LNUT_description'),
                'LNUT_date_create'=>  date("Y-m-d H:i:s"),
                'LNUT_PK_create'  =>  $this->session->userdata('id'),
                'LNUT_date_update'=>  date("Y-m-d H:i:s"),
                'LNUT_PK_update'  =>  $this->session->userdata('id'),
                
            );
            if(!$this->Learning_unit->agregarUnidad($data)){                         //utilizacion del metodo modificarUnidad() del modelo Learning_unit() para la modificacion de la unidad enviando el id y los datos pertinentes
                echo "error";                                                        // en caso de  fallar envia un mensaje de error
            }
            echo json_encode(array('msg'=> 'Unidad agregada' ));                     //si fue modificado con exito envia el mensaje correspondiente
        }       
    }
    
    /**
    *funcion para redirecionar a la visa de asignar usuarios a la unidad de aprendizaje
    *@param  int $doc
    *@return  view()
    */
    public function asignarUsuarios($doc){
        $roles=$this->Role->listar();                                               //trae los datos de enfoques para agregar a la  unidad
        $dato['id']     = $doc;
        $dato['roles']  = $roles;
        $this->load->view('private/view_ajax/asignacion_usuarios_unidades_ajax',$dato);//envio de la vista y los datos para la edicion de los usuarios
    }
    
    /**
    * funcion el envio de datos para dibujar la tabla de usuarios dentro de la unidad de aprendizaje.
    *
    * @return json_encode()
    */
     public function listarUsuarios($id){
         $draw   = intval($this->input->get("draw"));            //trae las varibles draw, start, length para la creacion de la tabla
         $start  = intval($this->input->get("start"));
         $length = intval($this->input->get("length"));
         $data =$this->Learning_unit->listarUsuarios($id);       //utiliza el metodo listar() del modelo learning_units() para traer los datos de todos las unidades
        
         foreach($data->result() as $r) {                        //ciclo para la creacion de las filas y columnas de la tabla de datos incluye los botones de acciones
            $dato [] = array(
                $r->USER_names,
                $r->ROLE_name,
                '<input type="button" class="btn btn-danger fa fa-remove remove" title="Eliminar usuario" id="'.$r->USLE_PK.'" value="eliminar" >',
            );
        }
        $output = array(                                    //creacion del vector de salida
            "draw" => $draw,                                //envio la variable de dibujo de la tabla                    
            "recordsTotal" =>$data->num_rows(),             //envia el numero de filas  para saber cuantos usuarios son en total
            "recordsFiltered" => $data->num_rows(),         //envio el numero de filas para el calculo de la paginacion de la tabla
            "data" => $data->num_rows()>0?$dato:$data,                                 //envia todos los datos de la tabla
        );
        echo json_encode($output);                          //envio del vector de salida con los parametros correspondientes
        exit;                                               //salida del proceso
    }
    
    /**
    * funcion para eliminar un usuario de la unida de aprendizaje
    *
    * @return json_encode() |set_status_header()
    */
    public function eliminarUsuario($pk){
        if($res = $this->Learning_unit->eliminarUsuario($pk)){                  //realiza la verificacion y eliminacion de la unidad pedagogica
            echo json_encode(array('msg'=> 'usuario eliminado exitosamente' )); //si el rol fue eliminado correctamenre envia el mensaje de confirmacion
        }else{                                                                  //si no fue posible eliminarlo
            echo json_encode($res);                                             //envio de la respueta
            $this->output->set_status_header(403);                              //envio del status de error en este caso 403
        }
        
    }
    
    /**
    * funcion para agregar los nuevos miembros a la unida de aprendizaje.
    *
    * @return json_encode()
    */
    public function agregarUsuario(){
        $unit       = $this->input->post('USLE_FK_learning_units');            //obtencion de todos los datos del formulario
        $doc        = $this->input->post('USLE_FK_users');                     //obtencion de todos los datos del formulario
        $role       = $this->input->post('USLE_FK_roles');                     //obtencion de todos los datos del formulario
        if($user = $this->Users->verificarUsuarioDoc($doc)->result_array()[0]){
            if($this->Learning_unit->verificarUsuario($unit,$user["USER_PK"])){            //verifica si el miembro ya existe en el curso
                echo json_encode($this->Learning_unit->verificarUsuario($unit,$user["USER_PK"]));
                $this->output->set_status_header(403);                          //envio de  estatus de error;
                exit;
            }
        }
        $data   = array(                                                    //creacion de arreglo para la insercion de datos
            'USLE_FK_users'             =>  $user["USER_PK"],
            'USLE_FK_learning_units'    =>  $unit,
            'USLE_FK_roles'             =>  $role,
            'USLE_date_create'          =>  date("Y-m-d H:i:s"),
            'USLE_date_update'          =>  date("Y-m-d H:i:s"),
            'USLE_PK_create'            =>  $this->session->userdata('id'),
            'USLE_PK_update'            =>  $this->session->userdata('id'),
        );
        
        if(!$this->Learning_unit->agregarUsuario($data)){                      //utilizacion del metodo agregarMiembroCicle() del modelo Cicle() para la agregacion de un nuevos miembros al curso
            echo "error";                                                   // en caso de  fallar envia un mensaje de
            echo json_encode(array('msg'=> 'Curso agregado agregado' ));    //si fue agregado con exito envia el mensaje correspondiente
        }
    }
}