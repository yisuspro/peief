<?php
 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Migration_create_tbl_types_identifications extends CI_Migration {
 
        public function up()
        {
                $this->dbforge->add_field(array(
                        'TPDI_PK' => array(
                                'type' => 'INT',
                                'constraint' => 10,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'TPDI_type_identification' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '45',
                        ),
                        
                ));
                $this->dbforge->add_key('TPDI_PK', TRUE);
                $this->dbforge->create_table('types_identifications');
                
        }
 
        public function down()
        {
                $this->dbforge->drop_table('types_identifications');
        }
}