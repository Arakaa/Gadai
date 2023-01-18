<?php
class Migration_customers extends CI_Migration
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
            'auth_id' => array('type' => 'INT', 'constraint' => 11),
            'name' => array('type' => 'VARCHAR', 'constraint' => '255'),
            'nik' => array('type' => 'VARCHAR', 'constraint' => '255'),
            'phone_number' => array('type' => 'VARCHAR', 'constraint' => '255'),
            'gender' => array('type' => 'VARCHAR', 'constraint' => '255'),
            'address' => array('type' => 'VARCHAR', 'constraint' => '255'),
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp'
        ));

        //create table
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('customers');

        //create index
        $sql = "CREATE INDEX index_customers_authid ON customers(auth_id)";
        $this->db->query($sql);
    }

    public function down()
    {
        $this->dbforge->drop_table('customers');
    }
}
