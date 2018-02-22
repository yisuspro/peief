<?php
/**
*
*@autor jesus andres castellanos aguilar
*
*archivo de migracion encargado de la cracion y eliminacion de la tabla users_members_cicles en la base de datos
* 
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_tbl_users_members_cicles extends CI_Migration {
    
    /**
    * funcion para crreacion de la tabla users_members_cicles
    *
    * @return create_table()
    */
    public function up(){
        $this->dbforge->add_field(array(                            //creacion del vector que contiene los campos de la tabla
            'UMCL_PK' => array(                                     //columna UMCL_PK tipo int, tamaño 10, auto icremental, solo positivos
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'UMCL_FK_users' => array(                               //columna UMCL_FK_users tipo int, tamaño 10, auto icremental, solo positivos
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
            ),
            'UMCL_FK_cicles' => array(                              //columna UMCL_FK_cicles tipo int, tamaño 10, auto icremental, solo positivos
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                
            ),
            'UMCL_FK_roles' => array(                               //columna UMCL_FK_roles tipo int, tamaño 10, auto icremental, solo positivos
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                
            ),
            'UMCL_date_create' => array(                    //columna UMCL_address tipo VARCHAR, tamaño 45
                'type' => 'DATETIME',
            ),
            'UMCL_date_update' => array(                  //columna UMCL_telephone tipo VARCHAR, tamaño 45
                'type' => 'DATETIME',
            ),
            'UMCL_PK_create' => array(                    //columna UMCL_address tipo VARCHAR, tamaño 45
                'type' => 'INT',
            ),
            'UMCL_PK_update' => array(                  //columna UMCL_telephone tipo VARCHAR, tamaño 45
                'type' => 'INT',
            ),
        ));
        $this->dbforge->add_key('UMCL_PK', TRUE);                   //agregar atributo de llave primaria al campo UMCL_PK    
        $this->dbforge->create_table('users_members_cicles');       //creacion de la tabla users_members_cicles con los atributos y columnas
        $this->dbforge->add_column('users_members_cicles',[
            'CONSTRAINT UMCL_FK_users FOREIGN KEY(UMCL_FK_users) REFERENCES users(USER_PK)',
        ]);
        $this->dbforge->add_column('users_members_cicles',[
            'CONSTRAINT UMCL_FK_cicles FOREIGN KEY(UMCL_FK_cicles) REFERENCES cicles(CCLS_PK)',
        ]); 
        $this->dbforge->add_column('users_members_cicles',[
            'CONSTRAINT UMCL_FK_roles FOREIGN KEY(UMCL_FK_roles) REFERENCES roles(ROLE_PK)',
        ]); 
    }
    
    /**
    * funcion para eliminacion de la tabla users_members_cicles
    *
    * @return drop_table()
    */
    public function down(){
        $this->dbforge->drop_table('users_members_cicles');        //eliminacion de la tabla users_members_cicles
    }
}