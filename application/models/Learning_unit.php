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
class Learning_unit extends CI_Model {
    
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
    * funcion para la verificacion y envio de los datos del permiso solicitado.
    * @param int $datos
    * @return get() | false
    */
    public function datosUnidad($datos){
        if(!$permiso= $this->db->select('*')->from('learning_units')->join('focus','learning_units.LNUT_FK_focus = focus.FOCS_PK')->where('LNUT_PK',$datos)){
            return false;
        }else{
            return $permiso->get();
        }
    }
    
    /**
    * funcion para la consulta de todos los permisos a la base de datos.
    * 
    * @return get() 
    */
    public function listar(){
        $permiso= $this->db->select('*')->from('learning_units')->join('focus','learning_units.LNUT_FK_focus = focus.FOCS_PK');
        return $permiso->get();
    }
    
    /**
    * funcion para la consulta de todos los permisos de un rol a la base de datos.
    * 
    * @return get() 
    */
    public function listarPermisoRol($id){
        $permiso= $this->db->select('*')->from('roles_permits')->join('permits','roles_permits.RLPR_FK_permits = permits.PRMS_PK')->where('RLPR_FK_roles',$id);
        return $permiso->get();
    }
    
    /**
    * funcion para la eliminacion de un permiso de la base de datos
    * @param int $datos
    * @return true | false
    */
    public function eliminar($datos){
        if(!$this->db->delete('learning_units', array('LNUT_PK' => $datos))){
            return FALSE;
        }
        return true;
    }
    
    /**
    * funcion para la modificacion de datos de los permisos en la base de datos 
    * @param int $datos
    * @return true | false
    */
    public function modificarUnidad($datos,$datos2){
        $this->db->where('LNUT_PK', $datos);
        if($this->db->update('learning_units', $datos2)){
            return true;
        }else{
            return false;
        }
    }
    
    /**
    * funcion para agregar nuevos datos de permisos en la base de datos
    * @param int $datos
    * @return true | false
    */
    public function agregarUnidad($datos){
         if(!$this->db->insert('learning_units',$datos)){
            return false;
        }
        return true;
    }
    
    
    
}