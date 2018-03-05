<?php

/**
*
*@autor jesus andres castellanos aguilar
*
* modelor encargado de todos los procesos referente a las asignaturas
* 
* contiene todas las consultas sql a la base de datos
* 
*/
class Subject extends CI_Model {
    
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
    public function datosAsignatura($datos){
        if(!$permiso= $this->db->select('*')->from('subjects')->join('learning_units','subjects.SBJC_FK_learning_units = learning_units.LNUT_PK')->where('SBJC_PK',$datos)){
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
        $permiso= $this->db->select('*')->from('subjects')->join('learning_units','subjects.SBJC_FK_learning_units = learning_units.LNUT_PK');
        return $permiso->get();

    
    }
    
    /**
    * funcion para la eliminacion de un permiso de la base de datos
    * @param int $datos
    * @return true | false
    */
    public function eliminar($datos){
        if(!$this->db->delete('subjects', array('SBJC_PK' => $datos))){
            return FALSE;
        }
        return true;
    }
    
    /**
    * funcion para la modificacion de datos de los permisos en la base de datos 
    * @param int $datos
    * @return true | false
    */
    public function modificarAsignatura($datos,$datos2){
        $this->db->where('SBJC_PK', $datos);
        if($this->db->update('subjects', $datos2)){
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
    public function agregarAsignatura($datos){
         if(!$this->db->insert('subjects',$datos)){
            return false;
        }
        return true;
    }
    
    
    
}