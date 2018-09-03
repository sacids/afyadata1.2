<?php
/**
 * Created by PhpStorm.
 * User: administrator
 * Date: 03/09/2018
 * Time: 11:55
 */

class Migration extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->input->is_cli_request())
            show_404();

        $this->load->library(array('migration'));
        $this->load->dbforge();
    }

    public function latest()
    {
        if ($this->migration->current() === FALSE) {
            echo $this->migration->error_string();
        }

        $this->migration->latest();
        echo $this->migration->error_string();
    }
}