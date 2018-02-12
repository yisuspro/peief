<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_tbl_permits extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'PRMS_PK' => array(
                                'type' => 'INT',
                                'constraint' => 10,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'PRMS_name' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '45',
                        ),
                        'PRMS_shortname' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '15',
                                'null' => TRUE,
                        ),
                        'PRMS_description' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '45',
                                'null' => TRUE,
                        ),
                ));
                $this->dbforge->add_key('PRMS_PK', TRUE);
                $this->dbforge->create_table('permits');
        }

        public function down()
        {
                $this->dbforge->drop_table('permits');
        }
}