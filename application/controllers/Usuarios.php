<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Usuarios extends CI_Controller
{
    
    function __construct() {
        parent::__construct ();
        
        $this->load->model('Logueo');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('Users');
        
      
    }
    public function index(){
        $this->load->view('public/registro');
    }
    public function registrar(){
        $this->load->model('Users');
        $username= $this->input->post('username');
        $name= $this->input->post('name');
        $lastname= $this->input->post('lastname');
        $mail= $this->input->post('mail');
        $password= $this->input->post('password');
        $data= array(
            'USER_username' =>$username,
            'USER_names'    =>$name,
            'USER_lastnames'=>$lastname,
            'USER_email'    =>$mail,
            'USER_password' =>$password,
        );
        
        if(!$this->Users->registrar($data)){
            echo "error";
        }
        $this->load->view('public/registro');
    }
    public function perfil(){
        $this->load->view('private/perfil');
    }
}
