<?php
/**
*
*@autor jesus andres castellanos aguilar
*
*archivo de migracion encargado de la cracion y eliminacion de la tabla comments en la base de datos
* 
*/
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Migration_create_tbl_comments extends CI_Migration {
    
    /**
    * funcion para crreacion de la tabla comments
    *
    * @return create_table()
    */
    public function up(){
        $this->dbforge->add_field(array(                                                        //creacion del vector que contiene los campos de la tabla
            'CMTS_PK' => array(                                                                 //columna CMTS_PK tipo int, tamaño 10, auto icremental, solo positivos
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ),
            'CMTS_content' => array(                                                         //columna CMTS_description tipo TEXT
                'type' => 'TEXT',
            ),
            'CMTS_FK_news' => array(                                                  //columna CMTS_FK_learning_units tipo int, tamaño 10, auto icremental, solo positivos
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
            ),
            'CMTS_FK_users' => array(                                                  //columna CMTS_FK_learning_units tipo int, tamaño 10, auto icremental, solo positivos
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
            ),
        ));
        $this->dbforge->add_key('CMTS_PK', TRUE);                                               //agregar atributo de llave primaria al campo CMTS_PK 
        $this->dbforge->create_table('comments');                                               //creacion de la tabla comments con los atributos y columnas
        $this->dbforge->add_column('comments',[
            'CONSTRAINT CMTS_FK_news FOREIGN KEY(CMTS_FK_news) REFERENCES news(NEWS_PK)',
        ]);
    }
    
    
    /**
    * funcion para eliminacion de la tabla comments
    *
    * @return drop_table()
    */
    public function down()
    {
        $this->dbforge->drop_table('comments');                                                  //eliminacion de la tabla comments
    }
}