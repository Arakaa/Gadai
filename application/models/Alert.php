<?php
class Alert extends CI_Model
{
    public function SuccessAlert($message)
    {
        $result = "<div class='alert alert-success alert-dismissible fade show'>" . $message . "<button type='button' class='btn-close' data-bs-dismiss='alert'></button></div>";
        return $result;
    }
    public function FailedAlert($message)
    {
        $result = "<div class='alert alert-danger alert-dismissible fade show'>" . $message . "<button type='button' class='btn-close' data-bs-dismiss='alert'></button></div>";
        return $result;
    }
    public function WarningAlert($message)
    {
        $result = "<div class='alert alert-warning alert-dismissible fade show'>" . $message . "<button type='button' class='btn-close' data-bs-dismiss='alert'></button></div>";
        return $result;
    }
}
