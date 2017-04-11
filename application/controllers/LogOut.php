<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LogOut extends CI_Controller
{
    public function index(){
        $this->logdata->logOut();
        header('Location: /');
    }
}