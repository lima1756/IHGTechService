<?php
if($state == "all"){
    $questions = $this->db->query("SELECT tickets.id_ticket, tickets.pregunta, estados.estado, tickets.fecha_hora, tickets.descripcion, users.email, users.nombre, users.apellido, users.tel, users.ext, users.cel, users.areaTrabajo, users.trabajo FROM tickets
                                    INNER JOIN ticketsu_tiene_estado ON ticketsu_tiene_estado.id_ticketSU = tickets.id_ticket
                                    INNER JOIN estados ON ticketsu_tiene_estado.id_estado = estados.id_estado
                                    INNER JOIN users ON tickets.id_mortal = users.id
                                    WHERE ticketsu_tiene_estado.fecha_hora IN (SELECT max(ticketsu_tiene_estado.fecha_hora) FROM ticketsu_tiene_estado GROUP BY ticketsu_tiene_estado.id_ticketSU)
                                    ");
    
    $questions=$questions->result();
}
elseif($state == "alto" || $state == "medio" || $state == "bajo"){
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
            if($pendiente->prioridad=="alto" || $pendiente->prioridad==null){
                if($pendiente->secs > 86400){
                    if($state=="alto"){
                        array_push($atrasados, $pendiente);
                    }
                }
            }
            elseif($pendiente->prioridad=="medio"){
                if($pendiente->secs > 172800){
                    if($state=="medio"){
                        array_push($atrasados, $pendiente);
                    }
                }
            }
            elseif($pendiente->prioridad=="bajo"){
                if($pendiente->secs > 259200){
                    if($state=="bajo"){
                        array_push($atrasados, $pendiente);
                    }
                }
            }
        }
    }
    $questions = $atrasados;
}
elseif($state == "Sin_resolver"){
    
    $state = "Sin resolver";
    $questions = $this->db->query("SELECT tickets.id_ticket, tickets.pregunta, estados.estado, tickets.descripcion, tickets.fecha_hora, users.email, users.nombre, users.apellido, users.tel, users.ext, users.cel, users.areaTrabajo, users.trabajo FROM tickets
                                    INNER JOIN ticketsu_tiene_estado ON ticketsu_tiene_estado.id_ticketSU = tickets.id_ticket
                                    INNER JOIN estados ON ticketsu_tiene_estado.id_estado = estados.id_estado
                                    INNER JOIN users ON tickets.id_mortal = users.id
                                    WHERE ticketsu_tiene_estado.fecha_hora IN (SELECT max(ticketsu_tiene_estado.fecha_hora) FROM ticketsu_tiene_estado GROUP BY ticketsu_tiene_estado.id_ticketSU)
                                    AND estados.estado = '" . $state . "'
                                    ");
    
    $questions = $questions->result();
}
elseif($state == "Nuevo"){
    $questions = $this->db->query("SELECT tickets.id_ticket, tickets.pregunta, estados.estado, tickets.descripcion, tickets.fecha_hora, users.email, users.nombre, users.apellido, users.tel, users.ext, users.cel, users.areaTrabajo, users.trabajo FROM tickets
                                    INNER JOIN ticketsu_tiene_estado ON ticketsu_tiene_estado.id_ticketSU = tickets.id_ticket
                                    INNER JOIN estados ON ticketsu_tiene_estado.id_estado = estados.id_estado
                                    INNER JOIN users ON tickets.id_mortal = users.id
                                    WHERE ticketsu_tiene_estado.fecha_hora IN (SELECT max(ticketsu_tiene_estado.fecha_hora) FROM ticketsu_tiene_estado GROUP BY ticketsu_tiene_estado.id_ticketSU)
                                    AND estados.estado = '" . $state . "'
                                    ");
    $questions = $questions->result();
}
elseif($state == "Diferido"){
    $questions = $this->db->query("SELECT tickets.id_ticket, tickets.pregunta, estados.estado, tickets.descripcion, tickets.fecha_hora, users.email, users.nombre, users.apellido, users.tel, users.ext, users.cel, users.areaTrabajo, users.trabajo FROM tickets
                                    INNER JOIN ticketsu_tiene_estado ON ticketsu_tiene_estado.id_ticketSU = tickets.id_ticket
                                    INNER JOIN estados ON ticketsu_tiene_estado.id_estado = estados.id_estado
                                    INNER JOIN users ON tickets.id_mortal = users.id
                                    WHERE ticketsu_tiene_estado.fecha_hora IN (SELECT max(ticketsu_tiene_estado.fecha_hora) FROM ticketsu_tiene_estado GROUP BY ticketsu_tiene_estado.id_ticketSU)
                                    AND estados.estado = '" . $state . "'
                                    ");
    $questions = $questions->result();
}
elseif($state == "Espera"){
    $questions = $this->db->query("SELECT tickets.id_ticket, tickets.pregunta, estados.estado, tickets.descripcion, tickets.fecha_hora, users.email, users.nombre, users.apellido, users.tel, users.ext, users.cel, users.areaTrabajo, users.trabajo FROM tickets
                                    INNER JOIN ticketsu_tiene_estado ON ticketsu_tiene_estado.id_ticketSU = tickets.id_ticket
                                    INNER JOIN estados ON ticketsu_tiene_estado.id_estado = estados.id_estado
                                    INNER JOIN users ON tickets.id_mortal = users.id
                                    WHERE ticketsu_tiene_estado.fecha_hora IN (SELECT max(ticketsu_tiene_estado.fecha_hora) FROM ticketsu_tiene_estado GROUP BY ticketsu_tiene_estado.id_ticketSU)
                                    AND estados.estado = '" . $state . "'
                                    ");
    $questions = $questions->result();
}
elseif($state == "Completado"){
    $questions = $this->db->query("SELECT tickets.id_ticket, tickets.pregunta, estados.estado, tickets.descripcion, tickets.fecha_hora, users.email, users.nombre, users.apellido, users.tel, users.ext, users.cel, users.areaTrabajo, users.trabajo FROM tickets
                                    INNER JOIN ticketsu_tiene_estado ON ticketsu_tiene_estado.id_ticketSU = tickets.id_ticket
                                    INNER JOIN estados ON ticketsu_tiene_estado.id_estado = estados.id_estado
                                    INNER JOIN users ON tickets.id_mortal = users.id
                                    WHERE ticketsu_tiene_estado.fecha_hora IN (SELECT max(ticketsu_tiene_estado.fecha_hora) FROM ticketsu_tiene_estado GROUP BY ticketsu_tiene_estado.id_ticketSU)
                                    AND estados.estado = '" . $state . "'
                                    ");
    $questions = $questions->result();
}
elseif(is_numeric($state))
{
    echo("<script>
            window.onload = function() {
                $('#radio".$state."').prop(\"checked\", true);
                $.ajaxSetup({
                    headers: {
                        }
                    })
                $.post(\"/ajax/ajaxticketsu\", {
                    'ticketid': ".$state."
                },
                function(data, status){
                    var json = JSON.parse(data);
                    var message = json.descripcion.replace(/\\n/g, \"<br />\");
                    $('#pregunta-container').show();
                    $('html, body').animate({
                        scrollTop: $(\"#pregunta-container\").offset().top
                    }, 1000);
                    $('#pregunta').html(json.pregunta);
                    $('#descripcion').html(message);
                    $('#estado_actual').val(json.estado);
                    $('#detalles').val(json.detalles);
                    $('#porcentaje').val(json.porcentaje);
                    $('#prioridad').val(json.prioridad);
                    $('#ticket_su').val(json.id_ticket);
                    $('#state').val(json.id_estado);
                    $('#foro').attr(\"href\", \"/dashboard/foro/tema/\"+json.id_ticket)
                    $('#llamadas').attr(\"href\", \"/dashboard/llamadas/\"+json.id_ticket)
                    if(typeof json.user !== \"undefined\")
                    {
                        document.getElementById(\"mortalUser\").innerHTML = \"<div style='padding-left:2em;'><p><b>Nombre: </b>\" + json.user.nombre + \" \" + json.user.apellido + \"</p>\" + \"<p><b>Correo:</b>\" + json.user.email + \"</p>\" + \"<p><b>Telefono: </b>\" + json.user.tel + \"</p>\" + \"<p><b>Extensión:</b>\" + json.user.ext + \"</p>\" + \"<p><b>Celular:</b>\" + json.user.cel + \"</p>\"  + \"<p><b>Area de trabajo:</b>\" + json.user.areaTrabajo + \"</p>\"  + \"<p><b>Trabajo:</b>\" + json.user.trabajo + \"</p></div>\";
                        correo = json.user.email;
                    }
                    if (typeof json.estados !== 'undefined')
                    {
                        var estados = document.getElementById(\"estadosAnteriores\");
                        
                        estados.innerHTML = \"<h4>Estados anteriores: </h4>\";
                        $.each(json.estados, function(i, item){
                            var d = new Date(json.estados[i].fecha_hora);
                            $('#estado_actual').val(json.estados[i].estado);
                            estados.innerHTML = estados.innerHTML + \"<label>\" + json.estados[i].estado + \" - \" + d.getDate() + \"/\" + (d.getMonth() + 1) + \"/\" + d.getFullYear() + \" \" + (d.getHours()+1) + \":\" + (d.getMinutes()+1) + \":\" + (d.getSeconds()+1) + \"</label><br><div>\" + (json.estados[i].detalles != null ? json.estados[i].detalles : \"\") + \"</div><hrstyle ='background-color:orange;border:none;'>\";
                            if (typeof json.estados[i].files !== 'undefined')
                            {
                                estados.innerHTML = estados.innerHTML +\"<p><b>Adjuntos: </b></p><ul>\";
                                $.each(json.estados[i].files, function(k, item){
                                    estados.innerHTML = estados.innerHTML + \"<pre><li><a href='/fileUploads/estados/\"+ json.estados[i].files[k].nombreAlmacenado +\"'>\"+ json.estados[i].files[k].nombreOriginal+ \"</a></li></pre>\";
                                });
                                estados.innerHTML = estados.innerHTML +\"</ul>\";
                            }
                            estados.innerHTML = estados.innerHTML + \"<hr style='border-top:1px solid #171717; margin-top:0px;'>\"                            
                        });
                    }
                    if(typeof json.files !== \"undefined\")
                    {
                        var adjuntosDesc = document.getElementById(\"adjuntosDesc\");
                        adjuntosDesc.innerHTML = \"<p><b>Archivos adjuntos: </b></p>\"
                        $.each(json.files, function(i, item){
                            adjuntosDesc.innerHTML = adjuntosDesc.innerHTML + \"<pre><li><a href='/fileUploads/tickets/\"+ json.files[i].nombreAlmacenado + \"'>\"+ json.files[i].nombreOriginal+ \"</a></li></pre>\";
                        });
                    }
                    else
                    {
                        var adjuntosDesc = document.getElementById(\"adjuntosDesc\");
                        adjuntosDesc.innerHTML = \"\"
                    }
                    if(typeof json.subtema !== \"undefined\")
                    {
                        $(\"#TemaTicket\").val(json.tema.id).change();
                        $(\"#SubTema\").val(json.subtema.id);
                    }
                });
            }

    
        </script>");
        $state = "all";
    $questions = $this->db->query("SELECT tickets.id_ticket, tickets.pregunta, estados.estado, tickets.descripcion, tickets.fecha_hora, users.email, users.nombre, users.apellido, users.tel, users.ext, users.cel, users.areaTrabajo, users.trabajo FROM tickets
                                    INNER JOIN ticketsu_tiene_estado ON ticketsu_tiene_estado.id_ticketSU = tickets.id_ticket
                                    INNER JOIN estados ON ticketsu_tiene_estado.id_estado = estados.id_estado
                                    INNER JOIN users ON tickets.id_mortal = users.id
                                    WHERE ticketsu_tiene_estado.fecha_hora IN (SELECT max(ticketsu_tiene_estado.fecha_hora) FROM ticketsu_tiene_estado GROUP BY ticketsu_tiene_estado.id_ticketSU)
                                    ");
    
    $questions=$questions->result();
}
elseif(isset($id))
{
    $state = "user";
    $questions = $this->db->query("SELECT tickets.id_ticket, tickets.pregunta, estados.estado, tickets.descripcion, tickets.fecha_hora, users.email, users.nombre, users.apellido, users.tel, users.ext, users.cel, users.areaTrabajo, users.trabajo FROM tickets
                                    INNER JOIN ticketsu_tiene_estado ON ticketsu_tiene_estado.id_ticketSU = tickets.id_ticket
                                    INNER JOIN estados ON ticketsu_tiene_estado.id_estado = estados.id_estado
                                    INNER JOIN users ON tickets.id_mortal = users.id
                                    WHERE ticketsu_tiene_estado.fecha_hora IN (SELECT max(ticketsu_tiene_estado.fecha_hora) FROM ticketsu_tiene_estado GROUP BY ticketsu_tiene_estado.id_ticketSU)
                                    AND tickets.id_mortal = $id");
    
    $questions=$questions->result();
}
else{
    
    $state = "all";
    $questions = $this->db->query("SELECT tickets.id_ticket, tickets.pregunta, estados.estado, tickets.descripcion, tickets.fecha_hora, users.email, users.nombre, users.apellido, users.tel, users.ext, users.cel, users.areaTrabajo, users.trabajo FROM tickets
                                    INNER JOIN ticketsu_tiene_estado ON ticketsu_tiene_estado.id_ticketSU = tickets.id_ticket
                                    INNER JOIN estados ON ticketsu_tiene_estado.id_estado = estados.id_estado
                                    INNER JOIN users ON tickets.id_mortal = users.id
                                    WHERE ticketsu_tiene_estado.fecha_hora IN (SELECT max(ticketsu_tiene_estado.fecha_hora) FROM ticketsu_tiene_estado GROUP BY ticketsu_tiene_estado.id_ticketSU)
                                    ");
    $questions=$questions->result();
}
