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
