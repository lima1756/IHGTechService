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

    public function item()
    {
        $id = $_POST['id'];
        $items = $this->db->query("SELECT * FROM inventario WHERE id_inventario = $id");
        $items = $items->result();
        $usuario = $this->db->query("SELECT id FROM users INNER JOIN usuario_tiene_inventario ON id=id_usuario INNER JOIN inventario on inventario.id_inventario = usuario_tiene_inventario.id_inventario WHERE inventario.id_inventario = " . $id);
        $usuario = $usuario->result(); 
        $out['items'] = $items[0];
        $out['users'] = $usuario;
        echo json_encode($out);
    }
}