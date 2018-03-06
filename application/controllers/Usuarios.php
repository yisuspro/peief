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
        $this->load->model(['Users','Logueo','Role']);
        $this->load->helper(['login_rules','url','form']);
        date_default_timezone_set('UTC');
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
                    // obtencion de todos los datos del formulario
                    $data= array(
                        'USER_identification'          =>   $this->input->post('USER_identification'),
                        'USER_PK'                      =>   $this->input->post('USER_identification'),
                        'USER_username'                =>   $this->input->post('USER_names').$this->input->post('USER_lastnames'),
                        'USER_names'                   =>   $this->input->post('USER_names'),
                        'USER_lastnames'               =>   $this->input->post('USER_lastnames'),
                        'USER_email'                   =>   $this->input->post('USER_email'),
                        'USER_password'                =>   $this->input->post('USER_password'),
                        'USER_address'                 =>   $this->input->post('USER_address'),
                        'USER_telephone'               =>   $this->input->post('USER_telephone'),
                        'USER_date_create'             =>   date("Y-m-d H:i:s"),
                        'USER_date_update'             =>   date("Y-m-d H:i:s"),
                        'USER_PK_create'               =>   $this->session->userdata('id'),
                        'USER_PK_update'               =>   $this->session->userdata('id'),
                        'USER_FK_state'                =>   1,
                        'USER_FK_type_identification'  =>   $this->input->post('USER_FK_type_identification'),
                        'USER_FK_gander'               =>   $this->input->post('USER_FK_gander')
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
        if($this->session->userdata('logueado') == FALSE){   //verifica si existe un usuario logueado
            redirect(base_url());
        }           
        $data = array(                      //creacion de vector con los datos de inicio de sesion
            'nombre'                =>  $this->session->userdata('nombre'),
            'id'                    =>  $this->session->userdata('id'),
            'apellido'              =>  $this ->session->userdata('apellido'),
            'email'                 =>  $this ->session->userdata('email'),
            'password'              =>  $this ->session->userdata('password'),
            'address'               =>  $this ->session->userdata('address'),
            'telephone'             =>  $this ->session->userdata('telephone'),
            'state'                 =>  $this ->session->userdata('state'),
            'type_identification'   =>  $this ->session->userdata('type_identification'),
            'gender'                =>  $this ->session->userdata('gender'),
        );         
        
        $data['title'] ='Perfil';                                                       //Titulo de pagina
                    
        $this->load->view('private/heads/head_1',$data);
        $this->load->view('private/heads/head_2');
        $this->load->view('private/heads/menus');
        $this->load->view('private/perfil', $data);                             //envio de vista perfil con los datos de la persona logueada   
        $this->load->view('private/footers/foot_1');
        $this->load->view('private/footers/foot_3');
        $this->load->view('private/footers/foot_2');
    }
    
    /**
    * funcion para retonar la vista principal donde se listan los usuarios.
    *
    * @return  view()
    */
    public function listarUsuarios(){
        $data['title']='Listar Usuarios';                                                      //Titulo de pagina
        
        $this->load->view('private/heads/head_1',$data);
        $this->load->view('private/heads/head_2');
        $this->load->view('private/heads/menus');
        $this->load->view('private/listar_usuarios', $data);    
        $this->load->view('private/footers/foot_1');
        $this->load->view('private/footers/foot_2');
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
        $output = array(                                    //creacion del vector de salida
            "draw" => $draw,                                //envio la variable de dibujo de la tabla                    
            "recordsTotal" =>$data->num_rows(),             //envia el numero de filas  para saber cuantos usuarios son en total
            "recordsFiltered" => $data->num_rows(),         //envio el numero de filas para el calculo de la paginacion de la tabla
            "data" => $data->result_array()       //envia todos los datos de la tabla
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
        $data=$this->Users->datosUsuario($doc)->result_array()[0];                                         //verifica por medio del metodo datosUsiarios() del modelo users() si el usuario existe ytae todos los datos pertinentes al usuario 
        $this->load->view('private/view_ajax/editar_usuario_ajax',$data);               //envio de la vista y los datos para la edicion de los usuarios
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
                'USER_names'         => form_error('USER_names'),
                'USER_lastnames'     => form_error('USER_lastnames'),
                'USER_email'         => form_error('USER_email'),
                'USER_address'       => form_error('USER_address'),
                'USER_telephone'     => form_error('USER_telephone'),
                'USER_password'      => form_error('USER_password'),
            );
            echo json_encode($errors);                                              //envio del vector de errores
            $this->output->set_status_header(402);                                  //envio del estatus del error en este caso 402
        }else{                                                                      //si las reglas fueron cumplidas
            //obtencion de todos los datos del formulario
            $data= array(                                                           //creacion del vector de los nuevos datos del usuario
                'USER_identification'           =>  $this->input->post('USER_identification'),
                'USER_username'                 =>  $this->input->post('USER_names').$this->input->post('USER_lastnames'),
                'USER_names'                    =>  $this->input->post('USER_names'),
                'USER_lastnames'                =>  $this->input->post('USER_lastnames'),
                'USER_email'                    =>  $this->input->post('USER_email'),
                'USER_password'                 =>  $this->input->post('USER_password'),
                'USER_address'                  =>  $this->input->post('USER_address'),
                'USER_telephone'                =>  $this->input->post('USER_telephone'),
                'USER_date_update'              =>  date("Y-m-d H:i:s"),
                'USER_PK_update'                =>  $this->session->userdata('id'),
                'USER_FK_state'                 =>  $this->input->post('USER_FK_state'),
                'USER_FK_type_identification'   =>  $this->input->post('USER_FK_type_identification'),
                'USER_FK_gander'                =>  $this->input->post('USER_FK_gander')
            );
            
            if(!$this->Users->modificarUsuario($doc,$data)){                    //utilizacion del metodo modificarUsuarios() del modelo users() para la modificacion del usuario  enviando el id y los datos pertinentes
                echo "error"; 
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
