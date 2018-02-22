<?php
/**
*
*@autor jesus andres castellanos aguilar
*
*archivo de migracion encargado de la cracion y eliminacion de la tabla learning_units en la base de datos
* 
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_tbl_learning_units extends CI_Migration {
    
    /**
    * funcion para crreacion de la tabla users
    *
    * @return create_table()
    */
    public function up(){
        $this->dbforge->add_field(array(                                                                   //creacion del vector que contiene los campos de la tabla
            'LNUT_PK' => array(                                                                            //columna LNUT_PK tipo int, tamaño 10, auto icremental, solo positivos
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ),
            'LNUT_name' => array(                                                                           //columna SBJC_name tipo VARCHAR, tamaño 45
                'type' => 'VARCHAR',
                'constraint' => '45',
            ),
            'LNUT_description' => array(                                                                    //columna SBJC_name tipo VARCHAR, tamaño 45
                'type' => 'VARCHAR',
                'constraint' => '45',
            ),
            'LNUT_FK_focus' => array(                                                                       //columna LNUT_FK_focus tipo int, tamaño 10, solo positivos
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
            ),
            'LNUT_date_create' => array(                                                                    //columna LNUT_address tipo VARCHAR, tamaño 45
                'type' => 'DATETIME',
            ),
            'LNUT_date_update' => array(                                                                     //columna LNUT_telephone tipo VARCHAR, tamaño 45
                'type' => 'DATETIME',
            ),
            'LNUT_PK_create' => array(                                                                         //columna LNUT_address tipo VARCHAR, tamaño 45
                'type' => 'INT',
            ),
            'LNUT_PK_update' => array(                                                                          //columna LNUT_telephone tipo VARCHAR, tamaño 45
                'type' => 'INT',
            ),
        ));
        $this->dbforge->add_key('LNUT_PK', TRUE);                                                           //agregar atributo de llave primaria al campo LNUT_PK
        $this->dbforge->create_table('learning_units');                                                     //creacion de la tabla users con los atributos y columnas
        $this->dbforge->add_column('learning_units',[
            'CONSTRAINT LNUT_FK_focus FOREIGN KEY(LNUT_FK_focus) REFERENCES focus(FOCS_PK)',
        ]);                                                                                                 //creacion de relacion a la tabla permits
    }
    /**
    * funcion para eliminacion de la tabla learning_units
    *
    * @return drop_table()
    */
    public function down(){
        $this->dbforge->drop_table('learning_units');                                                         //eliminacion de la tabla users
    }
}
