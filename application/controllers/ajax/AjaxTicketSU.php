<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AjaxTicketSU extends CI_Controller
{
    public function index()
    {
        $tickets = $this->db->query("SELECT tickets.pregunta, tickets.descripcion, ticket_sus.porcentaje, ticket_sus.prioridad,  
                         ticket_sus.id_ticketSU, ticket_sus.id_ticket FROM tickets INNER JOIN ticket_sus ON tickets.id_ticket = ticket_sus.id_ticket
                        WHERE ticket_sus.id_ticket =" . $_POST['ticketid']);
        $tickets = $tickets->result();
        $estados = $this->db->query("SELECT ticketsu_tiene_estado.fecha_hora, estados.estado, estados.detalles, estados.id_estado FROM estados
                                        INNER JOIN ticketsu_tiene_estado on ticketsu_tiene_estado.id_estado = estados.id_estado
                                        WHERE ticketsu_tiene_estado.id_ticketSU = ". $tickets[0]->id_ticketSU);
        $estados = $estados->result();
        if(count($estados)>0)
        {
            foreach($estados as $e)
            {
                $files = $this->db->query("SELECT files.id_file, files.nombreOriginal, files.nombreAlmacenado FROM files INNER JOIN files_estados on files.id_file = files_estados.id_file WHERE id_estado = ". $e->id_estado);
                $files = $files->result();
                if(count($files)>0)
                {
                    $e->files = $files;
                }
            }
                $tickets[0]->estados = $estados;
        }
        $files = $this->db->query("SELECT files.id_file, files.nombreOriginal, files.nombreAlmacenado FROM files INNER JOIN files_tickets on files.id_file = files_tickets.id_file WHERE id_ticket = " . $tickets[0]->id_ticket);
        $files = $files->result();
        if(count($files)>0)
        {
            $tickets[0]->files=$files;
        }
        echo json_encode($tickets[0]);
    }
}