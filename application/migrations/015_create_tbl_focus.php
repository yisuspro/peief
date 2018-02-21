<?php
/**
*
*@autor jesus andres castellanos aguilar
*
*archivo de migracion encargado de la cracion y eliminacion de la tabla focus en la base de datos
* 
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_tbl_focus extends CI_Migration {
    
    /**
    * funcion para crreacion de la tabla focus
    *
    * @return create_table()
    */
    public function up(){
        $this->dbforge->add_field(array(                //creacion del vector que contiene los campos de la tabla
            'FOCS_PK' => array(                         //columna FOCS_PK tipo int, tamaño 10, auto icremental, solo positivos
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'PRMS_name' => array(                       //columna PRMS_name tipo VARCHAR, tamaño 45
                'type' => 'VARCHAR',
                'constraint' => '45',
            ),
            'PRMS_description' => array(                //columna PRMS_description tipo VARCHAR, tamaño 45
                'type' => 'VARCHAR',
                'constraint' => '45',
            ),
        ));
        $this->dbforge->add_key('FOCS_PK', TRUE);       //agregar atributo de llave primaria al campo FOCS_PK 
        $this->dbforge->create_table('focus');          //creacion de la tabla focus con los atributos y columnas
    }
    
    /**
    * funcion para eliminacion de la tabla focus
    *
    * @return drop_table()
    */
    public function down(){
        $this->dbforge->drop_table('focus');            //eliminacion de la tabla focus
    }
}