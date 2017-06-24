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
    foreach($usuarios->result() as $u){
        $countP++;
    }
    $questions = $this->db->query("SELECT * FROM knowledge");
    $questions = $questions->result();
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
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.15/r-2.1.1/datatables.min.css"/>
        <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.15/r-2.1.1/datatables.min.js"></script>

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
                                    <a href="#" class="alert alert-danger"><i class="fa fa-exclamation fa-fw"></i> Usuarios<span class="fa arrow"></span>
                                    </a>
                                <?php else: ?>
                                    <a href="#"><i class="fa fa-user fa-fw"></i> Usuarios<span class="fa arrow"></span></a>
                                <?php endif; ?>
                                <ul class="nav nav-second-level">
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
                                        <a href="/dashboard/users"><i class="fa fa-users fa-fw"></i> Todos los usuario</a> 
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
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
                            <li>
                                <a href="/dashboard/inventario"><i class="fa fa-briefcase"></i> Inventario</a> 
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
            <h1 class="page-header">knowledge</h1>
        </div>
        <div class="col-med-12">
            <button class="btn btn-info btn-lg btn-block" id="btn_newQuestiom">Crear nueva entrada</button>
        </div>
        <div class="col-med-12">
            <br>
        </div>
        <!-- /.col-lg-12 -->
    </div>
        <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
           <table id="knowledge" class="display cell-border stripe">
                <thead>
                    <tr>
                        <th>Seleccionar</th>
                        <th>Titulo</th>
                        <th>Etiqueta</th>
                        <th>Fecha</th>
                        <th>Visitas</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($questions as $q): ?>
                    <tr>
                    <td><label class="btn active">
                        <input type="radio" name="entrada" value="<?php echo $q->id;?>" id="radio<?php echo $q->id;?>" href="#pregunta-container" style"display:none;" hidden/><i class="fa fa-circle-o fa-2x"></i><i class="fa fa-dot-circle-o fa-2x"></i>
                    </label></td>
                        <td><?php echo  $q->titulo ; ?></td>
                        <td><?php echo  $q->tema ; ?></td>
                        <td><?php echo date_format(new dateTime($q->fecha_hora), 'd-m-Y H:i:s'); ?></td>
                        <td><?php echo  $q->visitas ; ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.row -->
    <?php 
        $temas= $this->db->query("SELECT tema FROM knowledge GROUP BY tema");
        $temas = $temas->result();
    ?>
    
    <section id="pregunta-container" class="section-padding" style="display:none;">
        <div class="panel panel-default">
            <div class="panel-body">
                <form action="/dashboard/knowledge/submit" method="post" id="formulario" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Tema:</label>
                        <select id="select_tema" name="select_tema" class="form-control">
                            <?php foreach($temas as $t): ?>
                                <option value="<?php echo $t->tema; ?>"><?php echo $t->tema; ?></option>
                            <?php endforeach; ?>
                                <option value="null">Otro</option>
                        </select>
                        <label id="label_input_tema" for="input_tema" style="display:none;">Escribelo:</label>
                        <input type="text" name="input_tema" id="input_tema" class="form-control" style="display:none;"/>
                    </div>
                    <div class="form-group">
                        <label for="Titulo">Titulo:</label>
                        <input type="text" name="Titulo" id="Titulo" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="contenido">Contenido:</label>
                        <textarea  id="contenido" name="contenido"></textarea >
                    </div>
                    
                    <div class="input-group">
                        <label class="input-group-btn">
                            <span class="btn btn-primary">
                                Subir archivos <input type="file" name="files[]" style="display: none;" multiple>
                            </span>
                        </label>
                        <input type="text" class="form-control" readonly>
                    </div>
                    <div id="adjuntos" class="input-group">
                    
                    </div>
                    <br>
                    <div class="form-group">
                        <input type="number" id="id" name="id" hidden/>
                        <button onclick="saveF(); return false;" id="guardar" class="btn btn-success">Guardar</button>
                        <button onclick="resetF(); return false;" id="resetear" class="btn btn-warning" style="display:none;">Resetear</button>
                        <button onclick="deleteF(); return false;" id="eliminar" class="btn btn-danger" />Eliminar</button>
                    </div>
                </form>
            </div>
        </div>
    </section>


