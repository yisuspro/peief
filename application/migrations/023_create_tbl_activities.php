<?php
/**
*
*@autor jesus andres castellanos aguilar
*
*archivo de migracion encargado de la cracion y eliminacion de la tabla activities en la base de datos
* 
*/
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Migration_create_tbl_activities extends CI_Migration {
    
    /**
    * funcion para crreacion de la tabla activities
    *
    * @return create_table()
    */
    public function up(){
        $this->dbforge->add_field(array(          //creacion del vector que contiene los campos de la tabla
            'CTVT_PK' => array(                   //columna CTVT_PK tipo int, tamaño 10, auto icremental, solo positivos
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ),
            'CTVT_name' => array(                 //columna CTVT_name tipo VARCHAR, tamaño 45
                'type' => 'VARCHAR',
                'constraint' => '45',
            ),
            'CTVT_description' => array(          //columna CTVT_description tipo TEXT
                'type' => 'TEXT',
            ),
            'CTVT_duration' => array(             //columna CTVT_duration tipo VARCHAR, tamaño 45
                'type' => 'VARCHAR',
                'constraint' => '45',
            ),
            'CTVT_result' => array(               //columna CTVT_result tipo INT, tamaño 10
                'type' => 'INT',
                'constraint' => '10',
            ),
            'CTVT_order' => array(                //columna CTVT_order tipo INT, tamaño 10
                'type' => 'INT',
                'constraint' => '10',
            ),
            'CTVT_status' => array(               //columna CTVT_status tipo INT, tamaño 10
                'type' => 'INT',
                'constraint' => '10',
            ),
            'CTVT_FK_stages' => array(            //columna CTVT_FK_stages tipo int, tamaño 10, solo positivos
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
            ),
            'CTVT_date_start' => array(           //columna CTVT_date_start tipo DATETIME
                'type' => 'DATETIME',
            ),
            'CTVT_date_final' => array(           //columna CTVT_date_final tipo DATETIME
                'type' => 'DATETIME',
            ),
            
            'CTVT_order' => array(                //columna CTVT_order tipo INT, tamaño 10
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
            ),
        ));
        $this->dbforge->add_key('CTVT_PK', TRUE);  //agregar atributo de llave primaria al campo CTVT_PK 
        $this->dbforge->create_table('activities');//creacion de la tabla activities con los atributos y columnas
        $this->dbforge->add_column('activities',[  //creacion de relacion a la tabla stages
            'CONSTRAINT CTVT_FK_stages FOREIGN KEY(CTVT_FK_stages) REFERENCES stages(STGS_PK)',
        ]);
        
    }
    
    
    /**
    * funcion para eliminacion de la tabla activities
    *
    * @return drop_table()
    */
    public function down()
    {
        $this->dbforge->drop_table('activities');  //eliminacion de la tabla activities
    }
}