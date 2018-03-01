<?php
/**
*
*@autor jesus andres castellanos aguilar
*
*archivo de migracion encargado de la cracion y eliminacion de la tabla categories en la base de datos
* 
*/
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Migration_create_tbl_categories extends CI_Migration {
    
    /**
    * funcion para crreacion de la tabla categories
    *
    * @return create_table()
    */
    public function up(){
        $this->dbforge->add_field(array(                     //creacion del vector que contiene los campos de la tabla
            'CTGR_PK' => array(                              //columna CTGR_PK tipo int, tamaño 10, auto icremental, solo positivos
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ),
            'CTGR_name' => array(                            //columna CTGR_name tipo VARCHAR, tamaño 45
                'type' => 'VARCHAR',
                'constraint' => '45',
            ),
            'CTGR_description' => array(                     //columna CTGR_description tipo TEXT
                'type' => 'TEXT',
            ),
            'CTGR_order' => array(                           //columna CTGR_order tipo VARCHAR, tamaño 45
                'type' => 'VARCHAR',
                'constraint' => '45',
            ),
        ));
        $this->dbforge->add_key('CTGR_PK', TRUE);            //agregar atributo de llave primaria al campo CTGR_PK 
        $this->dbforge->create_table('categories');          //creacion de la tabla categories con los atributos y columnas
        
        
    }
    
    
    /**
    * funcion para eliminacion de la tabla categories
    *
    * @return drop_table()
    */
    public function down()
    {
        $this->dbforge->drop_table('categories');           //eliminacion de la tabla categories
    }
}