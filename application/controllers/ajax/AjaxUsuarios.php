<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AjaxUsuarios extends CI_Controller
{
    public function index()
    {
        $usuario = $this->db->query("SELECT *, users.id AS user_id FROM users, regions, countries WHERE users.id = " . $_POST['id'] . " AND regions.id = users.id_region AND countries.id = regions.country_id")->result();
        echo json_encode($usuario[0]);
    }
}