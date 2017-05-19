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
    $items = $this->db->query("SELECT * FROM countries")->result();
    $allUsers = $this->db->query("SELECT * FROM users");
    $realAllUsers = array();
    $conteo = 0;
    foreach($allUsers->result() as $u){
        $realAllUsers[$conteo][0] = $u;
        $comprobacion = $this->db->query("SELECT * FROM mortals where id_usuario = '" . $u->id . "';")->result();
        
        if(sizeof($comprobacion)==0)
        {
            $comprobacion = $this->db->query("SELECT * FROM superusers where id_usuario = '" . $u->id . "';")->result();
            if(sizeof($comprobacion)==0)
            {
                $comprobacion = $this->db->query("SELECT * FROM informes where id_usuario = '" . $u->id . "';")->result();
                if(sizeof($comprobacion)==0)
                {
                    $realAllUsers[$conteo][1] = null;
                }
                else
                {
                    $realAllUsers[$conteo][1] = "denied";
                }
            }
            else
            {
                $realAllUsers[$conteo][1] = "superUser";
            }
        }
        else
        {
            $realAllUsers[$conteo][1] = "User";
        }
        
        $conteo++;
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


        <!-- include dataTables -->
        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.13/css/jquery.dataTables.css">
        <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.13/js/jquery.dataTables.js"></script>

        <!-- select2 -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
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
            <h1 class="page-header">Usuarios</h1>
        </div>
        <div class="col-lg-12">
            <button class="btn btn-warning btn-lg btn-block" id="btn_newUser">Nuevo Usuario</button>
        </div>
        <div class="col-lg-12">
            <div id="error" class="alert alert-danger" style="visibility:hidden;display: none;"><?php echo validation_errors(); ?></div>
                <div id="registered" class="alert alert-success" style="visibility:hidden; display: none;"></div>
                <?php if(isset($error)){
                if(count($error)>0 || validation_errors()){
                    echo '<script type="text/javascript">
                                var errorDiv = document.getElementById(\'error\');
                                document.getElementById(\'error\').style.visibility = "visible";
                                document.getElementById(\'error\').style.display = "block";
                            </script>';     
                    foreach($error as $e)
                    if($e=="denied"){
                        echo '<script type="text/javascript">
                                errorDiv.innerHTML=errorDiv.innerHTML+"Su solicitud ya fue previamente denegada<br>";
                            </script>';
                    }
                    elseif($e=="registered"){
                        echo '<script type="text/javascript">
                                errorDiv.innerHTML=errorDiv.innerHTML+"Usuario ya registrado<br>";
                            </script>';
                    }
                    elseif($e=="passwords"){
                        echo '<script type="text/javascript">
                                errorDiv.innerHTML=errorDiv.innerHTML+"Porfavor revise que las contraseñas sean iguales<br>";
                            </script>';
                    }
                }
                elseif(count($error)==0){
                    echo '<script type="text/javascript">
                                var registered = document.getElementById(\'registered\');
                                registered.style.visibility = "visible";
                                registered.style.display = "block";
                                registered.innerHTML="Usuario almacenado exitosamente";
                            </script>';   
                }
                }
                ?>
        </div>
    </div>
  <br>

    <div class="row">
        <div class="col-lg-12">
           <table id="usuarios" class="table table-striped table-hover dt-responsive">
                <thead>
                    <tr>
                        <th>Seleccionar</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Trabajo</th>
                        <th>Tipo de usuario</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($realAllUsers as $u): ?>
                        <tr>
                            <?php if($u[1]!= null): ?>
                                <td><label class="btn active">
                                    <input type="radio" name="item" value="<?php echo $u[0]->id; ?>" id="<?php echo "radio" . $u[0]->id; ?>" style='display:none;' hidden/><i class="fa fa-circle-o fa-2x"></i><i class="fa fa-dot-circle-o fa-2x"></i>
                                </label></td>
                                <td><?php echo $u[0]->nombre . " " . $u[0]->apellido; ?></td>
                                <td><?php echo $u[0]->email; ?></td>
                                <td><?php echo $u[0]->trabajo; ?></td>
                                <td><?php echo $u[1] ?></td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.row -->
    <section id="user-Container" class="section-padding" style="display:none;">
        <h3>Usuario</h3>
        <form method="post" action="/dashboard/Users/newUser" id="formData" name="formData">
            <input type="hidden" id="id_Usuario" name="id_Usuario"/>
            <div class="row">
            
        
            <div class="form-group">
                <input type="email" class="form-control" name="email" id="email" value="<?php echo set_value('email'); ?>" placeholder="Tu Email" minlength=5/>
                <div class="validation"></div>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="pass" id="pass" placeholder="Contraseña" minlength=6/>
                <div class="validation"></div>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="pass2" id="pass" placeholder="Confirmar contraseña" data-rule="password" minlength=6/>
                <div class="validation"></div>
            </div>
            <div class="form-group">
                <input type="text" name="name" class="form-control form" id="name"  value="<?php echo set_value('name'); ?>" placeholder="Tu nombre" minlength=2  />
                <div class="validation"></div>
            </div>
            <div class="form-group">
                <input type="text" name="last" class="form-control form" id="last" value="<?php echo set_value('last'); ?>" placeholder="Tu apellido" minlength=2 />
                <div class="validation"></div>
            </div>
            <div class="form-group">
                <input type="number" name="cell" class="form-control form" id="cell" value="<?php echo set_value('cell'); ?>" placeholder="Tu celular" min=10000  />
                <div class="validation"></div>
            </div>

            <div class="form-group">
                <input type="number" name="tel" class="form-control form" id="tel" value="<?php echo set_value('tel'); ?>" placeholder="Tu telefono" minlength=10000  />
                <div class="validation"></div>
            </div>
            <div class="form-group">
                <input type="number" name="ext" class="form-control form" id="ext" value="<?php echo set_value('ext'); ?>" placeholder="Tu extensión" minlength=1 />
                <div class="validation"></div>
            </div>
            <div class="form-group">
                <input type="text" name="area" class="form-control form" id="area" value="<?php echo set_value('area'); ?>" placeholder="Tu area de trabajo" minlength=2 />
                <div class="validation"></div>
            </div>
            <div class="form-group">
                <input type="text" name="work" class="form-control form" id="work" value="<?php echo set_value('work'); ?>" placeholder="Tu trabajo" minlength=2 />
                <div class="validation"></div>
            </div>
            
            <div class="form-group">
                <select class="form-control" name="country" id="country" style="width:100%;"value="<?php echo set_value('country'); ?>">
                    <?php foreach ($items as $item): ?>
                        <option value='<?php echo $item->id ?>'><?php echo $item->name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group" id="nuevoButton" style="display:none">
                <button class="btn btn-success" id="SUNew" name="SUNew" onclick="return false;">Guardar como SU</button>
                <button class="btn btn-warning" id="mortalNew" name="mortalNew" onclick="return false;">Guardar como usuario</button>
            </div>
            <div class="form-group" id="myButtons" name="myButtons" style="display:none">
                <button class="btn btn-success" id="save" name="save" onclick="return false;">Guardar cambios</button>
                <button class="btn btn-warning" id="SU" name="SU" onclick="return false;">Convertir a SU</button>
                <button class="btn btn-warning" id="mortal" name="mortal" onclick="return false;">Convertir a usuario</button>
                <button class="btn btn-danger" id="delete" name="delete" onclick="return false;">Denegar acceso</button>
            </div>

        </form>
  
                    

    </section>

</div>
<!--FIN TODO -->
    <script>
        
        $(document).ready( function () {
            $('#usuarios').DataTable( {
                "language": {
                    "decimal":        ".",
                    "lengthMenu": "Mostrar _MENU_ items por página",
                    "zeroRecords": "Nada encontrado - lo sentimos",
                    "info": "Mostrando items _PAGE_ de _PAGES_",
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
                responsive: true,
                autoWidth: false,
            });
            
            
             
            
        });
        $("#country").select2({
                placeholder: {
                    id: '-1', // the value of the option
                    text: 'Seleccionar una opción'
                },
                allowClear: true,
                tags: true
            });
        $("#btn_newUser").on("click", function(){
            $("#user-Container").show();
            $("#email").val("");
            $("#name").val("");
            $("#last").val("");
            $("#cell").val("");
            $("#tel").val("");
            $("#ext").val("");
            $("#area").val("");
            $("#work").val("");
            $("#country").val("").trigger('change');;
            $("#id_Usuario").val("");
            $('html, body').animate({
                scrollTop: $("#user-Container").offset().top
            }, 1000);
            $("#nuevoButton").show();
            $("#myButtons").hide();
        });

        $('input[type=radio][name=item]').on("click", function() {
                $('#pregunta-container').show();
                $('#newTicket-Container').hide();
                <?php foreach ($realAllUsers as $key => $q): ?>
                    <?php if($key==0): ?>
                        if (this.value == <?php echo $q[0]->id; ?>) {
                            id=$('input:radio[name=item]:checked').val();
                        }
                    <?php else: ?>
                        else if (this.value == <?php echo $q[0]->id; ?>) {
                            id=$('input:radio[name=item]:checked').val();
                        }
                    <?php endif; ?>
                <?php endforeach; ?>
                $.ajaxSetup({
                    headers: {
                    }
                })
                $.post("/ajax/ajaxusuarios", {
                    'id': id
                },
                function(data, status){
                    $("#user-Container").show();
                    $('html, body').animate({
                        scrollTop: $("#user-Container").offset().top
                    }, 1000);
                    $("#nuevoButton").hide();
                    $("#myButtons").show();
                    json = JSON.parse(data);
                    $("#email").val(json.email);
                    $("#id_Usuario").val(json.id);
                    $("#name").val(json.nombre);
                    $("#last").val(json.apellido);
                    $("#cell").val(json.cel);
                    $("#tel").val(json.tel);
                    $("#ext").val(json.ext);
                    $("#area").val(json.areaTrabajo);
                    $("#work").val(json.trabajo);
                    $("#country").val(json.id_region).trigger('change');
                });
            });
            var formulario = document.getElementById("formData");
            $("#SUNew").on("click", function() {
                formulario.action="/dashboard/Users/newUser/superusers"
                formulario.submit();
            });

            $("#mortalNew").on("click", function() {
                formulario.action="/dashboard/Users/newUser/mortals"
                formulario.submit();
            });

            $("#save").on("click", function() {
                formulario.action="/dashboard/Users/alterUser"
                formulario.submit();
            });

            $("#SU").on("click", function() {
                formulario.action="/dashboard/Users/convertSU"
                formulario.submit();
            });

            $("#mortal").on("click", function() {
                formulario.action="/dashboard/Users/convertMortal"
                formulario.submit();
            }); 

            $("#delete").on("click", function() {
                formulario.action="/dashboard/Users/deleteAccess"
                formulario.submit();
            });

    </script>
    
   
    </body>
</html>




