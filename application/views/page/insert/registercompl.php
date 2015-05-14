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
                <div class="col-md-4 col-md-offset-4">
                    <div class="login-panel panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Complete su Registro</h3>
                        </div>
                        <div class="panel-body">
                            <?php echo form_open("/recibirdc") ?>
                            <!--     <form role="form" method="post" action="./registering"> -->
                            <fieldset>

                                <div class="form-group input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>
                                    <input class="form-control" placeholder="N° de Identificación" name="identity_card" type="text" value="<?php echo set_value('identity_card') ?>"required=""> 
                                    <font color="red" style="font-weight: bold; font-size: 8px; text-decoration: underline"><?php echo form_error('identity_card'); ?></font>
                                </div>

                                <div class="form-group input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>
                                    <input type="hidden" name="status" value="0" />
                                    <input type="text" class="form-control" name="firstname" value="<?php echo set_value('firstname') ?>" placeholder="Nombre" required="" pattern=".{3,20}"title="5 a 12 caracteres">

                                    <font color="red" style="font-weight: bold; font-size: 8px; text-decoration: underline"><?php echo form_error('nickname'); ?></font>

                                </div>


                                <div class="form-group input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>
                                    <input type="text" class="form-control" name="lastname" value="<?php echo set_value('lastname') ?>" placeholder="Apellido" required="" pattern=".{3,20}"title="5 a 12 caracteres">
                                    <font color="red" style="font-weight: bold; font-size: 8px; text-decoration: underline"><?php echo form_error('email'); ?></font>
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>

                                    <input class="form-control" placeholder="Fecha de Nacimiento" name="date_of_birth" type="text" value="<?php echo set_value('date_of_birth') ?>"required=""> 
                                    <font color="red" style="font-weight: bold; font-size: 8px; text-decoration: underline"><?php echo form_error('date_of_birth'); ?></font>

                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>

                                    <select class="form-control" name="gender" value="<?php echo set_value('gender') ?>">
                                        <option value="">...</option>
                                        <option value="M">Masculino</option>
                                        <option value="F">Femenino</option>

                                    </select>

                                </div>

                                <div class="form-group input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>

                                    <input class="form-control" placeholder="N° de Teléfono" name="phone" type="text" value="<?php echo set_value('phone') ?>"required=""> 
                                    <font color="red" style="font-weight: bold; font-size: 8px; text-decoration: underline"><?php echo form_error('phone'); ?></font>

                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>
                                    <input class="form-control" placeholder="Nacionalidad" name="nationality" type="text" value="<?php echo set_value('nationality') ?>"required=""> 
                                    <font color="red" style="font-weight: bold; font-size: 8px; text-decoration: underline"><?php echo form_error('nationality'); ?></font>
                                </div>



                                <div class="form-group input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>
                                    <input class="form-control" placeholder="País" name="country" type="text" value="<?php echo set_value('country') ?>"required=""> 
                                    <font color="red" style="font-weight: bold; font-size: 8px; text-decoration: underline"><?php echo form_error('country'); ?></font>
                                </div>

                                <div class="form-group input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>

                                    <input class="form-control" placeholder="Ciudad" name="city" type="text" value="<?php echo set_value('city') ?>"required=""> 
                                    <font color="red" style="font-weight: bold; font-size: 8px; text-decoration: underline"><?php echo form_error('city'); ?></font>

                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>

                                    <input class="form-control" placeholder="Dirección" name="address" type="address" value="<?php echo set_value('address') ?>"required=""> 
                                    <font color="red" style="font-weight: bold; font-size: 8px; text-decoration: underline"><?php echo form_error('address'); ?></font>

                                </div>


                                <input class="form-control" placeholder="" name="registration_date" type="hidden" value="<?php echo set_value('registration_date') ?>"required=""> 
                                <input class="form-control" placeholder="" name="id_user" type="hidden" value="<?php echo set_value('id_user') ?>"required=""> 

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
