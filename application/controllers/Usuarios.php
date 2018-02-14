<?php
/**
*@autor jesus andres castellanos aguilar
* controlador encargado de todos los procesos referente a los usuarios
*
* 
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class Usuarios extends CI_Controller
{
    /**
    * metodo cnstructor donde se cargan todos los helpers, librerias y modelos necesarios en el controlador
    *
    * 
    */
    function __construct() {
        parent::__construct ();
        
        $this->load->model('Users');
        $this->load->model('Logueo');
        $this->load->helper('login_rules');
        $this->load->helper('url');
        $this->load->helper('form');
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
    * @return json_encode() | var_dump()
    */
    public function registrar(){
        $this->form_validation->set_error_delimiters('','');
        $rules=getRulesAddUsers();
        $this->form_validation->set_rules($rules);
        if($this->form_validation->run() === FALSE){
            $errors = array(
                'USER_PK'       => form_error('USER_PK'),
                'USER_names'    => form_error('USER_names'),
                'USER_lastnames'=> form_error('USER_lastnames'),
                'USER_email'    => form_error('USER_email'),
                'USER_address'  => form_error('USER_address'),
                'USER_telephone'=> form_error('USER_telephone'),
                'USER_password' => form_error('USER_password'),
            );
            echo json_encode($errors);
            $this->output->set_status_header(402);
        }else{
            $doc =$this->input->post('USER_PK');
            
            if($res = $this->Users->verificarUsuario($doc)){
                    echo json_encode(array('msg'=> 'Usuario existente' ));
                    $this->output->set_status_header(401);
                    var_dump($res);
                    exit;
            }else{
                    $name       = $this->input->post('USER_names');
                    $lastname   = $this->input->post('USER_lastnames');
                    $email      = $this->input->post('USER_email');
                    $password   = $this->input->post('USER_password');
                    $address    = $this->input->post('USER_address');
                    $telephone  = $this->input->post('USER_telephone');
                    $state      = $this->input->post('USER_FK_state');
                    $type_identification= $this->input->post('USER_FK_type_identification');
                    $gander     = $this->input->post('USER_FK_gander');
                    $data= array(
                        'USER_PK' =>$doc,
                        'USER_username' =>$name.$lastname,
                        'USER_names'    =>$name,
                        'USER_lastnames'=>$lastname,
                        'USER_email'    =>$email,
                        'USER_password' =>$password,
                        'USER_address'  =>$address,
                        'USER_telephone'=>$telephone,
                        'USER_FK_state' =>1,
                        'USER_FK_type_identification' =>$type_identification,
                        'USER_FK_gander'=>$gander,
                    );
                
                    if(!$this->Users->registrar($data)){
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
        if($this->session->userdata('logueado')){
                $data = array();
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
                $this->load->view('private/perfil', $data);
            
            }else{
                redirect('index.php/login');
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
    * funcion para enviar los datos pertinetes a la tabla para listar los usuarios.
    *
    * @return  json_encode()
    */
    public function listarTabla(){
            $draw = intval($this->input->get("draw"));
            $start = intval($this->input->get("start"));
            $length = intval($this->input->get("length"));
            $data =$this->Users->listar();
             
        foreach($data->result() as $r) {

               $dato[] = array(
                    $r->USER_PK,
                    $r->USER_names,
                    $r->USER_lastnames,
                    $r->USER_email,
                    $r->USER_telephone,
                    $r->USER_address,
                    $r->STTS_state,
                    '<input type="button" class="btn btn-warning fa fa-remove edit"  id="'.$r->USER_PK.'" value="editar" ><input type="button" class="btn btn-danger fa fa-remove remove"  id="'.$r->USER_PK.'" value="eliminar" >',
                   
               );
          }
            $output = array(
                 "draw" => $draw,
                "recordsTotal" =>$data->num_rows() ,
                 "recordsFiltered" => $data->num_rows(),
                 "data" => $dato
            );
        echo json_encode($output);
        exit;
    }
    
    /**
    * funcion para  eliminar los usuarios.
    *
    * @return  json_encode()
    */
    public function eliminarUsuario($doc){
        if($res = $this->Users->eliminar($doc)){
            echo json_encode(array('msg'=> 'Usuario eliminado exitosamente' ));
        }else{
            echo json_encode($res);
            $this->output->set_status_header(403);
        }
    }
    
    public function editar(){
        $this->load->view('private/editar');
    }
}

