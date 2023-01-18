<?php defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_Controller
{
    public function __construct()
    {
        // Load the constructer from MY_Controller
        $this->load->model('DashboardModel');
        $this->load->model('Alert');
        $this->load->model('GeneralUtilities');
        parent::__construct();
    }

    public function login()
    {
        $this->load->view('login');
    }

    public function index()
    {
        if (!$this->DashboardModel->IsAuthorize()) {
            $this->session->set_flashdata('Login_ResponseMessage', $this->Alert->FailedAlert('Failed Authenticated!'));
            $this->load->view('login.php');
            return false;
        }

        //dailyRegistration && customerCount
        $getCustomers = $this->DashboardModel->GetCustomerAuth();
        $dailyRegistration = array_filter($getCustomers->result_array(), function ($obj) {
            $startDateToday = (new DateTime('00:00'))->format('Y-m-d H:i:s');
            $endDateToday = (new DateTime('23:59'))->format('Y-m-d H:i:s');
            return $obj['created_at'] >= $startDateToday && $obj['created_at'] <= $endDateToday;
        });

        //customerCountMonthly
        $monthlyCustomer = array_filter($getCustomers->result_array(), function ($obj) {
            $firstDayMonth = (new DateTime('00:00'))->modify('first day of')->format('Y-m-d H:i:s');
            $lastDayMonth = (new DateTime('23:59'))->modify('last day of')->format('Y-m-d H:i:s');
            return $obj['created_at'] >= $firstDayMonth && $obj['created_at'] <= $lastDayMonth;
        });

        //totalUnpaidTransactions
        $getSumGrandtotalTransactions = $this->DashboardModel->GetSumGrandtotalTransactions();
        $getSumPayments = $this->DashboardModel->GetSumPayments();
        $totalUnpaidTransactions = $getSumGrandtotalTransactions->GrandTotal - $getSumPayments->TotalPaid;

        //totalUnpaidTransactions (monthly)
        $totalMonthlyUnpaidTransactions = 0;
        $getTransactions = $this->DashboardModel->GetTransactions();
        $monthlyTransactions = array_filter($getTransactions->result_array(), function ($obj) {
            $firstDayMonth = (new DateTime('00:00'))->modify('first day of')->format('Y-m-d');
            $lastDayMonth = (new DateTime('23:59'))->modify('last day of')->format('Y-m-d');
            return $obj['date'] >= $firstDayMonth && $obj['date'] <= $lastDayMonth;
        });
        foreach ($monthlyTransactions as $trans) {
            $findPayment = $this->DashboardModel->GetPaymentByTransactionId($trans['id']);

            if (count($findPayment->result()) == 0) continue;
            $sumPaid = array_sum(array_column($findPayment->result(), 'PaymentPay'));
            $totalMonthlyUnpaidTransactions += $findPayment->row()->angsuran - $sumPaid;
        }

        //totalTodaysRevenue
        $getPayments = $this->DashboardModel->GetPayments();
        $getTodayPayments = array_filter($getPayments->result_array(), function ($obj) {
            $startDateToday = (new DateTime('00:00'))->format('Y-m-d H:i:s');
            $endDateToday = (new DateTime('23:59'))->format('Y-m-d H:i:s');
            return $obj['created_at'] >= $startDateToday && $obj['created_at'] <= $endDateToday;
        });
        $totalTodaysRevenue = array_sum(array_column($getTodayPayments, 'pay'));

        //totalMonthlyRevenue
        $getMonthlyPayments = array_filter($getPayments->result_array(), function ($obj) {
            $firstDayMonth = (new DateTime('00:00'))->modify('first day of')->format('Y-m-d');
            $lastDayMonth = (new DateTime('23:59'))->modify('last day of')->format('Y-m-d');
            return $obj['created_at'] >= $firstDayMonth && $obj['created_at'] <= $lastDayMonth;
        });
        $totalMonthlyRevenue = array_sum(array_column($getMonthlyPayments, 'pay'));

        //dueTransactions
        $comingTransactions = array_filter($getTransactions->result_array(), function ($obj) {
            $isReturn = false;
            $startDate = (new DateTime('00:00'))->modify('+1 days')->format('Y-m-d');
            $endDate = (new DateTime('23:59'))->modify('+7 days')->format('Y-m-d');
            for ($idx = 1; $idx < $obj['pay']; $idx++) {
                $dueDate = (new DateTime($obj['date']))->modify('+' . ($idx * 30) . ' days')->format('Y-m-d');
                if ($dueDate >= $startDate && $dueDate <= $endDate) {
                    $isReturn = true;
                }
            }
            return $isReturn;
        });
        // echo '<pre>comingTransactions: ', var_dump($comingTransactions), '</pre>';
        // die();

        $data = array(
            'customerCount'                     => $getCustomers->num_rows(),
            'customerCountMonthly'              => count($monthlyCustomer),
            'dailyRegistration'                 => $dailyRegistration,
            'totalUnpaidTransactions'           => $totalUnpaidTransactions,
            'totalMonthlyUnpaidTransactions'    => $totalMonthlyUnpaidTransactions,
            'totalTodaysRevenue'                => $totalTodaysRevenue,
            'totalMonthlyRevenue'               => $totalMonthlyRevenue,
            'comingTransactions'                => $comingTransactions
        );
        $this->load->view('index', $data);
    }

    public function customer()
    {
        if (!$this->DashboardModel->IsAuthorize()) {
            $this->session->set_flashdata('Login_ResponseMessage', $this->Alert->FailedAlert('Failed Authenticated!'));
            $this->load->view('login.php');
            return false;
        }

        $model = array(
            'name'      => $this->input->get('name') ?? "",
            'nik'       => $this->input->get('nik') ?? "",
            'email'     => $this->input->get('email') ?? "",
            'status'    => $this->input->get('status') ?? ""
        );
        $dataCustomers = $this->DashboardModel->GetCustomersListing($model);
        $datas = array(
            'dataCustomers' => $dataCustomers
        );

        $this->session->set_flashdata('model', $model);

        $this->load->view('customer', $datas);
    }

    public function createcustomer()
    {
        if (!$this->DashboardModel->IsAuthorize()) {
            $this->session->set_flashdata('Login_ResponseMessage', $this->Alert->FailedAlert('Failed Authenticated!'));
            $this->load->view('login.php');
            return false;
        }

        $this->load->view('createcustomer');
    }

    public function editcustomer($id)
    {
        if (!$this->DashboardModel->IsAuthorize()) {
            $this->session->set_flashdata('Login_ResponseMessage', $this->Alert->FailedAlert('Failed Authenticated!'));
            $this->load->view('login');
            return false;
        }

        $selectedCustomer = $this->DashboardModel->FindCustomer($id);
        if (!$selectedCustomer) {
            $this->session->set_flashdata('ResponseMessage', $this->Alert->FailedAlert('Customer not found!'));
            header('location:' . base_url() . 'dashboard/customer');
            return false;
        }

        $data = array(
            'selectedCustomer' => $selectedCustomer
        );
        $this->load->view('editcustomer', $data);
    }

    public function item()
    {
        if (!$this->DashboardModel->IsAuthorize()) {
            $this->session->set_flashdata('Login_ResponseMessage', $this->Alert->FailedAlert('Failed Authenticated!'));
            $this->load->view('login.php');
            return false;
        }

        $model = array(
            'name'          => $this->input->get('name') ?? "",
            'code'          => $this->input->get('code') ?? "",
            'status'        => $this->input->get('status') ?? ""
        );
        $dataItems = $this->DashboardModel->GetItemsListing($model);
        $datas = array(
            'dataItems' => $dataItems
        );

        $this->session->set_flashdata('model', $model);

        $this->load->view('item', $datas);
    }

    public function transaction()
    {
        if (!$this->DashboardModel->IsAuthorize()) {
            $this->session->set_flashdata('Login_ResponseMessage', $this->Alert->FailedAlert('Failed Authenticated!'));
            $this->load->view('login.php');
            return false;
        }

        $model = array(
            'daterange'     => $this->input->get('daterange') ?? "",
            'code'          => $this->input->get('code') ?? "",
            'customer'      => $this->input->get('customer') ?? "",
            'item'          => $this->input->get('item') ?? "",
            'status'        => $this->input->get('status') ?? "",
            'statuspayment' => $this->input->get('statuspayment') ?? "",
            'desc'          => $this->input->get('desc') ?? ""
        );

        $getCustomers = $this->DashboardModel->GetCustomerAuth();
        $activeCustomers = array_filter($getCustomers->result_array(), function ($obj) {
            return $obj['status'] == 1;
        });
        $getItems = $this->DashboardModel->GetAllItem();
        $activeItems = array_filter($getItems->result_array(), function ($obj) {
            return $obj['status'] == 1;
        });
        $dataTransactions = $this->DashboardModel->GetTransactionsListing($model);
        $filteredDataTransactions = array_filter($dataTransactions->result_array(), function ($obj) {
            $startDate = (new DateTime('00:00'))->modify('-30 days')->format('Y-m-d H:i:s'); //default: today - 29 days (Last Month)
            $endDate = (new DateTime('23:59'))->format('Y-m-d H:i:s'); //default: today (Last Month)

            if ($this->input->get('daterange')) {
                $splitDaterange = explode(" - ", $this->input->get('daterange'));
                $startDate = (new DateTime($splitDaterange[0]))->format('Y-m-d');
                $endDate = (new DateTime($splitDaterange[1]))->format('Y-m-d');
            }

            return $obj['date'] >= $startDate && $obj['date'] <= $endDate;
        });

        // sort by date asc
        usort($filteredDataTransactions, function ($a, $b) {
            if ($a["date"] == $b["date"])
                return (0);
            return (($a["date"] < $b["date"]) ? -1 : 1);
        });

        $datas = array(
            'activeCustomers'   => $activeCustomers,
            'activeItems'       => $getItems->result_array(),
            'dataTransactions'  => $filteredDataTransactions
        );

        $this->session->set_flashdata('model', $model);

        $this->load->view('transaction', $datas);
    }

    public function createtransaction()
    {
        if (!$this->DashboardModel->IsAuthorize()) {
            $this->session->set_flashdata('Login_ResponseMessage', $this->Alert->FailedAlert('Failed Authenticated!'));
            $this->load->view('login.php');
            return false;
        }

        $getCustomers = $this->DashboardModel->GetCustomerAuth();
        $activeCustomers = array_filter($getCustomers->result_array(), function ($obj) {
            return $obj['status'] == 1;
        });
        $getItems = $this->DashboardModel->GetAllItem();
        $activeItems = array_filter($getItems->result_array(), function ($obj) {
            return $obj['status'] == 1;
        });

        $datas = array(
            'activeCustomers'   => $activeCustomers,
            'activeItems'       => $activeItems
        );

        $this->load->view('createtransaction', $datas);
    }

    public function edittransaction($id)
    {
        if (!$this->DashboardModel->IsAuthorize()) {
            $this->session->set_flashdata('Login_ResponseMessage', $this->Alert->FailedAlert('Failed Authenticated!'));
            $this->load->view('login');
            return false;
        }

        $getCustomers = $this->DashboardModel->GetCustomerAuth();
        $activeCustomers = array_filter($getCustomers->result_array(), function ($obj) {
            return $obj['status'] == 1;
        });
        $getItems = $this->DashboardModel->GetAllItem();
        $activeItems = array_filter($getItems->result_array(), function ($obj) {
            return $obj['status'] == 1;
        });

        $selectedTransaction = $this->DashboardModel->FindTransaction($id);
        if (!$selectedTransaction) {
            $this->session->set_flashdata('ResponseMessage', $this->Alert->FailedAlert('Transaction not found!'));
            header('location:' . base_url() . 'dashboard/transaction');
            return false;
        }

        $datas = array(
            'activeCustomers'   => $activeCustomers,
            'activeItems'       => $activeItems,
            'selectedTransaction' => $selectedTransaction
        );

        $this->load->view('edittransaction', $datas);
    }

    public function printtransaction($id)
    {
        if (!$this->DashboardModel->IsAuthorize()) {
            $this->session->set_flashdata('Login_ResponseMessage', $this->Alert->FailedAlert('Failed Authenticated!'));
            $this->load->view('login');
            return false;
        }

        $selectedTransaction = $this->DashboardModel->FindTransaction($id);
        // echo '<pre>', var_dump($selectedTransaction), '</pre>';
        // die();
        if (!$selectedTransaction) {
            $this->session->set_flashdata('ResponseMessage', $this->Alert->FailedAlert('Transaction not found!'));
            header('location:' . base_url() . 'dashboard/transaction');
            return false;
        }

        $datas = array(
            'selectedTransaction' => $selectedTransaction
        );

        $this->load->view('printtransaction', $datas);
    }

    public function ReportTransaction()
    {
        if (!$this->DashboardModel->IsAuthorize()) {
            $this->session->set_flashdata('Login_ResponseMessage', $this->Alert->FailedAlert('Failed Authenticated!'));
            $this->load->view('login.php');
            return false;
        }

        $model = array(
            'daterange'     => $this->input->get('daterange') ?? "",
            'code'          => $this->input->get('code') ?? "",
            'customer'      => $this->input->get('customer') ?? "",
            'item'          => $this->input->get('item') ?? "",
            'status'        => $this->input->get('status') ?? "",
        );

        $getCustomers = $this->DashboardModel->GetCustomerAuth();
        $activeCustomers = array_filter($getCustomers->result_array(), function ($obj) {
            return $obj['status'] == 1;
        });
        $getItems = $this->DashboardModel->GetAllItem();
        $activeItems = array_filter($getItems->result_array(), function ($obj) {
            return $obj['status'] == 1;
        });
        $dataTransactions = $this->DashboardModel->GetReportTransactionsListing($model);
        $filteredDataTransactions = array_filter($dataTransactions->result_array(), function ($obj) {
            $startDate = (new DateTime('00:00'))->modify('-30 days')->format('Y-m-d H:i:s'); //default: today - 29 days (Last Month)
            $endDate = (new DateTime('23:59'))->format('Y-m-d H:i:s'); //default: today (Last Month)

            if ($this->input->get('daterange')) {
                $splitDaterange = explode(" - ", $this->input->get('daterange'));
                $startDate = (new DateTime($splitDaterange[0]))->format('Y-m-d');
                $endDate = (new DateTime($splitDaterange[1]))->format('Y-m-d');
            }

            return $obj['date'] >= $startDate && $obj['date'] <= $endDate;
        });

        // sort by date asc
        usort($filteredDataTransactions, function ($a, $b) {
            if ($a["date"] == $b["date"])
                return (0);
            return (($a["date"] < $b["date"]) ? -1 : 1);
        });

        $datas = array(
            'activeCustomers'   => $activeCustomers,
            'activeItems'       => $getItems->result_array(),
            'dataTransactions'  => $filteredDataTransactions
        );

        $this->session->set_flashdata('model', $model);

        $this->load->view('reporttransaction', $datas);
    }

    public function printreporttransaction()
    {
        if (!$this->DashboardModel->IsAuthorize()) {
            $this->session->set_flashdata('Login_ResponseMessage', $this->Alert->FailedAlert('Failed Authenticated!'));
            $this->load->view('login');
            return false;
        }

        $model = array(
            'daterange'     => $this->input->get('daterange') ?? "",
            'code'          => $this->input->get('code') ?? "",
            'customer'      => $this->input->get('customer') ?? "",
            'item'          => $this->input->get('item') ?? "",
            'status'        => $this->input->get('status') ?? "",
        );

        $dataTransactions = $this->DashboardModel->GetReportTransactionsListing($model)->result_array();

        $datas = array(
            'dataTransactions' => $dataTransactions
        );

        $this->load->view('printreporttransaction', $datas);
    }

    public function ReportCustomer()
    {
        if (!$this->DashboardModel->IsAuthorize()) {
            $this->session->set_flashdata('Login_ResponseMessage', $this->Alert->FailedAlert('Failed Authenticated!'));
            $this->load->view('login.php');
            return false;
        }

        $model = array(
            'customer'      => $this->input->get('customer') ?? ""
        );

        $getCustomers = $this->DashboardModel->GetCustomerAuth();
        $activeCustomers = array_filter($getCustomers->result_array(), function ($obj) {
            return $obj['status'] == 1;
        });
        usort($activeCustomers, function ($a, $b) {
            if ($a["name"] == $b["name"])
                return (0);
            return (($a["name"] < $b["name"]) ? -1 : 1);
        });

        $dataCustomers = $this->DashboardModel->GetReportCustomersListing($model)->result_array();

        $datas = array(
            'activeCustomers'   => $activeCustomers,
            'dataCustomers'  => $dataCustomers
        );

        $this->session->set_flashdata('model', $model);

        $this->load->view('reportcustomer', $datas);
    }

    public function printreportcustomer()
    {
        if (!$this->DashboardModel->IsAuthorize()) {
            $this->session->set_flashdata('Login_ResponseMessage', $this->Alert->FailedAlert('Failed Authenticated!'));
            $this->load->view('login.php');
            return false;
        }

        $model = array(
            'customer'      => $this->input->get('customer') ?? ""
        );

        $dataCustomers = $this->DashboardModel->GetReportCustomersListing($model)->result_array();

        $datas = array(
            'dataCustomers'  => $dataCustomers
        );

        $this->load->view('printreportcustomer', $datas);
    }

    // Post Method
    public function DoLogin()
    {
        $model = array(
            'email'     => $this->input->post('Email'),
            'password'  => $this->input->post('Password')
        );

        $validateUser = $this->DashboardModel->ValidateUser($model);
        if ($validateUser > 0) {
            $this->session->set_userdata('authId', $validateUser->id);
            $this->session->set_userdata('email', $validateUser->email);
            header('location:' . base_url() . 'dashboard');
        } else {
            $this->session->set_flashdata('Login_ResponseMessage', '<div class="alert alert-danger alert-dismissible fade show">Email atau Password salah!<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
            $this->load->view('login.php');
        }
    }

    public function DoLogout()
    {
        $this->session->sess_destroy();
        $this->load->view('login.php');
    }

    public function CustomerRegister()
    {
        $data = array(
            'name'      => $this->input->post('Name'),
            'nik'       => $this->input->post('NIK'),
            'phone'     => $this->input->post('PhoneNumber'),
            'gender'    => $this->input->post('Gender'),
            'address'   => $this->input->post('Address'),
            'email'     => $this->input->post('Email'),
            'password'  => $this->input->post('Password'),
            'cpassword' => $this->input->post('ConfirmationPassword'),
            'status'    => true
        );

        $validations = $this->DashboardModel->Validation($data);
        if (!empty($validations) && !$validations['success']) {
            $this->session->set_flashdata('ResponseMessage', $this->Alert->FailedAlert($validations['message']));
            $this->load->view('createcustomer');
            return false;
        }

        $createCustomer = $this->DashboardModel->InsertCustomer($data);
        if ($createCustomer) {
            $this->session->set_flashdata('ResponseMessage', $this->Alert->SuccessAlert("Create Succeed!"));
            header('location:' . base_url() . 'dashboard/customer');
        } else {
            $this->session->set_flashdata('ResponseMessage', $this->Alert->FailedAlert("Create Failed!"));
            $this->load->view('createcustomer');
        }
    }

    public function EditCustomerInformation()
    {
        $data = array(
            'id'        => $this->input->post('Id'),
            'name'      => $this->input->post('Name'),
            'nik'       => $this->input->post('NIK'),
            'phone'     => $this->input->post('PhoneNumber'),
            'gender'    => $this->input->post('Gender'),
            'address'   => $this->input->post('Address')
        );

        $validations = $this->DashboardModel->ValidationEdit($data);
        if (!empty($validations) && !$validations['success']) {
            $this->session->set_flashdata('ResponseMessage', $this->Alert->FailedAlert($validations['message']));
            header('location:' . base_url() . 'dashboard/editcustomer/' . $data['id']);
            return false;
        }

        $editCustomer = $this->DashboardModel->EditCustomer($data);
        if ($editCustomer) {
            $this->session->set_flashdata('ResponseMessage', $this->Alert->SuccessAlert("Update Succeed!"));
            header('location:' . base_url() . 'dashboard/customer');
        } else {
            $this->session->set_flashdata('ResponseMessage', $this->Alert->FailedAlert("Update Failed!"));
            header('location:' . base_url() . 'dashboard/editcustomer/' . $data['id']);
        }
    }

    public function DeleteCustomer($id)
    {
        $res = $this->DashboardModel->DeleteCustomer($id);
        if ($res)
            $this->session->set_flashdata('ResponseMessage', $this->Alert->SuccessAlert("Delete Succeed!"));
        else
            $this->session->set_flashdata('ResponseMessage', $this->Alert->FailedAlert('Delete Failed!'));

        header('location:' . base_url() . 'dashboard/customer');
    }

    public function ChangeCustomerStatus($status, $id)
    {
        $res = $this->DashboardModel->ChangeCustomerStatus($status, $id);
        if ($res)
            $this->session->set_flashdata('ResponseMessage', $this->Alert->SuccessAlert('Status update successful!'));
        else
            $this->session->set_flashdata('ResponseMessage', $this->Alert->FailedAlert('Status update failed!'));

        header('location:' . base_url() . 'dashboard/customer');
    }

    public function FindCustomer($id)
    {
        $result = array('success' => false, 'message' => 'an error has occured.', 'entity' => []);

        $selectedCustomer = $this->DashboardModel->FindCustomer($id);
        if ($selectedCustomer) {
            $result['success'] = true;
            $result['message'] = "Success";
            $result['entity'] = $selectedCustomer;
        }

        echo json_encode($result);
    }

    public function FindItem($id)
    {
        $result = array('success' => false, 'message' => 'an error has occured.', 'entity' => []);

        $selectedItem = $this->DashboardModel->FindItem($id);
        if ($selectedItem) {
            $result['success'] = true;
            $result['message'] = "Success";
            $result['entity'] = $selectedItem;
        }

        echo json_encode($result);
    }

    public function SubmitTransaction()
    {
        $data = array(
            'date'              => $this->input->post('Date'),
            'auth_id'           => $this->session->userdata('authId'),
            'code'              => $this->input->post('Code'),
            'customer'          => $this->input->post('Customer'),
            'nik'               => $this->input->post('NIK'),
            'address'           => $this->input->post('Address'),
            'phone'             => $this->input->post('Phone'),
            'itemname'          => $this->input->post('ItemName'),
            'itemcode'          => $this->input->post('ItemCode'),
            'price'             => (float)$this->input->post('Price'),
            'pay'               => (int)$this->input->post('Pay'),
            'desc'              => $this->input->post('Description'),
            'status'            => 1, // 1 = Incomplete
            'status_payment'    => 1 // 1 = Unpaid
        );

        $interest = 0;
        if ($data['pay'] == 3) $interest = 2.5;
        else if ($data['pay'] == 6) $interest = 5;
        else if ($data['pay'] == 12) $interest = 10;

        $payInstallation = $interest > 0 ? $data['price'] + ($data['price'] * ($interest / 100)) : $data['price'];
        $data['angsuran'] = $payInstallation;

        $validations = $this->DashboardModel->ValidateTransaction($data);
        if (!empty($validations) && !$validations['success']) {
            $this->session->set_flashdata('ResponseMessage', $this->Alert->FailedAlert($validations['message']));
            header('location:' . base_url() . 'dashboard/createtransaction');
            return false;
        }

        $createTransaction = $this->DashboardModel->InsertTransaction($data);
        if ($createTransaction) {
            $this->session->set_flashdata('ResponseMessage', $this->Alert->SuccessAlert("Create Succeed!"));
            header('location:' . base_url() . 'dashboard/transaction');
        } else {
            $this->session->set_flashdata('ResponseMessage', $this->Alert->FailedAlert("Create Failed!"));
            header('location:' . base_url() . 'dashboard/createtransaction');
        }
    }

    public function SubmitEditTransaction()
    {
        $data = array(
            'id'                => $this->input->post('Id'),
            'nik'               => $this->input->post('NIK'),
            'address'           => $this->input->post('Address'),
            'phone'             => $this->input->post('Phone'),
            'desc'              => $this->input->post('Description')
        );

        $validations = $this->DashboardModel->ValidateTransaction($data, true);
        if (!empty($validations) && !$validations['success']) {
            $this->session->set_flashdata('ResponseMessage', $this->Alert->FailedAlert($validations['message']));
            header('location:' . base_url() . 'dashboard/edittransaction/' . $data['id']);
            return false;
        }

        $editTransaction = $this->DashboardModel->EditTransaction($data);
        if ($editTransaction) {
            $this->session->set_flashdata('ResponseMessage', $this->Alert->SuccessAlert("Create Succeed!"));
            header('location:' . base_url() . 'dashboard/transaction');
        } else {
            $this->session->set_flashdata('ResponseMessage', $this->Alert->FailedAlert("Create Failed!"));
            header('location:' . base_url() . 'dashboard/edittransaction/' . $data['id']);
        }
    }

    public function ChangeTransactionStatus($status, $id)
    {
        $res = $this->DashboardModel->ChangeTransactionStatus($status, $id);
        if ($res) {
            if ($status == 3) {
                // if update status to cancelled (3), update status for the item who linked from selected transaction to inactive
                $selectedTransaction = $this->DashboardModel->FindTransaction($id);
                $itemId = $selectedTransaction->ItemId;
                $this->DashboardModel->ChangeItemStatus(0, $itemId); // 0 = Inactive
            }
            $this->session->set_flashdata('ResponseMessage', $this->Alert->SuccessAlert('Status update successful!'));
        } else
            $this->session->set_flashdata('ResponseMessage', $this->Alert->FailedAlert('Status update failed!'));

        header('location:' . base_url() . 'dashboard/transaction');
    }

    public function FindTransaction($id)
    {
        $result = array('success' => false, 'message' => 'an error has occured.', 'entity' => []);

        $selectedTransaction = $this->DashboardModel->FindTransaction($id);
        if ($selectedTransaction) {
            $result['success'] = true;
            $result['message'] = "Success";
            $result['entity'] = $selectedTransaction;
        }

        echo json_encode($result);
    }

    public function FindPaymentTransaction($id)
    {
        $result = array('success' => false, 'message' => 'an error has occured.', 'entity' => []);

        $selectedTransaction = $this->DashboardModel->FindTransaction($id);
        $selectedPayment = $this->DashboardModel->GetPaymentByTransactionId($id)->result();
        if ($selectedTransaction) {
            $selectedTransaction->payments = $selectedPayment;
            $result['success'] = true;
            $result['message'] = "Success";
            $result['entity'] = $selectedTransaction;
        }

        echo json_encode($result);
    }

    public function SetPayment()
    {
        $model = array(
            'idTransaction'     => $this->input->get('idTransaction') ?? "",
            'payFor'            => $this->input->get('payFor') ?? "",
            'includeCharge'     => $this->input->get('includeCharge') ?? "",
            'charge'            => $this->input->get('charge') ?? "",
            'amount'            => $this->input->get('amount') ?? "",
            'paymentMethod'     => $this->input->get('paymentMethod') ?? ""
        );

        $findTransaction = $this->DashboardModel->FindTransaction($model['idTransaction']);
        $findPayment = $this->DashboardModel->FindPaymentByTransactionId($model['idTransaction']);
        $newModel = [];
        for ($idx = 1; $idx <= $model['payFor']; $idx++) {
            $isLast = $idx == $model['payFor'];
            $dueDate = (new DateTime($findTransaction->date))->modify('+' . (($idx + count($findPayment)) * 30) . ' days')->format('Y-m-d');
            array_push($newModel, array(
                'idTransaction' => $model['idTransaction'],
                'due_date'      => $dueDate,
                'date'          => date('Y-m-d'),
                'pay'           => $model['amount'] / $model['payFor'],
                'charge'        => $isLast && $model['includeCharge'] == "true" ? $model['charge'] : 0,
                'method'        => $model['paymentMethod']
            ));
        }

        $createPayment = $this->DashboardModel->CreatePaymentTransaction($newModel);
        if ($createPayment) {
            $this->session->set_flashdata('ResponseMessage', $this->Alert->SuccessAlert("Payment Succeed!"));
            header('location:' . base_url() . 'dashboard/transaction');
        } else {
            $this->session->set_flashdata('ResponseMessage', $this->Alert->FailedAlert("Payment Failed!"));
            header('location:' . base_url() . 'dashboard/transaction');
        }
    }
}
