<?php

/**
*
*@autor jesus andres castellanos aguilar
*
* controlador encargado de todos los procesos referente a los usuarios
* 
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class Versions extends CI_Controller{
    
    /**
    * metodo cnstructor donde se cargan todos los helpers, librerias y modelos necesarios en el controlador
    *@library 
    *@model  users()|logueo()
    *@helper login_rules() |url() |form ()
    * 
    */
    function __construct() {
        parent::__construct ();
        $this->load->model('Version');
        $this->load->model('Logueo');
        $this->load->helper('login_rules');
        $this->load->helper('url');
        $this->load->helper('form');
    }
    
    /**
    * funcion para mostrar la  vista principal el cual es perfil.
    *
    * @return view ()
    */
    public function index(){
        $this->load->view('private/versions');
    }
    
    public function listarVersions(){
        $draw = intval($this->input->get("draw"));          //trae las varibles draw, start, length para la creacion de la tabla
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $data =$this->Version->listar();                       //utiliza el metodo listar() del modelo role() para traer los datos de todos los usuarios 
        foreach($data->result() as $r) {                    //ciclo para la creacion de las filas y columnas de la tabla de datos incluye los botones de acciones
            $dato[] = array(
                $r->VRSN_name,
                '<input type="button" class="btn btn-warning edit" title="Editar rol" id="'.$r->VRSN_PK.'" value="editar" ><input type="button" class="btn btn-danger remove" title="Eliminar rol" id="'.$r->VRSN_PK.'" value="eliminar" >',
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
    
    
    public function agregarVersions(){
        $this->form_validation->set_error_delimiters('','');   //quita los delimtadores de error
        $rules=getRulesAddVersion();                              //utiliza las reglas de agregar role para validar los campos del formulario
        $this->form_validation->set_rules($rules);             //ejecuta las reglas del fromulario 
        if($this->form_validation->run() === FALSE){           //si se incumple algunade las regla
            $errors = array(                                   //creacion del vector de los errores
                'VRSN_name'       => form_error('VRSN_name'),
            );
            echo json_encode($errors);                          //envio del vector de errores
            $this->output->set_status_header(402);              //envio del estatus del error en este caso 402
        }else{                                                  //si las reglas fueron cumplidas
            $name = $this->input->post('VRSN_name');            //obtencion de todos los datos del formulario
            $data= array(                                       //creacion del vector de los nuevos datos del role
                'VRSN_name' =>  $name,
            );
            if(!$this->Version->agregarVersion($data)){               //utilizacion del metodo modificarRol() del modelo Role() para la modificacion del usuario  enviando el id y los datos pertinentes
                echo "error";                                   // en caso de  fallar envia un mensaje de error
            }
            echo json_encode(array('msg'=> 'Version agregado' )); //si fue modificado con exito envia el mensaje correspondiente
        }
    }
    
    public function eliminarVersions($pk){
        if($res = $this->Version->eliminar($pk)){                                  //realiza la verificacion y eliminacion del rol
            echo json_encode(array('msg'=> 'version eliminado exitosamente' ));     //si el rol fue eliminado correctamenre envia el mensaje de confirmacion
        }else{                                                                  //si no fue posible eliminarlo
            echo json_encode($res);                                             //envio de la respueta
            $this->output->set_status_header(403);                              //envio del status de error en este caso 403
        }
    }
    
    public function editarVersion($pk){
         $data=$this->Version->datosVersion($pk);                                         //verifica por medio del metodo datosUsiarios() del modelo users() si el usuario existe ytae todos los datos pertinentes al usuario 
        foreach($data->result() as $r) {                                           //ciclop para  convertir los datos en un arreglo
            $dato = array();                                                       //creacion del vector que contendra los datos del usuario
            $dato['VRSN_PK'] = $r->VRSN_PK;
            $dato['VRSN_name'] = $r->VRSN_name;
        }
        $this->load->view('private/view_ajax/editar_version_ajax',$dato);               //envio de la vista y los datos para la edicion de los usuarios
    }
    public function modificarVersion($doc){
        $this->form_validation->set_error_delimiters('','');                        //quita los delimtadores de error
        $rules=getRulesAddVersion();                                                    //utiliza las reglas de agregar rol para validar los campos del formulario
        $this->form_validation->set_rules($rules);                                  //ejecuta las reglas del fromulario 
        if($this->form_validation->run() === FALSE){                                //si se incumple algunade las regla
            $errors = array(                                                        //creacion del vector de los errores
                'VRSN_name' => form_error('VRSN_name'),
                
            );
            echo json_encode($errors);                                              //envio del vector de errores
            $this->output->set_status_header(402);                                  //envio del estatus del error en este caso 402
        }else{                                                                      //si las reglas fueron cumplidas
            $name = $this->input->post('VRSN_name');                                 //obtencion de todos los datos del formulario
            $data = array(                                                           //creacion del vector de los nuevos datos del rol
                'VRSN_name' =>  $name,
                
            );
            if(!$this->Version->modificarVersion($doc,$data)){                             //utilizacion del metodo modificarRol() del modelo role() para la modificacion del rol  enviando el id y los datos pertinentes
                echo "error";                                                       // en caso de  fallar envia un mensaje de error
            }
            echo json_encode(array('msg'=> 'Version modificado' ));                     // si fue modificado con exito envia el mensaje correspondiente
        }
    }
    
}