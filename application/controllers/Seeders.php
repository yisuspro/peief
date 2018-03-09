<?php
 
/**
*
*@autor jesus andres castellanos aguilar
*
* controlador encargado de todos los procesos referente a los usuarios
* 
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class Seeders extends CI_Controller{
    
    /**
    * metodo cnstructor donde se cargan todos los helpers, librerias y modelos necesarios en el controlador
    *@library 
    *@model  users()|logueo()
    *@helper login_rules() |url() |form ()
    * 
    */
    function __construct() {
        parent::__construct ();
        $this->load->model(['Permits','Logueo','Cicle','Focu','Learning_unit','Plan','Role','Subject','Users','version']);
    }
    
    /**
    * funcion para mostrar la  vista principal el cual es perfil.
    *
    * @return view ()
    */
    public function index(){
        
       $state= array( 
            'STTS_PK'   =>  1,
            'STTS_state'=> 'Activo',
            
        );
        $this->Users->agregarEstado($state);
        $state= array( 
            'STTS_PK'   =>  2,
            'STTS_state'=> 'Inactivo',
            
        );
        $this->Users->agregarEstado($state);
        $typedoc= array(
            'TPDI_PK'=> 1,
            'TPDI_type_identification'=> 'cedula',
            
        );
        $this->Users->registrarT($typedoc);
        $typedoc= array(
            'TPDI_PK'=> 2,
            'TPDI_type_identification'=> 'tarjeta de identidad',
            
        );
        $this->Users->registrarT($typedoc);
        $typedoc= array(
            'TPDI_PK'=> 3,
            'TPDI_type_identification'=> 'registro civil',
            
        );
        $this->Users->registrarT($typedoc);
        $typedoc= array(
            'TPDI_PK'=> 4,
            'TPDI_type_identification'=> 'visa de extrangeria',
            
        );
        $this->Users->registrarT($typedoc);
        $typedoc= array(
            'TPDI_PK'=> 5,
            'TPDI_type_identification'=> 'otro',
            
        );
        $this->Users->registrarT($typedoc);
        $genders= array(
            'GNDR_PK'=> 1,
            'GNDR_gender'=> 'masculino',
            
        );
        $this->Users->registrarG($genders);
         $genders= array(
            'GNDR_PK'=> 2,
            'GNDR_gender'=> 'femeninio',
            
        );
        $this->Users->registrarG($genders);
         $genders= array(
            'GNDR_PK'=> 3,
            'GNDR_gender'=> 'otro',
            
        );
        $this->Users->registrarG($genders);
        $users= array(
            'USER_PK'               => 1,
            'USER_identification'   => 1073246137,
            'USER_username'         =>'yisuspro69',
            'USER_names'            =>'jesus andres',
            'USER_lastnames'        =>'castellanos',
            'USER_email'            =>'adminuni@hotmail.com',
            'USER_password'         =>'123456',
            'USER_address'          =>'kr 2 n 12a-66',
            'USER_telephone'        =>3212214497,
            'USER_date_create'      =>date("Y-m-d H:i:s"),
            'USER_date_update'      =>date("Y-m-d H:i:s"),
            'USER_PK_create'        =>1,
            'USER_PK_update'        =>1,
            'USER_FK_state'         =>1,
            'USER_FK_type_identification'=>1,
            'USER_FK_gender'        =>1,
        );
        $this->Users->registrar($users);
         
        $role= array(
            'ROLE_PK'           =>1,
            'ROLE_name'         =>'super admin',
            'ROLE_shortname'    =>'super_admin',
            'ROLE_description'  =>'--',
        );
        $this->Role->agregarRol($role);
        
        $permit= array(
            'PRMS_PK'           =>1,
            'PRMS_name'         =>'ver perfil',
            'PRMS_shortname'    =>'v_perfil',
            'PRMS_description'  =>'--',
        );
        $this->Permits->agregarPermiso($permit);
        $permit= array(
            'PRMS_PK'           =>2,
            'PRMS_name'         =>'ver las unidades de aprendizaje ',
            'PRMS_shortname'    =>'v_learning_u',
            'PRMS_description'  =>'--',
        );
        $this->Permits->agregarPermiso($permit);
        $permit= array(
            'PRMS_PK'           =>3,
            'PRMS_name'         =>'ver asignaturas ',
            'PRMS_shortname'    =>'v_subject',
            'PRMS_description'  =>'--',
        );
        $this->Permits->agregarPermiso($permit);
        $permit= array(
            'PRMS_PK'           =>4,
            'PRMS_name'         =>'ver cursos',
            'PRMS_shortname'    =>'v_cicles',
            'PRMS_description'  =>'--',
        );
        $this->Permits->agregarPermiso($permit);
        $permit= array(
            'PRMS_PK'           =>5,
            'PRMS_name'         =>'ver enfoques',
            'PRMS_shortname'    =>'v_enfoques',
            'PRMS_description'  =>'--',
        );
        $this->Permits->agregarPermiso($permit);
        $permit= array(
            'PRMS_PK'           =>6,
            'PRMS_name'         =>'ver permisos',
            'PRMS_shortname'    =>'v_permit',
            'PRMS_description'  =>'--',
        );
        $this->Permits->agregarPermiso($permit);
        $permit= array(
            'PRMS_PK'           =>7,
            'PRMS_name'         =>'ver planes',
            'PRMS_shortname'    =>'v_plans',
            'PRMS_description'  =>'--',
        );
        $this->Permits->agregarPermiso($permit);
        $permit= array(
            'PRMS_PK'           =>8,
            'PRMS_name'         =>'ver roles',
            'PRMS_shortname'    =>'v_roles',
            'PRMS_description'  =>'--',
        );
        $this->Permits->agregarPermiso($permit);
        $permit= array(
            'PRMS_PK'           =>9,
            'PRMS_name'         =>'ver usuarios',
            'PRMS_shortname'    =>'v_users',
            'PRMS_description'  =>'--',
        );
        $this->Permits->agregarPermiso($permit);
        $permit= array(
            'PRMS_PK'           =>10,
            'PRMS_name'         =>'ver versiones',
            'PRMS_shortname'    =>'v_versions',
            'PRMS_description'  =>'--',
        );
        $this->Permits->agregarPermiso($permit);
        
        $permit= array(
            'RLPR_FK_roles'     =>1,
            'RLPR_FK_permits'   =>1,
        );
        $this->Permits->asignarPermiso($permit);
        $permit= array(
            'RLPR_FK_roles'     =>1,
            'RLPR_FK_permits'   =>2,
        );
        $this->Permits->asignarPermiso($permit);
        $permit= array(
            'RLPR_FK_roles'     =>1,
            'RLPR_FK_permits'   =>3,
        );
        $this->Permits->asignarPermiso($permit);
        $permit= array(
            'RLPR_FK_roles'     =>1,
            'RLPR_FK_permits'   =>4,
        );
        $this->Permits->asignarPermiso($permit);
        $permit= array(
            'RLPR_FK_roles'     =>1,
            'RLPR_FK_permits'   =>5,
        );
        $this->Permits->asignarPermiso($permit);
        $permit= array(
            'RLPR_FK_roles'     =>1,
            'RLPR_FK_permits'   =>6,
        );
        $this->Permits->asignarPermiso($permit);
        $permit= array(
            'RLPR_FK_roles'     =>1,
            'RLPR_FK_permits'   =>7,
        );
        $this->Permits->asignarPermiso($permit);
        $permit= array(
            'RLPR_FK_roles'     =>1,
            'RLPR_FK_permits'   =>8,
        );
        $this->Permits->asignarPermiso($permit);
        $permit= array(
            'RLPR_FK_roles'     =>1,
            'RLPR_FK_permits'   =>9,
        );
        $this->Permits->asignarPermiso($permit);
        $permit= array(
            'RLPR_FK_roles'     =>1,
            'RLPR_FK_permits'   =>10,
        );
        $this->Permits->asignarPermiso($permit);
        $role= array(
            'USRL_FK_users'    =>1,
            'USRL_FK_roles'    =>1,
        );
        $this->Role->asignarRol($role);
        
        
        $focu= array(
            'FOCS_name'             =>  "Ninguno",
            'FOCS_description'      =>  "SIN ENFOQUE",
        );  
        $this->Focu->agregarFocus($focu);
        $focu= array(
            'FOCS_name'             =>  "EXPERIMENTAL",
            'FOCS_description'      =>  "--",
        );  
        $this->Focu->agregarFocus($focu);
        $focu= array(
            'FOCS_name'             =>  "IDENTIDAD NACIONAL",
            'FOCS_description'      =>  "--",
        );  
        $this->Focu->agregarFocus($focu);
        $focu= array(
            'FOCS_name'             =>  "CRÍTICO",
            'FOCS_description'      =>  "--",
        );  
        $this->Focu->agregarFocus($focu);
        $focu= array(
            'FOCS_name'             =>  "VIVENCIAL",
            'FOCS_description'      =>  "--",
        );  
        $this->Focu->agregarFocus($focu);
        $focu= array(
            'FOCS_name'             =>  "CONSTRUCCION DE PENSAMIENTO",
            'FOCS_description'      =>  "--",
        );  
        $this->Focu->agregarFocus($focu);
        $focu= array(
            'FOCS_name'             =>  "COMUNICATIVO",
            'FOCS_description'      =>  "--",
        );  
        $this->Focu->agregarFocus($focu);
        
        $focu= array(
            'FOCS_name'             =>  "PRÁCTICA",
            'FOCS_description'      =>  "--",
        );  
        $this->Focu->agregarFocus($focu);
        $focu= array(
            'FOCS_name'             =>  "INVESTIGATIVO",
            'FOCS_description'      =>  "--",
        );  
        $this->Focu->agregarFocus($focu);
        $focu= array(
            'FOCS_name'             =>  "GESTIÓN",
            'FOCS_description'      =>  "--",
        );  
        $this->Focu->agregarFocus($focu);
        
        $focu= array(
            'FOCS_name'             =>  "CLASE INVERTIDA",
            'FOCS_description'      =>  "--",
        );  
        $this->Focu->agregarFocus($focu);
        
        
        
    }
}