</div>
<!--FIN TODO -->
<script>


var json = JSON;
            $(document).ready( function () {
                //DataTable
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
                      { sWidth: '6%' },
                      { sWidth: '54%' },
                      { sWidth: '10%' },
                      { sWidth: '10%' },
                      { sWidth: '10%' }

                  ],
                  "order": [[ 3, "desc" ]]
                });
            //Summernote
            $('#contenido').summernote({
                height: 300,
                lang:   'es-ES'
            });
            //Selector de tema
             $('#select_tema').on('change', function() {
                if($('#select_tema').val()=="null")
                {
                    $('#label_input_tema').show();
                    $('#input_tema').show();
                }
                else
                {
                    $('#label_input_tema').hide();
                    $('#input_tema').hide();
                }
             });
           
            //Nuevo knowledge
            $("#btn_newQuestiom").click(function(){
                document.getElementById("adjuntos").innerHTML = "";
                $('input[type=radio][name=entrada]').prop('checked', false);
                $('#pregunta-container').show();
                $('#Titulo').val("");
                $('#contenido').summernote('code', "");
                $('#id').val(null);
                $('#label_input_tema').show();
                $('#input_tema').show();
                $('#select_tema').val("null");
                $('#resetear').hide();
                $('#eliminar').hide();
                $('html, body').animate({
                    scrollTop: $("#pregunta-container").offset().top
                }, 1000);
            }); 

            

            } );
            function resetF()
            {
                
                $('#pregunta-container').show();
                $('#Titulo').val(json.titulo);
                $('#contenido').summernote('code', json.contenido);
                $('#id').val(json.id);
                $('#select_tema').val(json.tema);
                return false;
            }

            function saveF()
            {
                $('#formulario').prop('action', '/dashboard/knowledge/submit');
                
                $('#formulario').submit();
            }

            function deleteF()
            {
                $('#formulario').prop('action', '/dashboard/knowledge/drop');
                
                $('#formulario').submit();
            }

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

    //Ajax para obtencion de datos en seleccion
             $('input[type=radio][name=entrada]').on("click", function() {
                <?php foreach ($questions as $key => $q): ?>
                    <?php if($key==0): ?>
                        if (this.value == <?php echo $q->id; ?>) {
                            id=$('input:radio[name=entrada]:checked').val();
                        }
                    <?php else: ?>
                        else if (this.value == <?php echo $q->id; ?>) {
                            id=$('input:radio[name=entrada]:checked').val();
                        }
                    <?php endif; ?>
                <?php endforeach; ?>
                $.ajaxSetup({
                })
                $.post("/ajax/ajaxFAQ", {
                    'id': id
                },
                function(data, status){
                    json = JSON.parse(data);
                    $('#pregunta-container').show();
                    $('#Titulo').val(json.titulo);
                    $('#contenido').summernote('code', json.contenido);
                    $('#resetear').show();
                    $('#id').val(json.id);
                    $('#select_tema').val(json.tema);
                    $('#eliminar').show();
                    $('#label_input_tema').hide();
                    $('#input_tema').hide();
                    $('html, body').animate({
                        scrollTop: $("#pregunta-container").offset().top
                    }, 1000);
                    if (typeof json.files !== 'undefined')
                    {
                        var adjuntos = document.getElementById("adjuntos");
                        adjuntos.innerHTML = "<br><b>Eliminar archivos adjuntos: </b>";
                        $.each(json.files, function(i, item){
                            adjuntos.innerHTML = adjuntos.innerHTML + "<br><input type='checkbox' name='adjuntos[]' value='" + json.files[i].id_file + "'/><a href='/fileUploads/knowledge/"+json.files[i].nombreAlmacenado +"'>" + json.files[i].nombreOriginal+"</a>";
                        });
                    }
                    else
                    {
                        var adjuntos = document.getElementById("adjuntos");
                        adjuntos.innerHTML = "";
                    }

                });
            });
    </script>
    
   
    </body>
</html>
