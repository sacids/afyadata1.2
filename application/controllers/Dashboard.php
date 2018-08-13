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

    //Dashboard constructor.
    public function __construct()
    {
        parent::__construct();
    }

    //index function
    function index()
    {
        $this->data['title'] = "Taarifa kwa Wakati!";

        //render view
        $this->load->view('header', $this->data);
        $this->load->view('sidebar');
        $this->load->view('dashboard');
        $this->load->view('footer');
    }
}