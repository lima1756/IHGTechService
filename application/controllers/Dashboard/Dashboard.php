<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function index()
    {
        if($this->logdata->getType() == "SU")
        {
            $this->load->view('SU/dashboard');
        }
        else
        {
            header("Location: /");
        }
    }
}