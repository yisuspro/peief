<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_tbl_roles_permits extends CI_Migration {
    public function up(){
        $this->dbforge->add_field(array(
            'RLPR_PK' => array(
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ),
            'RLPR_FK_roles' => array(
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
            ),
            'RLPR_FK_permits' => array(
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
            ),
        ));
        $this->dbforge->add_key('RLPR_PK', TRUE);
        $this->dbforge->create_table('roles_permits');
        $this->dbforge->add_column('roles_permits',[
            'CONSTRAINT RLPR_FK_roles FOREIGN KEY(RLPR_FK_roles) REFERENCES roles(ROLE_PK)',
        ]);
        $this->dbforge->add_column('roles_permits',[
            'CONSTRAINT RLPR_FK_permits FOREIGN KEY(RLPR_FK_permits) REFERENCES permits(PRMS_PK)',
        ]);
    }
    public function down(){
        $this->dbforge->drop_table('roles_permits');
    }
}
