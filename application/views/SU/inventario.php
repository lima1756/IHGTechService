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
    if($tipo=="proximos")
    {
        $items = $this->db->query("SELECT * FROM inventario WHERE CURDATE() BETWEEN DATE_SUB(fechaFinGarantia, INTERVAL 1 MONTH) AND fechaFinGarantia");
        $items = $items->result();
    }
    else if($tipo=="otros")
    {
        $items = $this->db->query("SELECT * FROM inventario WHERE CURDATE() < DATE_SUB(fechaFinGarantia, INTERVAL 1 MONTH)");
        $items = $items->result();
    }
    else if($tipo=="vencidos")
    {
        $items = $this->db->query("SELECT * FROM inventario WHERE fechaFinGarantia<CURDATE()");
        $items = $items->result();
    }
    else
    {
        $items = $this->db->query("SELECT * FROM inventario");
        $items = $items->result();
    }

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
            <h1 class="page-header">Inventario</h1>
        </div>
        <div class="col-lg-12">
            <button id="newItem" class="btn btn-warning btn-lg btn-block" id="btn_newTicket">Nuevo item</button>
        </div>
    </div>
  <br>

    <div class="row">
        <div class="col-lg-12">
           <table id="inventario" class="table table-striped table-hover dt-responsive">
                <thead>
                    <tr>
                        <th>Seleccionar</th>
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
                            <td><label class="btn active">
                                <input type="radio" name="item" value="<?php echo $t->id_inventario; ?>" id="<?php echo "radio" . $t->id_inventario; ?>" style='display:none;' hidden/><i class="fa fa-circle-o fa-2x"></i><i class="fa fa-dot-circle-o fa-2x"></i>
                            </label></td>
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
                <form method="post" action="/dashboard/inventario/newItem" id="formData" name="formData">
                    <input type="hidden" id="id_inventario" name="id_inventario"/>
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
                    <div class="form-group" id="inventarioButton">
                        <input type="submit" class="btn btn-success" value="Guardar"/>
                    </div>
                    <div class="form-group" id="bottons" name="buttons">
                        <button class="btn btn-success" id="save" name="save" onclick="return changeDirSave();">Guardar</button>
                        <button class="btn btn-danger" id="delete" name="delete" onclick="return changeDirDelete();">Eliminar</button>
                    </div>
                    
                </form>
        </section>

</div>
<!--FIN TODO -->
    <script>
        
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
                },
                responsive: true,
                autoWidth: false,
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
            $("#id_inventario").val(json.id_inventario);
                    
            $("#categoria").val("").trigger('change');
            $("#Marca").val("").trigger('change');
            $("#Modelo").val("").trigger('change');
            $("#serie").val("");
            $("#service").val("");
            $("#compra").val("").trigger('change');
            $("#inicio").val("").trigger('change');
            $("#fin").val("").trigger('change');

            idUsers =[];
            $('#usuarios').val(idUsers).trigger("change");
            $("#inventarioButton").show();
            $("#bottons").hide();
            $("#newItem-Container").show();
            $('html, body').animate({
                scrollTop: $("#newItem-Container").offset().top
            }, 1000);
        });
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

        $('input[type=radio][name=item]').on("click", function() {
                $('#pregunta-container').show();
                $('#newTicket-Container').hide();
                <?php foreach ($items as $key => $q): ?>
                    <?php if($key==0): ?>
                        if (this.value == <?php echo $q->id_inventario; ?>) {
                            id=$('input:radio[name=item]:checked').val();
                        }
                    <?php else: ?>
                        else if (this.value == <?php echo $q->id_inventario; ?>) {
                            id=$('input:radio[name=item]:checked').val();
                        }
                    <?php endif; ?>
                <?php endforeach; ?>
                $.ajaxSetup({
                    headers: {
                    }
                })
                $.post("/ajax/ajaxinventario/item", {
                    'id': id
                },
                function(data, status){
                    $("#inventarioButton").hide();
                    $("#bottons").show();
                    json = JSON.parse(data);
                    users = json.users;
                    json = json.items;
                    $("#id_inventario").val(json.id_inventario);
                    
                    $("#categoria").val(json.categoria).trigger('change');
                    $("#Marca").val(json.Marca).trigger('change');
                    $("#Modelo").val(json.Modelo).trigger('change');
                    $("#serie").val(json.noSerie);
                    $("#service").val(json.serviceTag);
                    $("#compra").val(json.fechaCompra);
                    $("#inicio").val(json.fechaInicioGarantia);
                    $("#fin").val(json.fechaFinGarantia);
                    $("#newItem-Container").show();
                    $('html, body').animate({
                        scrollTop: $("#newItem-Container").offset().top
                    }, 1000);
                    idUsers =[];
                    for(i = 0; i < users.length; i++)
                    {
                        idUsers.push(users[i].id);
                    }
                    console.log(idUsers);
                    $('#usuarios').val(idUsers).trigger("change");
                    //$('#usuarios').select2({}).select2('val', idUsers);  
                });
            });

            function changeDirSave(){
                document.getElementById("formData").action= "/dashboard/inventario/alterItem";
                document.getElementById("formData").submit();
            }
            function changeDirDelete(){
                document.getElementById("formData").action = "/dashboard/inventario/deleteItem";
                document.getElementById("formData").submit();
            }
    </script>
    
   
    </body>
</html>
