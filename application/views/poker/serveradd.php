<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<?php $this->load->view('page/header'); ?>

<?php $this->load->view('page/navegation/header'); ?>
<?php $this->load->view('page/navegation/notification'); ?>
</div>
<style>
                #boxpass {
                    background-color: #2B2A26;
                    width: 80%;
                    margin: 0 auto;
                    text-align: center;
                    padding: 10px;
                }
                
                a#buttonjoingame {
                    margin-top: 10px;
                }
                section#creating-sale {
                    background-color: #2B2A26;
                }
                #passloss {
                    background-color: transparent !important;
                    padding: 7px;
                    margin: 0px;
                    border: none !important;
                    background-image: none;
                    box-shadow: none;
                    color: #731010;
                    font-weight: bold;
                }
                #creating-sale .title-white span {
                        background-color: transparent;
                        font-size: 30px;
                        font-weight: bold;
                        color: #d3cf49;
                    }
                    .create-salas .input-group span {
                        background: white;
                        color: #d3cf49;
                        border: 0px;
                        outline: 0px;
                        border-bottom: 2px solid #9C9B97 !important;
                        border-right: 0px !important;
                    }
                    div .input-group * {
                        background-color: transparent !important;
                        border: 1px solid #9C9B97 !important;
                        height: 35px !important;
                        color: white;
                        font-weight: 100;
                        text-transform: uppercase;
                        text-shadow: none;
                        border-radius: 0px !important;
                    }
                    a#buttoncreate:hover {
                        color: #d3cf49;
                        text-shadow: none;
                    }
                    #maxus option {
                        color: black;
                    }
            </style>
