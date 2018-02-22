<?php
/**
*
*@autor jesus andres castellanos aguilar
*
* controlador encargado de todos los procesos referente a los roles
* 
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class Plans extends CI_Controller
{
    /**
    * metodo cnstructor donde se cargan todos los helpers, librerias y modelos necesarios en el controlador
    *@library 
    *@model  role()|logueo()
    *@helper login_rules() |url() |form ()
    * 
    */
    function __construct() {
        parent::__construct ();
        $this->load->model('Plan');
        $this->load->model('Version');
        $this->load->model('Logueo');
        $this->load->helper('login_rules');
        $this->load->helper('url');
        $this->load->helper('form');
    }
    
    /**
    * funcion para mostrar la  vista principal donde se istan los roles.
    *
    * @return view ()
    */
    public function index(){
        $this->load->view('private/Plans');
    }
    
    /**
    * funcion para mostrar la  vista principal donde se istan los roles.
    *
    * @return view ()
    */
    public function listarPlans(){
        $draw = intval($this->input->get("draw"));          //trae las varibles draw, start, length para la creacion de la tabla
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $data =$this->Plan->listar();                       //utiliza el metodo listar() del modelo role() para traer los datos de todos los usuarios 
        foreach($data->result() as $r) {                    //ciclo para la creacion de las filas y columnas de la tabla de datos incluye los botones de acciones
            $dato[] = array(
                $r->PLAN_name,
                '<input type="button" class="btn btn-warning edit" title="Editar rol" id="'.$r->PLAN_PK.'" value="editar" ><input type="button" class="btn btn-danger remove" title="Eliminar rol" id="'.$r->PLAN_PK.'" value="eliminar" ><input type="button" class="btn btn-success asignar" title="Asignar ersion" id="'.$r->PLAN_PK.'" value="asignar" >',
            );
        }
        $output = array(                                    //creacion del vector de salida
            "draw" => $draw,                                //envio la variable de dibujo de la tabla                    
            "recordsTotal" =>$data->num_rows(),             //envia el numero de filas  para saber cuantos usuarios son en total
            "recordsFiltered" => $data->num_rows(),         //envio el numero de filas para el calculo de la paginacion de la tabla
            "data" => $dato                                 //envia todos los datos de la tabla
        );
        echo json_encode($output);                          //envio del vector de salida con los parametros correspondientes
        exit;    
    }
    
    /**
    * funcion para mostrar la  vista principal donde se istan los roles.
    *
    * @return view ()
    */
    public function agregarPlans(){
        $this->form_validation->set_error_delimiters('','');   //quita los delimtadores de error
        $rules=getRulesAddPlan();                              //utiliza las reglas de agregar role para validar los campos del formulario
        $this->form_validation->set_rules($rules);             //ejecuta las reglas del fromulario 
        if($this->form_validation->run() === FALSE){           //si se incumple algunade las regla
            $errors = array(                                   //creacion del vector de los errores
                'PLAN_name'       => form_error('PLAN_name'),
            );
            echo json_encode($errors);                          //envio del vector de errores
            $this->output->set_status_header(402);              //envio del estatus del error en este caso 402
        }else{                                                  //si las reglas fueron cumplidas
            $name = $this->input->post('PLAN_name');            //obtencion de todos los datos del formulario
            $data= array(                                       //creacion del vector de los nuevos datos del role
                'PLAN_name' =>  $name,
            );
            if(!$this->Plan->agregarPlan($data)){               //utilizacion del metodo modificarRol() del modelo Role() para la modificacion del usuario  enviando el id y los datos pertinentes
                echo "error";                                   // en caso de  fallar envia un mensaje de error
            }
            echo json_encode(array('msg'=> 'Plan agregado' )); //si fue modificado con exito envia el mensaje correspondiente
        }
    }
    
    /**
    * funcion para mostrar la  vista principal donde se istan los roles.
    *
    * @return view ()
    */
    public function eliminarPlans($pk){
        if($res = $this->Plan->eliminar($pk)){                                  //realiza la verificacion y eliminacion del rol
            echo json_encode(array('msg'=> 'plan eliminado exitosamente' ));     //si el rol fue eliminado correctamenre envia el mensaje de confirmacion
        }else{                                                                  //si no fue posible eliminarlo
            echo json_encode($res);                                             //envio de la respueta
            $this->output->set_status_header(403);                              //envio del status de error en este caso 403
        }
    }
    
    /**
    * funcion para mostrar la  vista principal donde se istan los roles.
    *
    * @return view ()
    */
    public function editarPlan($pk){
         $data=$this->Plan->datosPlan($pk);                                         //verifica por medio del metodo datosUsiarios() del modelo users() si el usuario existe ytae todos los datos pertinentes al usuario 
        foreach($data->result() as $r) {                                           //ciclop para  convertir los datos en un arreglo
            $dato = array();                                                       //creacion del vector que contendra los datos del usuario
            $dato['PLAN_PK'] = $r->PLAN_PK;
            $dato['PLAN_name'] = $r->PLAN_name;
        }
        $this->load->view('private/view_ajax/editar_plan_ajax',$dato);               //envio de la vista y los datos para la edicion de los usuarios
    }
    /**
    * funcion para mostrar la  vista principal donde se istan los roles.
    *
    * @return view ()
    */
    public function modificarPlan($doc){
        $this->form_validation->set_error_delimiters('','');                        //quita los delimtadores de error
        $rules=getRulesAddPlan();                                                    //utiliza las reglas de agregar rol para validar los campos del formulario
        $this->form_validation->set_rules($rules);                                  //ejecuta las reglas del fromulario 
        if($this->form_validation->run() === FALSE){                                //si se incumple algunade las regla
            $errors = array(                                                        //creacion del vector de los errores
                'PLAN_name' => form_error('PLAN_name'),
                
            );
            echo json_encode($errors);                                              //envio del vector de errores
            $this->output->set_status_header(402);                                  //envio del estatus del error en este caso 402
        }else{                                                                      //si las reglas fueron cumplidas
            $name = $this->input->post('PLAN_name');                                 //obtencion de todos los datos del formulario
            $data = array(                                                           //creacion del vector de los nuevos datos del rol
                'PLAN_name' =>  $name,
                
            );
            if(!$this->Plan->modificarPlan($doc,$data)){                             //utilizacion del metodo modificarRol() del modelo role() para la modificacion del rol  enviando el id y los datos pertinentes
                echo "error";                                                       // en caso de  fallar envia un mensaje de error
            }
            echo json_encode(array('msg'=> 'Plan modificado' ));                     // si fue modificado con exito envia el mensaje correspondiente
        }
    }
    
    /**
    * funcion para mostrar la  vista principal donde se istan los roles.
    *
    * @return view ()
    */
    public function asignarVersionPlan($id){
        $data['id'] =$id;
        $this->load->view('private/view_ajax/asignacion_version_plan_ajax',$data); 
    }
    
    /**
    * funcion para mostrar la  vista principal donde se istan los roles.
    *
    * @return view ()
    */
    public function listarVersionsPlans($id){
        $draw = intval($this->input->get("draw"));          //trae las varibles draw, start, length para la creacion de la tabla
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $data =$this->Plan->listarVersionPlan($id);       //utiliza el metodo listarPermisoRol() del modelo permits() para traer los datos de todos los usuarios 
        foreach($data->result() as $r) {                    //ciclo para la creacion de las filas y columnas de la tabla de datos incluye los botones de acciones
            $dato [] = array(
                $r->VRSN_name,
                '<input type="button" class="btn btn-danger fa fa-remove remove" title="Eliminar rol" id="'.$r->VRPL_PK.'" value="eliminar" >',
            );
        }
        $output = array(                                    //creacion del vector de salida
            "draw" => $draw,                                //envio la variable de dibujo de la tabla                    
            "recordsTotal" =>$data->num_rows(),             //envia el numero de filas  para saber cuantos usuarios son en total
            "recordsFiltered" => $data->num_rows(),         //envio el numero de filas para el calculo de la paginacion de la tabla
            "data" => $dato,                                 //envia todos los datos de la tabla
        );
        echo json_encode($output);                          //envio del vector de salida con los parametros correspondientes
        exit;                                               //salida del proceso
    }
    
    /**
    * funcion para mostrar la  vista principal donde se istan los roles.
    *
    * @return view ()
    */
    public function listarVersions(){
        $draw = intval($this->input->get("draw"));          //trae las varibles draw, start, length para la creacion de la tabla
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $data =$this->Version->listar();       //utiliza el metodo listarPermisoRol() del modelo permits() para traer los datos de todos los usuarios 
        foreach($data->result() as $r) {                    //ciclo para la creacion de las filas y columnas de la tabla de datos incluye los botones de acciones
            $dato [] = array(
                $r->VRSN_name,
                '<input type="button" class="btn btn-success asignar" title="Eliminar rol" id="'.$r->VRSN_PK.'" value="asignar" >',
            );
        }
        $output = array(                                    //creacion del vector de salida
            "draw" => $draw,                                //envio la variable de dibujo de la tabla                    
            "recordsTotal" =>$data->num_rows(),             //envia el numero de filas  para saber cuantos usuarios son en total
            "recordsFiltered" => $data->num_rows(),         //envio el numero de filas para el calculo de la paginacion de la tabla
            "data" => $dato,                                 //envia todos los datos de la tabla
        );
        echo json_encode($output);                          //envio del vector de salida con los parametros correspondientes
        exit;                                               //salida del proceso
    }
    /**
    * funcion para eliminar el  rol.
    *
    * @return json_encode() |set_status_header()
    */
    public function eliminarVersionPlan($pk){
        if($res = $this->Plan->eliminarVersionPlan($pk)){                               //realiza la verificacion y eliminacion del rol
            echo json_encode(array('msg'=> 'version eliminado exitosamente' )); //si el rol fue eliminado correctamenre envia el mensaje de confirmacion
        }else{                                                                  //si no fue posible eliminarlo
            echo json_encode($res);                                             //envio de la respueta
            $this->output->set_status_header(403);                              //envio del status de error en este caso 403
        }
        
    }
    
    /**
    * funcion para eliminar el  rol.
    *
    * @return json_encode() |set_status_header()
    */
    public function asignarVersion($plan,$version){
        if ($this->Plan->consultarVersioPlan($plan,$version)){//verifica si el permiso ya fue asignado
            $this->output->set_status_header(402);              //envia el error en caso de existir
        }else{
            $data= array(
                'VRPL_FK_versions'            =>  $version,      //crea el vector con los datos
                'VRPL_FK_plans'               =>  $plan,
            );
            if ($this->Plan->asignarVersion($data)){         //envia y valida la insercion del nuevo permiso en el rol 
                return true;
            }
            return false;  
        }
    }
    
}
