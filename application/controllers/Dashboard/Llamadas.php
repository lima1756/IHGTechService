<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Llamadas extends CI_Controller
{
    public function index($id)
    {
        if(is_numeric($id))
        {
            $this->load->view('SU/llamadas', ['id'=>$id]);
        }
        else
        {
            header('Location: /dashboard/tickets');
        }
    }

    public function submit($id)
    {
        $insert = array(
            'id_ticket_su' => $id, 
            'detalles' => $_POST['detalles']
        );
        $this->db->insert("llamadas", $insert);
        header('Location: /dashboard/llamadas/'.$id);
    }
}