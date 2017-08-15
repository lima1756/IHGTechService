<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AjaxRegions extends CI_Controller
{
    public function index()
    {
        if($_POST['countryId'] != "" && is_numeric($_POST['countryId']))
        {
            $regions = $this->db->query("SELECT * FROM regions WHERE country_id = " . $_POST['countryId'])->result();
            echo json_encode($regions);
        }
        else
        {
            json_encode([]);
        }
    }
}