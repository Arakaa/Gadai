<?php defined('BASEPATH') or exit('No direct script access allowed');

class Register extends MY_Controller
{
    public function __construct()
    {
        // Load the constructer from MY_Controller
        $this->load->model('Crud');
        $this->load->model('RegisterModel');
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('index.php');
    }

    public function DoRegister()
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

        $validations = $this->RegisterModel->Validation($data);
        if (!empty($validations) && !$validations['success']) {
            $this->session->set_flashdata('Register_ResponseMessage', "<div class='alert alert-danger'>" . $validations['message'] . "</div>");
            $this->load->view('index.php');
            return false;
        }

        $createCustomer = $this->RegisterModel->InsertCustomer($data);
        if ($createCustomer) {
            $this->session->set_flashdata('Register_ResponseMessage', "<div class='alert alert-success'>Registrasi Berhasil!</div>");
            header('location:' . base_url() . 'login');
        } else {
            $this->session->set_flashdata('Register_ResponseMessage', "<div class='alert alert-danger'>Registrasi Gagal!</div>");
            $this->load->view('index.php');
        }
    }
}
