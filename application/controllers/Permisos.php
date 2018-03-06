<?php

/**
*
*@autor jesus andres castellanos aguilar
*
* controlador encargado de todos los procesos referente a los usuarios
* 
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class Permisos extends CI_Controller{
    
    /**
    * metodo cnstructor donde se cargan todos los helpers, librerias y modelos necesarios en el controlador
    *@library 
    *@model  users()|logueo()
    *@helper login_rules() |url() |form ()
    * 
    */
    function __construct() {
        parent::__construct ();
        $this->load->model(['Permits','Logueo']);
        $this->load->helper(['login_rules','url','form']);        
    }
    
    /**
    * funcion para mostrar la  vista principal el cual es perfil.
    *
    * @return view ()
    */
    public function index(){
        $data['title'] ='Permisos';
        
        $this->load->view('private/heads/head_1',$data);
        $this->load->view('private/heads/head_2');
        $this->load->view('private/heads/menus');
        $this->load->view('private/permisos',$data);    
        $this->load->view('private/footers/foot_1');
        $this->load->view('private/footers/foot_2');     
    }       
    
    /**
    * funcion para mostrar la  vista principal el cual es perfil.
    *
    * @return view ()
    */
    public function asignacionPermisos(){
        $this->load->view('private/view_ajax/asignacion_permisos_ajax');
    }
    
    /**
    * funcion el envio de datos para dibujar la tabla de roles.
    *
    * @return json_encode()
    */
     public function listarPermisos(){
        $draw = intval($this->input->get("draw"));          //trae las varibles draw, start, length para la creacion de la tabla
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $data =$this->Permits->listar();                    //utiliza el metodo listar() del modelo permits() para traer los datos de todos los usuarios 
        $output = array(                                    //creacion del vector de salida
            "draw" => $draw,                                //envio la variable de dibujo de la tabla                    
            "recordsTotal" =>$data->num_rows(),             //envia el numero de filas  para saber cuantos usuarios son en total
            "recordsFiltered" => $data->num_rows(),         //envio el numero de filas para el calculo de la paginacion de la tabla
            "data" => $data->result_array(),                                 //envia todos los datos de la tabla
        );
        echo json_encode($output);                          //envio del vector de salida con los parametros correspondientes
        exit;                                               //salida del proceso
    }
    
    /**
    * funcion para eliminar el  rol.
    *
    * @return json_encode() |set_status_header()
    */
    public function eliminarPermisos($pk){
        if($res = $this->Permits->eliminar($pk)){                               //realiza la verificacion y eliminacion del rol
            echo json_encode(array('msg'=> 'permiso eliminado exitosamente' )); //si el rol fue eliminado correctamenre envia el mensaje de confirmacion
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
    public function eliminarPermisosRol($rol,$permiso){
        if($res = $this->Permits->eliminarPermisoRol($rol,$permiso)){                               //realiza la verificacion y eliminacion del rol
            echo json_encode(array('msg'=> 'permiso eliminado exitosamente' )); //si el rol fue eliminado correctamenre envia el mensaje de confirmacion
        }else{                                                                  //si no fue posible eliminarlo
            echo json_encode($res);                                             //envio de la respueta
            $this->output->set_status_header(403);                              //envio del status de error en este caso 403
        }
        
    }
    
    /**
    *funcion para redirecionar a la visa de editar y envio de la informacion de los roles.
    *@param  int $doc
    *@return  view()
    */
    public function editarPermisos($doc){
        $data=$this->Permits->datosPermiso($doc)->result_array()[0];                                         //verifica por medio del metodo datosUsiarios() del modelo users() si el usuario existe ytae todos los datos pertinentes al usuario 
        $this->load->view('private/view_ajax/editar_permiso_ajax',$data);               //envio de la vista y los datos para la edicion de los usuarios
    }
    
    /**
    *funcion para la modificacion de  la informacion de los roles.
    *@param  int $doc
    *@return  json_encode() | echo "error" | set_status_header()
    */
    public function modificarPermisos($doc){
        $this->form_validation->set_error_delimiters('','');                        //quita los delimtadores de error
        $rules=getRulesAddPermiso();                                                    //utiliza las reglas de agregar rol para validar los campos del formulario
        $this->form_validation->set_rules($rules);                                  //ejecuta las reglas del fromulario 
        if($this->form_validation->run() === FALSE){                                //si se incumple algunade las regla
            $errors = array(                                                        //creacion del vector de los errores
                'PRMS_name'         => form_error('PRMS_name'),
                'PRMS_shortname'    => form_error('PRMS_shortname'),
                'PRMS_description'  => form_error('PRMS_description'),
                
            );
            echo json_encode($errors);                                              //envio del vector de errores
            $this->output->set_status_header(402);                                  //envio del estatus del error en este caso 402
        }else{                                                                      //si las reglas fueron cumplidas
            //obtencion de todos los datos del formulario                    
            $data= array(                                                           //creacion del vector de los nuevos datos del rol
                'PRMS_name'         =>  $this->input->post('PRMS_name'),
                'PRMS_shortname'    =>  $$this->input->post('PRMS_shortname'),
                'PRMS_description'  =>  $this->input->post('PRMS_description'),
                'PRMS_date_update'  =>  date("Y-m-d H:i:s"),
                'PRMS_PK_update'    =>  $this->session->userdata('id'),
                
            );
            if(!$this->Permits->modificarPermisos($doc,$data)){                      //utilizacion del metodo modificarRol() del modelo role() para la modificacion del rol  enviando el id y los datos pertinentes
                echo "error";                                                       // en caso de  fallar envia un mensaje de error
            }
            echo json_encode(array('msg'=> 'Permiso modificado' ));                 // si fue modificado con exito envia el mensaje correspondiente
        }
    }
    /**
    * funcion para mostrar la  vista de asigar roles.
    *
    * @return view ()
 /**
    * funcion para agregar roles a la base de datos.
    *
    * @return json_encode() |set_status_header() |echo "error"
    */
    public function agregarPermisos(){
        $this->form_validation->set_error_delimiters('','');                        //quita los delimtadores de error
        $rules=getRulesAddPermiso();                                                    //utiliza las reglas de agregar role para validar los campos del formulario
        $this->form_validation->set_rules($rules);                                  //ejecuta las reglas del fromulario 
        if($this->form_validation->run() === FALSE){                                //si se incumple algunade las regla
            $errors = array(                                                        //creacion del vector de los errores
                'PRMS_name'       => form_error('PRMS_name'),
                'PRMS_shortname'    => form_error('PRMS_shortname'),
                'PRMS_description'=> form_error('PRMS_description'),
                
            );
            echo json_encode($errors);                                              //envio del vector de errores
            $this->output->set_status_header(402);                                  //envio del estatus del error en este caso 402
        }else{                                                                      //si las reglas fueron cumplidas
            //obtencion de todos los datos del formulario                    
            $data= array(                                                           //creacion del vector de los nuevos datos del role
                'PRMS_name'         =>  $this->input->post('PRMS_name'),
                'PRMS_shortname'    =>  $this->input->post('PRMS_shortname'),
                'PRMS_description'  =>  $this->input->post('PRMS_description'),
                'PRMS_date_create'  =>  date("Y-m-d H:i:s"),
                'PRMS_date_update'  =>  date("Y-m-d H:i:s"),
                'PRMS_PK_create'    =>  $this->session->userdata('id'),
                'PRMS_PK_update'    =>  $this->session->userdata('id'),
                
            );
            if(!$this->Permits->agregarPermiso($data)){                                    //utilizacion del metodo modificarRol() del modelo Role() para la modificacion del usuario  enviando el id y los datos pertinentes
                echo "error";                                                       // en caso de  fallar envia un mensaje de error
            }
            echo json_encode(array('msg'=> 'Permiso modificado' ));                     //si fue modificado con exito envia el mensaje correspondiente
        }       
    }
    
    
}