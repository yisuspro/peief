<?php
/**
*
*@autor jesus andres castellanos aguilar
*
*archivo de migracion encargado de la cracion y eliminacion de la tabla type_projects en la base de datos
* 
*/
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Migration_create_tbl_type_projects extends CI_Migration {
    
    /**
    * funcion para crreacion de la tabla type_projects
    *
    * @return create_table()
    */
    public function up(){
        $this->dbforge->add_field(array(                                                        //creacion del vector que contiene los campos de la tabla
            'TPPJ_PK' => array(                                                                 //columna SBJC_PK tipo int, tamaño 10, auto icremental, solo positivos
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ),
            'TPPJ_name' => array(                                                               //columna SBJC_name tipo VARCHAR, tamaño 45
                'type' => 'VARCHAR',
                'constraint' => '45',
            ),
        ));
        $this->dbforge->add_key('TPPJ_PK', TRUE);                                               //agregar atributo de llave primaria al campo SBJC_PK 
        $this->dbforge->create_table('type_projects');                                               //creacion de la tabla type_projects con los atributos y columnas
        
                                                                                           
    }
    
    
    /**
    * funcion para eliminacion de la tabla type_projects
    *
    * @return drop_table()
    */
    public function down()
    {
        $this->dbforge->drop_table('type_projects');                                                  //eliminacion de la tabla type_projects
    }
}