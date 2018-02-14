<?php
function getRulesLogin(){
    return array(
        array(
                'field' => 'email',
                'label' => 'Correo',
                'rules' => 'required',
                'errors' => array(
                        'required' => 'el correo es requerido',
                ),
        ),
        array(
                'field' => 'password',
                'label' => 'contraseña',
                'rules' => 'required',
                'errors' => array(
                        'required' => 'la contraseña es requerida.',
                ),
        ),
    );
}

function getRulesAddUsers(){
    return array(
        array(
            'field' =>'USER_PK',
            'label' =>'USER_PK',
            'rules' =>'required',
            'errors'=> array(
                'required' => 'numero de documento necesario',
            ),
        ),
        array(
            'field' =>'USER_names',
            'label' =>'USER_names',
            'rules' =>'required',
            'errors'=> array(
                'required' => 'Nombres requeridos',
            ),
        ),
        array(
            'field' =>'USER_lastnames',
            'label' =>'USER_lastnames',
            'rules' =>'required',
            'errors'=> array(
                'required' => 'Apellidos requeridos',
            ),
        ),array(
            'field' =>'USER_email',
            'label' =>'USER_email',
            'rules' =>'required',
            'errors'=> array(
                'required' => 'correo requerido',
            ),
        ),array(
            'field' =>'USER_address',
            'label' =>'USER_address',
            'rules' =>'required',
            'errors'=> array(
                'required' => 'Direccion requerida',
            ),
        ),array(
            'field' =>'USER_telephone',
            'label' =>'USER_telephone',
            'rules' =>'required',
            'errors'=> array(
                'required' => 'telefono requerido',
            ),
        ),
        array(
            'field' =>'USER_password',
            'label' =>'USER_password',
            'rules' =>'required',
            'errors'=> array(
                'required' => 'clave requerida',
            ),
        ),
    );
    
}
