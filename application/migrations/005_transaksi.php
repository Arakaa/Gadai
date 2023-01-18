<?php
class Migration_transaksi extends CI_Migration
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
            'customer_id' => array('type' => 'INT', 'constraint' => 11),
            'barang_id' => array('type' => 'INT', 'constraint' => 11),
            'auth_id' => array('type' => 'INT', 'constraint' => 11),
            'code' => array('type' => 'VARCHAR', 'constraint' => '255'),
            'price' => array('type' => 'DECIMAL', 'constraint' => 24.2),
            'angsuran' => array('type' => 'DECIMAL', 'constraint' => 24.2),
            'date' => array('type' => 'DATE'),
            'pay' => array('type' => 'INT', 'constraint' => 5),
            'nik' => array('type' => 'VARCHAR', 'constraint' => '255'),
            'alamat' => array('type' => 'VARCHAR', 'constraint' => '255'),
            'phone_number' => array('type' => 'VARCHAR', 'constraint' => '255'),
            'description' => array('type' => 'TEXT'),
            'status' => array('type' => 'INT', 'constraint' => 5),
            'status_payment' => array('type' => 'INT', 'constraint' => 5),
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp'
        ));

        //create table
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('transaksi');

        //create index
        $sql = "CREATE INDEX index_transaksi_customerid ON transaksi(customer_id)";
        $this->db->query($sql);

        $sql = "CREATE INDEX index_transaksi_barangid ON transaksi(barang_id)";
        $this->db->query($sql);

        $sql = "CREATE INDEX index_transaksi_authid ON transaksi(auth_id)";
        $this->db->query($sql);
    }

    public function down()
    {
        $this->dbforge->drop_table('transaksi');
    }
}
