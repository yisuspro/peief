<?php

/**
*
*@autor jesus andres castellanos aguilar
*
* controlador encargado de todos los procesos referente a los usuarios
* 
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class Learning_units extends CI_Controller{
    
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
        $this->load->model('Focu');
        $this->load->model('Users');
        $this->load->model('Role');
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
        $focus= $this->Focu->listar();
        $data['focus']=$focus;
        $this->load->view('private/learning_units',$data);
    }

    /**
    * funcion el envio de datos para dibujar la tabla de roles.
    *
    * @return json_encode()
    */
     public function listarUnidades(){
        $draw = intval($this->input->get("draw"));          //trae las varibles draw, start, length para la creacion de la tabla
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $data =$this->Learning_unit->listar();              //utiliza el metodo listar() del modelo learning_units() para traer los datos de todos las unidades
        foreach($data->result() as $r) {                    //ciclo para la creacion de las filas y columnas de la tabla de datos incluye los botones de acciones
            $dato [] = array(
                $r->LNUT_name,
                $r->LNUT_description,
                $r->FOCS_name,
                '<input type="button" class="btn btn-warning fa fa-remove edit" title="Editar unidad" id="'.$r->LNUT_PK.'" value="editar" ><input type="button" class="btn btn-danger fa fa-remove remove" title="Eliminar unidad" id="'.$r->LNUT_PK.'" value="eliminar" ><input type="button" class="btn btn-info fa fa-remove asignar" title="Asignar miembros" id="'.$r->LNUT_PK.'" value="asignar" >',
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
    * funcion para eliminar la unidad pedagogica.
    *
    * @return json_encode() |set_status_header()
    */
    public function eliminarUnidades($pk){
        if($res = $this->Learning_unit->eliminar($pk)){                         //realiza la verificacion y eliminacion de la unidad pedagogica
            echo json_encode(array('msg'=> 'permiso eliminado exitosamente' )); //si el rol fue eliminado correctamenre envia el mensaje de confirmacion
        }else{                                                                  //si no fue posible eliminarlo
            echo json_encode($res);                                             //envio de la respueta
            $this->output->set_status_header(403);                              //envio del status de error en este caso 403
        }
        
    }
    
    /**
    *funcion para redirecionar a la visa de editar y envio de la informacion de las unidades pedagogicas.
    *@param  int $doc
    *@return  view()
    */
    public function editarUnidades($doc){
        $data=$this->Learning_unit->datosUnidad($doc);                              //verifica por medio del metodo datosUnidad() del modelo Learning_unit() si la unidad existe y trae todos los datos pertinentes al usuario 
        $focus=$this->Focu->listar();                                               //trae los datos de enfoques para agregar a la  unidad
        foreach($data->result() as $r) {                                            //ciclop para  convertir los datos en un arreglo
            $dato = array();                                                        //creacion del vector que contendra los datos de la unidad
            $dato['LNUT_PK'] = $r->LNUT_PK;
            $dato['LNUT_name'] = $r->LNUT_name;
            $dato['LNUT_FK_focus']= $r->LNUT_FK_focus;
            $dato['LNUT_description']= $r->LNUT_description;
            $dato['FOCS_name']= $r->FOCS_name;
            $dato['FOCS_PK']= $r->FOCS_PK;
            
        }
        $dato['focus']  = $focus;
        $this->load->view('private/view_ajax/editar_unidad_pedagogica_ajax',$dato);//envio de la vista y los datos para la edicion de los usuarios
    }
    
    /**
    *funcion para la modificacion de  la informacion de los roles.
    *@param  int $doc
    *@return  json_encode() | echo "error" | set_status_header()
    */
    public function modificarUnidades($doc){
        $this->form_validation->set_error_delimiters('','');                        //quita los delimtadores de error
        $rules=getRulesAddUnidad();                                                 //utiliza las reglas de agregar unidad para validar los campos del formulario
        $this->form_validation->set_rules($rules);                                  //ejecuta las reglas del fromulario 
        if($this->form_validation->run() === FALSE){                                //si se incumple algunade las regla
            $errors = array(                                                        //creacion del vector de los errores
                'LNUT_name'       => form_error('LNUT_name'),
                'LNUT_description'=> form_error('LNUT_description'),
            );
            echo json_encode($errors);                                              //envio del vector de errores
            $this->output->set_status_header(402);                                  //envio del estatus del error en este caso 402
        }else{                                                                      //si las reglas fueron cumplidas
            $name           = $this->input->post('LNUT_name');                      //obtencion de todos los datos del formulario                    
            $focus          = $this->input->post('LNUT_FK_focus');
            $description    = $this->input->post('LNUT_description');
            $data= array(                                                           //creacion del vector de los nuevos datos de la unidada
                'LNUT_name'                     =>  $name,
                'LNUT_FK_focus'                 =>  $focus,
                'LNUT_description'              =>  $description,
                'LNUT_date_update'=>date("Y-m-d H:i:s"),
                'LNUT_PK_update'=>$this->session->userdata('id'),
                
            );
            if(!$this->Learning_unit->modificarUnidad($doc,$data)){                 //utilizacion del metodo modificarUnidad() del modelo learning_unit() para la modificacion de la unidad  enviando el id y los datos pertinentes
                echo "error";                                                       // en caso de  fallar envia un mensaje de error
            }
            echo json_encode(array('msg'=> 'Unididad modificada' ));                // si fue modificado con exito envia el mensaje correspondiente
        }
    }
   
    /**
    * funcion para agregar unidades de aprendizaje a la base de datos.
    *
    * @return json_encode() |set_status_header() |echo "error"
    */
    public function agregarUnidad(){
        $this->form_validation->set_error_delimiters('','');                        //quita los delimtadores de error
        $rules=getRulesAddUnidad();                                                 //utiliza las reglas de agregar unidad para validar los campos del formulario
        $this->form_validation->set_rules($rules);                                  //ejecuta las reglas del fromulario 
        if($this->form_validation->run() === FALSE){                                //si se incumple algunade las regla
            $errors = array(                                                        //creacion del vector de los errores
                'LNUT_name'       => form_error('LNUT_name'),
                'LNUT_description'=> form_error('LNUT_description'),
            );
            echo json_encode($errors);                                              //envio del vector de errores
            $this->output->set_status_header(402);                                  //envio del estatus del error en este caso 402
        }else{                                                                      //si las reglas fueron cumplidas
            $name           = $this->input->post('LNUT_name');                      //obtencion de todos los datos del formulario                    
            $focus          = $this->input->post('LNUT_FK_focus');
            $description    = $this->input->post('LNUT_description');
            $data= array(                                                           //creacion del vector de los nuevos datos de la unidad
                'LNUT_name'       =>  $name,
                'LNUT_FK_focus'   =>  $focus,
                'LNUT_description'=>  $description,
                'LNUT_date_create'=>  date("Y-m-d H:i:s"),
                'LNUT_PK_create'  =>  $this->session->userdata('id'),
                'LNUT_date_update'=>  date("Y-m-d H:i:s"),
                'LNUT_PK_update'  =>  $this->session->userdata('id'),
                
            );
            if(!$this->Learning_unit->agregarUnidad($data)){                         //utilizacion del metodo modificarUnidad() del modelo Learning_unit() para la modificacion de la unidad enviando el id y los datos pertinentes
                echo "error";                                                        // en caso de  fallar envia un mensaje de error
            }
            echo json_encode(array('msg'=> 'Unidad agregada' ));                     //si fue modificado con exito envia el mensaje correspondiente
        }       
    }
    
    /**
    *funcion para redirecionar a la visa de editar y envio de la informacion de las unidades pedagogicas.
    *@param  int $doc
    *@return  view()
    */
    public function asignarUsuarios($doc){
        $roles=$this->Role->listar();                                               //trae los datos de enfoques para agregar a la  unidad
        $dato['id']     = $doc;
        $dato['roles']  = $roles;
        $this->load->view('private/view_ajax/asignacion_usuarios_unidades_ajax',$dato);//envio de la vista y los datos para la edicion de los usuarios
    }
    
    /**
    * funcion el envio de datos para dibujar la tabla de roles.
    *
    * @return json_encode()
    */
     public function listarUsuarios($id){
         $draw   = intval($this->input->get("draw"));            //trae las varibles draw, start, length para la creacion de la tabla
         $start  = intval($this->input->get("start"));
         $length = intval($this->input->get("length"));
         $data =$this->Learning_unit->listarUsuarios($id);       //utiliza el metodo listar() del modelo learning_units() para traer los datos de todos las unidades
        
         foreach($data->result() as $r) {                        //ciclo para la creacion de las filas y columnas de la tabla de datos incluye los botones de acciones
            $dato [] = array(
                $r->USER_names,
                $r->ROLE_name,
                '<input type="button" class="btn btn-danger fa fa-remove remove" title="Eliminar usuario" id="'.$r->USLE_PK.'" value="eliminar" >',
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
    * funcion para eliminar la unidad pedagogica.
    *
    * @return json_encode() |set_status_header()
    */
    public function eliminarUsuario($pk){
        if($res = $this->Learning_unit->eliminarUsuario($pk)){                         //realiza la verificacion y eliminacion de la unidad pedagogica
            echo json_encode(array('msg'=> 'usuario eliminado exitosamente' )); //si el rol fue eliminado correctamenre envia el mensaje de confirmacion
        }else{                                                                  //si no fue posible eliminarlo
            echo json_encode($res);                                             //envio de la respueta
            $this->output->set_status_header(403);                              //envio del status de error en este caso 403
        }
        
    }
    /**
    * funcion para agregar los nuevos miembros a los cursos.
    *
    * @return json_encode()
    */
    public function agregarUsuario(){
        $unit       = $this->input->post('USLE_FK_learning_units');            //obtencion de todos los datos del formulario
        $doc        = $this->input->post('USLE_FK_users');                     //obtencion de todos los datos del formulario
        $role       = $this->input->post('USLE_FK_roles');                     //obtencion de todos los datos del formulario
        if($user = $this->Users->verificarUsuarioDoc($doc)){
            foreach ($user->result() as $r){
                $hola=$r->USER_PK;
            }
            if($this->Learning_unit->verificarUsuario($unit,$hola)){            //verifica si el miembro ya existe en el curso
                echo json_encode($this->Learning_unit->verificarUsuario($unit,$hola));
                $this->output->set_status_header(403);                          //envio de  estatus de error;
                exit;
            }
        }
        $data   = array(                                                    //creacion de arreglo para la insercion de datos
            'USLE_FK_users'         =>  $hola,
            'USLE_FK_learning_units'        =>  $unit,
            'USLE_FK_roles'         =>  $role,
            'USLE_date_create'      =>  date("Y-m-d H:i:s"),
            'USLE_date_update'      =>  date("Y-m-d H:i:s"),
            'USLE_PK_create'        =>  $this->session->userdata('id'),
            'USLE_PK_update'        =>  $this->session->userdata('id'),
        );
        
        if(!$this->Learning_unit->agregarUsuario($data)){                      //utilizacion del metodo agregarMiembroCicle() del modelo Cicle() para la agregacion de un nuevos miembros al curso
            echo "error";                                                   // en caso de  fallar envia un mensaje de
            echo json_encode(array('msg'=> 'Curso agregado agregado' ));    //si fue agregado con exito envia el mensaje correspondiente
        }
    }
}