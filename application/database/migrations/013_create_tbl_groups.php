<?php
/**
*
*@autor jesus andres castellanos aguilar
*
*archivo de migracion encargado de la cracion y eliminacion de la tabla groups en la base de datos
* 
*/
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Migration_create_tbl_groups extends CI_Migration {
    
    /**
    * funcion para crreacion de la tabla groups
    *
    * @return create_table()
    */
    public function up(){
        $this->dbforge->add_field(array(            //creacion del vector que contiene los campos de la tabla    
            'GRUP_PK' => array(                     //columna VRSN_PK tipo int, tamaño 10, auto icremental, positivo
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'GRUP_name' => array(                   //columna VRSN_name tipo VARCHAR, tamaño 45
                'type' => 'VARCHAR',
                'constraint' => '45',
            ),
            'GRUP_FK_cicles' => array(              //columna VRSN_FK_cicles tipo INT, tamaño 10, numeros positivos
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
            ),
        ));
        $this->dbforge->add_key('GRUP_PK', TRUE);   //agregar atributo de llave primaria al campo VRSN_PK 
        $this->dbforge->create_table('groups');     //creacion de la tabla types_identifications con los atributos y columnas
        $this->dbforge->add_column('groups',[
            'CONSTRAINT GRUP_FK_cicles FOREIGN KEY(GRUP_FK_cicles) REFERENCES cicles(CCLS_PK)',
        ]);                                         //creacion de relacion a la tabla cicles
    }
    
    /**
    *funcion para eliminacion de la tabla versions
    *
    * @return drop_table()
    */
    public function down(){
        $this->dbforge->drop_table('groups');      //eliminacion de la tabla groups
    }
}