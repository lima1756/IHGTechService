<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NewUser extends CI_Controller
{
    public function index()
    {
        $this->config->set_item('language', 'spanish');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
         $this->load->view('SU/newUser');
    }
}