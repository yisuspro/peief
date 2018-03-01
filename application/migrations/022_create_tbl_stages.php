<?php
/**
*
*@autor jesus andres castellanos aguilar
*
*archivo de migracion encargado de la cracion y eliminacion de la tabla stages en la base de datos
* 
*/
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Migration_create_tbl_stages extends CI_Migration {
    
    /**
    * funcion para crreacion de la tabla stages
    *
    * @return create_table()
    */
    public function up(){
        $this->dbforge->add_field(array(                                                        //creacion del vector que contiene los campos de la tabla
            'STGS_PK' => array(                                                                 //columna STGS_PK tipo int, tamaño 10, auto icremental, solo positivos
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ),
            'STGS_name' => array(                                                               //columna STGS_name tipo VARCHAR, tamaño 45
                'type' => 'VARCHAR',
                'constraint' => '45',
            ),
            'STGS_description' => array(                                                         //columna STGS_description tipo TEXT
                'type' => 'TEXT',
            ),
            'STGS_FK_projects' => array(                                                  //columna STGS_FK_learning_units tipo int, tamaño 10, auto icremental, solo positivos
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
            ),
            'STGS_date_start' => array(                                                        //columna STGS_address tipo VARCHAR, tamaño 45
                'type' => 'DATETIME',
            ),
            'STGS_date_final' => array(                                                        //columna STGS_address tipo VARCHAR, tamaño 45
                'type' => 'DATETIME',
            ),
            
            'STGS_order' => array(                                                        //columna STGS_address tipo VARCHAR, tamaño 45
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
            ),
        ));
        $this->dbforge->add_key('STGS_PK', TRUE);                                               //agregar atributo de llave primaria al campo STGS_PK 
        $this->dbforge->create_table('stages');                                               //creacion de la tabla stages con los atributos y columnas
        $this->dbforge->add_column('stages',[
            'CONSTRAINT STGS_FK_projects FOREIGN KEY(STGS_FK_projects) REFERENCES projects(PRJC_PK)',
        ]);
        
    }
    
    
    /**
    * funcion para eliminacion de la tabla stages
    *
    * @return drop_table()
    */
    public function down()
    {
        $this->dbforge->drop_table('stages');                                                  //eliminacion de la tabla stages
    }
}