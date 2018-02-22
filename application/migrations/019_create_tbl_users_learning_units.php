<?php
/**
*
*@autor jesus andres castellanos aguilar
*
*archivo de migracion encargado de la cracion y eliminacion de la tabla users_learning_units en la base de datos
* 
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_tbl_users_learning_units extends CI_Migration {
    
    /**
    * funcion para crreacion de la tabla users_learning_units
    *
    * @return create_table()
    */
    public function up(){
        $this->dbforge->add_field(array(                                                                   //creacion del vector que contiene los campos de la tabla
            'USLE_PK' => array(                                                                            //columna USLE_PK tipo int, tamaño 10, auto icremental, solo positivos
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ),
            'USLE_FK_users' => array(                                                                     //columna USLE_FK_users tipo int, tamaño 10, solo positivos
                'type' => 'INT',
                'unsigned' => TRUE,
            ),
            'USLE_FK_learning_units' => array(                                                             //columna USLE_FK_learning_units tipo int, tamaño 10, solo positivos
                'type' => 'INT',
                'unsigned' => TRUE,
            ),
            'USLE_FK_roles' => array(                                                                     //columna USLE_FK_roles tipo int, tamaño 10, solo positivos
                'type' => 'INT',
                'unsigned' => TRUE,
            ),
            
            'USLE_date_create' => array(                    //columna USLE_address tipo VARCHAR, tamaño 45
                'type' => 'DATETIME',
            ),
            'USLE_date_update' => array(                  //columna USLE_telephone tipo VARCHAR, tamaño 45
                'type' => 'DATETIME',
            ),
            'USLE_PK_create' => array(                    //columna USLE_address tipo VARCHAR, tamaño 45
                'type' => 'INT',
            ),
            'USLE_PK_update' => array(                  //columna USLE_telephone tipo VARCHAR, tamaño 45
                'type' => 'INT',
            ),
        ));
        $this->dbforge->add_key('USLE_PK', TRUE);                                                           //agregar atributo de llave primaria al campo USLE_PK
        $this->dbforge->create_table('users_learning_units');                                               //creacion de la tabla users con los atributos y columnas
        
        $this->dbforge->add_column('users_learning_units',[
            'CONSTRAINT USLE_FK_users FOREIGN KEY(USLE_FK_users) REFERENCES users(USER_PK)',
        ]);                                                                                                 //creacion de relacion a la tabla users
        $this->dbforge->add_column('users_learning_units',[
            'CONSTRAINT USLE_FK_learning_units FOREIGN KEY(USLE_FK_learning_units) REFERENCES learning_units(LNUT_PK)',
        ]);                                                                                                 //creacion de relacion a la tabla learning_units
        $this->dbforge->add_column('users_learning_units',[
            'CONSTRAINT USLE_FK_roles FOREIGN KEY(USLE_FK_roles) REFERENCES roles(ROLE_PK)',
        ]);                                                                                                 //creacion de relacion a la tabla roles
    }
    /**
    * funcion para eliminacion de la tabla users_learning_units
    *
    * @return drop_table()
    */
    public function down(){
        $this->dbforge->drop_table('users_learning_units');                                                   //eliminacion de la tabla users_learning_units
    }
}
