<?php
/**
*
*@autor jesus andres castellanos aguilar
*
*archivo de migracion encargado de la cracion y eliminacion de la tabla cicles_subjects en la base de datos
* 
*/
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Migration_create_tbl_cicles_subjects extends CI_Migration {
    
    /**
    * funcion para crreacion de la tabla cicles_subjects
    *
    * @return create_table()
    */
    public function up(){
         $this->dbforge->add_field(array(                           //creacion del vector que contiene los campos de la tabla
            'CLSB_PK' => array(                                     //columna CLSB_PK tipo int, tamaño 10, auto icremental, solo positivos
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'CLSB_FK_cicles' => array(                               //columna CLSB_FK_cicles tipo int, tamaño 10, auto icremental, solo positivos
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'auto_increment' => TRUEcicles
            ),
            'CLSB_FK_subjects' => array(                              //columna CLSB_FK_subjects tipo int, tamaño 10, auto icremental, solo positivos
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
        ));
        $this->dbforge->add_key('CLSB_PK', TRUE);                       //agregar atributo de llave primaria al campo CLSB_PK    
        $this->dbforge->create_table('cicles_subjects');                //creacion de la tabla users_members_cicles con los atributos y columnas
        $this->dbforge->add_column('cicles_sunjects',[
            'CONSTRAINT CLSB_FK_cicles FOREIGN KEY(CLSB_FK_cicles) REFERENCES cicles(CCLS_PK)',
        ]);
        $this->dbforge->add_column('cicles_sunjects',[
            'CONSTRAINT CLSB_FK_subjects FOREIGN KEY(CLSB_FK_subjects) REFERENCES subjects(SBJC_PK)',
        ]);                                                             //creacion de relacion a la tabla users
    }
    
    /**
    * funcion para eliminacion de la tabla cicles_subjects
    *
    * @return drop_table()
    */
    public function down(){
        $this->dbforge->drop_table('cicles_subjects');                   //eliminacion de la tabla cicles_subjects
    }
}
 

