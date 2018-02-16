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
    
    public function eliminar($datos){
        if(!$this->db->delete('users', array('USER_PK' => $datos))){
            return FALSE;
        }
        return true;
    }
    public function datosUsuario($datos){
        if(!$usuario= $this->db->select('*')->from('users')->where('USER_PK',$datos)->join('states','users.USER_FK_state = states.STTS_PK')->join('ganders','users.USER_FK_gander = ganders.GNDR_PK')->join('types_identifications','users.USER_FK_type_identification = types_identifications.TPDI_PK')){
            return false;
        }else{
            return $usuario->get();
        }
    }
    public function modificarUsuario($datos,$datos2){
        $this->db->where('USER_PK', $datos);
        if($this->db->update('users', $datos2)){
            return true;
        }else{
            return false;
        }
    }

}