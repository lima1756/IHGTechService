<?php
    $this->db->set('visitas', 'visitas+1', FALSE);
    $this->db->where('id', $entrada->id);
    $this->db->update("knowledge");
    $masVisitadas = $this->db->query("SELECT id, titulo FROM knowledge ORDER BY visitas DESC LIMIT 5");
    $masVisitadas = $masVisitadas->result();
    $files = $this->db->query("SELECT * from files INNER JOIN files_knowledge ON files.id_file = files_knowledge.id_file WHERE files_knowledge.id_knowledge = ". $entrada->id); 
    $files = $files->result();
        $temas= $this->db->query("SELECT tema FROM knowledge GROUP BY tema");
    $temas = $temas->result();
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
                            <div class="panel panel-warning">
                                <div class="panel-heading"><h3><?php echo $entrada->titulo; ?></h3></div>
                                <div class="panel-body">
                                    <?php echo $entrada->contenido; ?>
                                    <?php if(count($files)>0): ?>
                                        <p><b>Archivos adjuntos: </b></p>
                                        <?php foreach($files as $f): ?>
                                            <pre><a href="/fileUploads/knowledge/<?php echo $f->nombreAlmacenado; ?>"><?php echo $f->nombreOriginal; ?></a></pre>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="panel-footer">
                                    <span style="float: left;"><b>Publicado:</b> <?php echo date("d-m-Y", strtotime($entrada->fecha_hora)); ?> </span>
                                    <span style="float: right;"><b>Tema:</b> <?php echo $entrada->tema; ?></span>
                                    <br>
                                </div>
                            </div>
                        <!--TODO -->
                    </div>
                    <div class="col-sm-3" id="lateral">
                        <h4>Buscar por palabra:</h4>
                        <form method="POST" action="/knowledge/search" id="formPalabra">
                            <div class="btn-group" role="group">
                                <input type="text" name="search" id="search" class="btn" placeholder="Buscar" style="width:75%; border-color:orange;"/>
                                <a class="btn btn-default" href="#" style="border-color:orange;" id="searchWord"><i class="fa fa-search" aria-hidden="true"></i></a>
                            </div>
                        </form>
                        <h4>Buscar por tema:</h4>
                        <form method="POST" action="/knowledge/tema" id="formTema">
                            <div class="btn-group" role="group">
                                <select name="tema" class="btn" id="tema" style="border-color:orange;">
                                    <?php foreach($temas as $t): ?>
                                        <option value="<?php echo $t->tema; ?>"><?php echo $t->tema; ?></option>
                                    <?php endforeach;?>
                                </select>
                                <a class="btn btn-default" href="#" style="border-color:orange;" id="searchTheme"><i class="fa fa-search" aria-hidden="true"></i></a>
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
           document.getElementById("searchWord").addEventListener("click", function () {
                var form = document.getElementById("formPalabra");
                form.action = "/knowledge/search/" + $('#search').val();
                form.submit();
            });

            document.getElementById("searchTheme").addEventListener("click", function () {
                var form = document.getElementById("formTema");
                form.action = "/knowledge/tema/" + $('#tema').val();
                form.submit();
            });
        </script>
    </body>
</html>