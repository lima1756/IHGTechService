<?php
    $usuarios = $this->db->query("SELECT * FROM (
                                    SELECT supers.* FROM (
                                        SELECT users.* FROM `users` 
                                        LEFT JOIN superusers 
                                        ON id = superusers.id_usuario 
                                        WHERE superusers.id_usuario IS NULL
                                    ) AS supers LEFT JOIN mortals
                                    ON supers.id = mortals.id_usuario 
                                    WHERE mortals.id_usuario IS NULL
                                ) AS usuarioComun LEFT JOIN informes ON usuarioComun.id = informes.id_usuario
                                WHERE informes.id_usuario IS NULL");
    $countP = 0;

    
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Dashboard</title>
        
        <link rel="stylesheet" type="text/css" href="/css/dashboard/bootstrap.css")/>
        <link rel="stylesheet" type="text/css" href="/css/dashboard/font-awesome.min.css")/>
        <link rel="stylesheet" type="text/css" href="/css/dashboard/metisMenu.min.css")/>
        <link rel="stylesheet" type="text/css" href="/css/dashboard/sb-admin-2.css")/>
        <style>
            label input[type="radio"] ~ i.fa.fa-circle-o{
                color: #c8c8c8;    display: inline;
            }
            label input[type="radio"] ~ i.fa.fa-dot-circle-o{
                display: none;
            }
            label input[type="radio"]:checked ~ i.fa.fa-circle-o{
                display: none;
            }
            label input[type="radio"]:checked ~ i.fa.fa-dot-circle-o{
                color: #7AA3CC;    display: inline;
            }
            label:hover input[type="radio"] ~ i.fa {
            color: #7AA3CC;
            }
            .inputfile + label {
                font-size: 1.25em;
                font-weight: 700;
                color: white;
                background-color: black;
                display: inline-block;
            }

            .inputfile:focus + label,
            .inputfile + label:hover {
                background-color: red;
            }
        </style>

        <?php
            if($state == "all"){
                $questions = $this->db->query("SELECT ticket_sus.id_ticket, tickets.pregunta, estados.estado, tickets.fecha_hora FROM ticket_sus INNER JOIN tickets ON ticket_sus.id_ticket = tickets.id_ticket
                                                INNER JOIN ticketsu_tiene_estado ON ticketsu_tiene_estado.id_ticketSU = ticket_sus.id_ticketSU
                                                INNER JOIN estados ON ticketsu_tiene_estado.id_estado = estados.id_estado
                                                WHERE ticketsu_tiene_estado.fecha_hora IN (SELECT max(ticketsu_tiene_estado.fecha_hora) FROM ticketsu_tiene_estado GROUP BY ticketsu_tiene_estado.id_ticketSU)
                                                AND ticket_sus.id_SU = ". $this->logdata->getData("id"));
                
                $questions=$questions->result();
            }
            elseif($state == "alto" || $state == "medio" || $state == "bajo"){
                $pendientes = $this->db->query("SELECT TIME_TO_SEC(TIMEDIFF(NOW(), ticket_sus.fecha_hora)) as secs, ticket_sus.id_ticket, ticket_sus.prioridad, tickets.pregunta, estados.estado, tickets.fecha_hora FROM ticket_sus
                                                INNER JOIN tickets ON ticket_sus.id_ticket = tickets.id_ticket
                                                INNER JOIN ticketsu_tiene_estado ON ticketsu_tiene_estado.id_ticketSU = ticket_sus.id_ticketSU
                                                INNER JOIN estados ON ticketsu_tiene_estado.id_estado = estados.id_estado
                                                WHERE ticketsu_tiene_estado.fecha_hora IN (SELECT max(ticketsu_tiene_estado.fecha_hora) FROM ticketsu_tiene_estado GROUP BY ticketsu_tiene_estado.id_ticketSU)
                                                AND ticket_sus.id_SU = ". $this->logdata->getData("id"));
                
                $pendientes = $pendientes->result();
                $atrasados = array();
                foreach($pendientes as $pendiente){
                    if($pendiente->estado!='Diferido' && $pendiente->estado!='Completado' && $pendiente->estado!='Sin Resolver'){
                        if($pendiente->prioridad=="alto"){
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
                $questions = $this->db->query("SELECT ticket_sus.id_ticket, tickets.pregunta, estados.estado, tickets.fecha_hora FROM ticket_sus
                                                INNER JOIN tickets ON ticket_sus.id_ticket = tickets.id_ticket
                                                INNER JOIN ticketsu_tiene_estado ON ticketsu_tiene_estado.id_ticketSU = ticket_sus.id_ticketSU
                                                INNER JOIN estados ON ticketsu_tiene_estado.id_estado = estados.id_estado
                                                WHERE ticketsu_tiene_estado.fecha_hora IN (SELECT max(ticketsu_tiene_estado.fecha_hora) FROM ticketsu_tiene_estado GROUP BY ticketsu_tiene_estado.id_ticketSU)
                                                AND estados.estado = '" . $state . "'
                                                AND ticket_sus.id_SU = ". $this->logdata->getData("id"));
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
                                $('#pregunta').html(json.pregunta);
                                $('#descripcion').html(message);
                                $('#estado_actual').val(json.estado);
                                $('#detalles').val(json.detalles);
                                $('#porcentaje').val(json.porcentaje);
                                $('#prioridad').val(json.prioridad);
                                $('#ticket_su').val(json.id_ticketSU);
                                $('#state').val(json.id_estado);
                                $('#foro').attr(\"href\", \"/dashboard/foro/\"+json.id_ticketSU)
                                $('#llamadas').attr(\"href\", \"/dashboard/llamadas/\"+json.id_ticketSU)
                            });
                        }

                
                    </script>");
                    $state = "all";
                $questions = $this->db->query("SELECT ticket_sus.id_ticket, tickets.pregunta, estados.estado, tickets.fecha_hora FROM ticket_sus INNER JOIN tickets ON ticket_sus.id_ticket = tickets.id_ticket
                                                INNER JOIN ticketsu_tiene_estado ON ticketsu_tiene_estado.id_ticketSU = ticket_sus.id_ticketSU
                                                INNER JOIN estados ON ticketsu_tiene_estado.id_estado = estados.id_estado
                                                WHERE ticketsu_tiene_estado.fecha_hora IN (SELECT max(ticketsu_tiene_estado.fecha_hora) FROM ticketsu_tiene_estado GROUP BY ticketsu_tiene_estado.id_ticketSU)
                                                AND ticket_sus.id_SU = ". $this->logdata->getData("id"));
                
                $questions=$questions->result();
            }
            else{
                $state = "all";
                $questions = $this->db->query("SELECT ticket_sus.id_ticket, tickets.pregunta, estados.estado, tickets.fecha_hora FROM ticket_sus INNER JOIN tickets ON ticket_sus.id_ticket = tickets.id_ticket
                                                INNER JOIN ticketsu_tiene_estado ON ticketsu_tiene_estado.id_ticketSU = ticket_sus.id_ticketSU
                                                INNER JOIN estados ON ticketsu_tiene_estado.id_estado = estados.id_estado
                                                WHERE ticketsu_tiene_estado.fecha_hora IN (SELECT max(ticketsu_tiene_estado.fecha_hora) FROM ticketsu_tiene_estado GROUP BY ticketsu_tiene_estado.id_ticketSU)
                                                AND ticket_sus.id_SU = ". $this->logdata->getData("id"));
                
                $questions=$questions->result();
            }

        ?>
        <script src="/js/dashboard/jquery.min.js"></script>
        <script src="/js/dashboard/bootstrap.min.js"></script>
        <script src="/js/dashboard/metisMenu.min.js"></script>
        <script src="/js/dashboard/raphael.min.js"></script>
        <script src="/js/dashboard/morris.min.js"></script>
        <script src="/js/dashboard/sb-admin-2.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.bundle.min.js"></script>
        <!-- include summernote css/js-->
        <link href="/dist/summernote.css" rel="stylesheet">
        <script src="/dist/summernote.js"></script>

        <!-- include summernote-es-ES -->
        <script src="/dist/lang/summernote-es-ES.js"></script>

        <!-- include dataTables -->
        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.13/css/jquery.dataTables.css">
        <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.13/js/jquery.dataTables.js"></script>

    </head>
    <body style="">
        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand noSpace" href="/dashboard"><span style="color: #D71820">I</span><span style="color: #E05F25">H</span><span style="color: #DC771B">G</span></p></a>
                </div>
                <!-- /.navbar-header -->

                <ul class="nav navbar-top-links navbar-right">
                    

                    <!-- /.dropdown -->
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="/logOut"><i class="fa fa-sign-out fa-fw"></i> Cerrar sesión</a>
                            </li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    <!-- /.dropdown -->
                </ul>
                <!-- /.navbar-top-links -->

                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            <li class="divider"></li>
                            <li>
                                <a href="/dashboard"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                            </li>
                            <li>
                                <?php if($countP>0): ?>
                                <a href="/dashboard/peticiones" class="alert alert-danger"><i class="fa fa-user fa-fw"></i> Peticiones
                                <span class="pull-right ">
                                <?php echo $countP; ?>
                                </span>
                                </a>
                                <?php else: ?>
                                <a href="/dashboard/peticiones"><i class="fa fa-user fa-fw"></i> Peticiones
                                </a>
                                <?php endif; ?>
                            </li>
                            <li>
                                <a href="/dashboard/foro"><i class="fa fa-book"></i> Foro</a>
                            </li>
                            <li>
                                <a href="/dashboard/knowledge"><i class="fa fa-question"></i> Knowledge</a>
                            </li>
                            <li>
                                <a href="/dashboard/tickets/all"><i class="fa fa-file-text"></i> Tickets</a> 
                            </li>
                        </ul>
                    </div>
                    <!-- /.sidebar-collapse -->
                </div>
                <!-- /.navbar-static-side -->
            </nav>
        </div>
    
<!--TODO-->
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <?php if($state=="all"): ?>
                
                <h1 class="page-header">Todos los Tickets</h1>
            <?php elseif($state=="alto"): ?>
                <h1 class="page-header">Tickets atrasados alta prioridad</h1>
            <?php elseif($state=="medio"): ?>
                <h1 class="page-header">Tickets atrasados media prioridad</h1>
            <?php elseif($state=="bajo"): ?>
                <h1 class="page-header">Tickets atrasados baja prioridad</h1>
            <?php else: ?>
                <h1 class="page-header">Tickets en <?php echo $state; ?></h1>
            <?php endif; ?>
        </div>
        <!-- /.col-lg-12 -->
    </div>
        <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
           <table id="tickets" class="display cell-border stripe">
                <thead>
                    <tr>
                        <th>Seleccionar</th>
                        <th>Fecha-hora</th>
                        <th>Estado</th>
                        <th>Pregunta</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($questions as $q): ?>
                    <tr>
                    <td><label class="btn active">
                        <input type="radio" name="ticket" value="<?php echo $q->id_ticket; ?>" id="<?php echo "radio" . $q->id_ticket; ?>" style='display:none;' hidden/><i class="fa fa-circle-o fa-2x"></i><i class="fa fa-dot-circle-o fa-2x"></i>
                    </label></td>
                    <td><?php echo $q->fecha_hora ; ?></td>
                    <td><?php echo $q->estado ; ?></td>
                    <td><?php echo $q->pregunta ; ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.row -->

    <section id="pregunta-container" class="section-padding" style="display:none;">
        <div class="panel panel-default">
            <div class="panel-heading">
                <span><h2 id="pregunta">YEI</h2><span>
            </div>
            <form method="POST" action="/dashboard/tickets/update" enctype="multipart/form-data">
                <div class="panel-body">
                    <b>Descripcion del problema:</b>
                    <p id="descripcion">asdfasfds</p>
                    <div id="adjuntosDesc"></div>
                    <b>Porcentaje de conclusión</b>
                        <div class="form-group">
                            <input id="porcentaje" name="porcentaje" type="number" value="" min="0" max="100" class="form-control"/>
                        </div>
                        <b>Prioridad</b>
                        <div class="form-group">
                            <select id="prioridad" name="prioridad" class="form-control">
                                <option value="alto">alto</option>
                                <option value="medio">medio</option>
                                <option value="bajo">bajo</option>
                            </select>
                        </div>
                </div>
                <div class="panel-footer">
                    <div id="estadosAnteriores" name="estadosAnteriores"></div>
                    <h4>Actualizar estado:</h4>
                    <b>Estado: </b>
                        <div class="form-group">
                            <select id="estado_actual" name="estado_actual" class="form-control">
                                <option value="Nuevo">Nuevo</option>
                                <option value="Espera">Espera</option>
                                <option value="Diferido">Diferido</option>
                                <option value="Sin resolver">Sin resolver</option>
                                <option value="Completado">Completado</option>
                            </select>
                        </div>
                        <b>Detalles: </b>
                        <div class="form-group" >
                            <textarea name="detalles" id="detalles" class="form-control"></textarea>
                        </div>
                        <div class="input-group">
                            <label class="input-group-btn">
                                <span class="btn btn-primary">
                                    Subir archivos <input type="file" name="files[]" style="display: none;" multiple>
                                </span>
                            </label>
                            <input type="text" class="form-control" readonly>
                        </div>
                        <br>
                        <div class="form-group">
                            <input type="hidden" name="ticket_su" id="ticket_su" value="">
                            <input type="hidden" name="state" id="state" value="">
                            <input type="submit" class="btn btn-success" value="Guardar"></input>
                            <a id="foro" href=""><button class="btn btn-info" type="button"> Ir a foro</button></a>
                            <a id="llamadas" href=""><button class="btn btn-info" type="button"> Ir a llamadas</button></a>
                        </div>
                    
                </div>
            </form>
        </div>
    </section>


</div>
<!--FIN TODO -->
<script>


var json = JSON;
             $(document).ready( function () {
                $('#tickets').DataTable( {
                  "language": {
                      "decimal":        ".",
                      "lengthMenu": "Mostrar _MENU_ preguntas por página",
                      "zeroRecords": "Nada encontrado - lo sentimos",
                      "info": "Mostrando pagina _PAGE_ de _PAGES_",
                      "infoEmpty": "No hay registros disponibles",
                      "infoFiltered": "(Filtrando de _MAX_ registros)",
                      "loadingRecords": "Cargando...",
                      "processing":     "Procesando...",
                      "search":         "Buscar:",
                      "paginate": {
                          "first":      "Primero",
                          "last":       "Ultimo",
                          "next":       "Siguiente",
                          "previous":   "Anterior"
                      }
                  },
                  bAutoWidth: false , 
                  aoColumns : [
                      { sWidth: '10%' },
                      { sWidth: '15%' },
                      { sWidth: '10%' },
                      { sWidth: '65%' },

                  ],
                  "order": [[ 1, "desc" ]]
                });

             $('#detalles').summernote({
                height: 300,
                lang:   'es-ES'
            });

             $('input[type=radio][name=ticket]').change(function() {
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
                $.ajaxSetup({
                    headers: {
                    }
                })
                $.post("/ajax/ajaxticketsu", {
                    'ticketid': id
                },
                function(data, status){
                    json = JSON.parse(data);
                    var message = json.descripcion.replace(/\n/g, "<br />");
                    $('#pregunta-container').show();
                    $('#pregunta').html(json.pregunta);
                    $('#descripcion').html(message);
                    $('#estado_actual').val(json.estado);
                    $('#detalles').val(json.detalles);
                    $('#porcentaje').val(json.porcentaje);
                    $('#prioridad').val(json.prioridad);
                    $('#ticket_su').val(json.id_ticketSU);
                    $('#state').val(json.id_estado);
                    $('#foro').attr("href", "/dashboard/foro/tema/"+json.id_ticketSU)
                    $('#llamadas').attr("href", "/dashboard/llamadas/"+json.id_ticketSU)
                    if (typeof json.estados !== 'undefined')
                    {
                        var estados = document.getElementById("estadosAnteriores");
                        
                        estados.innerHTML = "<h4>Estados anteriores: </h4>";
                        $.each(json.estados, function(i, item){
                            var d = new Date(json.estados[i].fecha_hora);
                            estados.innerHTML = estados.innerHTML + "<label>" + json.estados[i].estado + " - " + d.getDate() + "/" + (d.getMonth() + 1) + "/" + d.getFullYear() + " " + (d.getHours()+1) + ":" + (d.getMinutes()+1) + ":" + (d.getSeconds()+1) + "</label><br><div>" + (json.estados[i].detalles != null ? json.estados[i].detalles : "") + "</div><hrstyle ='background-color:orange;border:none;'>";
                        });
                    }
                });
            });
            
            } );

             $(document).on('change', ':file', function() {
    var input = $(this),
        numFiles = input.get(0).files ? input.get(0).files.length : 1,
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [numFiles, label]);
  });

  // We can watch for our custom `fileselect` event like this
  $(document).ready( function() {
      $(':file').on('fileselect', function(event, numFiles, label) {

          var input = $(this).parents('.input-group').find(':text'),
              log = numFiles > 1 ? numFiles + ' files selected' : label;

          if( input.length ) {
              input.val(log);
          } else {
              if( log ) alert(log);
          }

      });
      });
                </script>
    
   
    </body>
</html>
