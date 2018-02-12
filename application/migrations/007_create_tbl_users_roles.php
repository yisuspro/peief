<?php
 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Migration_create_tbl_users_roles extends CI_Migration {
 
        public function up()
        {
                $this->dbforge->add_field(array(
                        'USRL_PK' => array(
                                'type' => 'INT',
                                'constraint' => 10,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE,
                                
                        ),
                        'USRL_FK_users' => array(
                                'type' => 'INT',
                                'constraint' => 10,
                                'unsigned' => TRUE,
                        ),
                        'USRL_FK_roles' => array(
                                'type' => 'INT',
                                'constraint' => 10,
                                'unsigned' => TRUE,
                        ),
               
                ));
                
            $this->dbforge->add_key('USRL_PK', TRUE);
            $this->dbforge->create_table('users_roles');
            $this->dbforge->add_column('users_roles',[
                'CONSTRAINT USRL_FK_users FOREIGN KEY(USRL_FK_users) REFERENCES users(USER_PK)',
            ]);
            $this->dbforge->add_column('users_roles',[
                'CONSTRAINT USRL_FK_roles FOREIGN KEY(USRL_FK_roles) REFERENCES roles(ROLE_PK)',
            ]);
            
        }
 
        public function down()
        {
                $this->dbforge->drop_table('users_roles');
        }
}