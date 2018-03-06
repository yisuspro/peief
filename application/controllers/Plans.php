<?php
/**
*
*@autor jesus andres castellanos aguilar
*
* controlador encargado de todos los procesos referente a los planes de estudio
* 
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class Plans extends CI_Controller
{
    /**
    * metodo cnstructor donde se cargan todos los helpers, librerias y modelos necesarios en el controlador
    * @library 
    * @model  plan()|logueo() | version()
    * @helper login_rules() |url() |form ()
    * 
    */
    function __construct() {
        parent::__construct ();
        $this->load->model(['Plan','Version','Logueo']);
        $this->load->helper(['login_rules','url','form']);
    }
    
    /**
    * funcion para mostrar la  vista principal donde se listan los planes de estudio.
    *
    * @return view ()
    */
    public function index(){
        
        $data['title']='Planes';
        
        $this->load->view('private/heads/head_1',$data);
        $this->load->view('private/heads/head_2');
        $this->load->view('private/heads/menus');
        $this->load->view('private/plans');    
        $this->load->view('private/footers/foot_1');
        $this->load->view('private/footers/foot_2');
    }
    
    /**
    * funcion para listar los planes de estudio en la data teble.
    *
    * @return json_encode ()
    */
    public function listarPlans(){
        $draw = intval($this->input->get("draw"));          //trae las varibles draw, start, length para la creacion de la tabla
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $data =$this->Plan->listar();                       //utiliza el metodo listar() del modelo plan() para traer los datos de todos los planes 
        $output = array(                                    //creacion del vector de salida
            "draw" => $draw,                                //envio la variable de dibujo de la tabla                    
            "recordsTotal" =>$data->num_rows(),             //envia el numero de filas  para saber cuantos usuarios son en total
            "recordsFiltered" => $data->num_rows(),         //envio el numero de filas para el calculo de la paginacion de la tabla
            "data" => $data->result_array(),                                  //envia todos los datos de la tabla
        );
        echo json_encode($output);                          //envio del vector de salida con los parametros correspondientes
        exit;    
    }
    
    /**
    * funcion para agregar los nuevos planes de  estudio.
    *
    * @return json_encode()
    */
    public function agregarPlans(){
        $this->form_validation->set_error_delimiters('','');   //quita los delimtadores de error
        $rules=getRulesAddPlan();                              //utiliza las reglas de agregar plan para validar los campos del formulario
        $this->form_validation->set_rules($rules);             //ejecuta las reglas del fromulario 
        if($this->form_validation->run() === FALSE){           //si se incumple algunade las regla
            $errors = array(
                'PLAN_name' => form_error('PLAN_name'),
            );
            echo json_encode($errors);                          //envio del vector de errores
            $this->output->set_status_header(402);              //envio del estatus del error en este caso 402
        }else{                                                  //si las reglas fueron cumplidas
            //obtencion de todos los datos del formulario
            $data= array(                                       //creacion del vector de los nuevos datos del plan
                'PLAN_name' =>  $this->input->post('PLAN_name'),
            );
            if(!$this->Plan->agregarPlan($data)){               //utilizacion del metodo agregarPlan() del modelo Plan() para la agregacion de un nuevo plan los datos pertinentes
                echo "error";                                   // en caso de  fallar envia un mensaje de
            echo json_encode(array('msg'=> 'Plan agregado' ));  //si fue agregado con exito envia el mensaje correspondiente
            }
        }
    }
    
    /**
    * funcion para eliminar el plan correspondiente
    * @param int $pk
    * @return view ()
    */
    public function eliminarPlans($pk){
        if($res = $this->Plan->eliminar($pk)){                                      //realiza la verificacion y eliminacion del plan
            echo json_encode(array('msg'=> 'plan eliminado exitosamente' ));        //si el plan fue eliminado correctamente envia el mensaje de confirmacion
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
    public function editarPlan($pk){
        $data=$this->Plan->datosPlan($pk)->result_array()[0];          //verifica por medio del metodo datosPlan() del modelo Plan() si el usuario existe ytrae todos los datos pertinentes al usuario 
        $this->load->view('private/view_ajax/editar_plan_ajax',$data);  //envio de la vista y los datos para la edicion de los planes
    }
    /**
    * funcion para la modificacion de los datos del plan
    * @param int $doc
    * @return json_encode()
    */
    public function modificarPlan($doc){
        $this->form_validation->set_error_delimiters('','');             //quita los delimtadores de error
        $rules=getRulesAddPlan();                                        //utiliza las reglas de agregar plan para validar los campos del formulario
        $this->form_validation->set_rules($rules);                       //ejecuta las reglas del fromulario 
        if($this->form_validation->run() === FALSE){                     //si se incumple algunade las regla
            $errors = array(                                             //creacion del vector de los errores
                'PLAN_name' => form_error('PLAN_name'),
            );
            echo json_encode($errors);                                   //envio del vector de errores
            $this->output->set_status_header(402);                       //envio del estatus del error en este caso 402
        }else{                                                           //si las reglas fueron cumplidas
                               //obtencion de todos los datos del formulario
            $data = array(                                               //creacion del vector de los nuevos datos del plan
                'PLAN_name' =>  $this->input->post('PLAN_name'),
            );
            if(!$this->Plan->modificarPlan($doc,$data)){                 //utilizacion del metodo modificarPlan() del modelo Plan() para la modificacion del plan  enviando el id y los datos pertinentes
                echo "error";                                            //en caso de  fallar envia un mensaje de error
            }
            echo json_encode(array('msg'=> 'Plan modificado' ));         //si fue modificado con exito envia el mensaje correspondiente
        }
    }
    
}
