<?php
class Migration_auths extends CI_Migration
{
    public function __construct()
    {
        $this->load->dbforge();
        $this->load->database();
    }

    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'password' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'status' => array(
                'type' => 'INT',
                'constraint' => 5,
            ),
            'role_id' => array(
                'type' => 'INT',
                'constraint' => 11,
            ),
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp'
        ));

        //create table
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('auths');

        //create index
        $sql = "CREATE INDEX index_auths_roleid ON auths(role_id)";
        $this->db->query($sql);

        //create data
        $dataAuths = array(
            'email'         => 'admin@gmail.com',
            'password'      => md5("12345"),
            'status'        => 1,
            'role_id'       => 1
        );
        $this->db->insert('auths', $dataAuths);
    }

    public function down()
    {
        $this->dbforge->drop_table('auths');
    }
}
