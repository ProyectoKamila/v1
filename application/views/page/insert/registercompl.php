<div id="page-wrapper" class="custom-login-panel">

    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">

                <div class="login-panel panel panel-default custom-login-panel">
                    <div class="panel-heading custom-panel-heading">
                        <h3 class="panel-title custom-panel-title"><?php
                            if ($this->session->flashdata('mensaje') != false) {
                                echo $this->session->flashdata('mensaje');
                            } elseif (isset($dat)) {
                                echo 'Datos Personales ';
                            } else {
                                ?>Complete su Registro<?php } ?></h3>
                    </div>
                    <div class="panel-body custom-panel-body">
                        <?php echo form_open_multipart("/receivingdc") ?>
                        <!--     <form role="form" method="post" action="./registering"> -->
                        <fieldset>
                            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 sin-padding">
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><span class="fa fa-eye-slash"></span></span>

                                    <input class="form-control" name="id_user" type="hidden" value="<?php
                                    if (isset($data)) {
                                        echo $data;
                                    }
                                    ?>" required=""> 
                                    <input class="form-control" name="id_user_account_status" type="hidden" value="2" required=""> 
                                    <input class="form-control" placeholder="N° de Identificación" name="identity_card" type="text" value="<?php
                                    if (isset($dat)) {
                                        echo $dat[0]['identity_card'];
                                    } else
                                        echo set_value('identity_card')
                                        ?>"required="" <?php if (!isset($dat[0]['identity_card'])) { echo 'readonly="readonly"';} ?>> 
                                    <font color="red" style="font-weight: bold; font-size: 8px; text-decoration: underline"><?php echo form_error('identity_card'); ?></font>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 sin-padding">
                                <div class="form-group input-group sin-padding">
                                    <span class="input-group-addon"><span class="fa fa-user"></span></span>
                                    <input type="hidden" name="id_user_account_status" value="0" />
                                    <input type="text" class="form-control" name="firstname" value="<?php
                                    if (isset($dat)) {
                                        echo $dat[0]['first_name'];
                                    } else
                                        echo set_value('firstname')
                                        ?>" placeholder="Nombre" required="" pattern=".{3,20}"title="5 a 12 caracteres">

                                    <font color="red" style="font-weight: bold; font-size: 8px; text-decoration: underline"><?php echo form_error('nickname'); ?></font>

                                </div>
                            </div>

                            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 sin-padding">
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><span class="fa fa-user"></span></span>
                                    <input type="text" class="form-control" name="lastname" value="<?php
                                    if (isset($dat)) {
                                        echo $dat[0]['last_name'];
                                    } else
                                        echo set_value('lastname')
                                        ?>" placeholder="Apellido" required="" pattern=".{3,20}"title="5 a 12 caracteres">
                                    <font color="red" style="font-weight: bold; font-size: 8px; text-decoration: underline"><?php echo form_error('email'); ?></font>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 sin-padding">
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                    <input class="form-control" placeholder="Fecha de Nacimiento" name="date_of_birth" type="text" value="<?php
                                    if (isset($dat)) {
                                        echo $dat[0]['date_of_birth'];
                                    } else
                                        echo set_value('date_of_birth')
                                        ?>"required=""> 
                                    <font color="red" style="font-weight: bold; font-size: 8px; text-decoration: underline"><?php echo form_error('date_of_birth'); ?></font>

                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 sin-padding">
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><span class="fa fa-users"></span></span>
                                    <select class="form-control" name="gender" value="<?php
                                    if (isset($dat)) {
                                        echo $dat[0]['gender'];
                                    } else
                                        echo set_value('gender')
                                        ?>">
                                        <option value="">...</option>
                                        <option <?php
                                        if (isset($dat) && $dat[0]['gender'] == 'M') {
                                            echo 'selected';
                                        }
                                        ?> value="M">Masculino</option>
                                        <option <?php
                                        if (isset($dat) && $dat[0]['gender'] == 'F') {
                                            echo 'selected';
                                        }
                                        ?> value="F">Femenino</option>

                                    </select>

                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 sin-padding">
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><span class="fa fa-phone" ></span></span>

                                    <input class="form-control" placeholder="N° de Teléfono" name="phone" type="text" value="<?php
                                    if (isset($dat)) {
                                        echo $dat[0]['phone'];
                                    } else
                                        echo set_value('phone')
                                        ?>"required=""> 
                                    <font color="red" style="font-weight: bold; font-size: 8px; text-decoration: underline"><?php echo form_error('phone'); ?></font>

                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 sin-padding">
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><span class="fa fa-globe" ></span></span>
                                    <input class="form-control" placeholder="Nacionalidad" name="nationality" type="text" value="<?php
                                    if (isset($dat)) {
                                        echo $dat[0]['nationality'];
                                    } else
                                        echo set_value('nationality')
                                        ?>"required=""> 
                                    <font color="red" style="font-weight: bold; font-size: 8px; text-decoration: underline"><?php echo form_error('nationality'); ?></font>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 sin-padding">
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><span class="fa fa-map-marker"></span></span>
                                    <input class="form-control" placeholder="País" name="country" type="text" value="<?php
                                    if (isset($dat)) {
                                        echo $dat[0]['country'];
                                    } else
                                        echo set_value('country')
                                        ?>"required=""> 
                                    <font color="red" style="font-weight: bold; font-size: 8px; text-decoration: underline"><?php echo form_error('country'); ?></font>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 sin-padding">
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><span class="fa fa-location-arrow"></span></span>

                                    <input class="form-control" placeholder="Ciudad" name="city" type="text" value="<?php
                                    if (isset($dat)) {
                                        echo $dat[0]['city'];
                                    } else
                                        echo set_value('city')
                                        ?>"required=""> 
                                    <font color="red" style="font-weight: bold; font-size: 8px; text-decoration: underline"><?php echo form_error('city'); ?></font>

                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sin-padding">

                                <div class="form-group input-group">
                                    <span class="input-group-addon"><span class="fa fa-location-arrow" aria-hidden="true"></span></span>

                                    <input class="form-control" placeholder="Dirección" name="address" type="address" value="<?php
                                    if (isset($dat)) {
                                        echo $dat[0]['address'];
                                    } else
                                        echo set_value('address')
                                        ?>"required=""> 
                                    <font color="red" style="font-weight: bold; font-size: 8px; text-decoration: underline"><?php echo form_error('address'); ?></font>

                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sin-padding">
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><span class="fa fa-photo" aria-hidden="true"></span></span>

                                    <input class="form-control" placeholder="Imagen" name="userfile" type="file" > 


                                </div>
                            </div>

                            <input class="form-control" placeholder="" name="registration_date" type="hidden" value="<?php
                            if (isset($dat)) {
                                echo $dat[0]['registration_date'];
                            } else
                                echo set_value('registration_date')
                                ?>"required=""> 
                            <!-- Change this to a button or input when using this as a form -->
                            <!--<a href="index.html" class="btn btn-lg btn-success btn-block">iniciar sesi&oacute;n</a>-->
                            <div class="clearfix"></div>
                            <input type="submit" name="login" class="btn btn-lg btn-success btn-block" value="<?php
                                   if (isset($dat)) {
                                       echo 'Guardar Cambios';
                                   } else {
                                       ?>Registrarme<?php } ?>"/>

                        </fieldset>
                        <?php echo form_close() ?>
                    </div>
                </div>
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
