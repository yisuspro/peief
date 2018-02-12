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
                                'type' => 'VARCHAR',
                                'constraint' => '45',
                                'null' => TRUE,
                        ),
                        'USER_lastnames' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '45',
                                'null' => TRUE,
                        ),
                        'USER_password' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '45',
                                'null' => TRUE,
                        ),
                        'USER_email' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '45',
                                'null' => TRUE,
                        ),
                        'USER_FK_type_identification' => array(
                                                            'type' => 'INT',
                                'constraint' => 10,
                                'unsigned' => TRUE,
                        ),
                        'USER_FK_state' => array(
                                'type' => 'INT',
                                'constraint' => 10,
                                'unsigned' => TRUE,
                        ),
                        'USER_FK_gander' => array(
                                'type' => 'INT',
                                'constraint' => 10,
                                'unsigned' => TRUE,
                        ),
                        'USER_address' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '45',
                        ),
                        'USER_telephone' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '45',
                        ),
                ));
                $this->dbforge->add_key('USER_PK', TRUE);
                $this->dbforge->create_table('users');
                $this->dbforge->add_column('users',[
                 'CONSTRAINT USER_FK_state FOREIGN KEY(USER_FK_state) REFERENCES states(STTS_PK)',
                ]);
                $this->dbforge->add_column('users',[
                 'CONSTRAINT USER_FK_type_identification FOREIGN KEY(USER_FK_type_identification) REFERENCES types_identifications(TPDI_PK)',
                ]);
                $this->dbforge->add_column('users',[
                 'CONSTRAINT USER_FK_gander FOREIGN KEY(USER_FK_gander) REFERENCES ganders(GNDR_PK)',
                ]);
                
        }
 
        public function down()
        {
                $this->dbforge->drop_table('users');
        }
}