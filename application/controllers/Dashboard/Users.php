<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller
{
    public function index()
    {
     //   $this->config->set_item('language', 'spanish');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->view('SU/Users');
    }
    
    
    public function newUser($type)
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
            $insert = array(
                "email" => $email,
                "password" => $pass,
                "nombre" => $name,
                "apellido" => $last,
                "cel" =>$cell, 
                "tel" => $tel, 
                "ext" => $ext, 
                "areaTrabajo" => $area, 
                "trabajo" => $work, 
                "id_region" => $country
            );
            $this->db->insert("users", $insert);
            $IDmortal = $this->db->insert_id();
            if($this->logdata->getData("id") != null)
            {
                $insert = array(
                    "id_usuario" => $IDmortal
                );
                if($type=="mortal")
                    $this->db->insert("mortals", $insert);
                else
                    $this->db->insert("superusers", $insert);
            }
        }
        $this->load->view('SU/Users', ['error' => $error, 'goTo' => "registro"]);
    }
    
    public function alterUser()
    {

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $error = array();
        $this->form_validation->set_rules('email', 'e-Mail', 'required');
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
        if($this->input->post('pass') != $this->input->post('pass2'))
        {
            array_push($error, "passwords");    
        }
        if(count($error)==0)
        {
            if($pass=="")
            {
                $update = array(
                    "email" => $email,
                    "nombre" => $name,
                    "apellido" => $last,
                    "cel" =>$cell, 
                    "tel" => $tel, 
                    "ext" => $ext, 
                    "areaTrabajo" => $area, 
                    "trabajo" => $work, 
                    "id_region" => $country
                );
            }
            else
            {
                $update = array(
                    "email" => $email,
                    "password" => $pass,
                    "nombre" => $name,
                    "apellido" => $last,
                    "cel" =>$cell, 
                    "tel" => $tel, 
                    "ext" => $ext, 
                    "areaTrabajo" => $area, 
                    "trabajo" => $work, 
                    "id_region" => $country
                );
            }
            $this->db->where("id", $_POST['id_Usuario']);
            $this->db->update("users", $update);
        }
        $this->load->view('SU/Users', ['error' => $error, 'goTo' => "registro"]);
    }

    public function convertSU()
    {
        $this->db->query("DELETE FROM mortals WHERE id_usuario = " . $_POST['id_Usuario']);
        $this->db->query("DELETE FROM informes WHERE id_usuario = " . $_POST['id_Usuario']);
        $this->db->query("DELETE FROM superusers WHERE id_usuario = " . $_POST['id_Usuario']);
        $this->db->query("INSERT INTO superusers VALUES (" . $_POST['id_Usuario']. ")");
        header("Location: /dashboard/Users");
    }

    public function convertMortal()
    {
        $this->db->query("DELETE FROM informes WHERE id_usuario = " . $_POST['id_Usuario']);
        $this->db->query("DELETE FROM superusers WHERE id_usuario = " . $_POST['id_Usuario']);
        $this->db->query("DELETE FROM mortals WHERE id_usuario = " . $_POST['id_Usuario']);
        $this->db->query("INSERT INTO mortals VALUES (" . $_POST['id_Usuario']. ")");
        header("Location: /dashboard/Users");
    }

    public function deleteAccess()
    {
        $this->db->query("DELETE FROM mortals WHERE id_usuario = " . $_POST['id_Usuario']);
        $this->db->query("DELETE FROM superusers WHERE id_usuario = " . $_POST['id_Usuario']);
        $this->db->query("DELETE FROM informes WHERE id_usuario = " . $_POST['id_Usuario']);
        $this->db->query("INSERT INTO informes VALUES (" . $_POST['id_Usuario']. ")");
        header("Location: /dashboard/Users");
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