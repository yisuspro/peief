<?php
/**
*
*@autor jesus andres castellanos aguilar
*
*archivo de migracion encargado de la cracion y eliminacion de la tabla news en la base de datos
* 
*/
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Migration_create_tbl_news extends CI_Migration {
    
    /**
    * funcion para crreacion de la tabla news
    *
    * @return create_table()
    */
    public function up(){
        $this->dbforge->add_field(array(             //creacion del vector que contiene los campos de la tabla
            'NEWS_PK' => array(                      //columna NEWS_PK tipo int, tamaño 10, auto icremental, solo positivos
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ),
            'NEWS_description' => array(             //columna NEWS_description tipo TEXT
                'type' => 'TEXT',
            ),
            'NEWS_order' => array(                   //columna NEWS_order tipo VARCHAR, tamaño 45
                'type' => 'INT',
                'constraint' => '10',
            ),            
            'NEWS_priority' => array(                //columna NEWS_priority tipo VARCHAR, tamaño 45
                'type' => 'INT',
                'constraint' => '10',
            ),
            'NEWS_title' => array(                   //columna NEWS_title tipo VARCHAR, tamaño 45
                'type' => 'VARCHAR',
                'constraint' => '45',
            ),
            'NEWS_subtitle' => array(                //columna NEWS_subtitle tipo VARCHAR, tamaño 45
                'type' => 'VARCHAR',
                'constraint' => '45',
            ),
            'NEWS_date_create' => array(             //columna NEWS_date_create tipo DATETIME
                'type' => 'DATETIME',
            ),
            'NEWS_date_update' => array(             //columna NEWS_date_update tipo DATETIME
                'type' => 'DATETIME',
            ),
            'NEWS_PK_create' => array(               //columna NEWS_PK_create tipo INT
                'type' => 'INT',
                'constraint' => '10',
            ),
            'NEWS_PK_update' => array(               //columna NEWS_PG_update tipo INT
                'type' => 'INT',
                'constraint' => '10',
            ),
            'NEWS_content' => array(                 //columna NEWS_content tipo TEXT
                'type' => 'TEXT',
            ),
            'NEWS_note' => array(                    //columna NEWS_note tipo VARCHAR, tamaño 255
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
        ));
        $this->dbforge->add_key('NEWS_PK', TRUE);    //agregar atributo de llave primaria al campo NEWS_PK 
        $this->dbforge->create_table('news');        //creacion de la tabla news con los atributos y columnas
        
        
    }
    
    
    /**
    * funcion para eliminacion de la tabla news
    *
    * @return drop_table()
    */
    public function down()
    {
        $this->dbforge->drop_table('news');          //eliminacion de la tabla news
    }
}