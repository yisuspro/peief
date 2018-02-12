<?php
 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Migration_create_tbl_states extends CI_Migration {
 
        public function up()
        {
                $this->dbforge->add_field(array(
                        'STTS_PK' => array(
                                'type' => 'INT',
                                'constraint' => 10,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'STTS_state' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '45',
                        ),
                        
                ));
                $this->dbforge->add_key('STTS_PK', TRUE);
                $this->dbforge->create_table('states');
                
        }
 
        public function down()
        {
                $this->dbforge->drop_table('states');
        }
}