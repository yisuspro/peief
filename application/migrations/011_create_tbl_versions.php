<?php
/**
*
*@autor jesus andres castellanos aguilar
*
*archivo de migracion encargado de la cracion y eliminacion de la tabla versions en la base de datos
* 
*/
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Migration_create_tbl_versions extends CI_Migration {
    
    /**
    * funcion para crreacion de la tabla versions
    *
    * @return create_table()
    */
    public function up(){
        $this->dbforge->add_field(array(                        //creacion del vector que contiene los campos de la tabla    
            'VRSN_PK' => array(                                 //columna VRSN_PK tipo int, tamaño 10, auto icremental, positivo
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'VRSN_name' => array(                               //columna VRSN_name tipo VARCHAR, tamaño 45
                'type' => 'VARCHAR',
                'constraint' => '45',
            ),
            'VRSN_FK_plans' => array(                               //columna VRSN_name tipo VARCHAR, tamaño 45
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
            ),
        ));
        $this->dbforge->add_key('VRSN_PK', TRUE);               //agregar atributo de llave primaria al campo VRSN_PK 
        $this->dbforge->create_table('versions');               //creacion de la tabla types_identifications con los atributos y columnas
        $this->dbforge->add_column('versions',[
            'CONSTRAINT VRSN_FK_plans FOREIGN KEY(VRSN_FK_plans) REFERENCES plans(PLAN_PK)',
        ]); 
    }
    
    /**
    *funcion para eliminacion de la tabla versions
    *
    * @return drop_table()
    */
    public function down(){
        $this->dbforge->drop_table('versions');                 //eliminacion de la tabla versions
    }
}