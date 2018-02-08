<?php

class Logueo extends CI_Model {
    
    public function __construct(){
        
    }
    
    public function login($email,$password){
         $rep=$this->db->get_where('users', array('USER_email' => $email,'USER_password'=> $password), 1);
        if (!$rep->result()){
            return FALSE;
        }
        return $rep->result();
        
    }
}
