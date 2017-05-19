<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AjaxUsuarios extends CI_Controller
{
    public function index()
    {
        $usuario = $this->db->query("SELECT * FROM users WHERE id = " . $_POST['id'])->result();
        echo json_encode($usuario[0]);
    }
}