<?php
/**
*
*@autor jesus andres castellanos aguilar
*
*archivo de migracion encargado de la cracion y eliminacion de la tabla subcategories en la base de datos
* 
*/
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Migration_create_tbl_subcategories extends CI_Migration {
    
    /**
    * funcion para crreacion de la tabla subcategories
    *
    * @return create_table()
    */
    public function up(){
        $this->dbforge->add_field(array(                                                        //creacion del vector que contiene los campos de la tabla
            'SBCG_PK' => array(                                                                 //columna SBCG_PK tipo int, tamaño 10, auto icremental, solo positivos
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ),
            'SBCG_name' => array(                                                         //columna SBCG_description tipo TEXT
                'type' => 'VARCHAR',
                'constraint' => '45',
            ),
            'SBCG_description' => array(                                                         //columna SBCG_description tipo TEXT
                'type' => 'TEXT',
            ),
            'SBCG_FK_categories' => array(                                                  //columna SBCG_FK_learning_units tipo int, tamaño 10, auto icremental, solo positivos
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
            ),
            
        ));
        $this->dbforge->add_key('SBCG_PK', TRUE);                                               //agregar atributo de llave primaria al campo SBCG_PK 
        $this->dbforge->create_table('subcategories');                                               //creacion de la tabla subcategories con los atributos y columnas
        $this->dbforge->add_column('subcategories',[
            'CONSTRAINT SBCG_FK_categories FOREIGN KEY(SBCG_FK_categories) REFERENCES categories(CTGR_PK)',
        ]);
    }
    
    
    /**
    * funcion para eliminacion de la tabla subcategories
    *
    * @return drop_table()
    */
    public function down()
    {
        $this->dbforge->drop_table('subcategories');                                                  //eliminacion de la tabla subcategories
    }
}