<div class="container-fluid ">
    <div class="row" id='rowsales'>
        <div class="col-lg-9 col-md-10 col-sm-10 hidden-xs content-game poker sin-padding" id="">

            <div class="container-fluid sin-padding" id="torbo">
                <div class="row">
                    <div class="col-lg-10 col-md-10 col-sm-10 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 hidden-xs sin-padding" id="">
                        <div class="alert alert-danger" style="display: none;" role="alert" id="user-conect">!!Aff, Ya se encuentra conectado, revise los dispositivos conectados <a class="btn btn-default link-error" id="" href="./dispositivos">AQUI...</a></div>
                        <div class="alert alert-info alert-reward" style="display: none;" role="alert" id="boxsitdown"> 
                            <p>Arraste para selecionar la cantidad que deseas recargar... </p>
                            <span class="input-group-addon" id="sizing-addon3">Fichas</span>
                            <input type="range" oninput="outputUpdate(value)" step="1" class="form-control drag" placeholder="Minimo de coin para apostar" min="" max="" aria-describedby="sizing-addon3" id="inputapos">
                            <p>Entrar con <output for="fader" id="volume">--</output> </p>


                            <a class="btn btn-default link-error" id="buttonsitdown">SENTARSE</a>
                            <span class="glyphicon glyphicon-remove-circle close" onclick="ocultar_carga();"></span>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-lg-12 col-md-12 col-sm-12 hidden-xs" id="">
                        <div class="alert alert-danger" style="display: none;" role="alert" id="connection-lost-message">Se ha perdido la conexión. intente <a class="btn btn-default link-error" id="buttonreconect">reconectar...</a></div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-lg-12 col-md-12 col-sm-12 hidden-xs" id="game">
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-lg-10 col-md-10 col-sm-10 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 hidden-xs" id="sales">

                    </div>
                    <div class="clearfix"></div>
                    <div class="input-group input-group-sm col-lg-12 col-md-12 col-sm-12 hidden-xs" style="display: none" id="boxpass">
                        <div class="input-group input-group-sm col-lg-12 col-md-12 col-sm-12 hidden-xs" style="border: 0px !important">
                            <div class="alert alert-danger" style="display: none;" role="alert" id="passloss"></div>
                            <input type="password" class="form-control" placeholder="Clave" aria-describedby="sizing-addon3" id="passbox">
                            <a class="btn btn-default link-error" id="buttonjoingame">Acceder</a>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            
            <section class="create-salas register-form col-lg-6 col-md-6 col-sm-6 col-lg-offset-3 col-md-offset-3 col-sm-offset-3" id="creating-sale">
                <span class="glyphicon glyphicon-remove-circle close" onclick="ocultar_create_sala();"></span>
                <div class="col-xs-12 ">
                    <h2 class="title-white">Crear una sala<span class="label label-default">Diviertete!</span></h2>                    
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 hidden-xs sin-pading" id="newsale">
                    <div class="input-group input-group-sm col-lg-12 col-md-12 col-sm-12 hidden-xs">
                        <span class="input-group-addon glyphicon glyphicon-ok" id="sizing-addon3">
                        </span>
                        <input type="text" class="form-control" placeholder="nombre de la sala" aria-describedby="sizing-addon3" id="namesale">
                    </div>
                    <div class="input-group input-group-sm col-lg-12 col-md-12 col-sm-12 hidden-xs">
                        <span class="input-group-addon glyphicon glyphicon-lock" id="sizing-addon3"></span>
                        <input type="password" class="form-control" placeholder="Clave" aria-describedby="sizing-addon3" id="passsale">
                    </div>
                    <div class="input-group input-group-sm col-lg-12 col-md-12 col-sm-12 hidden-xs">
                        <span class="input-group-addon glyphicon glyphicon-usd" id="sizing-addon3"></span>
                        <input type="text" class="form-control" placeholder="Minimo de coin para apostar" aria-describedby="sizing-addon3" id="minapos">

                    </div>
                    <div class="input-group input-group-sm col-lg-12 col-md-12 col-sm-12 hidden-xs">
                        <span class="input-group-addon glyphicon glyphicon-usd" id="sizing-addon3"></span>
                        <input type="text" class="form-control" placeholder="Maximo de coin para apostar" aria-describedby="sizing-addon3" id="maxapos">

                    </div>
                    <div class="input-group input-group-sm col-lg-12 col-md-12 col-sm-12 hidden-xs">
                        <span class="input-group-addon glyphicon glyphicon-chevron-down" id="sizing-addon3"></span>
                        <input type="text" class="form-control" placeholder="minimo de la ciega" aria-describedby="sizing-addon3" id="minci">
                    </div>
                    <div class="input-group input-group-sm col-lg-12 col-md-12 col-sm-12 hidden-xs">
                        <span class="input-group-addon glyphicon glyphicon-chevron-up" id="sizing-addon3"></span>

                        <input type="text" class="form-control" placeholder="maximo de la ciega" aria-describedby="sizing-addon3" id="maxci">
                    </div>
                    <div class="input-group input-group-sm col-lg-12 col-md-12 col-sm-12 hidden-xs">
                        <span class="input-group-addon glyphicon glyphicon-user" id="sizing-addon3"></span>
                        <select class="input" id="maxus" title="Maximo de usuario">
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            <option>6</option>
                            <option>7</option>
                        </select>
                    </div>
                    <div class="input-group input-group-sm col-lg-12 col-md-12 col-sm-12 hidden-xs">
                        <a class="btn btn-default link-error btn-submit " id="buttoncreate" onclick="ocultar_create_sala();">Jugar Ahora</a>
                    </div>

                </div>
            </section>

            <section class="playing">
                <style>
                    .hori {
                        height: 20%;
                    }
                    .playing {
                        height: 515px !important;
                    }
                    .vert {
                        float: left;
                        width: 20%;
                        height: 100%;
                        position: relative;
                    }
                    #exitgame{
                        background-image: url(./imagen/poker/salir.png);
                        border: 0px;
                        border-radius: 0;
                        height: 43px;
                        width: 69px;
                        background-size: contain;
                    }
                    #exitgame:hover {
                        background-position: 1;
                    }
                    .nameusr {
                        color: white;
                        font-weight: 200;
                        font-size: 12;
                        margin: 0 auto;
                        clear: both;
                        width: 100%;
                    }
                    .fichsit {
                        background-image: url(./imagen/poker/jugadores.png);
                        height: 75px;
                        width: 71px;
                        border-radius: 100%;
                        position: relative;
                        float: left;
                    }
                    .profile-mesa {
                        position: absolute;
                        background-color: #2b2a27;
                        height: 50px;
                        width: 52px;
                        margin-top: 13px;
                        margin-left: 10px;
                        border-radius: 100%;
                        background-repeat: round;
                        background-size: contain;
                    }
                    .apostonline {
                        float: left;
                        color: white;
                        background-color: #920B18;
                        vertical-align: bottom;
                        text-align: center;
                        width: 60px;
                        margin-top: 16%;
                        margin-left: 5px;
                        font-size: 10px;
                    }
                    .timeturn {
                        position: absolute;
                        color: white;
                        width: 20px;
                        height: 20px;
                        background-color: #920b18;
                        font-size: 16px;
                        padding: 0;
                        margin: 0;
                        border-radius: 100%;
                        bottom: 0px;
                    }
                    .diler {
                        height: 100%;
                        width: 100%;
                    }
                    .right {
                        float: right !important;
                        text-align: right;
                        right: 0 !important;
                    }
                    .vert.c>* {
                        float: none;
                        margin: 0 auto !important;
                        text-align: center;
                        position: relative;
                    }
                    p.right {
                        margin-right: 5px;
                        text-align: center;
                    }
                    .c > p.apostonline {
                        margin: 5px auto !important;
                    }
                    .profile-mesa.right {
                        margin-right: 9px;
                    }
                    @media (max-width: 774px){
                        .playing{
                            background-size: contain;
                        }
                    }
                    .fichas {
                        height: 100%;
                        text-align: center;
                        width: 100%;
                        padding: 0;
                        margin: 0;
                    }
                    .card img {
                        height: 45px;
                    }
                    .card .img {
                        height: 45px !important;
                        width: 33px !important;
                        background-image: url(./imagen/poker/naipe.png);
                        background-size: cover;
                        float: left;
                    }
                    .card .img img{
                        height: 45px !important;
                        width: 33px !important;
                    }

                    p.montapuest {
                        color: white;
                        background-color: #920B18;
                        text-align: center;
                        width: 60px;
                        font-size: 10px;
                        position: absolute;
                        top: 40px;
                        border: 0px;
                        padding: 0px;
                    }

                    .card {
                        float: left;
                        height: 100%;
                        padding-top: 10px;
                        position: relative;
                        width: 50%;
                    }

                    .fichapuest {
                        float: left;
                        position: relative;
                        height: 100%;
                        width: 50%;
                    }

                    .fichapuest img {
                        position: absolute;
                        top: 10;
                        height: 20px;
                    }
                    .fichapuest img + img {
                        margin-left: 5px;
                    }
                    .pos img {
                        height: 45px;
                    }
                    .puest img {
                        position: absolute;
                        top: 10;
                        height: 20px;
                    }
                    .puest img + img {
                        margin-left: 5px;
                    }
                    .tabcard.c>* {
                        float: none;      margin: 0 auto !important;      text-align: center;      position: relative;
                    }

                    .card.c {
                        width: 100%;
                        height: 50px;
                        display: inline-flex;
                    }
                    .imgc {
                        margin: 0 auto;
                    }

                    .fichapuest.c {
                        height: 50%;
                        width: 100%;
                    }
                    .fichsit.c img {
                        margin: 0 auto;
                        position: relative;
                        margin-top: 12px;
                    }

                    .fichapuest.c>* {
                        float: none;      margin: 0 auto !important;      text-align: center;      position: relative;
                        top: 10px;
                    }
                    .oculto{
                        display: none;
                    }
                    #sales thead tr {
                        background-color: transparent !important;
                        text-align: center;
                        font-weight: 100 !important;
                        font-size: 25px !important;
                    }
                    
                    #sales tbody {
                        text-align: center;
                    }
                    
                    #sales tfoot tr {
                        background-color: transparent !important;
                    }
                    
                    #sales thead tr th {
                        width: 40%;
                        max-width: 40%;
                        overflow: hidden;
                        text-overflow: ellipsis;
                    }
                    
                    #sales thead tr th + th {
                        width: 20%;
                        max-width: 20%;
                    }
                    
                    #sales tfoot tr td {
                        overflow: hidden;
                        text-align: right;
                    }
                    
                    thead {
                        width: 880px;
                    }
                    
                    .optionsala > .btn {
                        border: 1px solid #9C9B97;
                        background-color: transparent;
                        text-shadow: none;
                        color: white;
                        text-transform: uppercase;
                        margin-right: 10px;
                        border-radius: 0px;
                    }
                    
                    span.glyphicon.glyphicon-play-circle {
                        color: white;
                    }
                    
                    .optionsala > .btn:hover {
                        background-color: transparent;
                        color: #d3cf49;
                    }
                    tr.general:hover {
                        color: #d3cf49;
                    }
                    
                </style>
                <div class="container-fluid">
                    <div class="row" id='rowgame' >
                        <div class="col-lg-12 col-md-12 col-sm-12 hidden-xs content-game " id="">
                            <div class="container-fluid hori">
                                <div class="row" id='rowgame' >
                                    <div class="vert">
                                        <a href="./poker#" class="btn btn-default" id="exitgame"></a>
                                    </div>
                                    <div class="vert " id='player1' ondblclick="seeplayer('#player1', 0);" style='cursor:pointer;'>
                                        <h3 class="nameusr" id='player1name'>No Disponible</h3>
                                        <div class="fichsit">
                                            <img src="http://www.apcd.org.br/clubedebeneficios/imagens/ico-close.png" alt="Player 1" id='player1imageprofile' class="profile-mesa">
                                        </div>
                                        <p class="apostonline " id='player1apos'>0</p>
                                        <p class="timeturn " id='player1time'>0</p>
                                    </div>
                                    <div class="vert">
                                        <div class="diler men"></div>
                                    </div>
                                    <div class="vert" id='player2' ondblclick="seeplayer('#player2', 1);" style='cursor:pointer;'>
                                        <h3 class="nameusr right" id='player2name'>No Disponible</h3>
                                        <div class="fichsit right">
                                            <img src="http://www.apcd.org.br/clubedebeneficios/imagens/ico-close.png" alt="Player 2" id='player2imageprofile' class="profile-mesa right">
                                        </div>
                                        <p class="apostonline right " id='player2apos'>0</p>
                                        <p class="timeturn right " id='player2time'>0</p>
                                    </div>
                                    <div class="vert">
                                        <!--<a href="./poker#" class="btn btn-default" id="exitgame">Abandonar Sala</a>-->
                                    </div>
                                </div>
                            </div>

                            <div class="container-fluid hori">
                                <div class="row" id='rowgame' >
                                    <div class="vert">
                                        <!--<a href="./poker#" class="btn btn-default" id="exitgame">Abandonar Sala</a>-->
                                    </div>
                                    <div class="vert">
                                        <div class="tabcard oculto mesaplayer1">
                                            <div class="card">
                                                <div class="img player1carta1"></div>
                                                <div class="img player1carta2"></div>
                                            </div>
                                            <div class="fichapuest">
                                                <img src="./imagen/poker/ficha-5.png" alt="montapuest">
                                                <p class="montapuest" id="montapuestplayer1">0</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="vert">
                                        <div class="fichas">
                                            <img src="./imagen/poker/fichas-enteras.png" alt="Fichas">
                                        </div>
                                        <!--<a href="./poker#" class="btn btn-default" id="exitgame">Abandonar Sala</a>-->
                                    </div>
                                    <div class="vert">
                                        <div class="tabcard oculto mesaplayer2">
                                            <div class="card right">
                                                <div class="img player2carta1 right"></div>
                                                <div class="img player2carta2 right"></div>
                                                <!--<img src="./imagen/poker/naipe.png" alt="carta1" class="carta1 player2carta1">-->
                                                <!--<img src="./imagen/poker/naipe.png" alt="carta2" class="carta2 player2carta2">-->
                                            </div>
                                            <div class="fichapuest right">
                                                <img src="./imagen/poker/ficha-5.png" alt="montapuest" class="right">
                                                <p class="montapuest right" id="montapuestplayer2">0</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="vert">
                                        <!--<a href="./poker#" class="btn btn-default" id="exitgame">Abandonar Sala</a>-->
                                    </div>
                                </div>
                            </div>

                            <div class="container-fluid hori">
                                <div class="row" id='rowgame' >
                                    <div class="vert " id='player7' ondblclick="seeplayer('#player7', 6);" style="width: 10%;cursor:pointer">
                                        <h3 class="nameusr" id='player7name'>No Disponible</h3>
                                        <div class="fichsit">
                                            <img src="http://www.apcd.org.br/clubedebeneficios/imagens/ico-close.png" alt="Player 7" id='player7imageprofile' class="profile-mesa">
                                        </div>
                                        <p class="apostonline " id='player7apos'>0</p>
                                        <p class="timeturn " id='player7time'></p>
                                    </div>
                                    <div class="vert" style="width: 15%">
                                        <div class="tabcard oculto mesaplayer7">
                                            <div class="card">
                                                <div class="img player7carta1"></div>
                                                <div class="img player7carta2"></div>
                                            </div>
                                            <div class="fichapuest">
                                                <img src="./imagen/poker/ficha-5.png" alt="montapuest">
                                                <p class="montapuest" id="montapuestplayer7">0</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="vert" style="width: 50%; padding-top: 2%">
                                        <div class="col-lg-12 col-md-12 col-sm-12 hidden-xs" id='mesa'>
                                            <div class="col-lg-2 col-md-2 col-sm-2 pos one">
                                                <img src="./imagen/poker/naipe.png" alt="carta1" id="one" class="">                                           
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-2 pos two">
                                                <img src="./imagen/poker/naipe.png" alt="carta1" id="two" class="">                                           
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-2 pos three">
                                                <img src="./imagen/poker/naipe.png" alt="carta1" id="three" class="">                                           
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-2 pos four">
                                                <img src="./imagen/poker/naipe.png" alt="carta1" id="four" class="">                                           
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-2 pos five">
                                                <img src="./imagen/poker/naipe.png" alt="carta1" id="five" class="">                                           
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-2 puest">
                                                <img src="./imagen/poker/ficha-5.png" alt="montapuest">
                                                <p class="montapuest pote">0</p>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 win" style="position: absolute;bottom: -40px;background-color: #920B18;color: white;text-align: center; display: none">
                                                <p>
                                                    Player: <a class="playerwin">0</a> jugada: <a class="playerplay">POKER</a><br>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="vert" style="width: 15%">
                                        <div class="tabcard oculto mesaplayer3">
                                            <div class="card right">
                                                <div class="img player3carta1 right"></div>
                                                <div class="img player3carta2 right"></div>
                                            </div>
                                            <div class="fichapuest right">
                                                <img src="./imagen/poker/ficha-5.png" alt="montapuest" class="right">
                                                <p class="montapuest right" id="montapuestplayer3">0</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="vert" id='player3' ondblclick="seeplayer('#player3', 2);" style="width: 10%; cursor:pointer" >
                                        <h3 class="nameusr right" id='player3name'>No Disponible</h3>
                                        <div class="fichsit right">
                                            <img id='player3imageprofile' src="http://www.apcd.org.br/clubedebeneficios/imagens/ico-close.png" alt="Player3" class="profile-mesa right">
                                        </div>
                                        <p class="apostonline right " id='player3apos'>0</p>
                                        <p class="timeturn right " id='player3time'></p>
                                    </div>
                                </div>
                            </div>

                            <div class="container-fluid hori">
                                <div class="row" id='rowgame' >
                                    <div class="vert">
                                        <!--<a href="./poker#" class="btn btn-default" id="exitgame">Abandonar Sala</a>-->
                                    </div>
                                    <div class="vert">
                                        <div class="tabcard oculto mesaplayer6" style="padding-top: 20%">
                                            <div class="card">
                                                <div class="img player6carta1"></div>
                                                <div class="img player6carta2"></div>
                                            </div>
                                            <div class="fichapuest">
                                                <img src="./imagen/poker/ficha-5.png" alt="montapuest">
                                                <p class="montapuest" id="montapuestplayer6">0</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="vert c">
                                        <div class="tabcard c  mesaplayer5">
                                            <div class="card c">
                                                <div class="imgc">
                                                    <div class="img player5carta1"></div>
                                                    <div class="img player5carta2"></div>
                                                </div>
                                            </div>
                                            <div class="fichapuest c">
                                                <img src="./imagen/poker/ficha-5.png" alt="montapuest">
                                                <p class="montapuest" id="montapuestplayer5">0</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="vert">
                                        <div class="tabcard oculto mesaplayer4" style="padding-top: 20%">
                                            <div class="card right">
                                                <div class="img player4carta1 right"></div>
                                                <div class="img player4carta2 right"></div>
                                            </div>
                                            <div class="fichapuest right">
                                                <img src="./imagen/poker/ficha-5.png" alt="montapuest" class="right">
                                                <p class="montapuest right" id="montapuestplayer4">0</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="vert">
                                        <!--<a href="./poker#" class="btn btn-default" id="exitgame">Abandonar Sala</a>-->
                                    </div>
                                </div>
                            </div>
                            <div class="container-fluid hori">
                                <div class="row" id='rowgame' >
                                    <div class="vert">

                                    </div>
                                    <div class="vert " id='player6' ondblclick="seeplayer('#player6', 5);" style="cursor:pointer">
                                        <h3 class="nameusr" id='player6name'>No Disponible</h3>
                                        <div class="fichsit">
                                            <img src="http://www.apcd.org.br/clubedebeneficios/imagens/ico-close.png" alt="Player 6" id='player6imageprofile' class="profile-mesa">
                                        </div>
                                        <p class="apostonline " id='player6apos'>0</p>
                                        <p class="timeturn " id='player6time'></p>
                                    </div>
                                    <div class="vert c" id='player5' ondblclick="seeplayer('#player5', 4);" style="cursor:pointer">
                                        <h3 class="nameusr" id='player5name'>No Disponible</h3>
                                        <div class="fichsit c">
                                            <img src="http://www.apcd.org.br/clubedebeneficios/imagens/ico-close.png" alt="Player 5" id='player5imageprofile' class="profile-mesa">
                                        </div>
                                        <p class="apostonline " id='player5apos'>0</p>
                                        <p class="timeturn " id='player5time'></p>
                                    </div>
                                    <div class="vert" id='player4' ondblclick="seeplayer('#player4', 3);" style="cursor:pointer">
                                        <h3 class="nameusr right" id='player4name'>No Disponible</h3>
                                        <div class="fichsit right">
                                            <img id='player4imageprofile' src="http://www.apcd.org.br/clubedebeneficios/imagens/ico-close.png" alt="Player 4" class="profile-mesa right">
                                        </div>
                                        <p class="apostonline right " id='player4apos'>0</p>
                                        <p class="timeturn right " id='player4time'></p>
                                    </div>
                                    <div class="vert">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="col-lg-3 col-md-2 col-sm-2 hidden-xs sidebar-game">
            <div class="content-user" id="playerdata" style="display: block;">
                <h3>Datos del Jugador</h3>
                <img src="./interface/images/recortes/poker/linea.png" alt="" class="img-responsive"/>
                <div class="profile">
                    <img src="" />
                </div>
                <p class="nameprofile"> Player</p>
                <p class="saldo">0</p>
            </div>
            <div class="content-option-user" id="playeroption" style="display: none;">
                <h3>Opciones del Jugador</h3>
                <p class="saldo apost-resume">0</p>
                <input type="hidden" value="0" class="input-group" id="apost-toal" style="float:left; height: 20px; width: 100px;" onkeypress="return justNumbers(event);">
                <img src="./interface/images/recortes/poker/linea.png" alt="" class="img-responsive"/>
                <div class="option-user">
                    <div class="container-fluid sin-padding">
                        <div class="row sin-padding">
                            <div class="col-lg-7 col-md-7 col-sm-7 izq">
                                <input type="submit" class="btn btn-default " id="apost" value="Apostar">
                                <input type="submit" class="btn btn-default " id="past" value="Pasar">
                                <input type="submit" class="btn btn-default " id="leave" value="Retirarse">
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 sin-padding der">
                                <div class="btn btn-default" id="apost-bote">
                                    BOTE
                                </div>
                                <div class="btn btn-default" id="apost-bote-mid">
                                    1/2 BOTE
                                </div>
                                <div class="btn btn-default" id="apost-all">
                                    todo
                                </div>
                                <div class="btn btn-default">
                                    <input type="text" class="input" id="apost-mont" placeholder="OTRO" onkeypress="return justNumbers(event);">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <img src="./interface/images/recortes/poker/linea.png" alt="" class="img-responsive"/>
            <h3>Chat del Jugador <span class="fa fa-weixin"></span></h3>
            <div class="content-chat" id="globalchat">
                <!--                <div class="message">
                                    <p><span class="name"> Jugador : </span> Hola que tal</p>
                                </div>
                                <div class="message">
                                    <p><span class="name responder"> Jugador : </span> You asked, Font Awesome delivers with 40 shiny new icons in version 4.3. Want to request new icons? Here's how. Need vectors or want to use on the desktop? Check the cheatsheet.</p>
                                </div>
                                <div class="message">
                                    <p><span class="name"> Jugador : </span> The complete set of 519 icons in Font Awesome 4.3.0</p>
                                </div>
                                <div class="message">
                                    <p><span class="name responder"> Jugador : </span> You asked, Font Awesome delivers with 40 shiny new icons in version 4.3. Want to request new icons? Here's how. Need vectors or want to use on the desktop? Check the cheatsheet.</p>
                                </div>-->

            </div>
            <div class="text-message">
                <div class="container-fluid sin-padding">
                    <div class="row sin-padding">
                        <div class="col-lg-7 col-md-7 col-sm-7 ">
                            <input type="text" class="text" id="newcomentglobal" maxlength="255" placeholder="Escribe tu comentario"></input>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 sin-padding">
                            <input type="submit" class="btn btn-default " id="comentglobal" value="Enviar">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!--<div class="row" id='rowgame'>--> 

    <input type="hidden" name="montapost" id="montapost">
