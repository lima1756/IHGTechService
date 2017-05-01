<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AjaxInventario extends CI_Controller
{
    public function marcas()
    {
        $datos = $this->db->query("SELECT Marca FROM inventario WHERE inventario.categoria = '".$_POST['categoria']."' GROUP BY Marca");
        $datos = $datos->result();
        echo json_encode($datos);
    }
    public function modelos()
    {
        $datos = $this->db->query("SELECT Modelo FROM inventario WHERE inventario.Marca = '".$_POST['marca']."' GROUP BY Modelo");
        $datos = $datos->result();
        echo json_encode($datos);
    }
}