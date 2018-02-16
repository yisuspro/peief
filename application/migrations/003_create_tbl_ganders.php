<?php
/**
*
*@autor jesus andres castellanos aguilar
*
*archivo de migracion encargado de la cracion y eliminacion de la tabla ganders en la base de datos
* 
*/
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Migration_create_tbl_ganders extends CI_Migration {
    
    /**
    * funcion para crreacion de la tabla ganders
    *
    * @return create_table()
    */
    public function up(){
        $this->dbforge->add_field(array(            //creacion del vector que contiene los campos de la tabla    
            'GNDR_PK' => array(                     //columna GNDR_PK tipo int, tamaño 10, auto icremental, no vacio
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'GNDR_gander' => array(                 //columna GNDR_gander tipo VARCHAR, tamaño 45
                'type' => 'VARCHAR',
                'constraint' => '45',
            ),
        ));
        $this->dbforge->add_key('GNDR_PK', TRUE);   //agregar atributo de llave primaria al campo GNDR_PK 
        $this->dbforge->create_table('ganders');    //creacion de la tabla ganders con los atributos y columnas
    }
    
    /**
    *funcion para eliminacion de la tabla ganders
    *
    * @return drop_table()
    */
    public function down(){
        $this->dbforge->drop_table('ganders');      //eliminacion de la tabla ganders
    }
}