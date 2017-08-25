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


    $usuarios = $this->db->query("SELECT count(id_ticket) AS totales , users.* 
                                FROM users INNER JOIN tickets ON users.id = tickets.id_mortal
                                GROUP BY id_mortal");
    $usuarios = $usuarios->result();
    
    $count = array();
    foreach($usuarios as $u){
        if(isset($count[$u->id])){
            $count[$u->id][0]+=$u->totales;
        }
        else{
            $count[$u->id]=[0, $u->email, $u->id];
            $count[$u->id][0]+=$u->totales;
        }
    }
    $misUsuarios = array();
    $misConteos = array();
    $misColores = array();
    $misColores2 = array();
    foreach($count as $c):
        array_push($misUsuarios, $c[2] . " " . $c[1]);
        array_push($misConteos, $c[0]);
        $uno = rand(1,255);
        $dos = rand(1,255);
        $tres = rand(1,255);
        array_push($misColores, 'rgba('.$uno.', '.$dos.', '.$tres.', 0.5)');
        array_push($misColores2, 'rgba('.$uno.', '.$dos.', '.$tres.', 1)');
    endforeach;

    
    $estados = $this->db->query("SELECT count(estados.estado) AS conteo, estados.estado FROM estados INNER JOIN ticketsu_tiene_estado ON ticketsu_tiene_estado.id_estado = estados.id_estado   
                                INNER JOIN tickets ON ticketsu_tiene_estado.id_ticketSU = tickets.id_ticket
                                WHERE ticketsu_tiene_estado.fecha_hora IN (SELECT max(ticketsu_tiene_estado.fecha_hora) FROM ticketsu_tiene_estado GROUP BY ticketsu_tiene_estado.id_ticketSU)
                                 GROUP BY estados.estado");
    $estados = $estados->result();                            
    $total = 0;
    foreach($estados as $p):
        $total+=$p->conteo;
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

    $invetarioVencidos = $this->db->query("SELECT id_inventario FROM inventario WHERE fechaFinGarantia<CURDATE()");
    $invetarioVencidos = sizeof($invetarioVencidos->result());

    $invetarioProximos = $this->db->query("SELECT id_inventario FROM inventario WHERE CURDATE() BETWEEN DATE_SUB(fechaFinGarantia, INTERVAL 1 MONTH) AND fechaFinGarantia");
    $invetarioProximos = sizeof($invetarioProximos->result());

    $invetarioSin = $this->db->query("SELECT id_inventario FROM inventario WHERE CURDATE() < DATE_SUB(fechaFinGarantia, INTERVAL 1 MONTH)");
    $invetarioSin = sizeof($invetarioSin->result());

    $subTemas = $this->db->query('SELECT COUNT(ticket_tiene_tema.idTema) AS cantidad, sub_temas_ticket.nombre FROM tech_service.ticket_tiene_tema 
        INNER JOIN sub_temas_ticket ON ticket_tiene_tema.idTema = sub_temas_ticket.id
        GROUP BY ticket_tiene_tema.idTema;')->result();
    $misColoresSubtemas = array();
    $misColoresSubtemas2 = array();
    foreach($subTemas as $c):
        $uno = rand(1,255);
        $dos = rand(1,255);
        $tres = rand(1,255);
        array_push($misColoresSubtemas, 'rgba('.$uno.', '.$dos.', '.$tres.', 0.5)');
        array_push($misColoresSubtemas2, 'rgba('.$uno.', '.$dos.', '.$tres.', 1)');
    endforeach;

    $temas = $this->db->query('SELECT count(sub_temas_ticket.id_tema) cantidad, sub_temas_ticket.id_tema, temas_tickets.nombre FROM tech_service.ticket_tiene_tema 
        INNER JOIN sub_temas_ticket ON ticket_tiene_tema.idTema = sub_temas_ticket.id
        INNER JOIN temas_tickets ON temas_tickets.id = sub_temas_ticket.id_tema
        GROUP BY sub_temas_ticket.id_tema')->result();
    $misColoresTemas = array();
    $misColoresTemas2 = array();
    foreach($temas as $c):
        $uno = rand(1,255);
        $dos = rand(1,255);
        $tres = rand(1,255);
        array_push($misColoresTemas, 'rgba('.$uno.', '.$dos.', '.$tres.', 0.5)');
        array_push($misColoresTemas2, 'rgba('.$uno.', '.$dos.', '.$tres.', 1)');
    endforeach;
    
    $users = $this->db->query("SELECT count(tickets.id_ticket) cantidad, users.nombre, users.apellido, users.email FROM tickets
        INNER JOIN users ON tickets.id_mortal = users.id
        GROUP BY users.id;")->result();
    $misColoresUsers = array();
    $misColoresUsers2 = array();
    foreach($users as $c):
        $uno = rand(1,255);
        $dos = rand(1,255);
        $tres = rand(1,255);
        array_push($misColoresUsers, 'rgba('.$uno.', '.$dos.', '.$tres.', 0.5)');
        array_push($misColoresUsers2, 'rgba('.$uno.', '.$dos.', '.$tres.', 1)');
    endforeach;

    $problemsByWeek = $this->db->query("SELECT count(idTema) cantidad, tech_service.sub_temas_ticket.nombre FROM tech_service.ticket_tiene_tema
        INNER JOIN tech_service.sub_temas_ticket
            ON tech_service.ticket_tiene_tema.idTema = tech_service.sub_temas_ticket.id
        INNER JOIN tech_service.tickets
            ON tickets.id_ticket = ticket_tiene_tema.id_ticketSU
        WHERE week(tickets.fecha_hora) = week(CURDATE())
        group by idTema")->result();
    $misColoresWeeks = array();
    $misColoresWeeks2 = array();
    foreach($problemsByWeek as $c):
        $uno = rand(1,255);
        $dos = rand(1,255);
        $tres = rand(1,255);
        array_push($misColoresWeeks, 'rgba('.$uno.', '.$dos.', '.$tres.', 0.5)');
        array_push($misColoresWeeks2, 'rgba('.$uno.', '.$dos.', '.$tres.', 1)');
    endforeach;

    $problemsByMonth = $this->db->query("SELECT count(idTema) cantidad, tech_service.sub_temas_ticket.nombre FROM tech_service.ticket_tiene_tema
        INNER JOIN tech_service.sub_temas_ticket
            ON tech_service.ticket_tiene_tema.idTema = tech_service.sub_temas_ticket.id
        INNER JOIN tech_service.tickets
            ON tickets.id_ticket = ticket_tiene_tema.id_ticketSU
        WHERE month(tickets.fecha_hora) = month(CURDATE())
        group by idTema")->result();
    $misColoresMonth = array();
    $misColoresMonth2 = array();
    foreach($problemsByMonth as $c):
        $uno = rand(1,255);
        $dos = rand(1,255);
        $tres = rand(1,255);
        array_push($misColoresMonth, 'rgba('.$uno.', '.$dos.', '.$tres.', 0.5)');
        array_push($misColoresMonth2, 'rgba('.$uno.', '.$dos.', '.$tres.', 1)');
    endforeach;
    
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

        <div id="page-wrapper">
            <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Dashboard</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
        <!-- /.row -->

    <div class="row grid">
        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 grid-item">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-pie-chart fa-fw"></i> Estado de solicitudes
                </div>
                <div class="panel-body">
                    <div>

                        <canvas id="estado-solicitud" width="400" height="400"></canvas>
                    
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 grid-item">
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
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
            
        </div>
        <!-- /.col-lg-8 -->
        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 grid-item">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-file-text-o fa-fw"></i> Atrasados
                </div>
                <?php 
                    $pendientes = $this->db->query("SELECT TIME_TO_SEC(TIMEDIFF(NOW(), tickets.fecha_hora)) as secs , prioridad, estado FROM tickets 
                                INNER JOIN ticketsu_tiene_estado ON ticketsu_tiene_estado.id_ticketSU = tickets.id_ticket   
                                INNER JOIN estados ON ticketsu_tiene_estado.id_estado = estados.id_estado
                                WHERE ticketsu_tiene_estado.fecha_hora IN (SELECT max(ticketsu_tiene_estado.fecha_hora) FROM ticketsu_tiene_estado GROUP BY ticketsu_tiene_estado.id_ticketSU)
                                ");
                    $pendientes = $pendientes->result();
                    $atrasados = array();
                    $atrasados[0]=0;
                    $atrasados[1]=0;
                    $atrasados[2]=0;
                    
                    foreach($pendientes as $pendiente){
                        if($pendiente->estado!='Diferido' && $pendiente->estado!='Completado' && $pendiente->estado!='Sin Resolver')
                        if($pendiente->prioridad=="alto" || $pendiente->prioridad==null){
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
        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 grid-item">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-pie-chart fa-fw"></i> Solicitudes por usuarios
                </div>
                <div class="panel-body">
                    <div>
                        <canvas id="usuarios" width="400" height="400"></canvas>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
            
        </div>
        <!-- /.col-lg-4 -->
        
        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 grid-item">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-pie-chart fa-fw"></i> Inventario
                </div>
                <div class="panel-body">
                    <div>
                        <canvas id="Inventario" width="400" height="400"></canvas>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
            
        </div>
        <!-- /.col-lg-4 -->

        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 grid-item">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-pie-chart fa-fw"></i> Tickets por Subtemas
                </div>
                <div class="panel-body">
                    <div>
                        <canvas id="subtemas" width="400" height="400"></canvas>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
            
        </div>
        <!-- /.col-lg-4 -->

        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 grid-item">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-pie-chart fa-fw"></i> Tickets por Temas
                </div>
                <div class="panel-body">
                    <div>
                        <canvas id="temas" width="400" height="400"></canvas>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
            
        </div>
        <!-- /.col-lg-4 -->

        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 grid-item">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-pie-chart fa-fw"></i> Problemas de usuarios
                </div>
                <div class="panel-body">
                    <div>
                        <canvas id="users" width="400" height="400"></canvas>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
            
        </div>
        <!-- /.col-lg-4 -->
        
        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 grid-item">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-pie-chart fa-fw"></i> Problemas por tema de la semana actual
                </div>
                <div class="panel-body">
                    <div>
                        <canvas id="week" width="400" height="400"></canvas>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
            
        </div>
        <!-- /.col-lg-4 -->

        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 grid-item">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-pie-chart fa-fw"></i> Problemas por tema del mes actual
                </div>
                <div class="panel-body">
                    <div>
                        <canvas id="month" width="400" height="400"></canvas>
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

        estadoS.onclick = function (evt) {
            var activePoints = estadoSolicitudes.getElementsAtEvent(evt);
            var chartData = activePoints[0]['_chart'].config.data;
            var idx = activePoints[0]['_index'];

            var label = chartData.labels[idx];
            if(label=="Espera")
                var url = "/dashboard/tickets/Espera";
            else if(label=="Nuevos")
                var url = "/dashboard/tickets/Nuevo";
            else if(label=="Diferidos")
                var url = "/dashboard/tickets/Diferido";
            window.location.href = url;
        };

        var usuarios =document.getElementById("usuarios");
        var graficaUsuarios = new Chart(usuarios, {
            name: 'graficaUsuarios',
            type: 'pie',
            data: {
                labels: [<?php foreach($misUsuarios as $p) echo ('"'.$p.'",');?>],
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

        usuarios.onclick = function (evt) {
            var activePoints = graficaUsuarios.getElementsAtEvent(evt);
            var chartData = activePoints[0]['_chart'].config.data;
            var idx = activePoints[0]['_index'];

            var label = chartData.labels[idx];
            
            var res = label.split(" ")[0];

            var url = "/dashboard/tickets/usuario/"+res;
            window.location.href = url;
        };

        var solicitudes = document.getElementById("solicitudes");
        var graficaSolicitudes = new Chart(solicitudes, {
            name: 'graficaSolicitudes',
            type: 'bar',
            data: {
                labels: ["Solicitudes"],
                datasets: [
                    {
                        label: "Completados",
                        backgroundColor : 'rgba(255, 99, 132, 0.5)',
                        hoverBackgroundColor: 'rgba(255, 99, 132, 1)',
                        data : [<?php echo ($conteos['Completado']);?>]
                    },
                    {
                        label: "Sin Resolver",
                        backgroundColor : 'rgba(54, 162, 235, 0.5)',
                        hoverBackgroundColor: 'rgba(54, 162, 235, 1)',
                        data : [<?php echo ($conteos['Sin resolver']);?>]
                    },
                    {
                        label: "Total",
                        backgroundColor : 'rgba(54, 162, 150, 0.5)',
                        hoverBackgroundColor: 'rgba(54, 162, 150, 1)',
                        data : [<?php echo($total);?>]
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

        solicitudes.onclick = function (evt) {
            var activePoints = graficaSolicitudes.getElementsAtEvent(evt);
            var chartData = activePoints[0]['_chart'].config.data;
            var idx = activePoints[0]['_index'];

            var label = chartData.labels[idx];

            if(label=="Sin Resolver")
                var url = "/dashboard/tickets/Sin_resolver";
            else if(label=="Completados")
                var url = "/dashboard/tickets/Completado";
            else
                var url = "/dashboard/tickets/all";
            window.location.href = url;
        };
        

        var inventario =document.getElementById("Inventario");
        var graficaInventario = new Chart(inventario, {
            name: 'graficaInventario',
            type: 'pie',
            data: {
                labels: ["Proximos a vencer", "Vigentes", "Vencidos"],
                datasets: [
                    {
                        backgroundColor : ['rgba(255, 99, 132, 0.5)', 'rgba(54, 162, 235, 0.5)', 'rgba(54, 162, 150, 0.5)'],
                        hoverBackgroundColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(54, 162, 150, 1)'],
                        data : [<?php echo ($invetarioProximos .",". $invetarioSin. "," .$invetarioVencidos); ?>]
                    }    
                ]
            },
            options: {}
        });

        inventario.onclick = function (evt) {
            var activePoints = graficaInventario.getElementsAtEvent(evt);
            var chartData = activePoints[0]['_chart'].config.data;
            var idx = activePoints[0]['_index'];

            var label = chartData.labels[idx];
            if(label=="Proximos a vencer")
                var url = "/dashboard/inventario/proximos";
            else if(label=="Vigentes")
                var url = "/dashboard/inventario/otros";
            else if(label=="Vencidos")
                var url = "/dashboard/inventario/vencidos";
            window.location.href = url;
        };
        $('.grid').isotope({
            itemSelector: '.grid-item',
        });

        var subTemas =document.getElementById("subtemas");
        var graficaSubtemas = new Chart(subTemas, {
            name: 'graficaSubtemas',
            type: 'pie',
            data: {
                labels: [<?php foreach($subTemas as $s) echo ('"'.$s->nombre.'",');?>],
                datasets: [
                    {
                        backgroundColor : [<?php foreach($misColoresSubtemas as $c) echo ('"'.$c.'",');?>],
                        hoverBackgroundColor: [<?php foreach($misColoresSubtemas2 as $c2) echo ('"'.$c2.'",');?>],
                        data : [<?php foreach($subTemas as $s) echo ($s->cantidad.',');?>]
                    }    
                ]
            },
            options: {}
        });

        var temas =document.getElementById("temas");
        var graficaTemas = new Chart(temas, {
            name: 'temas',
            type: 'pie',
            data: {
                labels: [<?php foreach($temas as $s) echo ('"'.$s->nombre.'",');?>],
                datasets: [
                    {
                        backgroundColor : [<?php foreach($misColoresTemas as $c) echo ('"'.$c.'",');?>],
                        hoverBackgroundColor: [<?php foreach($misColoresTemas2 as $c2) echo ('"'.$c2.'",');?>],
                        data : [<?php foreach($temas as $s) echo ($s->cantidad.',');?>]
                    }    
                ]
            },
            options: {}
        });

        var users =document.getElementById("users");
        var graficaUsers = new Chart(users, {
            name: 'users',
            type: 'pie',
            data: {
                labels: [<?php foreach($users as $s) echo ('"'.$s->nombre. ' ' . $s->apellido. ' - ' . $s->email . '",');?>],
                datasets: [
                    {
                        backgroundColor : [<?php foreach($misColoresUsers as $c) echo ('"'.$c.'",');?>],
                        hoverBackgroundColor: [<?php foreach($misColoresUsers2 as $c2) echo ('"'.$c2.'",');?>],
                        data : [<?php foreach($users as $s) echo ($s->cantidad.',');?>]
                    }    
                ]
            },
            options: {}
        });

        var week =document.getElementById("week");
        var graficaWeek = new Chart(week, {
            name: 'week',
            type: 'pie',
            data: {
                labels: [<?php if(count($problemsByWeek)>0): foreach($problemsByWeek as $s) echo ('"'.$s->nombre. '",'); else: echo "\"Sin problemas actualmente\""; endif;?>],
                datasets: [
                    {
                        backgroundColor : [<?php foreach($misColoresWeeks as $c) echo ('"'.$c.'",');?>],
                        hoverBackgroundColor: [<?php foreach($misColoresWeeks2 as $c2) echo ('"'.$c2.'",');?>],
                        data : [<?php if(count($problemsByWeek)>0): foreach($problemsByWeek as $s) echo ($s->cantidad.','); else: echo "0"; endif;?>]
                    }    
                ]
            },
            options: {}
        });

        var month =document.getElementById("month");
        var graficaMonth = new Chart(month, {
            name: 'month',
            type: 'pie',
            data: {
                labels: [<?php if(count($problemsByMonth)>0): foreach($problemsByMonth as $s) echo ('"'.$s->nombre. '",'); else: echo "\"Sin problemas actualmente\""; endif;?>],
                datasets: [
                    {
                        backgroundColor : [<?php foreach($misColoresMonth as $c) echo ('"'.$c.'",');?>],
                        hoverBackgroundColor: [<?php foreach($misColoresMonth2 as $c2) echo ('"'.$c2.'",');?>],
                        data : [<?php if(count($problemsByMonth)>0): foreach($problemsByMonth as $s) echo ($s->cantidad.','); else: echo "0"; endif;?>]
                    }    
                ]
            },
            options: {}
        });
    </script>
    </body>
</html>
