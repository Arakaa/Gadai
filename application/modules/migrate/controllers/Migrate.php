<?php
class Migrate extends MY_Controller
{
    public function index()
    {
        $this->load->library('migration');

        if ($this->migration->latest() === FALSE) {
            show_error($this->migration->error_string());
        } else {
            echo "MIGRATION SUCCESS!";
        }
    }
}
