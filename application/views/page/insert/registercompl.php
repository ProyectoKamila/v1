<?php //debug($dat[0]['imageprofile']); ?>
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
                            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 sin-padding col-lg-offset-4 col-sm-offset-3 col-xs-offset-3 ">
                                <?php 
                                if(isset($dat[0]['imageprofile']) &&  $dat[0]['imageprofile'] != null){
                                    $img = $dat[0]['imageprofile'];
                                }else{
                                    $img = './interface/images/recortes/home/logo.png';
                                }
                                
                                 ?>
                                <div class="img-profile" id="img-c" style="background: url(<?=$img;?>)no-repeat;background-position: center;background-size: cover;">
                                    <!--<img src="./interface/images/recortes/home/logo.png" alt="">-->
                                </div>      
                                
                                
                                
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sin-padding">
                                    <p style="color:white;">Por favor adjunte su imagen de perfil.</p>
                                    <div class="form-group input-group">
                                        
                                        <span class="input-group-addon"><span class="fa fa-photo" aria-hidden="true"></span></span>
    
                                        <input class="form-control" placeholder="Imagen" name="userfile2" type="file" > 
    
    
                                    </div>
                                </div>
                                
                            </div>
                            <div class="clearfix"></div>
                             <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 sin-padding">
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><span class="fa fa-users"></span></span>
                                    <select style="color:black" class="form-control" name="nationality" value="<?php
                                    if (isset($dat)) {
                                        echo $dat[0]['nationality'];
                                    } else
                                        echo set_value('nationality')
                                        ?>">
                                        <option value="">Nacionalidad</option>
                                        <option <?php
                                        if (isset($dat) && $dat[0]['nationality'] == 'V') {
                                            echo 'selected';
                                        }
                                        ?> value="V">Venezolano</option>
                                        <option <?php
                                        if (isset($dat) && $dat[0]['gender'] == 'E') {
                                            echo 'selected';
                                        }
                                        ?> value="E">Extranjero</option>

                                    </select>

                                </div>
                            </div>
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
                                        ?>"required="" <?php if (isset($dat[0]['identity_card'])) { echo 'readonly="readonly"';} ?>> 
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
                                    <input class="form-control" placeholder="Fecha de Nacimiento" name="date_of_birth" type="date" value="<?php
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
                                    <select  class="form-control select-country" name="gender" value="<?php
                                    if (isset($dat)) {
                                        echo $dat[0]['gender'];
                                    } else
                                        echo set_value('gender')
                                        ?>">
                                        <option value="">Sexo</option>
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
                                    <span class="input-group-addon"><span class="fa fa-map-marker"></span></span>
                                    
                                    <!--<input class="form-control" placeholder="País" name="country" type="text" value="<?php
                                    //if (isset($dat)) {-->
                                     // echo $dat[0]['country'];-->
                                    //} else-->
                                    //  echo set_value('country')-->
                                    ?>"required=""> -->
                                    <select name="country" class="form-control select-country" id="" >
                                        <option value="AF">Afganistán</option>
                                        <option value="AL">Albania</option>
                                        <option value="DE">Alemania</option>
                                        <option value="AD">Andorra</option>
                                        <option value="AO">Angola</option>
                                        <option value="AI">Anguilla</option>
                                        <option value="AQ">Antártida</option>
                                        <option value="AG">Antigua y Barbuda</option>
                                        <option value="AN">Antillas Holandesas</option>
                                        <option value="SA">Arabia Saudí</option>
                                        <option value="DZ">Argelia</option>
                                        <option value="AR">Argentina</option>
                                        <option value="AM">Armenia</option>
                                        <option value="AW">Aruba</option>
                                        <option value="AU">Australia</option>
                                        <option value="AT">Austria</option>
                                        <option value="AZ">Azerbaiyán</option>
                                        <option value="BS">Bahamas</option>
                                        <option value="BH">Bahrein</option>
                                        <option value="BD">Bangladesh</option>
                                        <option value="BB">Barbados</option>
                                        <option value="BE">Bélgica</option>
                                        <option value="BZ">Belice</option>
                                        <option value="BJ">Benin</option>
                                        <option value="BM">Bermudas</option>
                                        <option value="BY">Bielorrusia</option>
                                        <option value="MM">Birmania</option>
                                        <option value="BO">Bolivia</option>
                                        <option value="BA">Bosnia y Herzegovina</option>
                                        <option value="BW">Botswana</option>
                                        <option value="BR">Brasil</option>
                                        <option value="BN">Brunei</option>
                                        <option value="BG">Bulgaria</option>
                                        <option value="BF">Burkina Faso</option>
                                        <option value="BI">Burundi</option>
                                        <option value="BT">Bután</option>
                                        <option value="CV">Cabo Verde</option>
                                        <option value="KH">Camboya</option>
                                        <option value="CM">Camerún</option>
                                        <option value="CA">Canadá</option>
                                        <option value="TD">Chad</option>
                                        <option value="CL">Chile</option>
                                        <option value="CN">China</option>
                                        <option value="CY">Chipre</option>
                                        <option value="VA">Ciudad del Vaticano (Santa Sede)</option>
                                        <option value="CO">Colombia</option>
                                        <option value="KM">Comores</option>
                                        <option value="CG">Congo</option>
                                        <option value="CD">Congo, República Democrática del</option>
                                        <option value="KR">Corea</option>
                                        <option value="KP">Corea del Norte</option>
                                        <option value="CI">Costa de Marfíl</option>
                                        <option value="CR">Costa Rica</option>
                                        <option value="HR">Croacia (Hrvatska)</option>
                                        <option value="CU">Cuba</option>
                                        <option value="DK">Dinamarca</option>
                                        <option value="DJ">Djibouti</option>
                                        <option value="DM">Dominica</option>
                                        <option value="EC">Ecuador</option>
                                        <option value="EG">Egipto</option>
                                        <option value="SV">El Salvador</option>
                                        <option value="AE">Emiratos Árabes Unidos</option>
                                        <option value="ER">Eritrea</option>
                                        <option value="SI">Eslovenia</option>
                                        <option value="ES" selected>España</option>
                                        <option value="US">Estados Unidos</option>
                                        <option value="EE">Estonia</option>
                                        <option value="ET">Etiopía</option>
                                        <option value="FJ">Fiji</option>
                                        <option value="PH">Filipinas</option>
                                        <option value="FI">Finlandia</option>
                                        <option value="FR">Francia</option>
                                        <option value="GA">Gabón</option>
                                        <option value="GM">Gambia</option>
                                        <option value="GE">Georgia</option>
                                        <option value="GH">Ghana</option>
                                        <option value="GI">Gibraltar</option>
                                        <option value="GD">Granada</option>
                                        <option value="GR">Grecia</option>
                                        <option value="GL">Groenlandia</option>
                                        <option value="GP">Guadalupe</option>
                                        <option value="GU">Guam</option>
                                        <option value="GT">Guatemala</option>
                                        <option value="GY">Guayana</option>
                                        <option value="GF">Guayana Francesa</option>
                                        <option value="GN">Guinea</option>
                                        <option value="GQ">Guinea Ecuatorial</option>
                                        <option value="GW">Guinea-Bissau</option>
                                        <option value="HT">Haití</option>
                                        <option value="HN">Honduras</option>
                                        <option value="HU">Hungría</option>
                                        <option value="IN">India</option>
                                        <option value="ID">Indonesia</option>
                                        <option value="IQ">Irak</option>
                                        <option value="IR">Irán</option>
                                        <option value="IE">Irlanda</option>
                                        <option value="BV">Isla Bouvet</option>
                                        <option value="CX">Isla de Christmas</option>
                                        <option value="IS">Islandia</option>
                                        <option value="KY">Islas Caimán</option>
                                        <option value="CK">Islas Cook</option>
                                        <option value="CC">Islas de Cocos o Keeling</option>
                                        <option value="FO">Islas Faroe</option>
                                        <option value="HM">Islas Heard y McDonald</option>
                                        <option value="FK">Islas Malvinas</option>
                                        <option value="MP">Islas Marianas del Norte</option>
                                        <option value="MH">Islas Marshall</option>
                                        <option value="UM">Islas menores de Estados Unidos</option>
                                        <option value="PW">Islas Palau</option>
                                        <option value="SB">Islas Salomón</option>
                                        <option value="SJ">Islas Svalbard y Jan Mayen</option>
                                        <option value="TK">Islas Tokelau</option>
                                        <option value="TC">Islas Turks y Caicos</option>
                                        <option value="VI">Islas Vírgenes (EEUU)</option>
                                        <option value="VG">Islas Vírgenes (Reino Unido)</option>
                                        <option value="WF">Islas Wallis y Futuna</option>
                                        <option value="IL">Israel</option>
                                        <option value="IT">Italia</option>
                                        <option value="JM">Jamaica</option>
                                        <option value="JP">Japón</option>
                                        <option value="JO">Jordania</option>
                                        <option value="KZ">Kazajistán</option>
                                        <option value="KE">Kenia</option>
                                        <option value="KG">Kirguizistán</option>
                                        <option value="KI">Kiribati</option>
                                        <option value="KW">Kuwait</option>
                                        <option value="LA">Laos</option>
                                        <option value="LS">Lesotho</option>
                                        <option value="LV">Letonia</option>
                                        <option value="LB">Líbano</option>
                                        <option value="LR">Liberia</option>
                                        <option value="LY">Libia</option>
                                        <option value="LI">Liechtenstein</option>
                                        <option value="LT">Lituania</option>
                                        <option value="LU">Luxemburgo</option>
                                        <option value="MK">Macedonia, Ex-República Yugoslava de</option>
                                        <option value="MG">Madagascar</option>
                                        <option value="MY">Malasia</option>
                                        <option value="MW">Malawi</option>
                                        <option value="MV">Maldivas</option>
                                        <option value="ML">Malí</option>
                                        <option value="MT">Malta</option>
                                        <option value="MA">Marruecos</option>
                                        <option value="MQ">Martinica</option>
                                        <option value="MU">Mauricio</option>
                                        <option value="MR">Mauritania</option>
                                        <option value="YT">Mayotte</option>
                                        <option value="MX">México</option>
                                        <option value="FM">Micronesia</option>
                                        <option value="MD">Moldavia</option>
                                        <option value="MC">Mónaco</option>
                                        <option value="MN">Mongolia</option>
                                        <option value="MS">Montserrat</option>
                                        <option value="MZ">Mozambique</option>
                                        <option value="NA">Namibia</option>
                                        <option value="NR">Nauru</option>
                                        <option value="NP">Nepal</option>
                                        <option value="NI">Nicaragua</option>
                                        <option value="NE">Níger</option>
                                        <option value="NG">Nigeria</option>
                                        <option value="NU">Niue</option>
                                        <option value="NF">Norfolk</option>
                                        <option value="NO">Noruega</option>
                                        <option value="NC">Nueva Caledonia</option>
                                        <option value="NZ">Nueva Zelanda</option>
                                        <option value="OM">Omán</option>
                                        <option value="NL">Países Bajos</option>
                                        <option value="PA">Panamá</option>
                                        <option value="PG">Papúa Nueva Guinea</option>
                                        <option value="PK">Paquistán</option>
                                        <option value="PY">Paraguay</option>
                                        <option value="PE">Perú</option>
                                        <option value="PN">Pitcairn</option>
                                        <option value="PF">Polinesia Francesa</option>
                                        <option value="PL">Polonia</option>
                                        <option value="PT">Portugal</option>
                                        <option value="PR">Puerto Rico</option>
                                        <option value="QA">Qatar</option>
                                        <option value="UK">Reino Unido</option>
                                        <option value="CF">República Centroafricana</option>
                                        <option value="CZ">República Checa</option>
                                        <option value="ZA">República de Sudáfrica</option>
                                        <option value="DO">República Dominicana</option>
                                        <option value="SK">República Eslovaca</option>
                                        <option value="RE">Reunión</option>
                                        <option value="RW">Ruanda</option>
                                        <option value="RO">Rumania</option>
                                        <option value="RU">Rusia</option>
                                        <option value="EH">Sahara Occidental</option>
                                        <option value="KN">Saint Kitts y Nevis</option>
                                        <option value="WS">Samoa</option>
                                        <option value="AS">Samoa Americana</option>
                                        <option value="SM">San Marino</option>
                                        <option value="VC">San Vicente y Granadinas</option>
                                        <option value="SH">Santa Helena</option>
                                        <option value="LC">Santa Lucía</option>
                                        <option value="ST">Santo Tomé y Príncipe</option>
                                        <option value="SN">Senegal</option>
                                        <option value="SC">Seychelles</option>
                                        <option value="SL">Sierra Leona</option>
                                        <option value="SG">Singapur</option>
                                        <option value="SY">Siria</option>
                                        <option value="SO">Somalia</option>
                                        <option value="LK">Sri Lanka</option>
                                        <option value="PM">St Pierre y Miquelon</option>
                                        <option value="SZ">Suazilandia</option>
                                        <option value="SD">Sudán</option>
                                        <option value="SE">Suecia</option>
                                        <option value="CH">Suiza</option>
                                        <option value="SR">Surinam</option>
                                        <option value="TH">Tailandia</option>
                                        <option value="TW">Taiwán</option>
                                        <option value="TZ">Tanzania</option>
                                        <option value="TJ">Tayikistán</option>
                                        <option value="TF">Territorios franceses del Sur</option>
                                        <option value="TP">Timor Oriental</option>
                                        <option value="TG">Togo</option>
                                        <option value="TO">Tonga</option>
                                        <option value="TT">Trinidad y Tobago</option>
                                        <option value="TN">Túnez</option>
                                        <option value="TM">Turkmenistán</option>
                                        <option value="TR">Turquía</option>
                                        <option value="TV">Tuvalu</option>
                                        <option value="UA">Ucrania</option>
                                        <option value="UG">Uganda</option>
                                        <option value="UY">Uruguay</option>
                                        <option value="UZ">Uzbekistán</option>
                                        <option value="VU">Vanuatu</option>
                                        <option value="VE">Venezuela</option>
                                        <option value="VN">Vietnam</option>
                                        <option value="YE">Yemen</option>
                                        <option value="YU">Yugoslavia</option>
                                        <option value="ZM">Zambia</option>
                                        <option value="ZW">Zimbabue</option>
                                    </select>
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
                                <p style="color:white;">Por favor adjunte su documento de identidad escaneado.</p>
                                <div class="form-group input-group">
                                    
                                    <span class="input-group-addon"><span class="fa fa-photo" aria-hidden="true"></span></span>

                                    <input class="form-control" placeholder="Imagen" name="userfile" type="file" > 


                                </div>
                            </div>
                            <!--<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sin-padding">
                                <p style="color:white;">Por favor adjunte su imagen de perfil.</p>
                                <div class="form-group input-group">
                                    
                                    <span class="input-group-addon"><span class="fa fa-photo" aria-hidden="true"></span></span>

                                    <input class="form-control" placeholder="Imagen" name="userfile2" type="file" > 


                                </div>
                            </div>-->
                            <?php if(!isset($term)){ ?>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sin-padding">
                                <p style="color:white;">Acepta ud los terminos y condiciones.</p>
                                <input type="checkbox" name="acepto" required/>
                            </div>
                            <?php } ?>
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
<style type="text/css">
    .img-profile {
    display: block;
    max-width: 200px;
    max-height: 200px;
    margin: 0 auto;
    clear: both;
    border-radius: 50%;
    overflow: hidden;
    border: 1px solid;
    height: 100%;
    width: 100%;
}


</style>