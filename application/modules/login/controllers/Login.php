<?php defined('BASEPATH') or exit('No direct script access allowed');

class Login extends MY_Controller
{
    public function __construct()
    {
        // Load the constructer from MY_Controller
        $this->load->model('LoginModel');
        $this->load->model('Alert');
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('index.php');
    }

    public function ForgotPassword()
    {
        $this->load->view('forgotpassword');
    }

    public function ChangePassword()
    {
        $this->load->view('changepassword');
    }

    public function DoLogin()
    {
        $model = array(
            'email'     => $this->input->post('Email'),
            'password'  => $this->input->post('Password')
        );

        $validateUser = $this->LoginModel->ValidateUser($model);
        if ($validateUser > 0) {
            $this->session->set_userdata('customerId', $validateUser->CustomerId);
            $this->session->set_userdata('customerName', $validateUser->name);
            header('location:' . base_url());
        } else {
            $this->session->set_flashdata('CustomerLogin_ResponseMessage', '<div class="alert alert-danger alert-dismissible fade show">Email atau Password salah!<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
            $this->load->view('index.php');
        }
    }

    public function DoLogout($link = "")
    {
        $this->session->sess_destroy();
        header('location:' . base_url() . $link);
    }

    public function RecoverPassword()
    {
        $model = array(
            'email' => $this->input->post('Email')
        );

        $res = $this->LoginModel->RecoverPassword($model);
        if ($res['status']) {
            $this->session->set_flashdata('Forgot_ResponseMessage', $this->Alert->SuccessAlert($res['message'] . "<br>Password baru anda: <b>" . $res['entity'] . "</b>"));
            $this->load->view('index');
        } else {
            $this->session->set_flashdata('Forgot_ResponseMessage', $this->Alert->FailedAlert($res['message']));
            $this->load->view('forgotpassword');
        }
    }

    public function ChangingPassword()
    {
        $model = array(
            'customerid'    => $this->session->userdata('customerId'),
            'oldpwd'        => $this->input->post('OldPassword'),
            'newpwd'        => $this->input->post('NewPassword'),
        );

        $res = $this->LoginModel->ChangePassword($model);
        if ($res['status']) {
            $this->session->set_flashdata('Change_ResponseMessage', $this->Alert->SuccessAlert($res['message']));
            $this->DoLogout("login");
        } else {
            $this->session->set_flashdata('Change_ResponseMessage', $this->Alert->FailedAlert($res['message']));
            $this->load->view('changepassword');
        }
    }
}
