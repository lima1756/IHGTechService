<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peticiones extends CI_Controller
{
    public function index()
    {    
        $this->load->view('SU/peticiones');
    }

    public function SU($id)
    {
        $this->db->query('INSERT INTO superusers VALUES (' . $id . ')');
        header('Location: /dashboard/peticiones');
    }

    public function user($id)
    {
        $this->db->query('INSERT INTO mortals VALUES (' . $id . ')');
        header('Location: /dashboard/peticiones');
    }

    public function delete($id)
    {
        $this->db->query('INSERT INTO informes VALUES (' . $id . ')');
        header('Location: /dashboard/peticiones');
    }
}