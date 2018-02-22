<?php
/**
*
*@autor jesus andres castellanos aguilar
* helper encargado  de la reglas de validacion de los formularios del aplicativo
*
*/

/**
*
*funcion encargada de las reglas de inicio de sesion.
*retorna el vector de errores
*@return array ()
*
*/
function getRulesLogin(){
    return array(
        array(
            'field' => 'email',
            'label' => 'Correo',
            'rules' => 'required|valid_email',              //campo requerido y en formato de email
             'errors' => array(
                 'required' => 'el correo es requerido',    //mensajes de error
                 'valid_email' => 'correo mal escrito',
             ),
        ),
        array(
            'field' => 'password',
            'label' => 'contraseña',
            'rules' => 'required',                           //campo requerido
            'errors' => array(
                'required' => 'la contraseña es requerida.', //mensajes de error
            ),
        ),
    );
}

/**
*
*funcion encargada de las reglas del formulario de registro y de edicion
*retorna el vector de errores
*@return array ()
*
*/
function getRulesAddUsers(){
    return array(
        array(
            'field' =>'USER_identification',
            'label' =>'USER_identification',
            'rules' =>'required',                              //campo requerido 
            'errors'=> array(       
                'required' => 'numero de documento necesario', //mensajes de error         
            ),
        ),
        array(
            'field' =>'USER_names',
            'label' =>'USER_names',
            'rules' =>'required',                               //campo requerido
            'errors'=> array(
                'required' => 'Nombres requeridos',             //mensajes de error
            ),
        ),
        array(
            'field' =>'USER_lastnames',
            'label' =>'USER_lastnames',
            'rules' =>'required',                               //campo requerido
            'errors'=> array(
                'required' => 'Apellidos requeridos',           //mensajes de error
            ),
        ),array(
            'field' =>'USER_email',
            'label' =>'USER_email',
            'rules' =>'required|valid_email',                   //campo requerido y en formato de email
            'errors'=> array(
                'required' => 'correo requerido',               //mensajes de error
                'valid_email' => 'correo mal escrito',
                
            ),
        ),array(
            'field' =>'USER_address',
            'label' =>'USER_address',
            'rules' =>'required',                               //campo requerido  
            'errors'=> array(
                'required' => 'Direccion requerida',            //mensajes de error  
            ),
        ),array(
            'field' =>'USER_telephone',
            'label' =>'USER_telephone',
            'rules' =>'required',                               //campo requerido
            'errors'=> array(
                'required' => 'telefono requerido',             //mensajes de error
            ),
        ),
        array(
            'field' =>'USER_password',
            'label' =>'USER_password',
            'rules' =>'required',                               //campo requerido
            'errors'=> array(
                'required' => 'clave requerida',                //mensajes de error
            ),
        ),
    );
    
}

/**
*
*funcion encargada de las reglas del formulario de registro y de edicion
*retorna el vector de errores
*@return array ()
*
*/
function getRulesAddRol(){
    return array(
        array(
            'field' =>'ROLE_name',
            'label' =>'ROLE_name',
            'rules' =>'required',                              //campo requerido 
            'errors'=> array(       
                'required' => 'nombre del rol necesario',       //mensajes de error         
            ),
        ),
        array(
            'field' =>'ROLE_shortname',
            'label' =>'ROLE_shortname',
            'rules' =>'required',                               //campo requerido
            'errors'=> array(
                'required' => 'Nombre corto requerido',        //mensajes de error
            ),
        ),
        array(
            'field' =>'ROLE_description',
            'label' =>'ROLE_description',
            'rules' =>'required',                               //campo requerido
            'errors'=> array(
                'required' => 'Descripcion requerida ',         //mensajes de error
            ),
        ),
    );
    
}
/**
*
*funcion encargada de las reglas del formulario de registro y de edicion
*retorna el vector de errores
*@return array ()
*
*/
function getRulesAddPermiso(){
    return array(
        array(
            'field' =>'PRMS_name',
            'label' =>'PRMS_name',
            'rules' =>'required',                              //campo requerido 
            'errors'=> array(       
                'required' => 'nombre del permiso necesario',       //mensajes de error         
            ),
        ),
        array(
            'field' =>'PRMS_shortname',
            'label' =>'PRMS_shortname',
            'rules' =>'required',                               //campo requerido
            'errors'=> array(
                'required' => 'Nombre corto requerido',        //mensajes de error
            ),
        ),
        array(
            'field' =>'PRMS_description',
            'label' =>'PRMS_description',
            'rules' =>'required',                               //campo requerido
            'errors'=> array(
                'required' => 'Descripcion requerida ',         //mensajes de error
            ),
        ),
    );
    
}
/**
*
*funcion encargada de las reglas del formulario de registro y de edicion
*retorna el vector de errores
*@return array ()
*
*/
function getRulesAddPlan(){
    return array(
        array(
            'field' =>'PLAN_name',
            'label' =>'PLAN_name',
            'rules' =>'required',                                   //campo requerido 
            'errors'=> array(       
                'required' => 'nombre del plan es necesario',       //mensajes de error         
            ),
        ),
    );
    
}

/**
*
*funcion encargada de las reglas del formulario de registro y de edicion
*retorna el vector de errores
*@return array ()
*
*/
function getRulesAddVersion(){
    return array(
        array(
            'field' =>'VRSN_name',
            'label' =>'VRSN_name',
            'rules' =>'required',                                        //campo requerido 
            'errors'=> array(       
                'required' => 'nombre de la version es necesario',       //mensajes de error         
            ),
        ),
    );
    
}