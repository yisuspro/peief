<?php
/**
*
*@autor jesus andres castellanos aguilar
*
* modelor encargado de todos los procesos referente a el inicio de sesion de usuarios
* 
* contiene todas las consultas sql a la base de datos
* 
*/
class Logueo extends CI_Model {
    
    /**
    * metodo constructor donde se cargan todos los helpers, librerias necesarios en el modelo
    *@library 
    *
    *@helper 
    * 
    */
    public function __construct(){
        
    }
    
    /**
    * funcion para la verificacion y envio de los datos dell usuario logueado.
    *
    * @return row() | false
    */
    public function login($email,$password){
        $rep=$this->db->select('*')->join('states','users.USER_FK_state = states.STTS_PK')->join('ganders','users.USER_FK_gander = ganders.GNDR_PK')->join('types_identifications','users.USER_FK_type_identification = types_identifications.TPDI_PK')->get_where('users',array('USER_email' => $email,'USER_password'=> $password), 1);
        if (!$rep->result()){
            return FALSE;
        }
        $consulta =$rep;
        return $consulta->row();
    }
}
