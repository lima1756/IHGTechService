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
    $llamadas = $this->db->query("SELECT * FROM llamadas WHERE id_ticket_su = ". $id . " ORDER BY fecha_hora DESC");
    $llamadas = $llamadas->result();
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
        
        <script src="/js/dashboard/jquery.min.js"></script>
        <script src="/js/dashboard/bootstrap.min.js"></script>
        <script src="/js/dashboard/metisMenu.min.js"></script>
        <script src="/js/dashboard/raphael.min.js"></script>
        
        <script src="/js/dashboard/sb-admin-2.js"></script>
        
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
    <div class="chat-panel panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-comments fa-fw"></i> Llamadas
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <ul class="chat">
                <?php foreach($llamadas as $l): ?>
                    <li>
                        <div class="chat-body clearfix">
                            <div class="header">
                                <strong class="primary-font"><i class="fa fa-clock-o fa-fw"></i><?php echo date("d/m/y H:i:s",time($l->fecha_hora));?></strong>
                            </div>
                            <p>
                                <?php echo(nl2br($l->detalles)); ?>
                            </p>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <!-- /.panel-body -->
        <div class="panel-footer">
            <form action="/dashboard/llamadas/submit/<?php echo $id; ?>" method="post">
                <div class="form-group">
                    <textarea id="detalles" name="detalles" type="text" class="form-control" placeholder="Escribe aqui lo que desees guardar de la llamada"></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-warning btn-sm" id="btn-chat"/>
                </div>
            </form>
        </div>
        <!-- /.panel-footer -->
    </div>
</div>
<!--FIN TODO -->
<script>
   </script>
    
   
    </body>
</html>
