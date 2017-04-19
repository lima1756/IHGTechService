<?php
    $masVisitadas = $this->db->query("SELECT id, titulo FROM knowledge ORDER BY visitas DESC LIMIT 5");
    $masVisitadas = $masVisitadas->result();

    function csubstr($string, $start, $length=false) { 
        $pattern = '/(\[\w+[^\]]*?\]|\[\/\w+\]|<\w+[^>]*?>|<\/\w+>)/i'; 
        $clean = preg_replace($pattern, chr(1), $string); 
        if(!$length) 
            $str = substr($clean, $start); 
        else { 
            $str = substr($clean, $start, $length); 
            $str = substr($clean, $start, $length + substr_count($str, chr(1))); 
        } 
        $pattern = str_replace(chr(1),'(.*?)',preg_quote($str)); 
        if(preg_match('/'.$pattern.'/is', $string, $matched)) 
            return $matched[0]; 
        return $string; 
    } 



?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Knowledge</title>
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
        <section id ="feature" class="section-padding" style="margin-top:10px;">
            <div class="container" >
                <div class='row'>
                    <div class="col-sm-9" id="contenido">
                        <!--TODO -->
                        <?php foreach($entradas as $d): ?>
                            <div class="panel panel-warning">
                                <div class="panel-heading"><h3><?php echo $d->titulo; ?></h3></div>
                                <div class="panel-body">
                                    <?php echo csubstr($d->contenido, 0, 500); ?>...
                                    <p style="text-align:right;"><b><a href="/knowledge/entrada/<?php echo $d->id;?>">Leer mas</a></b></p>
                                </div>
                                <div class="panel-footer">
                                    <span style="float: left;"><b>Publicado:</b> <?php echo date("d-m-Y", strtotime($d->fecha_hora)); ?> </span>
                                    <span style="float: right;"><b>Tema:</b> <?php echo $d->tema; ?></span>
                                    <br>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <?php echo $this->pagination->create_links();?>
                        <!--TODO -->
                    </div>
                    <div class="col-sm-3" id="lateral">
                        <form method="POST" action="/knowledge/search">
                            <div class="btn-group" role="group">
                                <input type="text" name="search" class="btn" placeholder="Buscar" style="width:75%; border-color:orange;"/>
                                <a class="btn btn-default" href="#" style="border-color:orange;"><i class="fa fa-search" aria-hidden="true"></i></a>
                            </div>
                        </form>
                        <div id="masVisitadas">
                            <h4>Mas visitadas: </h4>
                            <ol style="list-style: decimal;">
                                <?php foreach($masVisitadas as $m): ?>
                                    <li><a href="/knowledge/entrada/<?php echo $m->id; ?>"><?php echo $m->titulo; ?></a></li>
                                <?php endforeach; ?>
                            </ol>
                        </div>
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
           
        </script>
    </body>
</html>