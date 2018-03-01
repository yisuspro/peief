<?php
/**
*
*@autor jesus andres castellanos aguilar
*
*archivo de migracion encargado de la cracion y eliminacion de la tabla subcategories_news en la base de datos
* 
*/
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Migration_create_tbl_subcategories_news extends CI_Migration {
    
    /**
    * funcion para crreacion de la tabla subcategories_news
    *
    * @return create_table()
    */
    public function up(){
         $this->dbforge->add_field(array(                           //creacion del vector que contiene los campos de la tabla
            'CGNW_PK' => array(                                     //columna CGNW_PK tipo int, tamaño 10, auto icremental, solo positivos
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
             'CGNW_FK_news' => array(                              //columna CGNW_FK_subjects tipo int, tamaño 10, auto icremental, solo positivos
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
            ),
            
            'CGNW_FK_subcategories' => array(                              //columna CGNW_FK_subjects tipo int, tamaño 10, auto icremental, solo positivos
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
            ),
         ));
        $this->dbforge->add_key('CGNW_PK', TRUE);                       //agregar atributo de llave primaria al campo CGNW_PK    
        $this->dbforge->create_table('subcategories_news');                //creacion de la tabla users_members_cicles con los atributos y columnas
        $this->dbforge->add_column('subcategories_news',[
            'CONSTRAINT CGNW_FK_news FOREIGN KEY(CGNW_FK_news) REFERENCES news(NEWS_PK)',
        ]);
        $this->dbforge->add_column('subcategories_news',[
            'CONSTRAINT CGNW_FK_subcategories FOREIGN KEY(CGNW_FK_subcategories) REFERENCES subcategories(SBCG_PK)',
        ]);                                                             //creacion de relacion a la tabla users
    }
    
    /**
    * funcion para eliminacion de la tabla subcategories_news
    *
    * @return drop_table()
    */
    public function down(){
        $this->dbforge->drop_table('subcategories_news');                   //eliminacion de la tabla subcategories_news
    }
}
 

