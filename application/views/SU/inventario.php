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
    $items = $this->db->query("SELECT * FROM inventario");
    $items = $items->result();

    $categorias = $this->db->query("SELECT categoria FROM inventario GROUP BY categoria");
    $categorias = $categorias->result();

    $usuarios = $this->db->query("SELECT id, email, nombre, apellido FROM users INNER JOIN mortals ON id_usuario=id");
    $usuarios = $usuarios->result();

    $SUs = $this->db->query("SELECT id, email, nombre, apellido FROM users INNER JOIN superusers ON id_usuario=id");
    $SUs = $SUs->result();

    foreach($SUs as $s)
        array_push($usuarios, $s);
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
            <h1 class="page-header">Inventario</h1>
        </div>
        <div class="col-lg-12">
            <button id="newItem" class="btn btn-warning btn-lg btn-block" id="btn_newTicket">Nuevo item</button>
        </div>
    </div>
  <br>
    <div class="row">
        <div class="col-lg-12">
           <table id="inventario" class="display nowrap" width="100%">
                <thead>
                    <tr>
                        <th>Categoria</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>no. Serie</th>
                        <th>Service tag</th>
                        <th>Fecha de compra</th>
                        <th>Fecha de inicio de garantia</th>
                        <th>Fecha de fin de garantia</th>
                        <th>Usuarios</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($items as $t): ?>
                        <?php $usuario = $this->db->query("SELECT email FROM users INNER JOIN usuario_tiene_inventario ON id=id_usuario INNER JOIN inventario on inventario.id_inventario = usuario_tiene_inventario.id_inventario WHERE inventario.id_inventario = " . $t->id_inventario);
                        $usuario = $usuario->result(); ?>
                        <tr>
                            <td><?php echo $t->categoria; ?></td>
                            <td><?php echo $t->Marca; ?></td>
                            <td><?php echo $t->Modelo; ?></td>
                            <td><?php echo $t->noSerie; ?></td>
                            <td><?php echo $t->serviceTag; ?></td>
                            <td><?php echo $t->fechaCompra; ?></td>
                            <td><?php echo $t->fechaInicioGarantia; ?></td>
                            <td><?php echo $t->fechaFinGarantia; ?></td>
                            <td><?php foreach($usuario as $u) { echo $u->email . "<br>"; }?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.row -->
    <section id="newItem-Container" class="section-padding" style="display:none;">
                <h3>Nuevo item</h3>
                <form method="post" action="/dashboard/inventario/newItem">
                    <div class="form-group">
                        <label for="categoria">Categoria:</label>
                        <select id="categoria" name="categoria" style="width:100%;" class="form-control">
                            <option></option>
                            <?php foreach($categorias as $c): ?>
                                <option value="<?php echo $c->categoria; ?>"><?php echo $c->categoria; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Marca">Marca:</label>
                        <select id="Marca" name="Marca" style="width:100%;" class="form-control">
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Modelo">Modelo:</label>
                        <select id="Modelo" name="Modelo" style="width:100%;" class="form-control">
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="serie">No. Serie:</label>
                        <input type="text" id="serie" name="serie" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="service">Service Tag:</label>
                        <input type="text" id="service" name="service" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="compra">Fecha de compra:</label>
                        <input type="date" id="compra" name="compra" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="inicio">Fecha inicio garantia:</label>
                        <input type="date" id="inicio" name="inicio" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="fin">Fecha fin garantia:</label>
                        <input type="date" id="fin" name="fin" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="fin">A quien va dirigido:</label>
                        <select id="usuarios" name="usuarios[]" style="width:100%;" class="form-control" multiple>
                            <?php foreach($usuarios as $u): ?>
                                <option value="<?php echo $u->id;?>"><?php echo $u->email . " - " . $u->nombre . " " . $u->apellido;?> </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <br>
                    <div class="form-group">
                        <input type="submit" class="btn btn-success" value="Guardar"/>
                    </div>
                    
                </form>
        </section>

</div>
<!--FIN TODO -->
    <script>
        $("#categoria").on("change", function()
        {
            obtenerMarcas();
            obtenerModelos();
        });
        $("#Marca").on("change", function()
        {
            obtenerModelos();
        });
        function obtenerMarcas()
        {
            $.ajaxSetup({
                headers: {
                },
                async: false,
            })
            $.post("/ajax/ajaxInventario/marcas", {
                'categoria': $("#categoria").val()
            },
            function(data, status){
                var subtemas = document.getElementById("Marca");
                subtemas.innerHTML = "";
                if(data != "")
                {
                    var datos = JSON.parse(data);
                    if(datos[0].Marca !== "undefined")
                    {
                        $.each(datos, function(i, item){
                            subtemas.innerHTML = subtemas.innerHTML + "<option value='" + datos[i].Marca + "'>" + datos[i].Marca + "</option>";
                        });
                    }
                }
            }
            );
        }
        function obtenerModelos()
        {
            $.ajaxSetup({
                headers: {
                },
                async: false,
            })
            $.post("/ajax/ajaxInventario/modelos", {
                'marca': $("#Marca").val()
            },
            function(data, status){
                var subtemas = document.getElementById("Modelo");
                subtemas.innerHTML = "";
                if(data != "")
                {
                    var datos = JSON.parse(data);
                    if(datos[0].Modelo !== "undefined")
                    {
                        $.each(datos, function(i, item){
                            subtemas.innerHTML = subtemas.innerHTML + "<option value='" + datos[i].Modelo + "'>" + datos[i].Modelo + "</option>";
                        });
                    }
                }
            }
            );
        }
        $(document).ready( function () {
            $('#inventario').DataTable( {
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
                }
                  
            });
             $("#categoria").select2({
                placeholder: {
                    id: '-1', // the value of the option
                    text: 'Seleccionar una opción'
                },
                allowClear: true,
                tags: true
            });
            $("#Marca").select2({
                placeholder: {
                    id: '-1', // the value of the option
                    text: 'Seleccionar una opción'
                },
                allowClear: true,
                tags: true
            });
            $("#Modelo").select2({
                placeholder: {
                    id: '-1', // the value of the option
                    text: 'Seleccionar una opción'
                },
                allowClear: true,
                tags: true
            });
            $("#usuarios").select2({
                tags: true
            });
        });

        $("#newItem").on("click", function(){
            $("#newItem-Container").show();
            $('html, body').animate({
                scrollTop: $("#newItem-Container").offset().top
            }, 1000);
        });

    </script>
    
   
    </body>
</html>
