<?php

class DashboardModel extends CI_Model
{
    public function ValidateUser($model)
    {
        $getRoles = $this->GetRoles("where role_name = 'Admin'")->row();

        $this->db->select('*');
        $this->db->from('auths');
        $this->db->where('role_id', $getRoles->role_id);
        $this->db->where('email', $model['email']);
        $this->db->where('password', md5($model['password']));
        $query = $this->db->get()->row();
        return $query;
    }

    public function IsAuthorize()
    {
        $res = true;
        if (!$this->session->userdata('authId'))
            $res = false;

        return $res;
    }

    public function GetCustomersListing($model)
    {
        // echo '<pre>', var_dump($model), '</pre>';
        // die();
        $this->db->select('*, customers.id as CustomerId, auths.id as AuthId');
        $this->db->from('customers');
        $this->db->join('auths', 'auths.id = customers.auth_id');

        if ($model['name'] != "") {
            $this->db->like('name', $model['name']);
        }
        if ($model['nik'] != "") {
            $this->db->like('nik', $model['nik']);
        }
        if ($model['email'] != "") {
            $this->db->like('email', $model['email']);
        }
        if ($model['status'] != "") {
            $this->db->like('status', $model['status']);
        }

        $query = $this->db->get();
        // echo '<pre>', var_dump($query->result_array()), '</pre>';
        // die();
        return $query->result_array();
    }

    public function Validation($model)
    {
        $result = array('success' => true, 'message' => '', 'entity' => []);

        if ($model['password'] != $model['cpassword']) {
            $result['success'] = false;
            $result['message'] = "Confirmation Password doesn't match, Registration aborted!";
        }

        $checkNikCustomer = $this->GetCustomers("where nik = '" . $model['nik'] . "'");
        if ($checkNikCustomer->num_rows() > 0) {
            $result['success'] = false;
            $result['message'] = "NIK already in use, Registration aborted!";
        }

        $checkEmailCustomer = $this->GetAuths("where email = '" . $model['email'] . "'");
        if ($checkEmailCustomer->num_rows() > 0) {
            $result['success'] = false;
            $result['message'] = "Email already in use, Registration aborted!";
        }

        return $result;
    }

    public function ValidationEdit($model)
    {
        $result = array('success' => true, 'message' => '', 'entity' => []);

        $checkNikCustomer = $this->GetCustomers("where id <> '" . $model['id'] . "' and nik = '" . $model['nik'] . "'");
        if ($checkNikCustomer->num_rows() > 0) {
            $result['success'] = false;
            $result['message'] = "NIK already in use, Registration aborted!";
        }

        return $result;
    }

    public function InsertCustomer($model)
    {
        $getRoleCustomer = $this->GetRoles("where role_name = 'Customer'")->row_array();
        $dataAuth = array(
            'email'     => $model['email'],
            'password'  => md5($model['password']),
            'status'    => $model['status'],
            'role_id'   => $getRoleCustomer['role_id'],
        );
        $insertAuths = $this->db->insert('auths', $dataAuth);

        if ($insertAuths > 0) {
            $getLastAuth = $this->GetAuths("order by id desc")->row_array();
            $dataCustomer = array(
                'auth_id'       => $getLastAuth['id'],
                'name'          => $model['name'],
                'nik'           => $model['nik'],
                'phone_number'  => $model['phone'],
                'gender'        => $model['gender'],
                'address'       => $model['address'],
            );

            $insertCustomer = $this->db->insert('customers', $dataCustomer);
            if ($insertCustomer > 0) return true;
        }

        return false;
    }

    public function EditCustomer($model)
    {
        $selectedCustomer = $this->FindCustomer($model['id']);
        $now = date("Y-m-d H:i:s");

        $getLastAuth = $this->GetAuths("order by id desc")->row_array();
        $dataCustomer = array(
            'auth_id'       => $selectedCustomer->AuthId,
            'name'          => $model['name'],
            'nik'           => $model['nik'],
            'phone_number'  => $model['phone'],
            'gender'        => $model['gender'],
            'address'       => $model['address'],
            'updated_at'    => $now
        );

        $this->db->where('id', $model['id']);
        return $this->db->update('customers', $dataCustomer);
    }

    public function DeleteCustomer($id)
    {
        $selectedCustomer = $this->FindCustomer($id);
        $authId = $selectedCustomer->AuthId;

        $this->db->delete('customers', array('id' => $id));
        return $this->db->delete('auths', array('id' => $authId));
    }

    public function ChangeCustomerStatus($status, $id)
    {
        $data = array('status' => $status);
        $this->db->where('id', $id);

        return $this->db->update('auths', $data);
    }

