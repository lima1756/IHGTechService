<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventario extends CI_Controller
{
    public function index()
    {
        $this->load->view("SU/inventario");
    }

    public function newItem()
    {
        $insert = array(
            "marca" => $_POST['Marca'],
            "Modelo" => $_POST['Modelo'],
            "noSerie" => $_POST['serie'],
            "serviceTag" => $_POST['service'],
            "fechaCompra" => $_POST['compra'],
            "fechaInicioGarantia" => $_POST['inicio'],
            "fechaFinGarantia" => $_POST['fin'],
            "categoria" => $_POST['categoria'],
        );
        $this->db->insert('inventario', $insert);
        $id = $this->db->insert_id();
        foreach($_POST['usuarios'] as $u)
        {
            $insert2 = array(
                "id_inventario" => $id,
                "id_usuario" => $u
            );
            $this->db->insert('usuario_tiene_inventario', $insert2);
        }
        header('Location: /dashboard/inventario');
    }
}