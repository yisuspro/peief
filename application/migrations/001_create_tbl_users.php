<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_tbl_users extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'USER_PK' => array(
                                'type' => 'INT',
                                'constraint' => 10,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'USER_username' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '45',
                        ),
                        'USER_names' => array(
                                'type' => 'TEXT',
                                'null' => TRUE,
                        ),
                        'USER_lastnames' => array(
                                'type' => 'TEXT',
                                'null' => TRUE,
                        ),
                        'USER_password' => array(
                                'type' => 'TEXT',
                                'null' => TRUE,
                        ),
                        'USER_email' => array(
                                'type' => 'TEXT',
                                'null' => TRUE,
                        ),
                ));
                $this->dbforge->add_key('USER_PK', TRUE);
                $this->dbforge->create_table('users');
                
        }

        public function down()
        {
                $this->dbforge->drop_table('users');
        }
}