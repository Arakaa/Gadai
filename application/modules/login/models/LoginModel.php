<?php

class LoginModel extends CI_Model
{
    public function ValidateUser($model)
    {
        $this->db->select('*, customers.id as CustomerId, auths.id as AuthId');
        $this->db->from('customers');
        $this->db->join('auths', 'auths.id = customers.auth_id');
        $this->db->where('email', $model['email']);
        $this->db->where('password', md5($model['password']));
        $query = $this->db->get()->row();
        return $query;
    }

    public function RecoverPassword($model)
    {
        // variable response result data (object)
        $response = array('status' => false, 'message' => '', 'entity' => []);

        // cek email
        $this->db->select('*, customers.id as CustomerId, auths.id as AuthId');
        $this->db->from('customers');
        $this->db->join('auths', 'auths.id = customers.auth_id');
        $this->db->where('email', $model['email']);
        $query = $this->db->get()->row();

        if ($query > 0) {
            // jika email ada
            $now = date("Y-m-d H:i:s");
            $newPassword = $this->generateRandomString(15);
            $dataCustomer = array(
                'password'  => md5($newPassword),
                'updated_at'    => $now
            );

            //query
            $this->db->where('id', $query->AuthId);
            $res = $this->db->update('auths', $dataCustomer);
            if ($res) {
                // jika update sukses
                $response['status'] = true;
                $response['message'] = "Password berhasil diubah!";
                $response['entity'] = $newPassword;
            } else {
                // jika update gagal
                $response['status'] = false;
                $response['message'] = "An error has occured! Password gagal diubah!";
            }
        } else {
            // jika email tidak ada
            $response['status'] = false;
            $response['message'] = "Email tidak ditemukan!";
        }

        return $response;
    }

    public function ChangePassword($model)
    {
        $response = array('status' => false, 'message' => '', 'entity' => []);

        $this->db->select('*, customers.id as CustomerId, auths.id as AuthId');
        $this->db->from('customers');
        $this->db->join('auths', 'auths.id = customers.auth_id');
        $this->db->where('customers.id', $model['customerid']);
        $query = $this->db->get()->row();

        if ($query > 0) {
            if ($query->password == md5($model['oldpwd'])) {
                $now = date("Y-m-d H:i:s");

                $dataCustomer = array(
                    'password'      => md5($model['newpwd']),
                    'updated_at'    => $now
                );

                $this->db->where('id', $query->AuthId);
                $res = $this->db->update('auths', $dataCustomer);
                if ($res) {
                    $response['status'] = true;
                    $response['message'] = "Password berhasil diubah!";
                } else {
                    $response['status'] = false;
                    $response['message'] = "An error has occured!";
                }
            } else {
                $response['status'] = false;
                $response['message'] = "Password lama salah!";
            }
        } else {
            $response['status'] = false;
            $response['message'] = "Email tidak ditemukan!";
        }

        return $response;
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
            $getLastCustomer = $this->GetCustomers("order by id desc")->row_array();
            $dataCustomer = array(
                'auth_id'       => $getLastCustomer['id'],
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

    function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
