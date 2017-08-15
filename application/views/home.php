
<?php
header('Access-Control-Allow-Origin: *');
    $this->load->helper('url');
  $type=$this->logdata->getType();
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Welcome!</title>
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans|Candal|Alegreya+Sans">
        <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="/css/imagehover.min.css">
        <link rel="stylesheet" type="text/css" href="/css/style.css">
        <link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css">
        <script src="/js/jquery.min.js"></script>
        <script src="/js/jquery.min.js"></script>
        <script src="/js/jquery.easing.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/custom.js"></script>
        <?php if(isset($goTo)): ?>
          <script>
            window.onload = function() {
                window.location = "#<?php echo $goTo ?>"
            }
          </script>
        <?php endif; ?>
        <?php if($type!="mortal" && $type!="SU"): ?>
          <?php $items = $this->db->query('SELECT id, name FROM countries ORDER BY name ASC;'); ?>
            <?php if (isset($signIn)): ?>
              <script>
                window.onload = function() {
                    window.location = "#login";   
                    $('#login').modal('show');
                    var errorDiv2 = document.getElementById('errorlogIn');
                    document.getElementById('errorlogIn').style.visibility = "visible";
                    document.getElementById('errorlogIn').style.display = "block";
                    errorDiv2.innerHTML=errorDiv2.innerHTML+"Los datos de inicio son erroneos";
                }
              </script>
            <?php endif; ?>
          <?php endif; ?>
        <!-- select2 -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    </head>
    <body>
      <!--Navigation bar-->
        <nav class="navbar navbar-default navbar-fixed-top">
          <div class="container">
              <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand noSpace" href="/"><span style="color: #D71820">I</span><span style="color: #E05F25">H</span><span style="color: #DC771B">G</span></p></a>
              </div>
              <div class="collapse navbar-collapse" id="myNavbar">
                  <ul class="nav navbar-nav navbar-right">
                      <?php if($type=="SU"): ?>
                          <li><a href="dashboard">Dashboard</a></li>
                          <li class="btn-trial"><a href="logOut">Cerrar Sesión</a></li>
                      <?php elseif($type=="mortal"): ?>
                          <li><a href="tickets">Tickets</a></li>
                          <li><a href="knowledge">knowledge</a></li>
                          <li class="btn-trial"><a href="logOut">Cerrar Sesión</a></li>
                        <?php else: ?>
                          <li><a href="#" data-target="#login" data-toggle="modal">Iniciar sesión</a></li>
                          <li class="btn-trial"><a href="#registro">Registrate</a></li>
                      <?php endif; ?>
                  </ul>
              </div>
          </div>
        </nav>

        <?php if($type!="mortal" && $type!="SU"): ?>
          <div class="modal fade" id="login" role="dialog">
            <div class="modal-dialog modal-sm">
              <!-- Modal content no 1-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title text-center form-title">Inicio de seción</h4>
                </div>
                <div class="modal-body padtrbl">

                  <div class="login-box-body">
                  <div id="errorlogIn" class="alert alert-danger" style="visibility:hidden;display: none;"></div>
                    <div class="form-group">
                      <form name="logIn" id="loginForm" action="logIn" method="post">
                      <div class="form-group has-feedback"> <!----- username -------------->
                            <input class="form-control" placeholder="Email"  id="email" type="email" name="email"/> 
                  <span style="display:none;font-weight:bold; position:absolute;color: red;position: absolute;padding:4px;font-size: 11px;background-color:rgba(128, 128, 128, 0.26);z-index: 17;  right: 27px; top: 5px;" id="span_loginid"></span><!---Alredy exists  ! -->
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback"><!----- password -------------->
                            <input class="form-control" placeholder="Contraseña" id="pass" type="password" name="pass"/>
                  <span style="display:none;font-weight:bold; position:absolute;color: grey;position: absolute;padding:4px;font-size: 11px;background-color:rgba(128, 128, 128, 0.26);z-index: 17;  right: 27px; top: 5px;" id="span_loginpsw"></span><!---Alredy exists  ! -->
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="checkbox icheck">
                                    <label>
                                      <input type="checkbox" id="loginrem" name="loginrem"> Remember Me
                                    </label>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <button type="submit" class="btn btn-green btn-block btn-flat">Sign In</button>
                            </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
        <?php endif; ?>
          <!--/ Modal box-->
    <!--Banner-->
        <div class="banner">
        <div class="bg-color">
            <div class="container">
            <div class="row">
                <div class="banner-text text-center">
                
                    <img class="logo text-border" src="img/IHG-logo.png"/>
                
                <div class="intro-para text-center quote">
                    <p class="big-text"><b>Servicio tecnico</b></p>
                    <p class="small-text">En IHG evolucionamos continuamente, abrazando las ultimas tecnologias para simplificar las tareas diarias y permitir a nuestros colegas trabajar con mayor eficiencia</p>
                </div>
                <a href="#feature" class="mouse-hover"><div class="mouse"></div></a>
                </div>
            </div>
            </div>
        </div>
        </div>
        <!--/ Banner-->
        <!--Feature-->
        <section id ="feature" class="section-padding">
        <div class="container">
            <div class="row">
            <div class="header-section text-center">
                <h2>Funcionamiento</h2>
                <p>En Tech-service, estamos comprometidos por brindar el mejor servicio tecnico<br>  a distancia para la empresa.</p>
                <hr class="bottom-line">
            </div>
            <div class="feature-info">
                <div class="fea">
                <div class="col-md-4">
                    <div class="heading pull-right">
                    <h4>Primer paso</h4>
                    <p>Registrate y espera que alguno de nuestros trabajadores acepte tu solicitud, te sera enviado un correo</p>
                    </div>
                    <div class="fea-img pull-left">
                    <i class="fa fa-desktop"></i>
                    </div>
                </div>
                </div>
                <div class="fea">
                <div class="col-md-4">
                    <div class="heading pull-right">
                    <h4>Segundo paso</h4>
                    <p>Revisa el Knowledge para ver si tu pregunta no ha sido resuelta con anterioridad. Si no lo encuentras, genera tu ticket con tu problema</p>
                    </div>
                    <div class="fea-img pull-left">
                    <i class="fa fa-laptop"></i>
                    </div>
                </div>
                </div>
                <div class="fea">
                <div class="col-md-4">
                    <div class="heading pull-right">
                    <h4>Tercer paso</h4>
                    <p>Mantente atento a tu correo para recibir la información del estado de tu problema :)</p>
                    </div>
                    <div class="fea-img pull-left">
                    <i class="fa fa-mobile"></i>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        </section>
        <!--/ feature-->
    
    <?php if($type!="mortal" && $type!="SU"): ?>
    <section id ="registro" class="section-padding">
      <div class="container">
        <div class="row">
          <div class="header-section text-center">
            <h2>Registrate</h2>
            <p>Esta herramienta tiene la intención de disminuir costos, simplificar tareas y permitir una mayor eficiencia de trabajo para todos. <br>¿Que esperas para registrarte?</p>
            <hr class="bottom-line">
          </div>
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
                          errorDiv.innerHTML=errorDiv.innerHTML+"Su usuario ya fue registrado, espere su confirmación, si ya la recibio intente iniciar sesion<br>";
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
                          registered.innerHTML="Su registro a sido guardado, espere la confirmación en su correo!";
                        </script>';   
            }
          }
          ?>
          
          <form action="/signUp" method="post" role="form" class="contactForm">
              <div class="col-md-6 col-sm-6 col-xs-12 left">
                <div class="form-group">
                    <input type="email" class="form-control" name="email" id="email" value="<?php echo set_value('email'); ?>" placeholder="Tu Email" minlength=5 required/>
                    <div class="validation"></div>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="pass" id="pass" placeholder="Tu contraseña" minlength=6/>
                    <div class="validation"></div>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="pass2" id="pass" placeholder="Confirmar contraseña" data-rule="password" minlength=6 required/>
                    <div class="validation"></div>
                </div>
                <div class="form-group">
                    <input type="text" name="name" class="form-control form" id="name"  value="<?php echo set_value('name'); ?>" placeholder="Tu nombre" minlength=2  required />
                    <div class="validation"></div>
                </div>
                <div class="form-group">
                    <input type="text" name="last" class="form-control form" id="last" value="<?php echo set_value('last'); ?>" placeholder="Tu apellido" minlength=2  required/>
                    <div class="validation"></div>
                </div>
                <div class="form-group">
                    <input type="number" name="cell" class="form-control form" id="cell" value="<?php echo set_value('cell'); ?>" placeholder="Tu celular" min=10000   required/>
                    <div class="validation"></div>
                </div>
                
              </div>
              
              <div class="col-md-6 col-sm-6 col-xs-12 right">
                <div class="form-group">
                    <input type="number" name="tel" class="form-control form" id="tel" value="<?php echo set_value('tel'); ?>" placeholder="Tu telefono" minlength=10000   required/>
                    <div class="validation"></div>
                </div>
                <div class="form-group">
                    <input type="number" name="ext" class="form-control form" id="ext" value="<?php echo set_value('ext'); ?>" placeholder="Tu extensión" minlength=1  required/>
                    <div class="validation"></div>
                </div>
                <div class="form-group">
                    <input type="text" name="area" class="form-control form" id="area" value="<?php echo set_value('area'); ?>" placeholder="Tu area de trabajo" minlength=2  required/>
                    <div class="validation"></div>
                </div>
                <div class="form-group">
                    <input type="text" name="work" class="form-control form" id="work" value="<?php echo set_value('work'); ?>" placeholder="Tu trabajo" minlength=2  required/>
                    <div class="validation"></div>
                </div>

                
                
                <div class="form-group">
                    <select class="form-control" name="country" id="country" style="width:100%;"value="<?php echo set_value('country'); ?>">
                        <?php foreach ($items->result() as $item): ?>
                            <option value='<?php echo $item->id ?>'><?php echo $item->name ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <select class="form-control" name="region" id="region" style="width:100%;" value="<?php echo set_value('region'); ?>" disabled>
                    </select>
                </div>
              </div>
              
              <div class="col-xs-12" style="text-align:center">
                <!-- Button -->
                <button type="submit" id="submit" name="submit" class="form btn btn-xl contact-form-button light-form-button" value="ok" >Registrarme</button>
              </div>
          </form>
          
        </div>
      </div>
    </section>
    <!--/ registro-->
    <?php endif; ?>

     <!--Footer-->
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
    <!--/ Footer-->
     <script>
        $("#country").on("change", function()
        {
            getRegions();
        });

        $("#country").on("click", function()
        {
            getRegions();
        });

        function getRegions()
        {
            $.ajaxSetup({
                headers: {
                },
                async: false,
            })
            $.post("/ajax/ajaxRegions", {
                'countryId': $("#country").val()
            },
            function(data, status){
                var regions = document.getElementById("region");
                if(data != "")
                {
                    regions.innerHTML = "";
                    var datos = JSON.parse(data);
                    if(datos[0] !== "undefined")
                    {
                        regions.innerHTML = "<option value=NULL>Otro</option>";
                        $.each(datos, function(i, item){
                            regions.innerHTML = regions.innerHTML + "<option value='" + datos[i].id + "'>" + datos[i].name + "</option>";
                        });
                        regions.disabled = false;
                    }
                }
                else
                {
                    regions.disabled = true;
                }
                
            }
            );
        }
        $("#country").select2({
            placeholder: {
                id: '-1', // the value of the option
                text: 'Seleccionar una opción'
            },
            allowClear: true,
            tags: true
        });
        $("#region").select2({
            placeholder: {
                id: '-1', // the value of the option
                text: 'Seleccionar una opción'
            },
            allowClear: true,
        });
     </script>   
    </body>
</html>