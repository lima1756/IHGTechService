<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SignUp extends CI_Controller
{
    public function index()
    {
        
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $error = array();
        $this->form_validation->set_rules('email', 'e-Mail', 'required');
        $this->form_validation->set_rules('pass', 'Contraseña', 'required');
        $this->form_validation->set_rules('name', 'Nombre', 'required');
        $this->form_validation->set_rules('last', 'Apellidos', 'required');
        $this->form_validation->set_rules('cell', 'Celular', 'required');
        $this->form_validation->set_rules('tel', 'Telefono', 'required');
        $this->form_validation->set_rules('ext', 'Extensión', 'required');
        $this->form_validation->set_rules('work', 'Trabajo', 'required');
        $this->form_validation->set_rules('area', 'Area', 'required');
        $this->form_validation->set_rules('country', 'País', 'required');
        $email = $this->input->post('email');
        $pass = $this->input->post('pass');
        $name = $this->input->post('name');
        $last = $this->input->post('last');
        $pass = hash("sha256", $pass);
        $cell = $this->input->post('cell');
        $tel = $this->input->post('tel');
        $ext = $this->input->post('ext');
        $work = $this->input->post('work');
        $area = $this->input->post('area');
        $country = $this->input->post('country');
        if($this->form_validation->run() == FALSE){
            array_push($error, "NULLS");
        }
        $check = $this->checkemail($email);
        if($check!="ok")
        {
            array_push($error, $check);    
        }
        if($this->input->post('pass') != $this->input->post('pass2'))
        {
            array_push($error, "passwords");    
        }
        if(count($error)==0)
        {
            $this->db->query("INSERT INTO users (email, password, nombre, apellido, cel, tel, ext, areaTrabajo, trabajo, id_region) 
            VALUES ('$email', '$pass', '$name', '$last', '$cell', '$tel', '$ext', '$area', '$work', $country)");
        }
        
        $this->load->view('home', ['error' => $error, 'goTo' => "registro"]);
    }
    

    private function checkemail($email){
        $vals = $this->db->query("SELECT email,id FROM users WHERE email = '$email'");
        if(count($vals->result())>0)
        {
            $vals = $vals->result();
            $vals = $this->db->query("SELECT * FROM informes WHERE id_usuario = " . $vals[0]->id);
            if(count($vals->result())>0)
            {
                return "denied";
            }
            else
            {
                return "registered";
            }
        }
        return "ok";
    }
}