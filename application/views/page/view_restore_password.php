<!DOCTYPE html>
<html lang="es">

    <head>
        <base href="<?php echo base_url(); ?>" />
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Recuperar Contrase&ntilde;a - Casino4As</title>
        <link rel="stylesheet/less" type="text/css" href="css/main.less" />
         <link rel="stylesheet" type="text/less" href="/interface/css/main.less">
        <script src="js/less.min.js"></script>
    </head>
    
    <body>
        
        <div class="container-fluid" style="<width:100%></width:100%>">
                    <div class="container-fluid sin-padding">
            <div class="row">
                <div class="col-xs-12 sin-padding">
                    <header class="navegation">
                        <div class="container sin-padding">
                            <div class="row">
                                <div id="menu1" class="col-lg-offset-1 col-lg-3 col-md-4 hidden-sm hidden-xs sin-padding col-xs-offset-0 col-xs-12">
                                    <ul class="nav nav-pills">
                                        <li role="presentation" class=""><a href="http://casino4as.com">INICIO</a></li>
                                        <li role="presentation"><a href="http://casino4as.com/nosotros">NOSOTROS</a></li>
                                        <li role="presentation"><a href="http://casino4as.com/juego">JUEGOS</a></li>
                                    </ul>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-sm-offset-3 col-xs-8 col-md-offset-0 col-xs-6 col-xs-offset-3">

                                    <section class="logo">
                                        <a href="http://casino4as.com">
                                            <img src="http://casino4as.com/wp-content/themes/casino4as_wp/images/recortes/home/logo.png" alt="" >
                                        </a>	
                                    </section>

                                </div>
                                <div id="menu2"  class="col-lg-2 col-md-2 hidden-sm hidden-xs sin-padding col-xs-offset-0 col-xs-12">
                                    <ul class="nav nav-pills">
                                        <li role="presentation" class=""><a href="http://casino4as.com/casino/poker">PÓKER</a></li>
                                        <li role="presentation"><a href="http://casino4s.com/casino/blog">BLOG</a></li>
                                    </ul>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
                                    <div class="acceder">
                                        <div class="activator" onclick="activate();">
                                            <p>ACCEDER</p>
                                        </div>
                                        <div class="redes hidden-sm hidden-xs">
                                            <a href="">
                                                <img src="http://casino4as.com/wp-content/themes/casino4as_wp/images/recortes/home/face.png" alt="">
                                            </a>
                                            <a href="">
                                                <img src="http://casino4as.com/wp-content/themes/casino4as_wp/images/recortes/home/twit.png" alt="">
                                            </a>
                                            <a href="">
                                                <img src="http://casino4as.com/wp-content/themes/casino4as_wp/images/recortes/home/google.png" alt="">
                                            </a>
                                            <a href="" class="hidden-sm hidden-md">
                                                <img src="http://casino4as.com/wp-content/themes/casino4as_wp/images/recortes/home/pinterest.png" alt="">
                                            </a>
                                        </div>
                                        <div class="menu-botones visible-xs visible-sm">
                                            <span class="glyphicon glyphicon-th" id="menu-movil" onclick="menu_movil();"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </header>

                </div>
            </div>
        </div>
        
            <div class="row" style="margin-top:100px">
           
                <div class="clearfix"></div>
                <?php if($checks == true){ ?>
                
                
                <div class="col-md-4 col-md-offset-4">
                    <div class="login-panel panel panel-default  custom-login-panel">
                    <?php if ($this->session->flashdata('message')!= null){
                        echo "<div id='infoMessage' class='alert alert-danger' role='alert'>". $this->session->flashdata('message') ."</div>";
                        }
                    ?>
              
                        <div class="panel-heading custom-panel-heading">
                            <h3 class="panel-title custom-panel-title">Recuperar Contrase&ntilde;a</h3>
                        </div>
                        <div class="panel-body custom-panel-body">
                            <form role="form" method="post" action="./restore-password">
                                <label for="" style="color:white !important;">Introduzca el correo con el que se registro</label>
                                <fieldset>
                                   <div class="form-group input-group">
                                        <span class="input-group-addon">@</span>
                                        <input type="email" class="form-control" name="emailr" value="<?php echo set_value('email') ?>" placeholder="Correo" required="">
                                        <font color="red" style="font-weight: bold; font-size: 14px; text-decoration: underline"><?php echo form_error('email'); ?></font>
                                    </div>
                                    <!-- Change this to a button or input when using this as a form -->
                                    <!--<a href="index.html" class="btn btn-lg btn-success btn-block">iniciar sesi&oacute;n</a>-->
                                    <input type="submit" name="login" class="btn btn-lg btn-success btn-block" value="Iniciar Sesi&oacute;n"/>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
                
                
                
                <?php }else{ ?>
                <div class="col-md-4 col-md-offset-4">
                    <div class="login-panel panel panel-default  custom-login-panel">
                    <?php if ($this->session->flashdata('message')!= null){
                        echo "<div id='infoMessage' class='alert alert-danger' role='alert'>". $this->session->flashdata('message') ."</div>";
                        }
                    ?>
              
                        <div class="panel-heading custom-panel-heading">
                            <h3 class="panel-title custom-panel-title">Recuperar Contrase&ntilde;a</h3>
                        </div>
                        <div class="panel-body custom-panel-body">
                            <form role="form" method="post" action="./restore-password">
                                <input type="hidden" name="token" value="<?= $token; ?>" />
                                <fieldset>
                                   <div class="form-group input-group">
                                        <span class="input-group-addon">@</span>
                                        <input type="email" class="form-control" name="email" value="<?php echo set_value('email') ?>" placeholder="Correo" required="">
                                        <font color="red" style="font-weight: bold; font-size: 14px; text-decoration: underline"><?php echo form_error('email'); ?></font>
                                    </div>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon fa fa-key" style="display: table-cell;"></span>
                                       
                                       <input class="form-control" placeholder="Password" name="pass" type="password" value=""required=""> 
                                    </div>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon fa fa-key" style="display: table-cell;"></span>
                                    
                                    <input class="form-control" placeholder="Repeat Password" name="passc" type="password" value=""required=""> 
                                    <font color="red" style="font-weight: bold; font-size: 14px; text-decoration: underline"><?php echo form_error('pass'); ?></font>

                                    </div>
                                    <!-- Change this to a button or input when using this as a form -->
                                    <!--<a href="index.html" class="btn btn-lg btn-success btn-block">iniciar sesi&oacute;n</a>-->
                                    <input type="submit" name="login" class="btn btn-lg btn-success btn-block" value="Iniciar Sesi&oacute;n"/>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
        <footer>
    <div class="pre">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-lg-offset-4 col-md-4 col-md-offset-4 col-sm-12  col-xs-12 col-xs-offset-0 ">
                    <div class="redes ">
                        <a href="">
                            <img src="http://casino4as.com/wp-content/themes/casino4as_wp/images/recortes/home/face.png" alt="">
                        </a>
                        <a href="">
                            <img src="http://casino4as.com/wp-content/themes/casino4as_wp/images/recortes/home/twit.png" alt="">
                        </a>
                        <a href="">
                            <img src="http://casino4as.com/wp-content/themes/casino4as_wp/images/recortes/home/google.png" alt="">
                        </a>
                        <a href="">
                            <img src="http://casino4as.com/wp-content/themes/casino4as_wp/images/recortes/home/pinterest.png" alt="">
                        </a>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                    <div class="logo-footer">
                        <img src="http://casino4as.com/wp-content/themes/casino4as_wp/images/recortes/home/logo-footer.png" alt="">
                    </div>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 hidden-xs hidden-sm">
                    <p class="copy">www.casino4s.com. Todos los derechos reservados<br>
                        Desarrollado por Proyecto Kamila</p>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                    <ul class="nav nav-pills">
                        <li role="presentation"><a href="http://casino4as.com">Inicio</a></li>
                        <li role="presentation"><a href="http://casino4as.com/nosotros">Nosotros</a></li>
                        <li role="presentation"><a href="http://casino4as.com/juego">Juegos</a></li>
                        <li role="presentation"><a href="http://casino4as.com/casino/poker">Póker</a></li>
                        <li role="presentation"><a href="http://casino4as.com/blog">Blog</a></li>
                    </ul>
                    <div class="clearfix"></div>
                    <p class="telefono hidden-xs"><span class="glyphicon glyphicon-earphone "></span> 900 234 80 32 <span class="glyphicon glyphicon-envelope email"></span> soporte@casino4as.com</p>
                    <div class="visible-xs">
                        <p class="telefono"> <span class="glyphicon glyphicon-earphone "></span> 900 234 80 32 </p>
                        <p class="telefono"> <span class="glyphicon glyphicon-envelope email"></span> soporte@casino4as.com</p>
                    </div>
                </div>
                <div class=" col-xs-12 visible-xs visible-sm">
                    <p class="copy">www.casino4s.com. Todos los derechos reservados<br>
                        Desarrollado por Proyecto Kamila</p>
                </div>
            </div>
        </div>
    </div>
</div>
</footer>

        <!-- jQuery -->
        <script src="bower_components/jquery/dist/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="bower_components/metisMenu/dist/metisMenu.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="dist/js/sb-admin-2.js"></script>

    </body>

</html>
