<?php
class Users extends CI_Model {
    public function __construct(){
        
    }
    public function registrar($datos){
         
        if(!$this->db->insert('users',$datos)){
            return false;
        }
        return true;
    }
    public function listar(){
        $usuarios = $this->db->select('USER_PK, USER_names')->from('users')->get();
        return $usuarios;
    }

}