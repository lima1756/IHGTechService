<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AjaxTickets extends CI_Controller
{
    public function index()
    {
        $query = "SELECT tickets.id_ticket, tickets.pregunta, estados.estado, tickets.fecha_hora, tickets.descripcion, users.email, concat(concat(users.nombre, ' '), users.apellido) as nombre, users.tel, users.ext, users.cel, users.areaTrabajo, users.trabajo FROM tickets
            INNER JOIN ticketsu_tiene_estado ON ticketsu_tiene_estado.id_ticketSU = tickets.id_ticket
            INNER JOIN estados ON ticketsu_tiene_estado.id_estado = estados.id_estado
            INNER JOIN users ON tickets.id_mortal = users.id
            WHERE ticketsu_tiene_estado.fecha_hora IN (SELECT max(ticketsu_tiene_estado.fecha_hora) FROM ticketsu_tiene_estado GROUP BY ticketsu_tiene_estado.id_ticketSU)";
        
        $usuario = $_POST['usuario'];
        $tema = $_POST['tema'];
        $subTema = $_POST['subTema'];
        if($usuario!="all")
            $query = $query . " AND users.id = $usuario";
        if($_POST['estado']=="all" && $_POST['usuario']=="all" && $_POST['tema']=="all" && $_POST['subTema']=="all" && $_POST["end"] =="" && $_POST["start"] =="")
        {
            $questions = $this->db->query("SELECT tickets.id_ticket, tickets.pregunta, estados.estado, tickets.fecha_hora, tickets.descripcion, users.email, concat(concat(users.nombre, ' '), users.apellido) as nombre, users.tel, users.ext, users.cel, users.areaTrabajo, users.trabajo FROM tickets
            INNER JOIN ticketsu_tiene_estado ON ticketsu_tiene_estado.id_ticketSU = tickets.id_ticket
            INNER JOIN estados ON ticketsu_tiene_estado.id_estado = estados.id_estado
            INNER JOIN users ON tickets.id_mortal = users.id
            WHERE ticketsu_tiene_estado.fecha_hora IN (SELECT max(ticketsu_tiene_estado.fecha_hora) FROM ticketsu_tiene_estado GROUP BY ticketsu_tiene_estado.id_ticketSU)
            ")->result();
        }
        elseif(($_POST['estado']=="alta"  || $_POST['estado'] == "media" || $_POST['estado'] == "baja") && $_POST['usuario']=="all" && $_POST['tema']=="all" && $_POST['subTema']=="all" && $_POST["end"] =="" && $_POST["start"] =="")
        {
            $pendientes = $this->db->query("SELECT TIME_TO_SEC(TIMEDIFF(NOW(), tickets.fecha_hora)) as secs, tickets.id_ticket, tickets.pregunta, tickets.descripcion, estados.estado, tickets.fecha_hora, users.email, users.nombre, users.apellido, users.tel, users.ext, users.cel, users.areaTrabajo, users.trabajo, tickets.prioridad FROM tickets
                                            INNER JOIN ticketsu_tiene_estado ON ticketsu_tiene_estado.id_ticketSU = tickets.id_ticket
                                            INNER JOIN estados ON ticketsu_tiene_estado.id_estado = estados.id_estado
                                            INNER JOIN users ON tickets.id_mortal = users.id
                                            WHERE ticketsu_tiene_estado.fecha_hora IN (SELECT max(ticketsu_tiene_estado.fecha_hora) FROM ticketsu_tiene_estado GROUP BY ticketsu_tiene_estado.id_ticketSU)
                                            ");
            
            $pendientes = $pendientes->result();
            $atrasados = array();
            foreach($pendientes as $pendiente){
                if($pendiente->estado!='Diferido' && $pendiente->estado!='Completado' && $pendiente->estado!='Sin Resolver'){
                    if(($pendiente->prioridad=="alto" || $pendiente->prioridad==null) && $_POST['estado']=="alta" && $pendiente->secs > 86400){
                        array_push($atrasados, $pendiente);
                    }
                    elseif($pendiente->prioridad=="medio" && $pendiente->secs > 172800 && $_POST['estado']=="media"){
                        array_push($atrasados, $pendiente);
                    }
                    elseif($pendiente->prioridad=="bajo" && $_POST['estado']=="baja" && $pendiente->secs > 259200){
                        array_push($atrasados, $pendiente);
                    }
                }
            }
            $questions = $atrasados;
        }
        elseif(($_POST['estado']=="Sin resolver" || $_POST['estado']=="nuevo" || $_POST['estado']=="diferido" || $_POST['estado']=="espera" || $_POST['estado']=="completado")
             && $_POST['usuario']=="all" && $_POST['tema']=="all" && $_POST['subTema']=="all" && $_POST["end"] =="" && $_POST["start"] =="")
        {
            $questions = $this->db->query("SELECT tickets.id_ticket, tickets.pregunta, estados.estado, tickets.descripcion, tickets.fecha_hora, users.email, users.nombre, users.apellido, users.tel, users.ext, users.cel, users.areaTrabajo, users.trabajo FROM tickets
                                    INNER JOIN ticketsu_tiene_estado ON ticketsu_tiene_estado.id_ticketSU = tickets.id_ticket
                                    INNER JOIN estados ON ticketsu_tiene_estado.id_estado = estados.id_estado
                                    INNER JOIN users ON tickets.id_mortal = users.id
                                    WHERE ticketsu_tiene_estado.fecha_hora IN (SELECT max(ticketsu_tiene_estado.fecha_hora) FROM ticketsu_tiene_estado GROUP BY ticketsu_tiene_estado.id_ticketSU)
                                    AND estados.estado = '" . $_POST['estado'] . "'
                                    ")->result();
        }
        echo json_encode($questions, JSON_OBJECT_AS_ARRAY);
    }



}


?>


<?php 
/* =========================================================
?>
<?php foreach ($questions as $key => $q): ?>
<?php if($key==0): ?>
    if (this.value == <?php echo $q->id_ticket; ?>) {
        id=$('input:radio[name=ticket]:checked').val();
    }
<?php else: ?>
    else if (this.value == <?php echo $q->id_ticket; ?>) {
        id=$('input:radio[name=ticket]:checked').val();
    }
<?php endif; ?>
<?php endforeach; ?>

<?php 
// ============================================================*/
?>