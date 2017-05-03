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
    $foro = array();
    $new = false;
    foreach($usuarios->result() as $u){
        $countP++;
    }
    $number = $this->db->query('SELECT * FROM foro WHERE id_nota IS NULL AND id_ticket_su = ' . $id );
    $number = $number->result();
    while(count($number)>0){
        array_push($foro, $number[0]);
        $number = $this->db->query('SELECT * FROM foro WHERE id_nota = ' . $number[0]->id );    
        $number = $number->result();
    }
    if(count($foro)==0)
    {
        $mine = $this->db->query("SELECT id_SU FROM ticket_sus WHERE id_ticketSU = " . $id);
        $mine = $mine->result();
            $new = true;
    }
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
                                <a href="/dashboard/newUser"><i class="fa fa-user-plus fa-fw"></i> Nuevo usuario</a> 
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
            <?php if(count($foro)>0): ?>
                <h1 class="page-header">Tema: <?php echo $foro[0]->Titulo; ?></h1>
            <?php elseif($new): ?>
                <h1 class="page-header">NUEVA ENTRADA</h1>
            <?php else: ?>
                <h1 class="page-header">Tema: <?php echo "TEMA NO ENCONTRADO"; ?></h1>
            <?php endif; ?>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <?php if(count($foro)>0): ?>
        <section id="pregunta-container" class="section-padding">
            <div class="panel panel-default">
                <?php foreach($foro as $f): ?>
                    <?php
                        $name = $this->db->query("SELECT nombre FROM users WHERE id=".$f->id_SU);
                        $name = $name->result();
                        $archivos = $this->db->query("SELECT files.* FROM files INNER JOIN files_foro ON files.id_file = files_foro.id_file INNER JOIN foro ON foro.id = files_foro.id_foro WHERE foro.id = " . $f->id);
                        $archivos = $archivos->result();
                    ?>
                    <div class="panel-heading">
                        <span><h3 id="user"><?php echo $name[0]->nombre; ?>:</h3><span>
                    </div>
                    <div class="panel-body">
                        <p><?php echo $f->mensaje; ?></p>
                        <p><b>Adjuntos:</b> 
                            <?php if(count($archivos)>0): ?>
                                <?php foreach($archivos as $file): ?>
                                    <br>
                                    <a href="/fileUploads/foro/<?php echo $file->nombreAlmacenado;?>"> <?php echo $file->nombreOriginal;?> </a>
                                <?php endforeach;?>
                            <?php else: ?>
                                <b>Ningun archivo adjunto</b>
                            <?php endif; ?>
                        </p>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <div class="panel panel-default">
                    <div class="panel-heading">
                        <span><h2>Contestar</h2><span>
                    </div>
                    <div class="panel-body">
                        <form action="/dashboard/foro/respuesta" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <?php
                                    if(count($foro)>0){
                                        $last=$foro[count($foro)-1]->id;
                                    }
                                    else{
                                        $last=null;
                                    }
                                ?>
                                <label>Respuesta:</label>
                                <textarea class="form-control" name="comentario" id="comentario"></textarea>
                                <br>
                                <div class="input-group">
                                    <label class="input-group-btn">
                                        <span class="btn btn-primary">
                                            Subir archivos <input type="file" name="files[]" style="display: none;" multiple>
                                        </span>
                                    </label>
                                    <input type="text" class="form-control" readonly>
                                </div>
                                <input type="hidden" name="last" value="<?php echo $last; ?>">
                                <input type="hidden" name="id_ticket_su" value="<?php echo $id; ?>">
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Enviar" class="btn btn-success"/>
                            </div>
                        </form>
                    </div>
            </div>
            
        </section>
        <?php elseif($new): ?>
            <section id="pregunta-container" class="section-padding">                
                <div class="panel panel-default">
                        <div class="panel-body">
                            <form action="/dashboard/foro/nuevo" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <?php
                                        if(count($foro)>0){
                                            $last=$foro[count($foro)-1]->id;
                                        }
                                        else{
                                            $last=null;
                                        }
                                    ?>
                                    <label>Titulo: </label>
                                    <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Titulo de la entrada"/>
                                    <label>Contenido</label>
                                    <textarea class="form-control" name="comentario" id="comentario"></textarea>
                                    <br>
                                    <div class="input-group">
                                        <label class="input-group-btn">
                                            <span class="btn btn-primary">
                                                Subir archivos <input type="file" name="files[]" style="display: none;" multiple>
                                            </span>
                                        </label>
                                        <input type="text" class="form-control" readonly>
                                    </div>

                                    <input type="hidden" name="last" value="<?php echo $last; ?>">
                                    <input type="hidden" name="id_ticket_su" value="<?php echo $id; ?>">
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Enviar" class="btn btn-success"/>
                                </div>
                            </form>
                        </div>
                </div>
                
            </section>
        <?php endif; ?>
</div>
<!--FIN TODO -->
<script>
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

  $('document').ready(function() {
    $('#comentario').summernote({
                height: 100,
                lang:   'es-ES'
            });
  });
    </script>
    
   
    </body>
</html>
