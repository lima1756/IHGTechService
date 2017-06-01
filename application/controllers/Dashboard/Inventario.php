<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventario extends CI_Controller
{
    public function index($tipo="")
    {
        if($this->logdata->getType() == "SU")
        {
            $this->load->view("SU/inventario", ["tipo" => $tipo]);
        }
        else
        {
            header("Location: /");
        }
    }

    public function user($id)
    {
        if($this->logdata->getType() == "SU")
        {
            $this->load->view("SU/inventario", ["tipo" => "", "id" => $id]);
        }
        else
        {
            header("Location: /");
        }
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

    public function alterItem(){
        $update = array(
            "marca" => $_POST['Marca'],
            "Modelo" => $_POST['Modelo'],
            "noSerie" => $_POST['serie'],
            "serviceTag" => $_POST['service'],
            "fechaCompra" => $_POST['compra'],
            "fechaInicioGarantia" => $_POST['inicio'],
            "fechaFinGarantia" => $_POST['fin'],
            "categoria" => $_POST['categoria'],
        );
        $this->db->where('id_inventario', $_POST['id_inventario']);  
        $this->db->update('inventario', $update);  
        
        $id = $_POST['id_inventario'];
        $this->db->where('id_inventario', $id);  
        $this->db->delete('usuario_tiene_inventario');

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

    public function deleteItem(){
        $this->db->where('id_inventario', $_POST['id_inventario']);  
        $this->db->delete('inventario');  
        
        $id = $_POST['id_inventario'];
        $this->db->where('id_inventario', $id);  
        $this->db->delete('usuario_tiene_inventario');
        header('Location: /dashboard/inventario');
    }
}