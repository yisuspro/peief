<?php

/**
*
*@autor jesus andres castellanos aguilar
*
* modelor encargado de todos los procesos referente a los permisos
* 
* contiene todas las consultas sql a la base de datos
* 
*/
class Version extends CI_Model {
    
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
    * funcion para la verificacion y envio de los datos del rol solicitado.
    * @param int $datos
    * @return get() | false
    */
    public function datosVersion($datos){
        if(!$rol= $this->db->select('*')->from('versions')->where('VRSN_PK',$datos)){
            return false;
        }else{
            return $rol->get();
        }
    }
    /**
    * funcion para la consulta de todos los roles a la base de datos.
    * 
    * @return get() 
    */
    public function listar(){
        $rol= $this->db->select('*')->from('versions');
        return $rol->get();
    }
    
   
    /**
    * funcion para la eliminacion de un rol de la base de datos
    * @param int $datos
    * @return true | false
    */
    public function eliminar($datos){
        if(!$this->db->delete('versions', array('VRSN_PK' => $datos))){
            return FALSE;
        }
        return true;
    }
    
    /**
    * funcion para la modificacion de datos de los roles en la base de datos 
    * @param int $datos
    * @return true | false
    */
    public function modificarVersion($datos,$datos2){
        $this->db->where('VRSN_PK', $datos);
        if($this->db->update('versions', $datos2)){
            return true;
        }else{
            return false;
        }
    }
    /**
    * funcion para agregar nuevos datos de roles en la base de datos
    * @param int $datos
    * @return true | false
    */
    public function agregarVersion($datos){
         if(!$this->db->insert('versions',$datos)){
            return false;
        }
        return true;
    }
}