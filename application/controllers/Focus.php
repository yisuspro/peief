<?php
/**
*
*@autor jesus andres castellanos aguilar
*
* controlador encargado de todos los procesos referente a los enfoque pedagogicos de estudio
* 
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class Focus extends CI_Controller{
    
    /**
    * metodo constructor donde se cargan todos los helpers, librerias y modelos necesarios en el controlador
    * @library 
    * @model  Focu()|logueo()
    * @helper login_rules() |url() |form ()
    * 
    */
    function __construct() {
        parent::__construct ();
        $this->load->model(['Focu','Logueo']);
        $this->load->helper(['login_rules','url','form']);
    }
    
    /**
    * funcion para mostrar la  vista principal donde se listan todos los enfoque pedagogicos de estudio.
    *
    * @return view ()
    */
    public function index(){
        $data['title']='Enfoques';
        $this->load->view('private/heads/header',$data);
        $this->load->view('private/heads/bar_up');
        $this->load->view('private/heads/menus');
        $this->load->view('private/focus', $data);    
        $this->load->view('private/footers/foot_1');
        $this->load->view('private/footers/foot_2');
    }
    
    /**
    * funcion para listar los planes de estudio en la data teble.
    *
    * @return json_encode ()
    */
    public function listarFocus(){
        $draw = intval($this->input->get("draw"));              //trae las varibles draw, start, length para la creacion de la tabla
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $data =$this->Focu->listar();                           //utiliza el metodo listar() del modelo Focu() para traer los datos de todos los planes 
        $output = array(                                    //creacion del vector de salida
            "draw" => $draw,                                //envio la variable de dibujo de la tabla                    
            "recordsTotal" =>$data->num_rows(),             //envia el numero de filas  para saber cuantos usuarios son en total
            "recordsFiltered" => $data->num_rows(),         //envio el numero de filas para el calculo de la paginacion de la tabla
            "data" => $data->result_array()                             //envia todos los datos de la tabla
        );
        echo json_encode($output);                          //envio del vector de salida con los parametros correspondientes
        exit;    
    }
    
    /**
    * funcion para agregar los nuevos enfoques pedagogicos de  estudio.
    *
    * @return json_encode()
    */
    public function agregarFocus(){
        $this->form_validation->set_error_delimiters('','');                //quita los delimtadores de error
        $rules=getRulesAddFocus();                                          //utiliza las reglas de agregar plan para validar los campos del formulario
        $this->form_validation->set_rules($rules);                          //ejecuta las reglas del fromulario 
        if($this->form_validation->run() === FALSE){                        //si se incumple algunade las regla
            $errors = array(
                'FOCS_name'         => form_error('FOCS_name'), 
                'FOCS_description'  => form_error('FOCS_description'),
            );
            echo json_encode($errors);                                      //envio del vector de errores
            $this->output->set_status_header(402);                          //envio del estatus del error en este caso 402
        }else{                                                              //si las reglas fueron cumplidas
            $data= array(                                                   //creacion del vector de los nuevos datos del enfoque pedagogico
                'FOCS_name'             =>  $this->input->post('FOCS_name'),
                'FOCS_description'      =>  $this->input->post('FOCS_description'),
            );
            if(!$this->Focu->agregarFocus($data)){                          //utilizacion del metodo agregarFocus() del modelo Focu() para la agregacion de un nuevo enfoque pedagogico con los datos pertinentes
                echo "error";                                               // en caso de  fallar envia un mensaje de
            echo json_encode(array('msg'=> 'Enfoque agregado' ));  //si fue agregado con exito envia el mensaje correspondiente
            }
        }
    }
    
    /**
    * funcion para eliminar el enfoque pedagogico correspondiente
    * @param int $pk
    * @return view ()
    */
    public function eliminarFocus($pk){
        if($res = $this->Focu->eliminar($pk)){                                      //realiza la verificacion y eliminacion del enfoque pedagogico
            echo json_encode(array('msg'=> 'curso eliminado exitosamente' ));       //si el enfoque fue eliminado correctamente envia el mensaje de confirmacion
        }else{                                                                      //si no fue posible eliminarlo
            echo json_encode($res);                                                 //envio de la respueta
            $this->output->set_status_header(403);                                  //envio del status de error en este caso 403
        }
    }
    
    /**
    * funcion para mostrar y editar los planes.
    * @param INT $pk
    * @return view () | $datos
    */
    public function editarFocus($pk){
        $data=$this->Focu->datosFocus($pk)->result_array()[0];              //verifica por medio del metodo datosFocus() del modelo Focu() si el enfoque existe y trae todos los datos pertinentes al enfoque 
        $this->load->view('private/view_ajax/editar_focus_ajax',$data);     //envio de la vista y los datos para la edicion de los planes
    }
    
    /**
    * funcion para la modificacion de los datos del enfoque pedagogico
    * @param int $doc
    * @return json_encode()
    */
    public function modificarFocus($doc){
        $this->form_validation->set_error_delimiters('','');        //quita los delimtadores de error
        $rules=getRulesAddFocus();                                  //utiliza las reglas de agregar enfoque para validar los campos del formulario
        $this->form_validation->set_rules($rules);                  //ejecuta las reglas del fromulario 
        if($this->form_validation->run() === FALSE){                //si se incumple algunade las regla
            $errors = array(
                'FOCS_name'         => form_error('FOCS_name'),
                'FOCS_description'  => form_error('FOCS_description'),
            );
            echo json_encode($errors);                          //envio del vector de errores
            $this->output->set_status_header(402);              //envio del estatus del error en este caso 402
        }else{                                                  //si las reglas fueron cumplidas   
            $data= array(                                       //creacion del vector de los nuevos datos del plan
                'FOCS_name'             =>  $this->input->post('FOCS_name'),
                'FOCS_description'      =>  $this->input->post('FOCS_description'),
            );
            if(!$this->Focu->modificarFocus($doc,$data)){                   //utilizacion del metodo modificarFocus() del modelo Focu() para la agregacion de un nuevo enfoque con los datos pertinentes
                echo "error";                                               // en caso de  fallar envia un mensaje de
            echo json_encode(array('msg'=> 'Enfoque agregado agregado' ));  //si fue agregado con exito envia el mensaje correspondiente
            }
        }
        
    }
    
 
}
