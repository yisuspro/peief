<?php

/**
*
*@autor jesus andres castellanos aguilar
*
* modelor encargado de todos los procesos referente a los roles
* 
* contiene todas las consultas sql a la base de datos
* 
*/
class Plan extends CI_Model {
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
    public function datosPlan($datos){
        if(!$rol= $this->db->select('*')->from('plans')->where('PLAN_PK',$datos)){
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
        $rol= $this->db->select('*')->from('plans');
        return $rol->get();
    }
    
    /**
    * funcion para la eliminacion de un rol de la base de datos
    * @param int $datos
    * @return true | false
    */
    public function eliminar($datos){
        if(!$this->db->delete('plans', array('PLAN_PK' => $datos))){
            return FALSE;
        }
        return true;
    }
    
    /**
    * funcion para la modificacion de datos de los roles en la base de datos 
    * @param int $datos
    * @return true | false
    */
    public function modificarPlan($datos,$datos2){
        $this->db->where('PLAN_PK', $datos);
        if($this->db->update('plans', $datos2)){
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
    public function agregarPlan($datos){
         if(!$this->db->insert('plans',$datos)){
            return false;
        }
        return true;
    }
    
    public function listarVersionPlan($id){
        $version= $this->db->select('*')->from('versions_plans')->join('versions','versions_plans.VRPL_FK_versions = versions.VRSN_PK')->where('VRPL_FK_plans',$id);
        return $version->get();
    }
    /**
    * funcion para la eliminacion de un permiso asignado a un rol de la base de datos
    * @param int $datos
    * @return true | false
    */
    public function eliminarVersionPlan($datos){
        if(!$this->db->delete('versions_plans', array('VRPL_PK' => $datos))){
            return FALSE;
        }
        return true;
    }
    /**
    * funcion para la eliminacion de un permiso asignado a un rol de la base de datos
    * @param int $datos
    * @return true | false
    */
    public function consultarVersioPlan($plan,$version){
        $where= "VRPL_FK_versions ='".$version."' AND VRPL_FK_plans ='".$plan."'";
         if($this->db->from('versions_plans')->where($where)->get()->result()){
            return true;
        }
    }
    
    /**
    * funcion para la eliminacion de un permiso asignado a un rol de la base de datos
    * @param int $datos
    * @return true | false
    */
    public function asignarVersion($datos){
         if(!$this->db->insert('versions_plans',$datos)){
            return false;
        }
    }
}