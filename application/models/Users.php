<?php
class Users extends CI_Model {
    public function __construct(){
        
    }
    public function verificarUsuario($doc){
        $rep=$this->db->select('USER_PK')->get_where('users',array('USER_PK' => $doc), 1);
        if (!$rep->result()){
            return FALSE;
        }
        $consulta =$rep;
        return $consulta->row();
    }
    public function registrar($datos){
        if(!$this->db->insert('users',$datos)){
            return false;
        }
        return true;
    }
    public function listar(){
        $usuarios = $this->db->select('*')->from('users')->join('states','users.USER_FK_state = states.STTS_PK')->join('ganders','users.USER_FK_gander = ganders.GNDR_PK')->join('types_identifications','users.USER_FK_type_identification = types_identifications.TPDI_PK');
        return $usuarios->get();
    }

}