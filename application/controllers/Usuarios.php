<?php
/**
*
*@autor jesus andres castellanos aguilar
*
* controlador encargado de todos los procesos referente a los usuarios
* 
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class Usuarios extends CI_Controller
{
    /**
    * metodo cnstructor donde se cargan todos los helpers, librerias y modelos necesarios en el controlador
    *@library 
    *@model  users()|logueo()
    *@helper login_rules() |url() |form ()
    * 
    */
    function __construct() {
        parent::__construct ();
        $this->load->model('Users');
        $this->load->model('Logueo');
        $this->load->model('Role');
        $this->load->helper('login_rules');
        $this->load->helper('url');
        $this->load->helper('form');
        date_default_timezone_set('UTC');
    }
    
    /**
    * funcion para mostrar la  vista principal el cual es perfil.
    *
    * @return view ()
    */
    public function index(){
        $this->load->view('public/registro');
    }
    
    /**
    * funcion para registrar un nuevo usuario, comprueba si los datos se encuentran llenos y si  el usuario a ingresar ya existe.
    *
    * @return json_encode() | var_dump() |set_status_header()
    */
    public function registrar(){
        $this->form_validation->set_error_delimiters('','');                                //quita los delimitadores de los errores
        $rules=getRulesAddUsers();                                                          //trae las reglas del formulario de ingresar usuario del helper login_rules()
        $this->form_validation->set_rules($rules);                                          //valida las reglas del formulario
        if($this->form_validation->run() === FALSE){                                        //si las reglas son incumplidas
            $errors = array(                                                                //creacion del vector de errores    
                'USER_identification'=> form_error('USER_identification'),
                'USER_names'    => form_error('USER_names'),
                'USER_lastnames'=> form_error('USER_lastnames'),
                'USER_email'    => form_error('USER_email'),
                'USER_address'  => form_error('USER_address'),
                'USER_telephone'=> form_error('USER_telephone'),
                'USER_password' => form_error('USER_password'),
            );
            echo json_encode($errors);                                                      //envio de los errores 
            $this->output->set_status_header(402);                                          //envio del codigo de error   en este caso 402
        }else{                                                                              //si  las reglas no son incumplidas
                                            
            $doc =$this->input->post('USER_PK');                                            //obtencion del documento del usuario
            if($res = $this->Users->verificarUsuario($doc)){                                //comprueba si el usuario existe en la base de datos
                    echo json_encode(array('msg'=> 'Usuario existente' ));                  //si existe envia el emnsaje de usuario existente
                    $this->output->set_status_header(401);                                  //envio de estatus de error en este caso 401
                    var_dump($res);                                                         //envio de la respuesta 
                    exit;                                                                   //salida del proceso
            }else{                                                                          // si el usuario no existe
                    $doc =$this->input->post('USER_identification');    
                    $name       = $this->input->post('USER_names');                         // obtencion de todos los datos del formulario
                    $lastname   = $this->input->post('USER_lastnames');
                    $email      = $this->input->post('USER_email');
                    $password   = $this->input->post('USER_password');
                    $address    = $this->input->post('USER_address');
                    $telephone  = $this->input->post('USER_telephone');
                    $state      = $this->input->post('USER_FK_state');
                    $type_identification= $this->input->post('USER_FK_type_identification');
                    $gander     = $this->input->post('USER_FK_gander');
                    $data= array(
                        'USER_identification'=> $doc,
                        'USER_PK'=> $doc,
                        'USER_username' =>$name.$lastname,
                        'USER_names'    =>$name,
                        'USER_lastnames'=>$lastname,
                        'USER_email'    =>$email,
                        'USER_password' =>$password,
                        'USER_address'  =>$address,
                        'USER_telephone'=>$telephone,
                        'USER_date_create'=>date("Y-m-d H:i:s"),
                        'USER_date_update'=>date("Y-m-d H:i:s"),
                        'USER_PK_create'=>$this->session->userdata('id'),
                        'USER_PK_update'=>$this->session->userdata('id'),
                        'USER_FK_state' =>1,
                        'USER_FK_type_identification' =>$type_identification,
                        'USER_FK_gander'=>$gander,
                    );
                
                    if(!$this->Users->registrar($data)){                                    //registro del usuarios en caso de erro envia mensaje de error si no confirma la accion de gardar
                        echo "error";
                    }
                    echo json_encode(array('msg'=> 'usuario guardado' ));
                    
            }
            
            var_dump($res);
        }
    }
    
    /**
    * funcion de perfil, redirecciona  si no existe sesion  a la vista de login.
    *
    * @return redirect() | view()
    */
    public function perfil(){
        if($this->session->userdata('logueado')){                                               //verifica si el usuario esta logueado
                $data = array();                                                                //creacion de vector con los datos de inicio de sesion
                $data['nombre'] = $this->session->userdata('nombre');
                $data['id'] =$this->session->userdata('id');
                $data['apellido']= $this ->session->userdata('apellido');
                $data['email']= $this ->session->userdata('email');
                $data['password']= $this ->session->userdata('password');
                $data['address']= $this ->session->userdata('address');
                $data['telephone']= $this ->session->userdata('telephone');
                $data['state']= $this ->session->userdata('state');
                $data['type_identification']= $this ->session->userdata('type_identification');
                $data['gander']= $this ->session->userdata('gander');
                $this->load->view('private/perfil', $data);                                     //envio de vista perfil con los datos de la persona logueada
            }else{
                redirect('index.php/login');                                                    // si no se encuentra logueado redirecciona al login
            }
    }
    
    /**
    * funcion para retonar la vista principal donde se listan los usuarios.
    *
    * @return  view()
    */
    public function listarUsuarios(){
        $this->load->view('private/listar_usuarios');
    }
    /**
    * funcion para retonar la vista ajax principal donde se listan los usuarios.
    *
    * @return  view()
    */
    public function listarUsuariosAjax(){
        $this->load->view('private/view_ajax/listar_usuarios_ajax');
    }
    
    /**
    * funcion para enviar los datos pertinetes a la tabla para listar los usuarios.
    *
    * @return  json_encode()
    */
    public function listarTabla(){
        $draw = intval($this->input->get("draw"));          //trae las varibles draw, start, length para la creacion de la tabla
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $data =$this->Users->listar();                      //utiliza el metodo listar() del modelo users() para traer los datos de todos los usuarios 
        foreach($data->result() as $r) {                    //ciclo para la creacion de las filas y columnas de la tabla de datos incluye los botones de acciones
            $dato[] = array(                                //creacion de la matriz que lleva todos los datos
                $r->USER_identification,
                $r->USER_names,
                $r->USER_lastnames,
                $r->USER_email,
                $r->USER_telephone,
                $r->USER_address,
                $r->STTS_state,
                '<input type="button" class="btn btn-warning fa fa-remove edit" title="Editar un usuario" id="'.$r->USER_PK.'" value="editar" ><input type="button" class="btn btn-danger fa fa-remove remove" title="Eliminar un usuario" id="'.$r->USER_PK.'" value="eliminar" ><input type="button" class="btn btn-info fa fa-remove asignar" title="Asignar un rol" id="'.$r->USER_PK.'" value="asignar" >',
            );
        }
        $output = array(                                    //creacion del vector de salida
            "draw" => $draw,                                //envio la variable de dibujo de la tabla                    
            "recordsTotal" =>$data->num_rows(),             //envia el numero de filas  para saber cuantos usuarios son en total
            "recordsFiltered" => $data->num_rows(),         //envio el numero de filas para el calculo de la paginacion de la tabla
            "data" => $dato                                 //envia todos los datos de la tabla
        );
        echo json_encode($output);                          //envio del vector de salida con los parametros correspondientes
        exit;                                               //salida del proceso
    }   
    
    /**
    *funcion para  eliminar los usuarios.
    *@param  int $doc
    *@return  json_encode() | set_status_header()
    */
    public function eliminarUsuario($doc){
        if($res = $this->Users->eliminar($doc)){                                //realiza la verificacion y eliminacion del usuario
            echo json_encode(array('msg'=> 'Usuario eliminado exitosamente' )); // si el usuario fue eliminado correctamenre envia el mensaje de confirmacion
        }else{                                                                  //si no fue posible eliminarlo
            echo json_encode($res);                                             //envio de la respueta
            $this->output->set_status_header(403);                              //envio del status de error en este caso 403
        }
    }
    
    /**
    *funcion para redirecionar a la visa de editar la informacion de los usuarios.
    *@param  int $doc
    *@return  view()
    */
    public function editarUsuario($doc){
        $data=$this->Users->datosUsuario($doc);                                         //verifica por medio del metodo datosUsiarios() del modelo users() si el usuario existe ytae todos los datos pertinentes al usuario 
        foreach($data->result() as $r) {                                                //ciclop para  convertir los datos en un arreglo
            $dato = array();                                                            //creacion del vector que contendra los datos del usuario
            $dato['USER_PK'] = $r->USER_PK;
            $dato['USER_identification'] = $r->USER_identification;
            $dato['USER_names'] = $r->USER_names;
            $dato['USER_lastnames']= $r->USER_lastnames;
            $dato['USER_email']= $r->USER_email;
            $dato['USER_password']= $r->USER_password;
            $dato['USER_address']= $r->USER_address;
            $dato['USER_telephone']= $r->USER_telephone;
            $dato['USER_FK_state']= $r->USER_FK_state;
            $dato['USER_FK_type_identification']= $r->USER_FK_type_identification;
            $dato['USER_FK_gander']= $r->USER_FK_gander;
            $dato['STTS_state']= $r->STTS_state;
            $dato['TPDI_type_identification']= $r->TPDI_type_identification;
            $dato['GNDR_gander']= $r->GNDR_gander;
        }
        $this->load->view('private/view_ajax/editar_usuario_ajax',$dato);               //envio de la vista y los datos para la edicion de los usuarios
    }
    
    /**
    *funcion para la modificacion de  la informacion de los usuarios.
    *@param  int $doc
    *@return  view()
    */
    public function modificarUsuario($doc){
        $this->form_validation->set_error_delimiters('','');                        //quita los delimtadores de error
        $rules=getRulesAddUsers();                                                  //utiliza las reglas de agregar usuario para validar los campos del formulario
        $this->form_validation->set_rules($rules);                                  //ejecuta las reglas del fromulario 
        if($this->form_validation->run() === FALSE){                                //si se incumple algunade las regla
            $errors = array(                                                        //creacion del vector de los errores
                'USER_identification'=> form_error('USER_identification'),
                'USER_names'    => form_error('USER_names'),
                'USER_lastnames'=> form_error('USER_lastnames'),
                'USER_email'    => form_error('USER_email'),
                'USER_address'  => form_error('USER_address'),
                'USER_telephone'=> form_error('USER_telephone'),
                'USER_password' => form_error('USER_password'),
            );
            echo json_encode($errors);                                              //envio del vector de errores
            $this->output->set_status_header(402);                                  //envio del estatus del error en este caso 402
        }else{                                                                      //si las reglas fueron cumplidas
            $pk         = $this->input->post('USER_identification');                              //obtencion de todos los datos del formulario
            $name       = $this->input->post('USER_names');
            $lastname   = $this->input->post('USER_lastnames');
            $email      = $this->input->post('USER_email');
            $password   = $this->input->post('USER_password');
            $address    = $this->input->post('USER_address');
            $telephone  = $this->input->post('USER_telephone');
            $state      = $this->input->post('USER_FK_state');
            $type_identification= $this->input->post('USER_FK_type_identification');
            $gander     = $this->input->post('USER_FK_gander');
            $data= array(                                                           //creacion del vector de los nuevos datos del usuario
                'USER_identification'           =>  $pk,
                'USER_username'                 =>  $name.$lastname,
                'USER_names'                    =>  $name,
                'USER_lastnames'                =>  $lastname,
                'USER_email'                    =>  $email,
                'USER_password'                 =>  $password,
                'USER_address'                  =>  $address,
                'USER_telephone'                =>  $telephone,
                'USER_date_update'=>date("Y-m-d H:i:s"),
                'USER_PK_update'=>$this->session->userdata('id'),
                'USER_FK_state'                 =>  $state,
                'USER_FK_type_identification'   =>  $type_identification,
                'USER_FK_gander'                =>  $gander,
            );
            if(!$this->Users->modificarUsuario($doc,$data)){                        //utilizacion del metodo modificarUsuarios() del modelo users() para la modificacion del usuario  enviando el id y los datos pertinentes
                echo "error";                                                       // en caso de  fallar envia un mensaje de error
            }
            echo json_encode(array('msg'=> 'usuario modificado' ));                 // si fue modificado con exito envia el mensaje correspondiente
        }
    }
    
     /**
    * funcion de perfil, redirecciona  si no existe sesion  a la vista de login.
    *
    * @return redirect() | view()
    */
    public function AsignarRol($doc){
        $data['id'] =$doc;
        $data['tabla']=$this->Role->listar();
        $this->load->view('private/view_ajax/asignacion_roles_ajax',$data);
    }
    
}
