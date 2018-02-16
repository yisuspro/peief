<?php
/**
*
*@autor jesus andres castellanos aguilar
*
*archivo de migracion encargado de la cracion y eliminacion de la tabla permits en la base de datos
* 
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_tbl_permits extends CI_Migration {
    
    /**
    * funcion para crreacion de la tabla permits
    *
    * @return create_table()
    */
    public function up(){
        $this->dbforge->add_field(array(                //creacion del vector que contiene los campos de la tabla
            'PRMS_PK' => array(                         //columna PRMS_PK tipo int, tamaño 10, auto icremental, solo positivos
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'PRMS_name' => array(                       //columna PRMS_name tipo VARCHAR, tamaño 45
                'type' => 'VARCHAR',
                'constraint' => '45',
            ),
            'PRMS_shortname' => array(                  //columna PRMS_shortname tipo VARCHAR, tamaño 45, no vacio
                'type' => 'VARCHAR',
                'constraint' => '15',
                'null' => TRUE,
            ),
            'PRMS_description' => array(                //columna PRMS_description tipo VARCHAR, tamaño 45, no vacio
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => TRUE,
            ),
        ));
        $this->dbforge->add_key('PRMS_PK', TRUE);       //agregar atributo de llave primaria al campo PRMS_PK 
        $this->dbforge->create_table('permits');        //creacion de la tabla permits con los atributos y columnas
    }
    
    /**
    * funcion para eliminacion de la tabla permits
    *
    * @return drop_table()
    */
    public function down(){
        $this->dbforge->drop_table('permits');          //eliminacion de la tabla permits
    }
}