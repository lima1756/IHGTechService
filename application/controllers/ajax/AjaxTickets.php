<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AjaxTickets extends CI_Controller
{
    public function index($print = true)
    {
        // Basic query, yes, basic ;-;
        $query = "SELECT TIME_TO_SEC(TIMEDIFF(NOW(), tickets.fecha_hora)) as secs, tickets.id_ticket, tickets.pregunta, estados.estado, tickets.fecha_hora, tickets.descripcion, users.email, concat(concat(users.nombre, ' '), users.apellido) as nombre, users.tel, users.ext, users.cel, users.areaTrabajo, users.trabajo, tickets.prioridad FROM tickets
            INNER JOIN ticketsu_tiene_estado ON ticketsu_tiene_estado.id_ticketSU = tickets.id_ticket
            INNER JOIN estados ON ticketsu_tiene_estado.id_estado = estados.id_estado
            INNER JOIN users ON tickets.id_mortal = users.id
            INNER JOIN ticket_tiene_tema ON tickets.id_ticket = ticket_tiene_tema.id_ticketSU
            INNER JOIN sub_temas_ticket ON ticket_tiene_tema.idTema = sub_temas_ticket.id
            INNER JOIN temas_tickets ON temas_tickets.id = sub_temas_ticket.id_tema
            WHERE ticketsu_tiene_estado.fecha_hora IN (SELECT max(ticketsu_tiene_estado.fecha_hora) FROM ticketsu_tiene_estado GROUP BY ticketsu_tiene_estado.id_ticketSU)";

        //Saving POST in local variables
        $estado = $_POST['estado'];
        $usuario = $_POST['usuario'];
        $tema = $_POST['tema'];
        $subTema = $_POST['subTema'];
        $start = $_POST['start'];
        $end = $_POST['end'];

        //Complementing the query depending the filter input data
        if($usuario!="all")
            $query = $query . " AND users.id = $usuario";
        if($tema != "all")
            $query = $query . " AND temas_tickets.id = $tema";
        if($subTema != "all")
            $query = $query . " AND sub_temas_ticket.id = $subTema";
        if($start != "")
            $query = $query . " AND tickets.fecha_hora >= '$start'";
        if($end != "")
            $query = $query . " AND tickets.fecha_hora <= '$end'";
        if(($estado=="Sin resolver" || $estado=="nuevo" || $estado=="diferido" || $estado=="espera" || $estado=="completado")
            && $_POST['usuario']=="all" && $_POST['tema']=="all" && $_POST['subTema']=="all" && $_POST["end"] =="" && $_POST["start"] =="")
        {
            $query = $query . "AND estados.estado = '$estado'";
        }

        // Run query
        $questions = $this->db->query($query)->result();

        // Filter $quesstions if $estado input is 'alta', 'media' or 'baja'
        if(($estado=="alta"  || $estado == "media" || $estado == "baja"))
        {
            $atrasados = array();
            foreach($questions as $pendiente){
                if($pendiente->estado!='Diferido' && $pendiente->estado!='Completado' && $pendiente->estado!='Sin Resolver'){
                    if(($pendiente->prioridad=="alto" || $pendiente->prioridad==null) && $estado=="alta" && $pendiente->secs > 86400){
                        array_push($atrasados, $pendiente);
                    }
                    elseif($pendiente->prioridad=="medio" && $pendiente->secs > 172800 && $estado=="media"){
                        array_push($atrasados, $pendiente);
                    }
                    elseif($pendiente->prioridad=="bajo" && $estado=="baja" && $pendiente->secs > 259200){
                        array_push($atrasados, $pendiente);
                    }
                }
            }
            $questions = $atrasados;
        }
        if($print)
            echo json_encode($questions, JSON_OBJECT_AS_ARRAY);
        else
            return $questions;
    }

    public function excel()
    {
        $data = $this->index(false);
        echo "ID,Fecha y hora,Estado,Pregunta,Nombre,e-mail,Telefono,Extension,Celular,Area de Trabajo,Trabajo\n";
        foreach($data as $d)
        {
            echo $d->id_ticket . ",\"" . $d->fecha_hora . "\",\"" . $d->estado . "\",\"" . $d->pregunta . "\",\"" . $d->nombre . "\",\"" . $d->email . "\",=\"" . $d->tel . "\",=\"" . $d->ext . "\",=\"" . $d->cel . "\",\"" . $d->areaTrabajo . "\",\"" . $d->trabajo . "\"\n";
        }
    }


}

