<?php
class Migration_roles extends CI_Migration
{
    public function __construct()
    {
        $this->load->dbforge();
        $this->load->database();
    }

    public function up()
    {
        $this->dbforge->add_field(array(
            'role_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'role_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
            )
        ));
        $this->dbforge->add_key('role_id', TRUE);
        $this->dbforge->create_table('roles');

        $dataRoles = array('role_name'  => 'Admin');
        $this->db->insert('roles', $dataRoles);
        $dataRoles2 = array('role_name'  => 'Customer');
        $this->db->insert('roles', $dataRoles2);
    }

    public function down()
    {
        $this->dbforge->drop_table('roles');
    }
}