    public function GetDailyRegistrations()
    {
        $startDateToday = (new DateTime('00:00'))->format('Y-m-d H:i:s');
        $endDateToday = (new DateTime('23:59'))->format('Y-m-d H:i:s');
        $this->db->select('*, customers.id as CustomerId, auths.id as AuthId');
        $this->db->from('customers');
        $this->db->join('auths', 'auths.id = customers.auth_id');
        $this->db->where('customers.created_at >=', $startDateToday);
        $this->db->where('customers.created_at <=', $endDateToday);
        $res = $this->db->get()->result_array();
        return $res;
    }

    public function GetItemsListing($model)
    {
        // echo '<pre>', var_dump($model), '</pre>';
        // die();
        $this->db->select('*');
        $this->db->from('barang');

        if ($model['name'] != "") {
            $this->db->like('name', $model['name']);
        }
        if ($model['code'] != "") {
            $this->db->like('code', $model['code']);
        }
        // if ($model['type'] != "") {
        //     $this->db->like('type', $model['type']);
        // }
        if ($model['status'] != "") {
            $this->db->like('status', $model['status']);
        }

        $query = $this->db->get();
        // echo '<pre>', var_dump($query->result_array()), '</pre>';
        // die();
        return $query->result_array();
    }

    public function GetTransactionsListing($model)
    {
        $this->db->select('*, transaksi.id as TransactionId, transaksi.code as TransactionCode, transaksi.status as TransactionStatus, customers.id as CustomerId, customers.name as CustomerName, barang.id as BarangId, barang.name as ItemName, barang.code as ItemCode, auths.id as AuthId');
        $this->db->from('transaksi');
        $this->db->join('customers', 'customers.id = transaksi.customer_id');
        $this->db->join('barang', 'barang.id = transaksi.barang_id');
        $this->db->join('auths', 'auths.id = transaksi.auth_id');

        if ($model['code'] != "") {
            $this->db->like('transaksi.code', $model['code']);
        }
        if ($model['customer'] != "") {
            $this->db->where('customers.id', $model['customer']);
        }
        if ($model['item'] != "") {
            $this->db->where('barang.id', $model['item']);
        }
        if ($model['status'] != "") {
            $this->db->like('transaksi.status', $model['status']);
        }
        if ($model['statuspayment'] != "") {
            $this->db->like('transaksi.status_payment', $model['statuspayment']);
        }
        if ($model['desc'] != "") {
            $this->db->like('transaksi.description', $model['desc']);
        }

        $query = $this->db->get();
        // echo '<pre>', var_dump($query->result_array()), '</pre>';
        // die();
        return $query;
    }

    public function GetReportTransactionsListing($model)
    {
        $this->db->select('*, transaksi.id as TransactionId, transaksi.code as TransactionCode, transaksi.status as TransactionStatus, customers.id as CustomerId, customers.name as CustomerName, barang.id as BarangId, barang.name as ItemName, barang.code as ItemCode, auths.id as AuthId');
        $this->db->from('transaksi');
        $this->db->join('customers', 'customers.id = transaksi.customer_id');
        $this->db->join('barang', 'barang.id = transaksi.barang_id');
        $this->db->join('auths', 'auths.id = transaksi.auth_id');

        if ($model['code'] != "") {
            $this->db->like('transaksi.code', $model['code']);
        }
        if ($model['customer'] != "") {
            $this->db->where('customers.id', $model['customer']);
        }
        if ($model['item'] != "") {
            $this->db->where('barang.id', $model['item']);
        }
        if ($model['status'] != "") {
            $this->db->like('transaksi.status', $model['status']);
        }

        $query = $this->db->get();
        // echo '<pre>', var_dump($query->result_array()), '</pre>';
        // die();
        return $query;
    }

