<?php

class RegisterModel extends CI_Model
{
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

    public function Validation($model)
    {
        $result = array('success' => true, 'message' => '', 'entity' => []);

        if ($model['password'] != $model['cpassword']) {
            $result['success'] = false;
            $result['message'] = "Konfirmasi Password tidak sama, Registrasi gagal!";
        }

        $checkNikCustomer = $this->GetCustomers("where nik = '" . $model['nik'] . "'");
        if ($checkNikCustomer->num_rows() > 0) {
            $result['success'] = false;
            $result['message'] = "NIK Telah digunakan, Registrasi gagal!";
        }

        $checkEmailCustomer = $this->GetAuths("where email = '" . $model['email'] . "'");
        if ($checkEmailCustomer->num_rows() > 0) {
            $result['success'] = false;
            $result['message'] = "Email Telah digunakan, Registrasi gagal!";
        }

        return $result;
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
