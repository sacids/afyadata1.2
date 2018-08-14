<?php
/**
 * Created by PhpStorm.
 * User: administrator
 * Date: 13/08/2018
 * Time: 11:41
 */

class Dashboard extends CI_Controller
{
    private $data;

    public function __construct()
    {
        parent::__construct();
    }

    //check if user logged in
    function is_logged_in()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
    }

    //index function
    function index()
    {
        $this->data['title'] = "Taarifa kwa Wakati!";
        $this->is_logged_in();

        //render view
        $this->load->view('header', $this->data);
        $this->load->view('sidebar');
        $this->load->view('dashboard');
        $this->load->view('footer');
    }
}