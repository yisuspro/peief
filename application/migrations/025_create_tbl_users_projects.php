<?php
/**
*
*@autor jesus andres castellanos aguilar
*
*archivo de migracion encargado de la cracion y eliminacion de la tabla users_projects en la base de datos
* 
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_tbl_users_projects extends CI_Migration {
    
    /**
    * funcion para crreacion de la tabla users_projects
    *
    * @return create_table()
    */
    public function up(){
        $this->dbforge->add_field(array(                                                                   //creacion del vector que contiene los campos de la tabla
            'USPR_PK' => array(                                                                            //columna USPR_PK tipo int, tamaño 10, auto icremental, solo positivos
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ),
            'USPR_FK_users' => array(                                                                     //columna USPR_FK_users tipo int, tamaño 10, solo positivos
                'type' => 'INT',
                'unsigned' => TRUE,
            ),
            'USPR_FK_projects' => array(                                                             //columna USPR_FK_learning_units tipo int, tamaño 10, solo positivos
                'type' => 'INT',
                'unsigned' => TRUE,
            ),
            'USPR_FK_roles' => array(                                                                     //columna USPR_FK_roles tipo int, tamaño 10, solo positivos
                'type' => 'INT',
                'unsigned' => TRUE,
            ),
            
            'USPR_date_create' => array(                    //columna USPR_address tipo VARCHAR, tamaño 45
                'type' => 'DATETIME',
            ),
            'USPR_date_update' => array(                  //columna USPR_telephone tipo VARCHAR, tamaño 45
                'type' => 'DATETIME',
            ),
            'USPR_PK_create' => array(                    //columna USPR_address tipo VARCHAR, tamaño 45
                'type' => 'INT',
            ),
            'USPR_PK_update' => array(                  //columna USPR_telephone tipo VARCHAR, tamaño 45
                'type' => 'INT',
            ),
        ));
        $this->dbforge->add_key('USPR_PK', TRUE);                                                           //agregar atributo de llave primaria al campo USPR_PK
        $this->dbforge->create_table('users_projects');                                               //creacion de la tabla users con los atributos y columnas
        
        $this->dbforge->add_column('users_projects',[
            'CONSTRAINT USPR_FK_users FOREIGN KEY(USPR_FK_users) REFERENCES users(USER_PK)',
        ]);                                                                                                 //creacion de relacion a la tabla users
        $this->dbforge->add_column('users_projects',[
            'CONSTRAINT USPR_FK_projects FOREIGN KEY(USPR_FK_projects) REFERENCES projects(PRJC_PK)',
        ]);                                                                                                 //creacion de relacion a la tabla learning_units
        $this->dbforge->add_column('users_projects',[
            'CONSTRAINT USPR_FK_roles FOREIGN KEY(USPR_FK_roles) REFERENCES roles(ROLE_PK)',
        ]);                                                                                                 //creacion de relacion a la tabla roles
    }
    /**
    * funcion para eliminacion de la tabla users_projects
    *
    * @return drop_table()
    */
    public function down(){
        $this->dbforge->drop_table('users_projects');                                                   //eliminacion de la tabla users_projects
    }
}
