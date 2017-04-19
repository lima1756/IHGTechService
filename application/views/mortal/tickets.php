
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Tickets</title>
        <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="/css/imagehover.min.css">
        <link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="/css/style.css">
        <script src="/js/jquery.min.js"></script>
        <script src="/js/jquery.easing.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/custom.js"></script>

     
        
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
        </style>
        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.13/css/jquery.dataTables.css">
        <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.13/js/jquery.dataTables.js"></script>
                <!-- include summernote css/js-->
        <link href="/dist/summernote.css" rel="stylesheet">
        <script src="/dist/summernote.js"></script>

        <!-- include summernote-es-ES -->
        <script src="/dist/lang/summernote-es-ES.js"></script>
        <?php
if(isset($state))
if(is_numeric($state))
    {
        echo("<script>
                window.onload = function() {
                    $('#radio".$state."').prop(\"checked\", true);
                    $.ajaxSetup({
                        headers: {
                                'X-CSRF-TOKEN': '".csrf_token()."'
                            }
                        })
                $.post(\"/ajaxMRT\", {
                    'ticketid': ".$state."
                },
                function(data, status){
                    var json = JSON.parse(data);
                    var message = json.descripcion.replace(/\\n/g, \"<br />\");
                    $('#pregunta-container').show();
                    $('#pregunta').html(json.pregunta);
                    $('#descripcion').html(message);
                });
                $.post(\"/ajaxMRTI\", {
                    'ticketid': ".$state."
                },
                function(data, status){
                    if(data==\"-1\"){
                        $('#imgn').attr(\"src\", \"\")
                        $('#imgn').attr('alt', 'No se subió ninguna imagen');
                    }
                    else{
                        var json = JSON.parse(data);
                        $('#imgn').attr(\"src\", \"/storage/ticketImages/\" + json.nombre)
                        $('#imgn').attr('alt', 'img');
                    }
                });
                 $.post(\"/ajaxMRTSI\", {
                    'ticketid': ".$state."
                },
                function(data, status){
                    var json = JSON.parse(data);
                    $('#progressbar').attr(\"style\", \"width:\"+json.porcentaje+\"%\");
                    $('#barValue').html(json.porcentaje+\"% Resuelto\");
                    if(json.porcentaje<60){
                        $('#progressbar').attr(\"class\", \"progress-bar progress-bar-danger\");
                    }
                    else if(json.porcentaje<90){
                        $('#progressbar').attr(\"class\", \"progress-bar progress-bar-warning\");
                    }
                    else if(json.porcentaje<101){
                        $('#progressbar').attr(\"class\", \"progress-bar progress-bar-success\");
                    }
                    if (typeof json.estado !== 'undefined') {
                        $('#estado-actual').html(json.estado);
                    }
                    else{
                        $('#estado-actual').html('Sin asignar');
                    }
                    if (typeof json.detalles !== 'undefined') {
                        if(json.detalles=\"NULL\"){
                            $('#detalles').html(\"No hay detalles aun\");
                        }
                        else{
                            $('#detalles').html(json.detalles);
                        }
                    }
                    else{
                        $('#detalles').html('Sin detalles');
                    }
                });
                }

        
            </script>");
    }
?>
    </head>
    <body style="">
        <!--Navigation bar-->
        <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand noSpace" href="/"><span style="color: #D71820">I</span><span style="color: #E05F25">H</span><span style="color: #DC771B">G</span></a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
              <li><a href="/tickets">Tickets</a></li>
              <li><a href="/knowledge">knowledge</a></li>
              <li class="btn-trial"><a href="/logOut">Cerrar Sesión</a></li>
            </ul>
            </div>
        </div>
        </nav>
          <!--Feature-->
        <section id ="feature" class="section-padding">
        <?php
          $questions = $this->db->query("SELECT * FROM tickets WHERE id_mortal = " . $this->logdata->getData("id"));
          $questions = $questions->result();
        ?>
        <div class="container" style="margin-top:10px;">
            <div class="row">
                <?php if(isset($error)): ?>
                <div class="col-med-12">
                    <div class="alert alert-danger">
                        <strong>Error!</strong> Archivo no valido. Porfavor vuelva a intentarlo
                    </div>
                </div>
                <?php endif; ?>
                <div class="col-med-12">
                    <a href="#newTicket-Container"><button class="btn btn-warning btn-lg btn-block" id="btn_newTicket">Crear nuevo ticket</button></a>
                </div>
            </div>
        </div>
        <div class="container" style="margin-top:20px;">
            <div class="row">
                <div class="col-med-12">
                    <div class="page-header">
                        <h1>Mis tickets: <small>Selecciona el ticket del que desees ver mas informacion</small></h1>
                    </div>
                </div>
              <div class="col-med-12">
                <table id="knowledge" class="display cell-border stripe">
                  <thead>
                      <tr>
                          <th>Seleccionar</th>
                          <th>Fecha-hora</th>
                          <th>Pregunta</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($questions as $q): ?>
                      <tr>
                        <td><label class="btn active">
                            <input type="radio" name='ticket' value="<?php echo $q->id_ticket; ?>" id="<?php echo $q->id_ticket; ?>" style='display:none;'/><i class="fa fa-circle-o fa-2x"></i><i class="fa fa-dot-circle-o fa-2x"></i>
                        </label></td>
                        <td><?php echo $q->fecha_hora; ?></td>
                        <td><?php echo $q->pregunta; ?></td>
                      </tr>
                    <?php endforeach;?>
                  </tbody>
              </table>
              </div>
            </div>
        </div>
        </section>
        <!--/ feature-->
    <section id="pregunta-container" class="section-padding" style="display:none;">
        <div class="container">
            <div class="row">
                <div class="col-med-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <span><h2 id="pregunta"></h2><span>
                        </div>
                        <div class="panel-body">
                            <b>Descripcion del problema:</b>
                            <p id="descripcion"></p>
                            <div id="adjuntosDesc"></div>
                            <b>Porcentaje de conclusión</b>
                                <div class="progress" id="progress">
                                    <div class="progress-bar progress-bar-danger" id="progressbar" role="progressbar" aria-valuenow="01"
                                    aria-valuemin="0" aria-valuemax="100" style="width:01%">
                                        <font color="black" id="barValue">00% Resuelto</font>
                                    </div>
                                </div>
                                <b>Prioridad</b><p id="prioridad" name="prioridad"></p>
                        </div>
                        <div class="panel-footer">
                            <div id="estadosAnteriores" name="estadosAnteriores"></div>
                        </div>
                    </div>
                </div>
            </div>
    </section>


    <section id="newTicket-Container" class="section-padding" style="display:none;">
        <div class="container">
            <div class="row">
                <div class="col-med-12">
                    <h3>Nuevo ticket</h3>
                    <form method="post" action="/tickets/newTicket" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="preguntaForm">Pregunta:</label>
                            <input type="text" class="form-control" id="preguntaForm" name="preguntaForm" required/>
                        </div>
                        <div class="form-group">
                            <label for="descripcionForm">Descripcion del problema:</label>
                            <textarea class="form-control" rows="5" id="descripcionForm" name="descripcionForm" required></textarea>
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
                        <button type="submit" class="btn btn-success">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <footer id="footer" class="footer">
      <div class="container text-center">

        ©2017 Tech-Service. Todos los derechos reservados
        <div class="credits">
            <!-- 
                All the links in the footer should remain intact. 
                You can delete the links only if you purchased the pro version.
                Licensing information: https://bootstrapmade.com/license/
                Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Mentor
            -->
            Designed by <a href="https://bootstrapmade.com/">Free Bootstrap Themes</a>
        </div>
      </div>
    </footer>
    <script type="text/javascript">
            $(document).ready( function () {
                $('#knowledge').DataTable( {
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
                      { sWidth: '75%' },

                  ],
                  "order": [[ 1, "desc" ]]
                });
             
            } );
            $("#btn_newTicket").click(function(){ 
                $("input[name=ticket]").prop('checked', false);
                $('#pregunta-container').hide();
                $('#newTicket-Container').show();
            });
            $('#descripcionForm').summernote({
                height: 300,
                lang:   'es-ES'
            });
            $('input[type=radio][name=ticket]').on("click",  function() {
                var id=-1;
                var contenidosRecibidos= new Array();
                <?php foreach ($questions as $key => $q): ?>
                    <?php if($key==0): ?>
                        if (this.value == <?php echo $q->id_ticket; ?>) {
                            id=$('input:radio[name=ticket]:checked').val();
                        }
                    <?php else: ?>
                        else if (this.value == <?php echo $q->id_ticket;?>) {
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
                    $('#progressbar').attr("style", "width:"+json.porcentaje+"%");
                    $('#barValue').html(json.porcentaje+"% Resuelto");
                    $('html, body').animate({
                        scrollTop: $("#pregunta-container").offset().top
                    }, 1000);
                    if(json.porcentaje<60){
                        $('#progressbar').attr("class", "progress-bar progress-bar-danger");
                    }
                    else if(json.porcentaje<90){
                        $('#progressbar').attr("class", "progress-bar progress-bar-warning");
                    }
                    else if(json.porcentaje<101){
                        $('#progressbar').attr("class", "progress-bar progress-bar-success");
                    }
                    document.getElementById("prioridad").innerHTML = json.prioridad;
                    $('#ticket_su').val(json.id_ticketSU);
                    $('#id_ticket').val(json.id_ticket);
                    $('#state').val(json.id_estado);
                    $('#foro').attr("href", "/dashboard/foro/tema/"+json.id_ticketSU)
                    $('#llamadas').attr("href", "/dashboard/llamadas/"+json.id_ticketSU)
                    if (typeof json.estados !== 'undefined')
                    {
                        var estados = document.getElementById("estadosAnteriores");
                        
                        estados.innerHTML = "<h4>Estados anteriores: </h4>";
                        $.each(json.estados, function(i, item){
                            var d = new Date(json.estados[i].fecha_hora);
                            $('#estado_actual').val(json.estados[i].estado);
                            estados.innerHTML = estados.innerHTML + "<label>" + json.estados[i].estado + " - " + d.getDate() + "/" + (d.getMonth() + 1) + "/" + d.getFullYear() + " " + (d.getHours()+1) + ":" + (d.getMinutes()+1) + ":" + (d.getSeconds()+1) + "</label><br><div>" + (json.estados[i].detalles != null ? json.estados[i].detalles : "") + "</div><hrstyle ='background-color:orange;border:none;'>";
                            if (typeof json.estados[i].files !== 'undefined')
                            {
                                estados.innerHTML = estados.innerHTML +"<p><b>Adjuntos: </b></p><ul>";
                                $.each(json.estados[i].files, function(k, item){
                                    estados.innerHTML = estados.innerHTML + "<pre><li><a href='/fileUploads/estados/"+ json.estados[i].files[k].nombreAlmacenado +"'>"+ json.estados[i].files[k].nombreOriginal+ "</a></li></pre>";
                                });
                                estados.innerHTML = estados.innerHTML +"</ul>";
                            }
                            estados.innerHTML = estados.innerHTML + "<hr style='border-top:1px solid #171717; margin-top:0px;'>"                            
                        });
                    }
                    if(typeof json.files !== "undefined")
                    {
                        var adjuntosDesc = document.getElementById("adjuntosDesc");
                        adjuntosDesc.innerHTML = "<p><b>Archivos adjuntos: </b></p>"
                        $.each(json.files, function(i, item){
                            adjuntosDesc.innerHTML = adjuntosDesc.innerHTML + "<pre><li><a href='/fileUploads/tickets/"+ json.files[i].nombreAlmacenado +"'>"+ json.files[i].nombreOriginal+ "</a></li></pre>";
                        });
                    }
                    else
                    {
                        var adjuntosDesc = document.getElementById("adjuntosDesc");
                        adjuntosDesc.innerHTML = ""
                    }
                });
            });

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