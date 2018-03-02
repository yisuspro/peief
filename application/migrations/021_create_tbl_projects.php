<?php
/**
*
*@autor jesus andres castellanos aguilar
*
*archivo de migracion encargado de la cracion y eliminacion de la tabla projects en la base de datos
* 
*/
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Migration_create_tbl_projects extends CI_Migration {
    
    /**
    * funcion para crreacion de la tabla projects
    *
    * @return create_table()
    */
    public function up(){
        $this->dbforge->add_field(array(            //creacion del vector que contiene los campos de la tabla
            'PRJC_PK' => array(                     //columna PRJC_PK tipo int, tamaño 10, auto icremental, solo positivos
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ),
            'PRJC_name' => array(                   //columna PRJC_name tipo VARCHAR, tamaño 45
                'type' => 'VARCHAR',
                'constraint' => '45',
            ),
            'PRJC_description' => array(            //columna PRJC_description tipo TEXT
                'type' => 'TEXT',
            ),
            'PRJC_FK_type_proyects' => array(       //columna PRJC_FK_learning_units tipo int, tamaño 10, auto icremental, solo positivos
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
            ),
            
            'PRJC_date_create' => array(            //columna PRJC_date_create tipo DATETIME
                'type' => 'DATETIME',
            ),
            'PRJC_date_update' => array(            //columna PRJC_date_update tipo DATETIME
                'type' => 'DATETIME',
            ),
            'PRJC_PK_create' => array(              //columna PRJC_PK_create tipo INT
                'type' => 'INT',
            ),
            'PRJC_PK_update' => array(              //columna PRJC_PK_update tipo INT
                'type' => 'INT',
            ),
            
            'PRJC_date_start' => array(             //columna PRJC_date_start tipo DATETIME
                'type' => 'DATETIME',
            ),
            
            'PRJC_date_final' => array(             //columna PRJC_date_final tipo DATETIME
                'type' => 'DATETIME',
            ),
        ));
        $this->dbforge->add_key('PRJC_PK', TRUE);   //agregar atributo de llave primaria al campo PRJC_PK 
        $this->dbforge->create_table('projects');   //creacion de la tabla projects con los atributos y columnas
        $this->dbforge->add_column('projects',[     //creacion de relacion a la tabla type_projects
            'CONSTRAINT PRJC_FK_type_proyects FOREIGN KEY(PRJC_FK_type_proyects) REFERENCES type_projects(TPPJ_PK)',
        ]);
        
    }
    
    
    /**
    * funcion para eliminacion de la tabla projects
    *
    * @return drop_table()
    */
    public function down()
    {
        $this->dbforge->drop_table('projects');     //eliminacion de la tabla projects
    }
}