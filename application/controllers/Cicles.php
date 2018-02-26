<?php
/**
*
*@autor jesus andres castellanos aguilar
*
* controlador encargado de todos los procesos referente a los planes de estudio
* 
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class Cicles extends CI_Controller{
    
    /**
    * metodo cnstructor donde se cargan todos los helpers, librerias y modelos necesarios en el controlador
    * @library 
    * @model  plan()|logueo() | version()
    * @helper login_rules() |url() |form ()
    * 
    */
    function __construct() {
        parent::__construct ();
        $this->load->model('Cicle');
        $this->load->model('Plan');
        $this->load->model('Role');
        $this->load->model('users');
        $this->load->model('Logueo');
        $this->load->helper('login_rules');
        $this->load->helper('url');
        $this->load->helper('form');
    }
    
    /**
    * funcion para mostrar la  vista principal donde se listan los planes de estudio.
    *
    * @return view ()
    */
    public function index(){
        $versiones = $this->Plan->listarVersionsPlans();
        $data['versiones']=$versiones;
        $this->load->view('private/Cicles',$data);
    }
    
    /**
    * funcion para listar los planes de estudio en la data teble.
    *
    * @return json_encode ()
    */
    public function listarCicles(){
        $draw = intval($this->input->get("draw"));             //trae las varibles draw, start, length para la creacion de la tabla
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $data =$this->Cicle->listar();                       //utiliza el metodo listar() del modelo plan() para traer los datos de todos los planes 
        foreach($data->result() as $r) {                    //ciclo para la creacion de las filas y columnas de la tabla de datos incluye los botones de acciones
            $dato[] = array(
                $r->CCLS_name,
                $r->VRSN_name.'/'.$r->PLAN_name,
                '<input type="button" class="btn btn-warning edit" title="Editar Curso" id="'.$r->CCLS_PK.'" value="editar" ><input type="button" class="btn btn-danger remove" title="Eliminar Curso" id="'.$r->CCLS_PK.'" value="eliminar" ><input type="button" class="btn btn-success asignar" title="Agregar asignaturas" id="'.$r->CCLS_PK.'" value="asignaturas" >',
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
    * funcion para agregar los nuevos planes de  estudio.
    *
    * @return json_encode()
    */
    public function agregarCicles(){
        $this->form_validation->set_error_delimiters('','');   //quita los delimtadores de error
        $rules=getRulesAddCicle();                              //utiliza las reglas de agregar plan para validar los campos del formulario
        $this->form_validation->set_rules($rules);             //ejecuta las reglas del fromulario 
        if($this->form_validation->run() === FALSE){           //si se incumple algunade las regla
            $errors = array(
                'CCLS_name' => form_error('CCLS_name'),
            );
            echo json_encode($errors);                          //envio del vector de errores
            $this->output->set_status_header(402);              //envio del estatus del error en este caso 402
        }else{                                                  //si las reglas fueron cumplidas
            $name = $this->input->post('CCLS_name');            //obtencion de todos los datos del formulario
            $versions = $this->input->post('CCLS_FK_versions_plans');            
            $data= array(                                       //creacion del vector de los nuevos datos del plan
                'CCLS_name'             =>  $name,
                'CCLS_FK_versions_plans'=>  $versions,
                'CCLS_date_create'      =>  date("Y-m-d H:i:s"),
                'CCLS_date_update'      =>  date("Y-m-d H:i:s"),
                'CCLS_PK_create'        =>  $this->session->userdata('id'),
                'CCLS_PK_update'        =>  $this->session->userdata('id'),
            );
            if(!$this->Cicle->agregarCicle($data)){                       //utilizacion del metodo agregarPlan() del modelo Plan() para la agregacion de un nuevo plan los datos pertinentes
                echo "error";                                             // en caso de  fallar envia un mensaje de
            echo json_encode(array('msg'=> 'Curso agregado agregado' ));  //si fue agregado con exito envia el mensaje correspondiente
            }
        }
    }
    
    /**
    * funcion para eliminar el plan correspondiente
    * @param int $pk
    * @return view ()
    */
    public function eliminarCicles($pk){
        if($res = $this->Cicle->eliminar($pk)){                                      //realiza la verificacion y eliminacion del plan
            echo json_encode(array('msg'=> 'curso eliminado exitosamente' ));        //si el plan fue eliminado correctamente envia el mensaje de confirmacion
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
    public function editarCicle($pk){
        $data=$this->Cicle->datosCicle($pk);                             //verifica por medio del metodo datosPlan() del modelo Plan() si el usuario existe ytrae todos los datos pertinentes al usuario 
        foreach($data->result() as $r) {                                //ciclo para  convertir los datos en un arreglo
            $dato = array();                                            //creacion del vector que contendra los datos del plan
            $dato['CCLS_PK']    = $r->CCLS_PK;
            $dato['CCLS_name']  = $r->CCLS_name;
            $dato['CCLS_FK_versions_plans']= $r->CCLS_FK_versions_plans;
            $dato['VRSN_name']  = $r->VRSN_name;
            $dato['PLAN_name']  = $r->PLAN_name;
        }
        $roles = $this->Role->listar();
        $versiones = $this->Plan->listarVersionsPlans();
        $dato['versiones']=$versiones;
        $dato['roles']=$roles;
        $this->load->view('private/view_ajax/editar_cicle_ajax',$dato);  //envio de la vista y los datos para la edicion de los planes
    }
    /**
    * funcion para la modificacion de los datos del plan
    * @param int $doc
    * @return json_encode()
    */
    public function modificarCicle($doc){
        $this->form_validation->set_error_delimiters('','');             //quita los delimtadores de error
        $rules=getRulesAddCicle();                                        //utiliza las reglas de agregar plan para validar los campos del formulario
        $this->form_validation->set_rules($rules);                       //ejecuta las reglas del fromulario 
        if($this->form_validation->run() === FALSE){                     //si se incumple algunade las regla
            $errors = array(                                             //creacion del vector de los errores
                'CCLS_name' => form_error('CCLS_name'),
            );
            echo json_encode($errors);                                   //envio del vector de errores
            $this->output->set_status_header(402);                       //envio del estatus del error en este caso 402
        }else{                                                           //si las reglas fueron cumplidas
            $name = $this->input->post('CCLS_name');                     //obtencion de todos los datos del formulario
            $versions = $this->input->post('CCLS_FK_versions_plans');                    
            $data = array(                                               //creacion del vector de los nuevos datos del plan
                'CCLS_name'             =>  $name,
                'CCLS_FK_versions_plans'=>  $versions,
                'CCLS_date_update'      =>  date("Y-m-d H:i:s"),
                'CCLS_PK_update'        =>  $this->session->userdata('id'),
            );
            if(!$this->Cicle->modificarCicle($doc,$data)){                 //utilizacion del metodo modificarPlan() del modelo Plan() para la modificacion del plan  enviando el id y los datos pertinentes
                echo "error";                                            //en caso de  fallar envia un mensaje de error
            }
            echo json_encode(array('msg'=> 'Cicle modificado' ));         //si fue modificado con exito envia el mensaje correspondiente
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
    public function listarVersionsCicles($id){
        $draw = intval($this->input->get("draw"));                                  //trae las varibles draw, start, length para la creacion de la tabla
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $data =$this->Plan->listarVersionPlan($id);                                 //utiliza el metodo listarVersionsCicles() del modelo Plan() para traer los datos de todos las versiones de los planes
        foreach($data->result() as $r) {                                            //ciclo para la creacion de las filas y columnas de la tabla de datos incluye los botones de acciones
            $dato [] = array(
                $r->VRSN_name,
                '<input type="button" class="btn btn-danger fa fa-remove remove" title="Eliminar Version" id="'.$r->VRPL_PK.'" value="eliminar" >',
            );
        }
        $output = array(                                                            //creacion del vector de salida
            "draw" => $draw,                                                        //envio la variable de dibujo de la tabla                    
            "recordsTotal" =>$data->num_rows(),                                     //envia el numero de filas  para saber cuantos usuarios son en total
            "recordsFiltered" => $data->num_rows(),                                 //envio el numero de filas para el calculo de la paginacion de la tabla
            "data" => $dato,                                                        //envia todos los datos de la tabla
        );
        echo json_encode($output);                                                  //envio del vector de salida con los parametros correspondientes
        exit;                                                                       //salida del proceso
    }
    
    /**
    * funcion para listar todas las versiones para agregar a los planes.
    *
    * @return json_encode()
    */
    public function listarVersions(){
        $draw   = intval($this->input->get("draw"));                                //trae las varibles draw, start, length para la creacion de la tabla
        $start  = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $data   =$this->Version->listar();                                          //utiliza el metodo listar() del modelo Version() para traer los datos de todos las versiones
        foreach($data->result() as $r) {                                            //ciclo para la creacion de las filas y columnas de la tabla de datos incluye los botones de acciones
            $dato [] = array(
                $r->VRSN_name,
                '<input type="button" class="btn btn-success asignar" title="Asignar Version" id="'.$r->VRSN_PK.'" value="asignar" >',
            );
        }
        
        $output = array(                                                            //creacion del vector de salida
            "draw" => $draw,                                                        //envio la variable de dibujo de la tabla                    
            "recordsTotal" =>$data->num_rows(),                                     //envia el numero de filas  para saber cuantos usuarios son en total
            "recordsFiltered" => $data->num_rows(),                                 //envio el numero de filas para el calculo de la paginacion de la tabla
            "data" => $dato,                                                        //envia todos los datos de la tabla
        );
        
        echo json_encode($output);                                                  //envio del vector de salida con los parametros correspondientes
        exit;                                                                       //salida del proceso
    }
    
    /**
    * funcion para eliminar la version de un plan
    *
    * @return json_encode() |set_status_header()
    */
    public function eliminarVersionPlan($pk){
        if($res = $this->Plan->eliminarVersionPlan($pk)){                           //realiza la verificacion y eliminacion de la version del plan
            echo json_encode(array('msg'=> 'version eliminado exitosamente' ));     //si la version del plan fue eliminado correctamenre envia el mensaje de confirmacion
        }else{                                                                      //si no fue posible eliminarlo
            echo json_encode($res);                                                 //envio de la respueta
            $this->output->set_status_header(403);                                  //envio del status de error en este caso 403
        }
        
    }
    
    /**
    * funcion para asignar una version a un plan.
    *
    * @return true | false  |set_status_header()
    */
    public function asignarVersion($plan,$version){
        if ($this->Plan->consultarVersioPlan($plan,$version)){                     //verifica si la version ya fu asignada al plan
            $this->output->set_status_header(402);                                 //envia el error en caso de existir
        }else{
            $data= array(
                'VRPL_FK_versions'            =>  $version,                        //crea el vector con los datos
                'VRPL_FK_plans'               =>  $plan,
            );
            if ($this->Plan->asignarVersion($data)){                               //envia y valida la insercion de la nueva version del plan
                return true;
            }
            return false;  
        }
    }
    
    /**
    * funcion para listar los miembros dentro de un curso.
    *
    * @return json_encode ()
    */
    public function listarMiembrosCicles($id){
        $draw = intval($this->input->get("draw"));              //trae las varibles draw, start, length para la creacion de la tabla
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $data =$this->Cicle->listarMiembros($id);               //utiliza el metodo listarMiembros() del modelo Cicle() para traer los datos de todos los planes 
        foreach($data->result() as $r) {                        //ciclo para la creacion de las filas y columnas de la tabla de datos incluye los botones de acciones
            $dato[] = array(
                $r->USER_names.' '.$r->USER_lastnames,
                $r->ROLE_name,
                '<input type="button" class="btn btn-danger remove" title="Eliminar Curso" id="'.$r->UMCL_PK.'" value="eliminar" >',
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
    * funcion para agregar los nuevos miembros a los cursos.
    *
    * @return json_encode()
    */
    public function agregarMiembro(){
        $cicle  = $this->input->post('CICLE_PK');                           //obtencion de todos los datos del formulario
        $doc    = $this->input->post('UMCL_FK_users');                      //obtencion de todos los datos del formulario
        $role    = $this->input->post('UMCL_FK_roles');                     //obtencion de todos los datos del formulario
        if($user = $this->users->verificarUsuarioDoc($doc)){
            foreach ($user->result() as $r){
                $hola=$r->USER_PK;
            }
            if($this->Cicle->verificarMiembroCicle($cicle,$hola)){          //verifica si el miembro ya existe en el curso
                echo json_encode($this->Cicle->verificarMiembroCicle($cicle,$hola));
                $this->output->set_status_header(403);                      //envio de  estatus de error;
                exit;
            }
        }
        $data   = array(                                                    //creacion de arreglo para la insercion de datos
            'UMCL_FK_users'         =>  $hola,
            'UMCL_FK_cicles'        =>  $cicle,
            'UMCL_FK_roles'         =>  $role,
            'UMCL_date_create'      =>  date("Y-m-d H:i:s"),
            'UMCL_date_update'      =>  date("Y-m-d H:i:s"),
            'UMCL_PK_create'        =>  $this->session->userdata('id'),
            'UMCL_PK_update'        =>  $this->session->userdata('id'),
        );
        
        if(!$this->Cicle->agregarMiembroCicle($data)){                      //utilizacion del metodo agregarMiembroCicle() del modelo Cicle() para la agregacion de un nuevos miembros al curso
            echo "error";                                                   // en caso de  fallar envia un mensaje de
            echo json_encode(array('msg'=> 'Curso agregado agregado' ));    //si fue agregado con exito envia el mensaje correspondiente
        }
    }
    
    /**
    * funcion para eliminar los miembros de un curso.
    * @param int $pk
    * @return json_encode() | set_status_header()
    */
    public function eliminarMiembro($pk){
        if($res = $this->Cicle->eliminarrMiembroCicle($pk)){                                //realiza la verificacion y eliminacion de la version del plan
            echo json_encode(array('msg'=> 'miembro eliminado del curso correctamente'));   //si la version del plan fue eliminado correctamenre envia el mensaje de confirmacion
        }else{                                                                              //si no fue posible eliminarlo
            echo json_encode($res);                                                         //envio de la respueta
            $this->output->set_status_header(403);                                          //envio del status de error en este caso 403
        }
    }
        
    /**
    * funcion para mostrar la  vista de asigar materias.
    *
    * @return view () | $data
    */
    public function asignarMateria($PK){
        $data['id'] =$PK;
        $this->load->view('private/view_ajax/asignacion_asignaturas_cicle_ajax',$data);
    }
    
    /**
    * funcion para listar las materias agregadas al curso.
    * @param  int $PK
    * @return json_encode()
    */
    public function listarMateriasCicle($PK){
        $draw = intval($this->input->get("draw"));                  //trae las varibles draw, start, length para la creacion de la tabla
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $data =$this->Cicle->listarMateriaCicle($PK);               //utiliza el metodo listarMateriaCicle0() del modelo Cicle() para traer los datos de todos los planes 
        foreach($data->result() as $r) {                            //ciclo para la creacion de las filas y columnas de la tabla de datos incluye los botones de acciones
            $dato[] = array(
                $r->SBJC_name,
                '<input type="button" class="btn btn-danger remove" title="Eliminar Curso" id="'.$r->CLSB_PK.'" value="eliminar" >',
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
    * funcion para eliminar las materias agregadas a un curso.
    * @param int $PK
    * @return json_encode ()    | set_status_header()
    */
    public function eliminarMateriaCicle($PK){
        if($res = $this->Cicle->eliminarMateriaCicle($PK)){                                 //realiza la verificacion y eliminacion de la materia en el curso
            echo json_encode(array('msg'=> 'materia eliminada del curso correctamente'));   //si la version del plan fue eliminado correctamenre envia el mensaje de confirmacion
        }else{                                                                              //si no fue posible eliminarlo
            echo json_encode($res);                                                         //envio de la respueta
            $this->output->set_status_header(403);                                          //envio del status de error en este caso 403
        }
    }
    
    /**
    * funcion para listar las materias que se pueden agregar a el curso
    *
    * @return json_encode ()
    */
    public function listarMaterias(){
        $draw = intval($this->input->get("draw"));          //trae las varibles draw, start, length para la creacion de la tabla
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $data =$this->Cicle->listarMaterias();              //utiliza el metodo listarMaterias() del modelo Cicle() para traer los datos de todos las materias
        foreach($data->result() as $r) {                    //ciclo para la creacion de las filas y columnas de la tabla de datos incluye los botones de acciones
            $dato[] = array(
                $r->SBJC_name,
                '<input type="button" class="btn btn-success asignar" title="Eliminar Curso" id="'.$r->SBJC_PK.'" value="asignar" >',
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
    * funcion para asignar materias al curso.
    * @param int $curso,$matria
    * @return true | false
    */
    public function asignarMateriaCurso($curso,$materia){
        if ($this->Cicle->consultarMateriaCicle($curso,$materia)){  //verifica si la materia ya fue asignada ya fue asignado
            $this->output->set_status_header(402);                  //envia el error en caso de existir
        }else{
            $data= array(
                'CLSB_FK_cicles'   =>  $curso,                      //crea el vector con los datos
                'CLSB_FK_subjects' =>  $materia,
                'CLSB_date_create'      =>  date("Y-m-d H:i:s"),
                'CLSB_date_update'      =>  date("Y-m-d H:i:s"),
                'CLSB_PK_create'        =>  $this->session->userdata('id'),
                'CLSB_PK_update'        =>  $this->session->userdata('id'),
            );
            if ($this->Cicle->asignarMateria($data)){               //envia y valida la insercion de la nueva materia en el curso
                return true;
            }
            return false;  
        }
    }
}
