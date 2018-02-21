<?php
/**
*
*@autor jesus andres castellanos aguilar
*
*archivo de migracion encargado de la cracion y eliminacion de la tabla versions_plans en la base de datos
* 
*/
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Migration_create_tbl_versions_plans extends CI_Migration {
    
    /**
    * funcion para crreacion de la tabla versions_plans
    *
    * @return create_table()
    */
    public function up(){
        $this->dbforge->add_field(array(                    //creacion del vector que contiene los campos de la tabla    
            'VRPL_PK' => array(                             //columna VRPL_PK tipo int, tamaño 10, auto icremental, positivo
                'type'          => 'INT',
                'constraint'    => 10,
                'unsigned'      => TRUE,
                'auto_increment'=> TRUE
            ),
            'VRPL_FK_versions'  => array(                    //columna VRPL_FK_versions tipo int, tamaño 10, auto icremental, positivo
                'type'          => 'INT',
                'constraint'    => 10,
                'unsigned'      => TRUE,
            ),
            'VRPL_FK_plans' => array(                       //columna VRPL_FK_plans tipo int, tamaño 10, auto icremental, positivo
                'type'          => 'INT',
                'constraint'    => 10,
                'unsigned'      => TRUE,
            ),
        ));
        $this->dbforge->add_key('VRPL_PK', TRUE);           //agregar atributo de llave primaria al campo VRPL_PK 
        $this->dbforge->create_table('versions_plans');     //creacion de la tabla versions_plans con los atributos y columnas
        $this->dbforge->add_column('versions_plans',[
            'CONSTRAINT VRPL_FK_versions FOREIGN KEY(VRPL_FK_versions) REFERENCES versions(VRSN_PK)',
        ]);
        $this->dbforge->add_column('versions_plans',[
            'CONSTRAINT VRPL_FK_plans FOREIGN KEY(VRPL_FK_plans) REFERENCES plans(PLAN_PK)',
        ]); 
    }
    
    /**
    *funcion para eliminacion de la tabla versions_plans
    *
    * @return drop_table()
    */
    public function down(){
        $this->dbforge->drop_table('versions_plans');      //eliminacion de la tabla ganders
    }
}