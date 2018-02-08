<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_tbl_roles extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'ROLE_PK' => array(
                                'type' => 'INT',
                                'constraint' => 10,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'ROLE_name' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '45',
                        ),
                        'ROLE_shortname' => array(
                                'type' => 'TEXT',
                                'null' => TRUE,
                        ),
                        'USER_description' => array(
                                'type' => 'TEXT',
                                'null' => TRUE,
                        ),
                ));
                $this->dbforge->add_key('ROLE_PK', TRUE);
                $this->dbforge->create_table('roles');
        }

        public function down()
        {
                $this->dbforge->drop_table('roles');
        }
}