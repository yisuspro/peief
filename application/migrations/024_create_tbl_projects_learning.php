<?php
/**
*
*@autor jesus andres castellanos aguilar
*
*archivo de migracion encargado de la cracion y eliminacion de la tabla projects_learning en la base de datos
* 
*/
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Migration_create_tbl_projects_learning extends CI_Migration {
    
    /**
    * funcion para crreacion de la tabla projects_learning
    *
    * @return create_table()
    */
    public function up(){
        $this->dbforge->add_field(array(                   //creacion del vector que contiene los campos de la tabla
            'PRLN_PK' => array(                             //columna PRLN_PK tipo int, tamaño 10, auto icremental, solo positivos
             'type' => 'INT',
             'constraint' => 10,
             'unsigned' => TRUE,
             'auto_increment' => TRUE
         ),
          'PRLN_FK_learning_units' => array(             //columna PRLN_FK_learning_units tipo int, tamaño 10, auto icremental, solo positivos
             'type' => 'INT',
             'constraint' => 10,
             'unsigned' => TRUE,
         ),
         'PRLN_FK_projects' => array(                    //columna PRLN_FK_projects tipo int, tamaño 10, auto icremental, solo positivos
             'type' => 'INT',
              'constraint' => 10,
             'unsigned' => TRUE,
         ),
         'PRLN_date_create' => array(                    //columna PRLN_date_create tipo DATETIME
             'type' => 'DATETIME',
         ),
         'PRLN_date_update' => array(                    //columna PRLN_date_update tipo DATETIME
             'type' => 'DATETIME',
         ),
         'PRLN_PK_create' => array(                      //columna PRLN_PK_create tipo INT
             'type' => 'INT',
         ),
         'PRLN_PK_update' => array(                      //columna PRLN_PK_update tipo INT
             'type' => 'INT',
         ),
     ));
     $this->dbforge->add_key('PRLN_PK', TRUE);           //agregar atributo de llave primaria al campo PRLN_PK    
     $this->dbforge->create_table('projects_learning');  //creacion de la tabla users_members_cicles con los atributos y columnas
     $this->dbforge->add_column('projects_learning',[    //creacion de relacion a la tabla learning_units
         'CONSTRAINT PRLN_FK_learning_units FOREIGN KEY(PRLN_FK_learning_units) REFERENCES learning_units(LNUT_PK)',
     ]);
     $this->dbforge->add_column('projects_learning',[
         'CONSTRAINT PRLN_FK_projects FOREIGN KEY(PRLN_FK_projects) REFERENCES projects(PRJC_PK)',
     ]);                                                  //creacion de relacion a la tabla users
 }

 /**
 * funcion para eliminacion de la tabla projects_learning
 *
 * @return drop_table()
 */
 public function down(){ 
     $this->dbforge->drop_table('projects_learning');                   //eliminacion de la tabla projects_learning
 }
}
 

