<?php
 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Migration_create_tbl_ganders extends CI_Migration {
 
        public function up()
        {
                $this->dbforge->add_field(array(
                        'GNDR_PK' => array(
                                'type' => 'INT',
                                'constraint' => 10,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'GNDR_gander' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '45',
                        ),
                ));
                $this->dbforge->add_key('GNDR_PK', TRUE);
                $this->dbforge->create_table('ganders');
                
        }
 
        public function down()
        {
                $this->dbforge->drop_table('ganders');
        }
}