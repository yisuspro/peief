<?php

/**
*
*@autor jesus andres castellanos aguilar
*
* controlador encargado de todos los procesos referente a las asignaturas
* 
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class Subjects extends CI_Controller{
    
    /**
    * metodo cnstructor donde se cargan todos los helpers, librerias y modelos necesarios en el controlador
    *@library 
    *@model  Learning_unity()|logueo()
    *@helper login_rules() |url() |form ()
    * 
    */
    function __construct() {
        parent::__construct ();
        $this->load->model('Learning_unit');
        $this->load->model('Logueo');
        $this->load->model('Subject');
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
        $data['unidades']=$this->Learning_unit->listar();
        $data['title']='Asignaturas';
        $this->load->view('private/heads/head_1',$data);
        $this->load->view('private/heads/head_2');
        $this->load->view('private/heads/menus');
        $this->load->view('private/subjects', $data);    
        $this->load->view('private/footers/foot_1');
        $this->load->view('private/footers/foot_2');
    }

    /**
    * funcion el envio de datos para dibujar la tabla de roles.
    *
    * @return json_encode()
    */
     public function listarAsignaturas(){
        $draw   = intval($this->input->get("draw"));          //trae las varibles draw, start, length para la creacion de la tabla
        $start  = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $data=$this->Subject->listar();
        foreach($data->result() as $r) {                    //ciclo para la creacion de las filas y columnas de la tabla de datos incluye los botones de acciones
            $dato [] = array(
                $r->SBJC_name,
                $r->SBJC_description,
                $r->LNUT_name,
                '<input type="button" class="btn btn-warning fa fa-remove edit" title="Editar unidad" id="'.$r->SBJC_PK.'" value="editar" ><input type="button" class="btn btn-danger fa fa-remove remove" title="Eliminar unidad" id="'.$r->SBJC_PK.'" value="eliminar" >',
            );
        }
        $output = array(                                    //creacion del vector de salida
            "draw" => $draw,                                //envio la variable de dibujo de la tabla                    
            "recordsTotal" =>$data->num_rows(),             //envia el numero de filas  para saber cuantos usuarios son en total
            "recordsFiltered" => $data->num_rows(),         //envio el numero de filas para el calculo de la paginacion de la tabla
            "data" => $data->num_rows()>0?$dato:$data,                                 //envia todos los datos de la tabla
        );
        echo json_encode($output);                          //envio del vector de salida con los parametros correspondientes
        exit;                   
              
    }
    
    /**
    * funcion para eliminar la unidad pedagogica.
    *
    * @return json_encode() |set_status_header()
    */
    public function eliminarAsignatura($pk){
        if($res = $this->Subject->eliminar($pk)){                                   //realiza la verificacion y eliminacion de la asignatura
            echo json_encode(array('msg'=> 'asignatura eliminada exitosamente' ));  //si el rol fue eliminado correctamenre envia el mensaje de confirmacion
        }else{                                                                      //si no fue posible eliminarlo
            echo json_encode($res);                                                 //envio de la respueta
            $this->output->set_status_header(403);                                  //envio del status de error en este caso 403
        }   
        
    }
    
    /**
    *funcion para redirecionar a la visa de editar y envio de la informacion de las unidades pedagogicas.
    *@param  int $doc
    *@return  view()
    */
    public function editarAsignatura($doc){
        $data=$this->Subject->datosAsignatura($doc)->result_array()[0];          //verifica por medio del metodo datosUnidad() del modelo Learning_unit() si la unidad existe y trae todos los datos pertinentes al usuario       
        $data['unidades']  = $this->Learning_unit->listar(); //trae los datos de enfoques para agregar a la  unidad
        $this->load->view('private/view_ajax/editar_asignatura_ajax',$data);//envio de la vista y los datos para la edicion de los usuarios
    }
    
    /**
    *funcion para la modificacion de  la informacion de los roles.
    *@param  int $doc
    *@return  json_encode() | echo "error" | set_status_header()
    */
    public function modificarAsignatura($doc){
        $this->form_validation->set_error_delimiters('','');                        //quita los delimtadores de error
        $rules=getRulesAddAsignatura();                                                 //utiliza las reglas de agregar unidad para validar los campos del formulario
        $this->form_validation->set_rules($rules);                                  //ejecuta las reglas del fromulario 
        if($this->form_validation->run() === FALSE){                                //si se incumple algunade las regla
            $errors = array(                                                        //creacion del vector de los errores
                'SBJC_name'       => form_error('SBJC_name'),
                'SBJC_description'=> form_error('SBJC_description'),
            );
            echo json_encode($errors);                                              //envio del vector de errores
            $this->output->set_status_header(402);                                  //envio del estatus del error en este caso 402
        }else{                                                                      //si las reglas fueron cumplidas
            $name           = $this->input->post('SBJC_name');                      //obtencion de todos los datos del formulario                    
            $focus          = $this->input->post('SBJC_FK_learning_units');
            $description    = $this->input->post('SBJC_description');
            $data= array(                                                           //creacion del vector de los nuevos datos de la unidada
                'SBJC_name'                     =>  $name,
                'SBJC_FK_learning_units'        =>  $focus,
                'SBJC_description'              =>  $description,
                'SBJC_date_update'=>date("Y-m-d H:i:s"),
                'SBJC_PK_update'=>$this->session->userdata('id'),
                
            );
            if(!$this->Subject->modificarAsignatura($doc,$data)){                   //utilizacion del metodo modificarUnidad() del modelo learning_unit() para la modificacion de la unidad  enviando el id y los datos pertinentes
                echo "error";                                                       // en caso de  fallar envia un mensaje de error
            }
            echo json_encode(array('msg'=> 'Asignatura modificada' ));                // si fue modificado con exito envia el mensaje correspondiente
        }
    }
   
    /**
    * funcion para agregar unidades de aprendizaje a la base de datos.
    *
    * @return json_encode() |set_status_header() |echo "error"
    */
    public function agregarAsignatura(){
        $this->form_validation->set_error_delimiters('','');                        //quita los delimtadores de error
        $rules=getRulesAddAsignatura();                                             //utiliza las reglas de agregar unidad para validar los campos del formulario
        $this->form_validation->set_rules($rules);                                  //ejecuta las reglas del fromulario 
        if($this->form_validation->run() === FALSE){                                //si se incumple algunade las regla
            $errors = array(                                                        //creacion del vector de los errores
                'SBJC_name'       => form_error('SBJC_name'),
                'SBJC_description'=> form_error('SBJC_description'),
            );
            echo json_encode($errors);                                              //envio del vector de errores
            $this->output->set_status_header(402);                                  //envio del estatus del error en este caso 402
        }else{                                                                      //si las reglas fueron cumplidas
            $name           = $this->input->post('SBJC_name');                      //obtencion de todos los datos del formulario                    
            $focus          = $this->input->post('SBJC_FK_learning_units');
            $description    = $this->input->post('SBJC_description');
            $data= array(                                                           //creacion del vector de los nuevos datos de la unidad
                'SBJC_name'       =>  $name,
                'SBJC_FK_learning_units'=>  $focus,
                'SBJC_description'=>  $description,
                'SBJC_date_create'=>date("Y-m-d H:i:s"),
                'SBJC_PK_create'  =>$this->session->userdata('id'),
                'SBJC_date_update'=>date("Y-m-d H:i:s"),
                'SBJC_PK_update'  =>$this->session->userdata('id'),
                
            );
            if(!$this->Subject->agregarAsignatura($data)){                         //utilizacion del metodo modificarUnidad() del modelo Learning_unit() para la modificacion de la unidad enviando el id y los datos pertinentes
                echo "error";                                                        // en caso de  fallar envia un mensaje de error
            }
            echo json_encode(array('msg'=> 'Asignatura agregada' ));                     //si fue modificado con exito envia el mensaje correspondiente
        }       
    }
    
  
    
}