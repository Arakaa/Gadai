<?php defined('BASEPATH') or exit('No direct script access allowed');

class Transaction extends MY_Controller
{
    public function __construct()
    {
        // Load the constructer from MY_Controller
        parent::__construct();
        $this->load->model('Alert');
        $this->load->model('TransactionModel');
    }

    public function index()
    {
        if (!$this->TransactionModel->IsAuthorize()) {
            $this->session->set_flashdata('ResponseMessage', $this->Alert->FailedAlert('Failed Authenticated!'));
            header('location:' . base_url() . '/login');
            return false;
        }

        $customerId = $this->session->userdata('customerId');
        $dataCustomer = $this->TransactionModel->GetTransactionByCustomer($customerId);
        // echo '<pre>', var_dump($dataCustomer), '</pre>';
        // die();

        $datas = array(
            'transactionCustomer'   => $dataCustomer
        );

        $this->load->view('index', $datas);
    }
}
