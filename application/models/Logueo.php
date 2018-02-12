<?php

class Logueo extends CI_Model {
    
    public function __construct(){
        
    }
    
    public function login($email,$password){
         $rep=$this->db->select('*')->join('states','users.USER_FK_state = states.STTS_PK')->join('ganders','users.USER_FK_gander = ganders.GNDR_PK')->join('types_identifications','users.USER_FK_type_identification = types_identifications.TPDI_PK')->get_where('users',array('USER_email' => $email,'USER_password'=> $password), 1);
        if (!$rep->result()){
            return FALSE;
        }
        $consulta =$rep;
       
        return $consulta->row();
    }
}
