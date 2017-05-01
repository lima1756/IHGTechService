<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AjaxTemas extends CI_Controller
{
    public function index()
    {
        if($_POST['id'] != "" && is_numeric($_POST['id']))
        {
            $temas= $this->db->query("SELECT * FROM sub_temas_ticket WHERE id_tema = " . $_POST['id']);
            $temas=$temas->result();
            echo json_encode($temas);
        }
        else
        {
            json_encode([]);
        }
    }
}