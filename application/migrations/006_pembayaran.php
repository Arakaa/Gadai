<?php
class Migration_pembayaran extends CI_Migration
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
            'transaksi_id' => array('type' => 'INT', 'constraint' => 11),
            'due_date' => array('type' => 'DATE'),
            'date' => array('type' => 'DATETIME'),
            'pay' => array('type' => 'DECIMAL', 'constraint' => 24.2),
            'charge' => array('type' => 'DECIMAL', 'constraint' => 24.2),
            'method' => array('type' => 'VARCHAR', 'constraint' => '255'),
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp'
        ));

        //create table
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('pembayaran');

        //create index
        $sql = "CREATE INDEX index_pembayaran_transaksiid ON pembayaran(transaksi_id)";
        $this->db->query($sql);
    }

    public function down()
    {
        $this->dbforge->drop_table('pembayaran');
    }
}
