<?php //http://isotope.metafizzy.co/layout-modes/masonry.html
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
    $paises = $this->db->query("SELECT count(id_mortal) AS totales , countries.name, countries.id 
                                FROM tickets INNER JOIN users ON users.id = tickets.id_mortal INNER JOIN countries ON users.id_region = countries.id
                                GROUP BY id_mortal");
    $paises = $paises->result();
    $estados = $this->db->query("SELECT count(estados.estado) AS conteo, estados.estado FROM estados INNER JOIN ticketsu_tiene_estado ON ticketsu_tiene_estado.id_estado = estados.id_estado   
                                INNER JOIN ticket_sus ON ticketsu_tiene_estado.id_ticketSU = ticket_sus.id_ticketSU
                                WHERE ticketsu_tiene_estado.fecha_hora IN (SELECT max(ticketsu_tiene_estado.fecha_hora) FROM ticketsu_tiene_estado GROUP BY ticketsu_tiene_estado.id_ticketSU)
                                 GROUP BY estados.estado");
    $estados = $estados->result();                            
    $total = 0;
    foreach($estados as $p):
        if($p->estado == "Completado" || $p->estado == "Sin resolver"):
            $total+=$p->conteo;
        endif;
    endforeach;
    $count = array();
    foreach($paises as $pais){
        if(isset($count[$pais->id])){
            $count[$pais->id][0]+=$pais->totales;
        }
        else{
            $count[$pais->id]=[0, $pais->name];
            $count[$pais->id][0]+=$pais->totales;
        }
    }
    $misPaises = array();
    $misConteos = array();
    $misColores = array();
    $misColores2 = array();
    foreach($count as $c):
        array_push($misPaises, $c[1]);
        array_push($misConteos, $c[0]);
        $uno = rand(1,255);
        $dos = rand(1,255);
        $tres = rand(1,255);
        array_push($misColores, 'rgba('.$uno.', '.$dos.', '.$tres.', 0.5)');
        array_push($misColores2, 'rgba('.$uno.', '.$dos.', '.$tres.', 1)');
    endforeach;
    $conteos = array();   
    foreach($estados as $p)
    {
            $conteos[$p->estado] = $p->conteo;
    }
    if(!isset($conteos['Nuevo']))
    {
        $conteos['Nuevo']=0;
    }
    if(!isset($conteos['Espera']))
    {
        $conteos['Espera']=0;
    }
    if(!isset($conteos['Diferido']))
    {
        $conteos['Diferido']=0;
    }
    if(!isset($conteos['Completado']))
    {
        $conteos['Completado']=0;
    }
    if(!isset($conteos['Sin resolver']))
    {
        $conteos['Sin resolver']=0;
    }


/*
    */
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Dashboard</title>
        
        <link rel="stylesheet" type="text/css" href="/css/dashboard/bootstrap.css")/>
        <link rel="stylesheet" type="text/css" href="/css/dashboard/font-awesome.min.css")/>
        <link rel="stylesheet" type="text/css" href="/css/dashboard/metisMenu.min.css")/>
        <link rel="stylesheet" type="text/css" href="/css/dashboard/sb-admin-2.css")/>

        <script src="/js/dashboard/jquery.min.js"></script>

        <script src="/js/isotope.js"></script>

        <script src="/js/dashboard/bootstrap.min.js"></script>
        <script src="/js/dashboard/metisMenu.min.js"></script>
        <script src="/js/dashboard/raphael.min.js"></script>
        <script src="/js/dashboard/morris.min.js"></script>
        <script src="/js/dashboard/sb-admin-2.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.bundle.min.js"></script>

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

        <div id="page-wrapper">
            <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Dashboard</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
        <!-- /.row -->

    <div class="row grid">
        <div class="col-lg-4 grid-item">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-pie-chart fa-fw"></i> Estado de solicitudes
                </div>
                <div class="panel-body">
                    <div>

                        <canvas id="estado-solicitud" width="400" height="400"></canvas>
                    
                    </div>
                    <div class="text-center">
                            <a href="/dashboard/tickets/Espera"><button class="btn btn-info">Ver en espera</button></a>
                            <a href="/dashboard/tickets/Nuevo"><button class="btn btn-info">Ver nuevos</button></a>
                            <a href="/dashboard/tickets/Diferido"><button class="btn btn-info">Ver diferidos</button></a>
                        </div>
                </div>
                <!-- /.panel-body -->
            </div>
        </div>
        <div class="col-lg-4 grid-item">
            <!-- /.panel -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bar-chart-o fa-fw"></i> Solicitudes
                    <div class="pull-right">
                    </div>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                        <div>
                            <canvas id="solicitudes" width="400" height="400"></canvas>
                        </div>
                        <div class="text-center">
                            <a href="/dashboard/tickets/Completado"><button class="btn btn-info">Ver Completadas</button></a>
                            <a href="/dashboard/tickets/Sin_resolver"><button class="btn btn-info">Ver Sin resolver</button></a>
                            <a href="/dashboard/tickets/all"><button class="btn btn-info">Ver Total</button></a>
                        </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
            
        </div>
        <!-- /.col-lg-8 -->
        <div class="col-lg-4 grid-item">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-file-text-o fa-fw"></i> Atrasados
                </div>
                <?php 
                    $pendientes = $this->db->query("SELECT TIME_TO_SEC(TIMEDIFF(NOW(), ticketsu_tiene_estado.fecha_hora)) as secs , prioridad, estado FROM ticket_sus INNER JOIN ticketsu_tiene_estado ON ticketsu_tiene_estado.id_ticketSU = ticket_sus.id_ticketSU   
                                INNER JOIN estados ON ticketsu_tiene_estado.id_estado = estados.id_estado
                                WHERE ticketsu_tiene_estado.fecha_hora IN (SELECT max(ticketsu_tiene_estado.fecha_hora) FROM ticketsu_tiene_estado GROUP BY ticketsu_tiene_estado.id_ticketSU)
                                AND id_SU = ". $this->logdata->getData("id"));
                    $pendientes = $pendientes->result();
                    $atrasados = array();
                    $atrasados[0]=0;
                    $atrasados[1]=0;
                    $atrasados[2]=0;
                    foreach($pendientes as $pendiente){
                        if($pendiente->estado!='Diferido' && $pendiente->estado!='Completado' && $pendiente->estado!='Sin Resolver')
                        if($pendiente->prioridad=="alto"){
                            if($pendiente->secs > 86400){
                                $atrasados[0]++;
                            }
                        }
                        elseif($pendiente->prioridad=="medio"){
                            if($pendiente->secs > 172800){
                                $atrasados[1]++;
                            }
                        }
                        elseif($pendiente->prioridad=="bajo"){
                            if($pendiente->secs > 259200){
                                $atrasados[2]++;
                            }
                        }
                    }
                ?>
                
                <div class="panel-body">
                <h3>Prioridad: </h3>
                <a href="/dashboard/tickets/alto"><h4>Alta: </h4> <p><?php echo $atrasados[0]; ?></p></a>
                <a href="/dashboard/tickets/medio"><h4>Media: </h4> <p><?php echo$atrasados[1]; ?></p></a>
                <a href="/dashboard/tickets/bajo"><h4>Baja: </h4> <p><?php echo$atrasados[2]; ?></p></a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 grid-item">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-pie-chart fa-fw"></i> Solicitudes por paises
                </div>
                <div class="panel-body">
                    <div>
                        <canvas id="paises" width="400" height="400"></canvas>
                    </div>
                    <div class="text-center">
                        <a href="/dashboard/countriesStats"><button class="btn btn-info">Ver informacion</button></a>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
            
        </div>
        <!-- /.col-lg-4 -->
        
        <div class="col-lg-4 grid-item">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-pie-chart fa-fw"></i> unDash
                </div>
                <div class="panel-body">
                    <div>
                        <canvas id="" width="400" height="400"></canvas>
                    </div>
                    <div class="text-center">
                        <a href="/dashboard/countriesStats"><button class="btn btn-info">Botones</button></a>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
            
        </div>
        <!-- /.col-lg-4 -->

        <div class="col-lg-4 grid-item">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-pie-chart fa-fw"></i> unDash
                </div>
                <div class="panel-body">
                    <div>
                        <canvas id="" width="400" height="400"></canvas>
                    </div>
                    <div class="text-center">
                        <a href="/dashboard/countriesStats"><button class="btn btn-info">Botones</button></a>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
            
        </div>
        <!-- /.col-lg-4 -->
    </div>
    <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <script>
        $('.grid').isotope({
            itemSelector: '.grid-item',
            
         

        });
        var estadoS =document.getElementById("estado-solicitud");
        var estadoSolicitudes = new Chart(estadoS, {
            name: 'estadoSolicitudes',
            type: 'pie',
            data: {
                labels: ["Espera", "Nuevos", "Diferidos"],
                datasets: [
                    {
                        backgroundColor : ['rgba(255, 99, 132, 0.5)', 'rgba(54, 162, 235, 0.5)', 'rgba(54, 162, 150, 0.5)'],
                        hoverBackgroundColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(54, 162, 150, 1)'],
                        data : [<?php echo ($conteos['Espera'] .",". $conteos['Nuevo']. "," .$conteos['Diferido']); ?>]
                    }    
                ]
            },
            options: {}
        });

        var paises =document.getElementById("paises");
        var graficaPaises = new Chart(paises, {
            name: 'graficaPaises',
            type: 'pie',
            data: {
                labels: [<?php foreach($misPaises as $p) echo ('"'.$p.'",');?>],
                datasets: [
                    {
                        backgroundColor : [<?php foreach($misColores as $c) echo ('"'.$c.'",');?>],
                        hoverBackgroundColor: [<?php foreach($misColores2 as $c2) echo ('"'.$c2.'",');?>],
                        data : [<?php foreach($misConteos as $cont) echo ($cont.',');?>]
                    }    
                ]
            },
            options: {}
        });

        var solicitudes =document.getElementById("solicitudes");
        var graficaSolicitudes = new Chart(solicitudes, {
            name: 'graficaSolicitudes',
            type: 'bar',
            data: {
                labels: ["Completados", "Sin Resolver", "Total"],
                datasets: [
                    {
                        label: "Solicitudes",
                        backgroundColor : ['rgba(255, 99, 132, 0.5)', 'rgba(54, 162, 235, 0.5)', 'rgba(54, 162, 150, 0.5)'],
                        hoverBackgroundColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(54, 162, 150, 1)'],
                        data : [<?php echo ($conteos['Completado'] . ", " . $conteos['Sin resolver'] . ", " . $total);?>]
                    }    
                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
        
    </script>
    </body>
</html>
