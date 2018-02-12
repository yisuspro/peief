<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class login extends CI_Controller
{
    
    function __construct() {
        parent::__construct ();
        
        $this->load->model('Logueo');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper('login_rules');
        
      
    }
    
    public function index(){
        $this->load->view('public/login');
        
    }
    
    
    public function validate(){
        $this->form_validation->set_error_delimiters('','');
        $rules= getRulesLogin();
        $this->form_validation->set_rules($rules);
        if($this->form_validation->run() === FALSE){
            $errors = array(
                'email'=> form_error('email'),
                'password'=> form_error('password')
            );
            echo json_encode($errors);
            $this->output->set_status_header(401);
        }else{
            $email= $this->input->post('email');
            $pass= $this->input->post('password');
            if(!$res = $this->Logueo->login($email,$pass)){
                echo json_encode(array('msg'=> 'Verifique sus credenciales' ));
                $this->output->set_status_header(402);
                var_dump($res);
                exit;
            }else{
                $usuario_data = array(
                    'id'        => $res->USER_PK,
                    'nombre'    => $res->USER_names,
                    'apellido'    => $res->USER_lastnames,
                    'email'    => $res->USER_email,
                    'password'    => $res->USER_password,
                    'address'    => $res->USER_address,
                    'telephone'    => $res->USER_telephone,
                    'state'    => $res->STTS_state,
                    'type_identification'    => $res->TPDI_type_identification,
                    'gander'    => $res->GNDR_gander,
                    'logueado'  => TRUE,
            );
            $this->session->set_userdata($usuario_data);
            }
            var_dump($res);
        }
    }
    
     public function logout(){
         $usuario_data = array(
             'logueado' => FALSE
         );
         $this->session->set_userdata($usuario_data);
         redirect('index.php/login');
     }
    
    
}
