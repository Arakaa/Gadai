<?php
class Migration_barang extends CI_Migration
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
            'name' => array('type' => 'VARCHAR', 'constraint' => '255'),
            'code' => array('type' => 'VARCHAR', 'constraint' => '255'),
            'jenis' => array('type' => 'VARCHAR', 'constraint' => '255'),
            'tipe' => array('type' => 'VARCHAR', 'constraint' => '255'),
            'status' => array('type' => 'INT', 'constraint' => 5),
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp'
        ));

        //create table
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('barang');
    }

    public function down()
    {
        $this->dbforge->drop_table('barang');
    }
}
