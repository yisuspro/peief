<?php

/**
*
*@autor jesus andres castellanos aguilar
*
* controlador encargado de todos los procesos referente a los usuarios
* 
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class Seeders extends CI_Controller{
    
    /**
    * metodo cnstructor donde se cargan todos los helpers, librerias y modelos necesarios en el controlador
    *@library 
    *@model  users()|logueo()
    *@helper login_rules() |url() |form ()
    * 
    */
    function __construct() {
        parent::__construct ();
        $this->load->model('Permits');
        $this->load->model('Logueo');
        $this->load->model('Cicle');
        $this->load->model('Focu');
        $this->load->model('Learning_unit');
        $this->load->model('Plan');
        $this->load->model('Role');
        $this->load->model('Subject');
        $this->load->model('Users');
        $this->load->model('version');
    }
    
    /**
    * funcion para mostrar la  vista principal el cual es perfil.
    *
    * @return view ()
    */
    public function index(){
        $users= array(
            'USER_identification'   => 1073246137,
            'USER_username'         =>'yisuspro69',+
            'USER_names'            =>'jesus andres',
            'USER_lastnames'        =>'castellanos',
            'USER_email'            =>'adminuni@hotmail.com',
            'USER_password'         =>'123456',
            'USER_address'          =>'kr 2 n 12a-66',
            'USER_telephone'        =>3212214497,
            'USER_date_create'      =>date("Y-m-d H:i:s"),
            'USER_date_update'      =>date("Y-m-d H:i:s"),
            'USER_PK_create'        =>$this->session->userdata('id'),
            'USER_PK_update'        =>$this->session->userdata('id'),
            'USER_FK_state'         =>1,
            'USER_FK_type_identification'=>1,
            'USER_FK_gander'        =>1,
        );
        $this->Users->registrar($users);
    }
    
   
}