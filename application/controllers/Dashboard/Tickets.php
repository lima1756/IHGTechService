<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tickets extends CI_Controller
{
    public function index($state = "")
    {
        
        if($state == "")
        {
            $this->load->view('SU/tickets', ['state'=>"all"]);
        }
        else
        {
            $this->load->view('SU/tickets', ['state'=>$state]);
        }
    }
}