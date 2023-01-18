<?php

class TransactionModel extends CI_Model
{
    public function IsAuthorize()
    {
        $res = true;
        if (!$this->session->userdata('customerId'))
            $res = false;

        return $res;
    }

    public function GetTransactionByCustomer($idCustomer)
    {
        $this->db->select('*, customers.id as CustomerId, customers.name as CustomerName, 
                        transaksi.id as TransactionId, transaksi.code as TransactionCode, transaksi.status as TransactionStatus, 
                        barang.id as ItemId, barang.name as ItemName, barang.code as ItemCode');
        $this->db->from('transaksi');
        $this->db->join('customers', 'transaksi.customer_id = customers.id');
        $this->db->join('barang', 'transaksi.barang_id = barang.id');
        $this->db->where('transaksi.customer_id', $idCustomer);
        $this->db->where('transaksi.status <>', 3);
        $res = $this->db->get()->result_array();
        return $res;
    }

    public function FindSumChargePaymentByTransactionId($id)
    {
        $this->db->select('SUM(pembayaran.charge) as Charge');
        $this->db->from('pembayaran');
        $this->db->where('pembayaran.transaksi_id', $id);
        $res = $this->db->get()->row();
        return $res;
    }

    public function FindPaymentByTransactionId($id)
    {
        $this->db->select('*, pembayaran.id as PaymentId, transaksi.id as TransactionId');
        $this->db->from('pembayaran');
        $this->db->join('transaksi', 'transaksi.id = pembayaran.transaksi_id');
        $this->db->where('transaksi.id', $id);
        $res = $this->db->get()->result_array();
        return $res;
    }

    public function GetCustomers($where = "")
    {
        $res = $this->db->query("Select * from customers " . $where);
        return $res;
    }

    public function GetAuths($where = "")
    {
        $res = $this->db->query("Select * from auths " . $where);
        return $res;
    }

    public function GetRoles($where = "")
    {
        $res = $this->db->query("Select * from roles " . $where);
        return $res;
    }
}
