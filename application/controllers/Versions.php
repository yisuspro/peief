<?php

/**
*
*@autor jesus andres castellanos aguilar
*
* controlador encargado de todos los procesos referente a las versiones
* 
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class Versions extends CI_Controller{
    
    /**
    * metodo cnstructor donde se cargan todos los helpers, librerias y modelos necesarios en el controlador
    *@library 
    *@model  Version()|logueo()
    *@helper login_rules() |url() |form ()
    * 
    */
    function __construct() {
        parent::__construct ();
        $this->load->model(['Plan','Version','Logueo']);
        $this->load->helper(['login_rules','url','form']);
    }
    
    /**
    * funcion para mostrar la  vista principal el cual contiene todas las versiones existentes
    *
    * @return view ()
    */
    public function index(){
        
        $data['planes']=$this->Plan->listar();
        
        $data['title']='Versiones';
        
        $this->load->view('private/heads/head_1',$data);
        $this->load->view('private/heads/head_2');
        $this->load->view('private/heads/menus');
        
        $this->load->view('private/versions', $data);    
        $this->load->view('private/footers/foot_1');
        $this->load->view('private/footers/foot_2');
    }
    
    /**
    * funcion para obtener y listar todas las versiones existentes
    *
    * @return json_encode()
    */
    public function listarVersions(){
        $draw = intval($this->input->get("draw"));          //trae las varibles draw, start, length para la creacion de la tabla
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $data =$this->Version->listar();                    //utiliza el metodo listar() del modelo Version() para traer los datos de todos las versiones
        $output = array(                                    //creacion del vector de salida
            "draw" => $draw,                                //envio la variable de dibujo de la tabla                    
            "recordsTotal" =>$data->num_rows(),             //envia el numero de filas  para saber cuantas versiones son en total
            "recordsFiltered" => $data->num_rows(),         //envio el numero de filas para el calculo de la paginacion de la tabla
            "data" => $data->result_array(),                                 //envia todos los datos de la tabla
        );
        echo json_encode($output);                          //envio del vector de salida con los parametros correspondientes
        exit;    
    }
    
    /**
    * funcion para agregar una nueva version a la base de datos
    *
    * @return json_encode() | set_status_header()
    */
    public function agregarVersions(){
        $this->form_validation->set_error_delimiters('','');   //quita los delimtadores de error
        $rules=getRulesAddVersion();                           //utiliza las reglas de agregar version para validar los campos del formulario
        $this->form_validation->set_rules($rules);             //ejecuta las reglas del fromulario 
        if($this->form_validation->run() === FALSE){           //si se incumple alguna de las regla
            $errors = array(                                   //creacion del vector de los errores
                'VRSN_name' => form_error('VRSN_name'),
            );
            echo json_encode($errors);                          //envio del vector de errores
            $this->output->set_status_header(402);              //envio del estatus del error en este caso 402
        }else{                                                  //si las reglas fueron cumplidas
            //obtencion de todos los datos del formulario
            $data= array(                                       //creacion del vector de los nuevos datos de la vesion
                'VRSN_name'     => $this->input->post('VRSN_name'),
                'VRSN_FK_plans' => $this->input->post('VRSN_FK_plans'),
            );
            if(!$this->Version->agregarVersion($data)){         //utilizacion del metodo agregarVersion() del modelo Version() para la agregacion de versiones a la base de datos
                echo "error";                                   // en caso de  fallar envia un mensaje de error
            }
            echo json_encode(array('msg'=> 'Version agregado' ));//si fue agregada con exito envia el mensaje correspondiente
        }
    }
    
    /**
    * funcion para eliminar una version existente en la base de datos
    * @param int $pk
    * @return json_encode() | set_status_header()
    */
    public function eliminarVersions($pk){
        if($res = $this->Version->eliminar($pk)){                               //realiza la verificacion y eliminacion de la version
            echo json_encode(array('msg'=> 'version eliminado exitosamente' )); //si la version fue eliminada correctamenre envia el mensaje de confirmacion
        }else{                                                                  //si no fue posible eliminarlo
            echo json_encode($res);                                             //envio de la respueta
            $this->output->set_status_header(403);                              //envio del status de error en este caso 403
        }
    }
    
    /**
    * funcion para mostrar la  vista principal de edicion de una version existente
    * @param int $pk
    * @return view () |String $datos
    */
    
    public function editarVersion($pk){                                        
        $dato['data']=  $this->Version->datosVersion($pk)->result_array()[0];   
        $dato['planes']  = $this->Plan->listar();//trae los datos de enfoques para agregar a la  unidad
        $this->load->view('private/view_ajax/editar_version_ajax',$dato);//envio de la vista y los datos para la edicion de los usuarios
    }
    
    
    /**
    * funcion para la modificacion de los datos de versiones existentes
    * @param int $oc
    * @return view ()
    */
    public function modificarVersion($doc){
        $this->form_validation->set_error_delimiters('','');   //quita los delimtadores de error
        $rules=getRulesAddVersion();                           //utiliza las reglas de agregar version para validar los campos del formulario
        $this->form_validation->set_rules($rules);             //ejecuta las reglas del fromulario 
        if($this->form_validation->run() === FALSE){           //si se incumple algunade las regla
            $errors = array(                                   //creacion del vector de los errores
                'VRSN_name'     => form_error('VRSN_name'),
                'VRSN_FK_plans' => form_error('VRSN_FK_plans'),
            );
            echo json_encode($errors);                         //envio del vector de errores
            $this->output->set_status_header(402);             //envio del estatus del error en este caso 402
        }else{                                                 //si las reglas fueron cumplidas
            $data = array(                                     //creacion del vector de los nuevos datos de la version
                'VRSN_name'     =>  $this->input->post('VRSN_name'),
                'VRSN_FK_plans' =>  $this->input->post('VRSN_FK_plans')
            );
            if(!$this->Version->modificarVersion($doc,$data)){ //utilizacion del metodo modificarVersion() del modelo Version() para la modificacion de la version enviando el id y los datos pertinentes
                echo "error";                                  // en caso de  fallar envia un mensaje de error
            }
            echo json_encode(array('msg'=> 'Version modificado' )); // si fue modificado con exito envia el mensaje correspondiente
        }
    }
    
}