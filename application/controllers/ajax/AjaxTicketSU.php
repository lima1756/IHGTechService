<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AjaxTicketSU extends CI_Controller
{
    public function index()
    {
        $tickets = $this->db->query("SELECT tickets.pregunta, tickets.descripcion, ticket_sus.porcentaje, ticket_sus.prioridad,  
                         ticket_sus.id_ticketSU FROM tickets INNER JOIN ticket_sus ON tickets.id_ticket = ticket_sus.id_ticket
                        WHERE ticket_sus.id_ticket =" . $_POST['ticketid']);
        $tickets = $tickets->result();
        $estados = $this->db->query("SELECT ticketsu_tiene_estado.fecha_hora, estados.estado, estados.detalles FROM estados
                                        INNER JOIN ticketsu_tiene_estado on ticketsu_tiene_estado.id_estado = estados.id_estado
                                        WHERE ticketsu_tiene_estado.id_ticketSU = ". $tickets[0]->id_ticketSU);
        if(count($estados->result())>0)
        {
                $tickets[0]->estados = $estados->result();
        }
        echo json_encode($tickets[0]);
    }
}