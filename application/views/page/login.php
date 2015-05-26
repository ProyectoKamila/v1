<!DOCTYPE html>
<html lang="es">

    <head>
        <base href="<?php echo base_url(); ?>" />
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Casino4As</title>


        <link href="style.css" rel="stylesheet">
        <!-- Bootstrap Core CSS -->
        <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="dist/css/sb-admin-2.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body>

        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-2">
                    <div class="login-panel panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Identificarse</h3>
                        </div>
                        <div class="panel-body">
                            <form role="form" method="post" action="./login">
                                <fieldset>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon">@</span>
                                        <input type="text" class="form-control" name="namenick" placeholder="Username" value="sergio" required="" pattern=".{5,12}"title="5 a 12 caracteres">
                                    </div>
                                    <!--                                    <div class="form-group">
                                                                            <input class="form-control" placeholder="E-mail / Nickname" name="email" type="email" autofocus>
                                                                        </div>-->
                                    <div class="form-group input-group">
                                        <span class="input-group-addon fa fa-key" style="display: table-cell;"></span>
                                        <input class="form-control" placeholder="Password" name="password" type="password" value="123456" required=""><!-- Pr4y2ct4 -->
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input name="remember" type="checkbox" value="1">No cerrar sesi&oacute;n
                                        </label>
                                    </div>
                                    <!-- Change this to a button or input when using this as a form -->
                                    <!--<a href="index.html" class="btn btn-lg btn-success btn-block">iniciar sesi&oacute;n</a>-->
                                    <input type="submit" name="login" class="btn btn-lg btn-success btn-block" value="Iniciar Sesi&oacute;n"/>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="login-panel panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Registrate</h3>
                        </div>
                        <div class="panel-body">
                            <?php echo form_open("/check") ?>
                        <!--     <form role="form" method="post" action="./registering"> -->
                                <fieldset>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon">@</span>
                                        <input type="hidden" name="id_user_account_status" value="0" />
                                        <input type="text" class="form-control" name="nickname" value="<?php echo set_value('nickname') ?>" placeholder="Username" required="" pattern=".{5,12}"title="5 a 12 caracteres">
                                        
                                        <font color="red" style="font-weight: bold; font-size: 14px; text-decoration: underline"><?php echo form_error('nickname'); ?></font>
                                        
                                    </div>
                                    <fieldset>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon">@</span>
                                            <input type="email" class="form-control" name="email" value="<?php echo set_value('email') ?>" placeholder="Correo" required="">
                                            <font color="red" style="font-weight: bold; font-size: 14px; text-decoration: underline"><?php echo form_error('email'); ?></font>
                                        </div>
                                        <!--                                    <div class="form-group">
                                                                                <input class="form-control" placeholder="E-mail / Nickname" name="email" type="email" autofocus>
                                                                            </div>-->
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
                                        <input type="submit" name="login" class="btn btn-lg btn-success btn-block" value="Registrarme"/>
                                    </fieldset>
                          <?php echo form_close() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
