<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AjaxTicketSU extends CI_Controller
{
    public function index()
    {
        $tickets = $this->db->query("SELECT tickets.pregunta, tickets.descripcion, ticket_sus.porcentaje, ticket_sus.prioridad,  tickets.id_mortal,
                         ticket_sus.id_ticketSU, ticket_sus.id_ticket FROM tickets INNER JOIN ticket_sus ON tickets.id_ticket = ticket_sus.id_ticket
                        WHERE ticket_sus.id_ticket =" . $_POST['ticketid']);
        $tickets = $tickets->result();
        $estados = $this->db->query("SELECT ticketsu_tiene_estado.fecha_hora, estados.estado, estados.detalles, estados.id_estado FROM estados
                                        INNER JOIN ticketsu_tiene_estado on ticketsu_tiene_estado.id_estado = estados.id_estado
                                        WHERE ticketsu_tiene_estado.id_ticketSU = ". $tickets[0]->id_ticketSU);
        $estados = $estados->result();
        $usuario = $this->db->query("SELECT users.email, users.nombre, users.apellido, users.cel, users.tel, users.ext, users.areaTrabajo, users.trabajo, users.id_region 
                                    FROM users WHERE id = " . $tickets[0]->id_mortal);
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
        $subTema = $this->db->query("SELECT id, nombre, id_tema FROM ticket_tiene_tema INNER JOIN sub_temas_ticket ON ticket_tiene_tema.idTema = id WHERE id_ticketSU = " . $tickets[0]->id_ticketSU);
        $subTema = $subTema->result();

        if(isset($subTema[0]))
        {
            $Tema = $this->db->query("SELECT id, nombre FROM temas_tickets WHERE id = " . $subTema[0]->id_tema);
            $Tema = $Tema->result();
            if(isset($Tema[0]))
            {
                $tickets[0]->subtema = $subTema[0];
                $tickets[0]->tema = $Tema[0];
            }
        }

        

        $files = $this->db->query("SELECT files.id_file, files.nombreOriginal, files.nombreAlmacenado FROM files INNER JOIN files_tickets on files.id_file = files_tickets.id_file WHERE id_ticket = " . $tickets[0]->id_ticket);
        $files = $files->result();
        if(count($files)>0)
        {
            $tickets[0]->files=$files;
        }
        $tickets[0]->user = $usuario->result()[0];
        echo json_encode($tickets[0]);
    }
}