    public function GetReportCustomersListing($model)
    {
        $this->db->select('*, sum(transaksi.pay) as SumSubtotal, sum(transaksi.angsuran) as SumGrandtotal, 
                            customers.id as CustomerId, customers.nik as CustomerNIK, customers.address as CustomerAddress, customers.phone_number as CustomerPhone,
                            transaksi.nik as TransactionNIK, transaksi.phone_number as TransactionPhone, transaksi.id as TransactionId, 
                            transaksi.status as TransactionStatus, transaksi.alamat as TransactionAddress');
        $this->db->from('customers');
        $this->db->join('transaksi', 'customers.id = transaksi.customer_id');

        $this->db->where('transaksi.status <>', 3); // exclude cancelled transactions
        if ($model['customer'] != "") {
            $this->db->where('customers.id', $model['customer']);
        }
        $this->db->group_by('customers.name');
        $query = $this->db->get();
        return $query;
    }

    public function ValidateTransaction($model, $isEdit = false)
    {
        $result = array('success' => true, 'message' => '', 'entity' => []);

        if (!$isEdit) {
            if ($model['price'] <= 0) {
                $result['success'] = false;
                $result['message'] = "Price must be greater than 0, Create Transaction aborted!";
            }

            $checkTransactionCode = $this->GetTransactions("where code = '" . $model['code'] . "'");
            if ($checkTransactionCode->num_rows() > 0) {
                $result['success'] = false;
                $result['message'] = "Transaction Code already in use, Create Transaction aborted!";
            }

            $checkItemCode = $this->GetItems("where code = '" . $model['itemcode'] . "' and status = 1");
            if ($checkItemCode->num_rows() > 0) {
                $result['success'] = false;
                $result['message'] = "Item Code already in use, Create Transaction aborted!";
            }
        } else {
            $selectedTransaction = $this->FindTransaction($model['id']);
            if ((int)$selectedTransaction->status_payment != 1 || (int)$selectedTransaction->status_payment != 1) {
                $result['success'] = false;
                $result['message'] = "Transaction status already paid or completed, Edit Transaction aborted!";
            }
        }

        return $result;
    }

    public function InsertTransaction($model)
    {
        $dataItem = array(
            'name'      => $model['itemname'],
            'code'      => $model['itemcode'],
            'status'      => 1
        );
        $insertItem = $this->db->insert('barang', $dataItem);

        if ($insertItem > 0) {
            $getLastItem = $this->GetItems("order by id desc")->row_array();
            $dataTransaction = array(
                'customer_id'       => $model['customer'],
                'barang_id'         => $getLastItem['id'],
                'auth_id'           => $model['auth_id'],
                'code'              => $model['code'],
                'price'             => $model['price'],
                'angsuran'          => $model['angsuran'],
                'date'              => $model['date'],
                'pay'               => $model['pay'],
                'nik'               => $model['nik'],
                'alamat'            => $model['address'],
                'phone_number'      => $model['phone'],
                'description'       => $model['desc'],
                'status'            => $model['status'],
                'status_payment'    => $model['status_payment'],
            );

            $insertTransaction = $this->db->insert('transaksi', $dataTransaction);
            if ($insertTransaction > 0) return true;
        }

        return false;
    }

    public function EditTransaction($model)
    {
        $now = date("Y-m-d H:i:s");
        $dataTransaction = array(
            'nik'           => $model['nik'],
            'alamat'        => $model['address'],
            'phone_number'  => $model['phone'],
            'description'   => $model['desc'],
            'updated_at'    => $now
        );

        $this->db->where('id', $model['id']);
        return $this->db->update('transaksi', $dataTransaction);
    }

    public function ChangeTransactionStatus($status, $id)
    {
        $data = array('status' => $status);
        $this->db->where('id', $id);

        return $this->db->update('transaksi', $data);
    }

    public function ChangeItemStatus($status, $id)
    {
        $data = array('status' => $status);
        $this->db->where('id', $id);

        return $this->db->update('barang', $data);
    }

    public function CreatePaymentTransaction($model)
    {
        $idTransaction = 0;
        // Create Data Payment
        foreach ($model as $row) {
            $idTransaction = $row['idTransaction'];
            $dataPayment = array(
                'transaksi_id'  => $idTransaction,
                'due_date'      => $row['due_date'],
                'date'          => $row['date'],
                'pay'           => $row['pay'],
                'charge'        => $row['charge'],
                'method'        => $row['method'],
            );

            $this->db->insert('pembayaran', $dataPayment);
        }

        // Update Status Transaction
        $getPaymentByTransactionId = $this->GetPaymentByTransactionId($idTransaction)->result_array();
        if ($getPaymentByTransactionId) {
            $status = $getPaymentByTransactionId[0]['pay'] == count($getPaymentByTransactionId) ? 3 : 2;

            if ($status == 3) {
                // update status barang to inactive if transaction is completed
                $barangId = $getPaymentByTransactionId[0]['barang_id'];
                $dataBarang = array('status' => 0);
                $this->db->where('id', $barangId);
                $this->db->update('barang', $dataBarang);
            }

            $data = array(
                'status_payment' => $status,
                'status' => ($status == 3 ? 2 : 1)
            );
            $this->db->where('id', $idTransaction);

            return $this->db->update('transaksi', $data);
        }
        return false;
    }

    ///
    public function FindCustomer($id)
    {
        $this->db->select('*, customers.id as CustomerId, auths.id as AuthId');
        $this->db->from('customers');
        $this->db->join('auths', 'auths.id = customers.auth_id');
        $this->db->where('customers.id', $id);
        $res = $this->db->get()->row();
        return $res;
    }

    function FindTransaction($id)
    {
        $this->db->select('*, transaksi.id as TransactionId, transaksi.code as TransactionCode, transaksi.status as TransactionStatus, customers.id as CustomerId, customers.name as CustomerName, barang.id as ItemId, barang.name as ItemName, barang.code as ItemCode, auths.id as AuthId, customers.nik as CustomerNIK, customers.address as CustomerAddress, customers.phone_number as CustomerPhone, transaksi.nik as TransactionNIK, transaksi.alamat as TransactionAddress, transaksi.phone_number as TransactionPhone');
        $this->db->from('transaksi');
        $this->db->join('customers', 'transaksi.customer_id = customers.id');
        $this->db->join('barang', 'transaksi.barang_id = barang.id');
        $this->db->join('auths', 'transaksi.auth_id = auths.id');
        $this->db->where('transaksi.id', $id);
        $res = $this->db->get()->row();
        return $res;
    }

    function FindPaymentByTransactionId($id)
    {
        $this->db->select('*');
        $this->db->from('pembayaran');
        $this->db->where('pembayaran.transaksi_id', $id);
        $res = $this->db->get()->result();
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

    public function GetSumTotalPaymentByCustomer($id)
    {
        $this->db->select('SUM(pembayaran.charge) as Charge, SUM(pembayaran.pay) as SumPay');
        $this->db->from('pembayaran');
        $this->db->join('transaksi', 'pembayaran.transaksi_id = transaksi.id');
        $this->db->where('transaksi.customer_id', $id);
        $this->db->group_by('transaksi.customer_id');
        $res = $this->db->get()->row();
        // echo '<pre>', var_dump($res->result_array()), '</pre>';
        // die();
        return $res;
    }

    public function FindItem($id)
    {
        $this->db->select('*');
        $this->db->from('barang');
        $this->db->where('id', $id);
        $res = $this->db->get()->row();
        return $res;
    }

    function GetPaymentByTransactionId($id)
    {
        $this->db->select('*, pembayaran.id as PaymentId, transaksi.id as TransactionId, pembayaran.pay as PaymentPay, transaksi.pay as TransactionPay');
        $this->db->from('pembayaran');
        $this->db->join('transaksi', 'pembayaran.transaksi_id = transaksi.id');
        $this->db->where('transaksi.id', $id);
        $res = $this->db->get();
        return $res;
    }

    function GetPaymentTransactions()
    {
        $this->db->select('*, pembayaran.id as PaymentId, transaksi.id as TransactionId, SUM(pembayaran.pay) as PaymentPay, transaksi.pay as TransactionPay');
        $this->db->from('pembayaran');
        $this->db->join('transaksi', 'pembayaran.transaksi_id = transaksi.id');
        $res = $this->db->get();
        return $res;
    }

    function GetUnpaidPayments()
    {
        $this->db->select('SUM(pembayaran.pay) as TotalPaid, SUM(transaksi.angsuran) as GrandTotal');
        $this->db->from('pembayaran');
        $this->db->join('transaksi', 'pembayaran.transaksi_id = transaksi.id');
        $res = $this->db->get();
        return $res;
    }

    function GetSumGrandtotalTransactions()
    {
        $this->db->select('SUM(transaksi.angsuran) as GrandTotal');
        $this->db->from('transaksi');
        $res = $this->db->get()->row();
        return $res;
    }

    function GetSumPayments()
    {
        $this->db->select('SUM(pembayaran.pay) as TotalPaid');
        $this->db->from('pembayaran');
        $res = $this->db->get()->row();
        return $res;
    }

    public function GetCustomers($where = "")
    {
        $res = $this->db->query("Select * from customers " . $where);
        return $res;
    }

    public function GetTransactions($where = "")
    {
        $res = $this->db->query("Select * from transaksi " . $where);
        return $res;
    }

    public function GetPayments($where = "")
    {
        $res = $this->db->query("Select * from pembayaran " . $where);
        return $res;
    }

    public function GetCustomerAuth()
    {
        $this->db->select('*, customers.id as CustomerId, auths.id as AuthId');
        $this->db->from('customers');
        $this->db->join('auths', 'auths.id = customers.auth_id');
        $res = $this->db->get();
        return $res;
    }

    public function GetAllItem($where = "")
    {
        $this->db->select('*');
        $this->db->from('barang');
        $res = $this->db->get();
        return $res;
    }

    public function GetRoles($where = "")
    {
        $res = $this->db->query("Select * from roles " . $where);
        return $res;
    }

    public function GetItems($where = "")
    {
        $res = $this->db->query("Select * from barang " . $where);
        return $res;
    }

    public function GetAuths($where = "")
    {
        $res = $this->db->query("Select * from auths " . $where);
        return $res;
    }
}
