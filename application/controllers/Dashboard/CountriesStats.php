<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CountriesStats extends CI_Controller
{
    public function index($state = "")
    {
        $this->load->view("SU/countriesStats");
    }
}