</div>
<?php $this->load->view('page/footer'); ?>   
<script src="./interface/scripts/main.js"></script>
<script>
                                function sales(arraycon, clients) {
                                    var content = " <table class='table table-striped list-sales '><thead><tr class='titulo'><th class=''>SALA</th><th>APUESTA</th><th>MIN/MAX</th><th>MAX JUG</th></tr></thead>";
                                    var recorrido = arraycon;
                                    var ide = 0;
                                    //                                console.log(recorrido);
                                    for (var i in recorrido) {
                                        if (recorrido[i] !== null) {

                                            //                                    console.log(recorrido[i]);

                                            var classtyle = "";
                                            if (recorrido[i].boolpass !== 0) {
                                                classtyle = "glyphicon glyphicon-lock";
                                            }

                                            content += "<tr class='general' style='cursor:pointer;'  ondblclick='joingame(" + i + "," + recorrido[i].boolpass + ")'><td><span class='" + classtyle + "' id=''> </span>" + recorrido[i].name + "</td><td>" + recorrido[i].apu_min + "/" + recorrido[i].apu_max + "</td><td>" + recorrido[i].jug_min + "/" + recorrido[i].jug_max + "</td><td>" + recorrido[i].max_jug + "</td></tr>"
                                            ide++;

                                        }
                                    }
                                    content += "<tfoot><tr><td colspan='1'><p></p><p><span id='clients'> " + clients + "</span> Jugadores están conectados</p></td><td colspan='3' class='optionsala'><a class='btn btn-default btn-crear-sala'  id='newsale' onclick='mostrar_create_sala();'>Crear sala</a><a class='btn btn-default'  id='buttonrefresh' onclick='Javascript:refresh();' >refrescar lista</a><a class='btn btn-default btn-play'  id='play' ><span class='glyphicon glyphicon-play-circle'></span> PLAY</a></td></tr></tfoot>";
                                    content += "</tablet>";
                                    $('#sales').html(content);
                                }

</script>

