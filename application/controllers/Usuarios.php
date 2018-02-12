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
                redirect('login');
            }
    }
    
    
    public function listarUsuarios(){
        $this->load->view('private/listar_usuarios');
    }
    
    
    public function listarTabla(){
            $draw = intval($this->input->get("draw"));
            $start = intval($this->input->get("start"));
            $length = intval($this->input->get("length"));
            $data =$this->Users->listar();
             
        foreach($data->result() as $r) {

               $dato[] = array(
                    $r->USER_PK,
                    $r->USER_names
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
}

