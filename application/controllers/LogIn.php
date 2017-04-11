<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LogIn extends CI_Controller
{
    public function index(){
        
        $email = $this->input->post('email');
        $pass = $this->input->post('pass');
        $remember = $this->input->post('loginrem');
        $error = "sign-in";
        if($remember == "on"){
            if ($this->logdata->logIn($email, $pass, true)) {
                header('Location: /');
            }
            else
            {
                $this->load->view('home', ['signIn' => $error]);
            }
        }
        elseif ($this->logdata->logIn($email, $pass)) {
            header('Location: /');
        }
        else
        {
            $this->load->view('home', ['signIn' => $error]);
        }
        
        $this->load->view('home', ['signIn' => $error]);
    }
}
