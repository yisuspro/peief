<?php
/**
*
*@autor jesus andres castellanos aguilar
*
*archivo de migracion encargado de la cracion y eliminacion de la tabla cicles en la base de datos
* 
*/
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Migration_create_tbl_cicles extends CI_Migration {
    
    /**
    * funcion para crreacion de la tabla cicles
    *
    * @return create_table()
    */
    public function up(){
        $this->dbforge->add_field(array(                //creacion del vector que contiene los campos de la tabla
            'CCLS_PK' => array(                         //columna CCLS_PK tipo int, tamaño 10, auto icremental, solo positivos
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'CCLS_name' => array(                       //columna CCLS_name tipo VARCHAR, tamaño 45
                'type' => 'VARCHAR',
                'constraint' => '45',
            ),
            'CCLS_FK_versions' => array(                 //columna CCLS_FK_versions tipo int, tamaño 10, solo positivos
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
            ),
        ));
        $this->dbforge->add_key('CCLS_PK', TRUE);       //agregar atributo de llave primaria al campo CCLS_PK 
        $this->dbforge->create_table('cicles');          //creacion de la tabla cicles con los atributos y columnas
        $this->dbforge->add_column('cicles',[
            'CONSTRAINT CCLS_FK_versions FOREIGN KEY(CCLS_FK_versions) REFERENCES versions(VRSN_PK)',
        ]);                                             //creacion de relacion a la tabla cicles
    }
    
    /**
    * funcion para eliminacion de la tabla cicles
    *
    * @return drop_table()
    */
    public function down(){
        $this->dbforge->drop_table('cicles');            //eliminacion de la tabla cicles
    }
}