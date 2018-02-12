<?php
 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Migration_create_tbl_documentation_users extends CI_Migration {
    public function up(){
        $this->dbforge->add_field(array(
            'DOCU_PK' => array(
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ),
            'DOCU_name' => array(
                'type' => 'VARCHAR',
                'constraint' => 45,
                'unsigned' => TRUE,
            ),
             'DOCU_dscription' => array(
                'type' => 'VARCHAR',
                'constraint' => 45,
                'unsigned' => TRUE,
            ),
             'DOCU_location' => array(
                'type' => 'VARCHAR',
                'constraint' => 45,
                'unsigned' => TRUE,
            ),
            'DOCU_FK_users' => array(
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
            ),
        ));
        $this->dbforge->add_key('DOCU_PK', TRUE);
        $this->dbforge->create_table('documentation_users');
        $this->dbforge->add_column('documentation_users',[
            'CONSTRAINT DOCU_FK_users FOREIGN KEY(DOCU_FK_users) REFERENCES users(USER_PK)',
        ]);
        
    }
    public function down(){
        $this->dbforge->drop_table('documentation_users');
    }
}
 

