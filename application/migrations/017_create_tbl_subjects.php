<?php
/**
*
*@autor jesus andres castellanos aguilar
*
*archivo de migracion encargado de la cracion y eliminacion de la tabla subjects en la base de datos
* 
*/
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Migration_create_tbl_subjects extends CI_Migration {
    
    /**
    * funcion para crreacion de la tabla subjects
    *
    * @return create_table()
    */
    public function up(){
        $this->dbforge->add_field(array(                                                        //creacion del vector que contiene los campos de la tabla
            'SBJC_PK' => array(                                                                 //columna SBJC_PK tipo int, tamaño 10, auto icremental, solo positivos
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ),
            'SBJC_name' => array(                                                               //columna SBJC_name tipo VARCHAR, tamaño 45
                'type' => 'VARCHAR',
                'constraint' => '45',
            ),
            'SBJC_description' => array(                                                        //columna SBJC_description tipo VARCHAR, tamaño 45
                'type' => 'VARCHAR',
                'constraint' => '45',
            ),
            'SBJC_FK_learning_units' => array(                                                  //columna SBJC_FK_learning_units tipo int, tamaño 10, auto icremental, solo positivos
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ),
        ));
        $this->dbforge->add_key('SBJC_PK', TRUE);                                               //agregar atributo de llave primaria al campo SBJC_PK 
        $this->dbforge->create_table('subjects');                                               //creacion de la tabla subjects con los atributos y columnas
        $this->dbforge->add_column('subjects',[
            'CONSTRAINT SBJC_FK_learning_units FOREIGN KEY(SBJC_FK_learning_units) REFERENCES learning_units(LNUT_PK)',
        ]);
                                                                                           
    }
    
    
    /**
    * funcion para eliminacion de la tabla subjects
    *
    * @return drop_table()
    */
    public function down()
    {
        $this->dbforge->drop_table('subjects');                                                  //eliminacion de la tabla subjects
    }
}