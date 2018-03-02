<?php
/**
*
*@autor jesus andres castellanos aguilar
*
*archivo de migracion encargado de la cracion y eliminacion de la tabla users_newspapers en la base de datos
* 
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_tbl_users_newspaper extends CI_Migration {
    
    /**
    * funcion para crreacion de la tabla users_newspapers
    *
    * @return create_table()
    */
    public function up(){
        $this->dbforge->add_field(array(                    //creacion del vector que contiene los campos de la tabla
            'USNP_PK' => array(                             //columna USNP_PK tipo int, tamaño 10, auto icremental, solo positivos
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ),
            'USNP_FK_users' => array(                       //columna USNP_FK_users tipo int, tamaño 10, solo positivos
                'type' => 'INT',
                'unsigned' => TRUE,
            ),
            'USNP_FK_categories' => array(                  //columna USNP_FK_categories tipo int, tamaño 10, solo positivos
                'type' => 'INT',
                'unsigned' => TRUE,
            ),
            'USNP_FK_roles' => array(                       //columna USNP_FK_roles tipo int, tamaño 10, solo positivos
                'type' => 'INT',
                'unsigned' => TRUE,
            ),
            
            'USNP_date_create' => array(                    //columna USNP_date_create tipo DATETIME
                'type' => 'DATETIME',
            ),
            'USNP_date_update' => array(                    //columna USNP_date_update tipo DATETIME
                'type' => 'DATETIME',
            ),
            'USNP_PK_create' => array(                      //columna USNP_PK_create tipo INT
                'type' => 'INT',
            ),
            'USNP_PK_update' => array(                      //columna USNP_PK_update tipo INT
                'type' => 'INT',
            ),
        ));
        $this->dbforge->add_key('USNP_PK', TRUE);                                                           //agregar atributo de llave primaria al campo USNP_PK
        $this->dbforge->create_table('users_newspapers');                                                   //creacion de la tabla users con los atributos y columnas
        
        $this->dbforge->add_column('users_newspapers',[
            'CONSTRAINT USNP_FK_users FOREIGN KEY(USNP_FK_users) REFERENCES users(USER_PK)',
        ]);                                                                                                 //creacion de relacion a la tabla users
        $this->dbforge->add_column('users_newspapers',[
            'CONSTRAINT USNP_FK_categories FOREIGN KEY(USNP_FK_categories) REFERENCES categories(CTGR_PK)',
        ]);                                                                                                 //creacion de relacion a la tabla categories
        $this->dbforge->add_column('users_newspapers',[
            'CONSTRAINT USNP_FK_roles FOREIGN KEY(USNP_FK_roles) REFERENCES roles(ROLE_PK)',
        ]);                                                                                                 //creacion de relacion a la tabla roles
    }
    /**
    * funcion para eliminacion de la tabla users_newspapers
    *
    * @return drop_table()
    */
    public function down(){
        $this->dbforge->drop_table('users_newspapers');                                                     //eliminacion de la tabla users_newspapers
    }
}
