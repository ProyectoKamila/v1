<!--http://localhost/v1/game-slot-machine/game_1024x768/-->
<!DOCTYPE html>
<html>
    <head>
        <title>Casino 4as - Slotmachine Marino</title>
        <?php $this->load->view('page/header'); ?>
        <!--<link rel="stylesheet" href="./game-slot-machine/game_1024x768/css/reset.css" type="text/css">-->
        <!--<link rel="stylesheet" href="./game-slot-machine/game_1024x768/css/main.css" type="text/css">-->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" />
        <meta name="msapplication-tap-highlight" content="no"/>
        <script type="text/javascript" src="./game-slot-machine/game_1024x768/js/jquery-2.0.3.min.js"></script>
        <script type="text/javascript" src="./game-slot-machine/game_1024x768/js/createjs-2013.12.12.min.js"></script>
        <script type="text/javascript" src="./game-slot-machine/game_1024x768/js/ctl_utils.js"></script>
        <script type="text/javascript" src="./game-slot-machine/game_1024x768/js/sprite_lib.js"></script>
        <!--      <?php // $this->load->view('slotmachine/CSSettings');  ?> -->
        <script type="text/javascript" src="./game-slot-machine/game_1024x768/js/CSlotSettings.js"></script>
        <script type="text/javascript" src="./game-slot-machine/game_1024x768/js/CLang.js"></script>
        <script type="text/javascript" src="./game-slot-machine/game_1024x768/js/CPreloader.js"></script>
        <script type="text/javascript" src="./games/slot-marino/game_1024x768/js/CMain.js"></script>
        <script type="text/javascript" src="./game-slot-machine/game_1024x768/js/CTextButton.js"></script>
        <script type="text/javascript" src="./game-slot-machine/game_1024x768/js/CGfxButton.js"></script>
        <script type="text/javascript" src="./game-slot-machine/game_1024x768/js/CToggle.js"></script>
        <script type="text/javascript" src="./game-slot-machine/game_1024x768/js/CBetBut.js"></script>
        <script type="text/javascript" src="./game-slot-machine/game_1024x768/js/CMenu.js"></script>
        <script type="text/javascript" src="./game-slot-machine/game_1024x768/js/CGame.js"></script>
        <script type="text/javascript" src="./game-slot-machine/game_1024x768/js/CReelColumn.js"></script>
        <script type="text/javascript" src="./game-slot-machine/game_1024x768/js/CInterface.js"></script>
        <script type="text/javascript" src="./game-slot-machine/game_1024x768/js/CPayTablePanel.js"></script>
        <script type="text/javascript" src="./game-slot-machine/game_1024x768/js/CStaticSymbolCell.js"></script>
        <script type="text/javascript" src="./game-slot-machine/game_1024x768/js/CTweenController.js"></script>


    </head>
    <body ondragstart="return false;" ondrop="return false;">
        <div class="fondo-game"  style="background: #0E6E96!important;">
        <?php $this->load->view('page/navegation/header'); ?>
        <?php $this->load->view('page/navegation/notification'); ?>
    <script>
        $(document).ready(function () {
            var oMain = new CMain({
                min_reel_loop: 2, //NUMBER OF REEL LOOPS BEFORE SLOT STOPS  
                reel_delay: 2, //NUMBER OF FRAMES TO DELAY THE REELS THAT START AFTER THE FIRST ONE
                time_show_win: 1000, //DURATION IN MILLISECONDS OF THE WINNING COMBO SHOWING
                time_show_all_wins: 1000, //DURATION IN MILLISECONDS OF ALL WINNING COMBO
                money: 0                //STARING CREDIT FOR THE USER
            });
            'use strict';
            var socket;
            var protocol_identifier = 'server';
            var myId;
            var idgame = 2; //aqui debe llevarse el nombre del juego que selecciono
            var idgame_free = 2; 
            var free_gameslot = 0;
            var free=0;
            var freeselect=0;
            var nicklist;
            var is_typing_indicator;
            var window_has_focus = true;
            var actual_window_title = document.title;
            var flash_title_timer;
            var connected = false;
            var connection_retry_timer;
            var server_url = 'ws://162.252.57.97:8082/';
          //var server_url = 'ws://localhost:8082/';
            var token = "<?php
        if (isset($_COOKIE['token'])) {
            echo $_COOKIE['token'];
        } elseif ($this->session->userdata('token')) {
            echo $this->session->userdata('token');
        }
        ?>";
            $(oMain).on("game_start", function (evt) {
                totalcoins();
                var options = {
                    "backdrop": "static"
                }
                $('#myModal').modal(options);
                // alert("game_start");
            });
            $(oMain).on("end_bet", function (evt, iMoney, iBetWin) {
                // alert("juegos gratis: "+ free_gameslot + " Win:"+iBetWin);
                if (free_gameslot > 0) {
                       //jugarGratis(freg);
                 jugarGratis(free_gameslot);
                }
                       if (free > 0) {
                          
                            setTimeout(function() {
                                
                           free=free-1;
                            $('#cantidad').html(free);
                           NUM_PAYLINES=freeselect;
                            s_oGame.onMaxBetjgXxx();
                                
                            },2000);
                }
                else{
                    freeselect=20;
                    NUM_PAYLINES=freeselect;
                }
                
            });
            $(oMain).on("restart", function (evt) {
                //alert("restart");
            });
            $('#money-text').keyup(function (event) {
                this.value = this.value.replace(/[^0-9\.]/g, '');
            });
            $('#buttonreconect').click(function () {
                hideConnectionLostMessage();
                connetserver();
            });
            $('#money-button').click(function () {
                var value_mt = $('#money-text').val();
                var total_money = $('#total_coins').html();
                //alert(total_money);
                //alert(value_mt);
                           total_money = total_money.replace(/\./g,''); 
                if (value_mt > 10 && value_mt < parseFloat(total_money)) {
                    // alert('llega aqui');
                    iMoney = value_mt;
                    s_oGame.TOTAL_MONEY = value_mt;
                    s_oGame._iMoney = value_mt;
                    s_oGame.moneyref(parseFloat(value_mt));
                    //   console.log('iMoney' + iMoney);
                    //  console.log('total Money' + TOTAL_MONEY);
                    s_oInterface.refreshMoney(parseFloat(iMoney));
                    s_oInterface.enableSpin();
                    var enviarm = {
                        type: 'sitmoney',
                        sitmoney: value_mt
                    }
                    socket.send(JSON.stringify(enviarm));
                    $('#myModal').modal('toggle');
                    value_mt = value_mt.replace(/\./g,''); 
                } else if (parseInt(value_mt) < 10)
                {
                    alert('Monto mínimo.');
                } else
                {
                    alert('saldo insuficiente.');
                }
            });
            // CONFIG DEL BOTON JUEGOS GRATIS
            $('#jg-button1').click(function () {
                $("#text-win").slideDown();
                $(".item-free").slideUp();
                  $(".numb-free").slideDown();
                  free_gameslot = 0;
                  freeselect=20;
                  $('#cantidad').html(5);
                  $("#text-win").addClass('celebra');
                  setTimeout(function() {
                          console.log('el timeup');
                            
                          $('#jgModal').modal('toggle');
                       $(".item-free").slideDown();
                       $("#text-win").slideUp();
                            var intro = {
                                type: 'playfreegame',
                                free: 5
                            }
                        $(".item-free").slideDown();
                        $("#text-win").removeClass('celebra');
                        socket.send(JSON.stringify(intro));
                }, 3000);
                
            document.getElementById('text-win').innerHTML = 'Has Ganado 5 juegos por 20 Lineas';

                
        
            });
            //10 x 10
            $('#jg-button2').click(function () {
                $("#text-win").slideDown();
                $(".item-free").slideUp();
                $(".numb-free").slideDown();
                  free_gameslot = 0;
                  freeselect=20;
                  $('#cantidad').html(10);
                  $("#text-win").addClass('celebra');
                  setTimeout(function() {
                          console.log('el timeup');
                       $('#jgModal').modal('toggle');
                       $(".item-free").slideDown();
                       $("#text-win").slideUp();
                            var intro = {
                                type: 'playfreegame',
                                free: 10
                            }
                        $(".item-free").slideDown();
                        $("#text-win").removeClass('celebra');
                        socket.send(JSON.stringify(intro));
                }, 3000);
                 document.getElementById('text-win').innerHTML = 'Has Ganado 10 juegos por 20 Lineas';
            });
                   //10 x 10
            $('#jg-button3').click(function () {
                $("#text-win").slideDown();
                $(".item-free").slideUp();
                $(".numb-free").slideDown();
                  free_gameslot = 0;
                  freeselect=20;
                  $('#cantidad').html(20);
                  $("#text-win").addClass('celebra');
                  setTimeout(function() {
                          console.log('el timeup');
                            
                          $('#jgModal').modal('toggle');
                       $(".item-free").slideDown();
                       $("#text-win").slideUp();
                            var intro = {
                                type: 'playfreegame',
                                free: 20
                            }
                        $(".item-free").slideDown();
                        $("#text-win").removeClass('celebra');
                        socket.send(JSON.stringify(intro));
                }, 3000);
                 document.getElementById('text-win').innerHTML = 'Has Ganado 20 juegos por 5 Lineas';
             
            });
//totalcoins();
            connetserver();
            function connetserver() {
                //muestra el tiempo de espera al servidor revisar la funcion para que cargue si no hay conexion
                // show_timer();
                //abrir la conexion
                open_connection();
            }
            function open_connection() {
//var server_url = 'ws://162.252.57.97:8082/';
                //socket = new WebSocket('ws://casino4as-krondon.c9.io:8082/', 'server'); 
                //socket = new WebSocket('ws://localhost:8082/', 'server');
                socket = new WebSocket('ws://162.252.57.97:8082/', 'server');
                socket.addEventListener("open", connection_established);
            }
            //cuando la conexion se establece
            function connection_established(event) {
                connected = true;
                //hideConnectionLostMessage();
                clearInterval(connection_retry_timer);
                // alert(token);
                introduce(token);
                socket.addEventListener('message', function (event) {
                    message_received(event.data);
                });
                socket.addEventListener('close', function (event) {
                    connected = false;
                    showConnectionLostMessage();
                    //reConnect();
                });
            }
            //mensaje al perder la conexion
            function showConnectionLostMessage() {
                // $('#send-msg textarea, #send-msg span').hide();
                $('#connection-lost-message').slideDown();
            }
            //esconde el mensaje de perder conexion
            function hideConnectionLostMessage() {
                // $('#send-msg textarea, #send-msg span').hide();
                $('#connection-lost-message').slideUp();
                $('#user-conect').slideUp();
            }
            function introduce(nickname) {
                var intro = {
                    type: 'join',
                    token: nickname,
                    idgame: idgame,
                    idgame_free:idgame_free
                }
                socket.send(JSON.stringify(intro));
            }
            function is_websocket_supported() {
                if ('WebSocket' in window) {
                    return true;
                }
                return false;
            }
            message_received = function (message) {
                var message;
                message = JSON.parse(message);
                //trae las salas actuales
                if (message.type === 'sales') {
                    myId = message.userId;
                    // $('#chat-container').fadeIn();
                    //$('#loading-message').hide();
                    var newvar = {};
                    newvar = new Object();
                    newvar = message.messagesend;
                    var myObj = newvar;
                    var array = $.map(myObj, function (value, index) {
                        return [value];
                    });
                    //sales(array, message.clients);
                }
                //                si ya esta conectado
                else if (message.type === 'prueba') {
                    myId = message.userId;
                    // $('#chat-container').fadeIn();
                    //$('#loading-message').hide();
                    var newvar = message.messagesend;
                    s_oGame.pruebacgame(newvar);
                }
                else if (message.type === 'money_total') {
                    myId = message.userId;
                    var coinsvar = message.messagesend;
                    coinslabel(coinsvar);
                }
                else if (message.type === 'free_game') {
                     // myId = message.userId;
                   free_gameslot = 2;
                   freg = message.messagesend;
                            console.log(freg);
                   
                }
                      else if (message.type === 'free_game_play') {
                          console.log('aqui paso');
                         myId = message.userId;
                            if(free > 0){
                                console.log('aqui');
                                console.log(free);
                                free += message.messagesend;
                            }
                            else{
                                free = message.messagesend;
                          
                                   free=free -1;
                                   //console.log('free sele '+freeselect);
                                   NUM_PAYLINES=freeselect;
                                s_oGame.onMaxBetjgXxx();
                         
                            
                        }
               
                }
                else if (message.type === 'prueba2') {
                    myId = message.userId;
                    // $('#chat-container').fadeIn();
                    //$('#loading-message').hide();
                    var newvar = message.messagesend;
                    s_oGame.pruebacgame2(newvar);
                }
                else if (message.type === 'readyconect') {
                    $('#user-conect').slideDown();
                    // $('#chat-container').fadeIn();
                    //$('#loading-message').hide();
                    //$('#game').html(message.messagesend);
                }
                //para traer datos del usuarhio
                else if (message.type === 'welcome') {
                    myId = message.userId;
                    // $('#chat-container').fadeIn();
                    //$('#loading-message').hide();
                    //console.log(message.messagesend);
                } else if (message.type === 'message' && parseInt(message.sender) !== parseInt(myId)) {
                    //add_new_msg_to_log(message);
                    blink_window_title('~ message poker ~');
                    //showNewMessageDesktopNotification(message.nickname, message.message);
                } else if (message.type === 'nicklist') {
                    var chatter_list_html = '';
                    nicklist = message.nicklist;
                    for (var i in nicklist) {
                        chatter_list_html += '<li>' + nicklist[i] + '</li>';
                    }
                    chatter_list_html = '<ul>' + chatter_list_html + '</ul>';
                    $('#chatter-list').html(chatter_list_html);
                } else if (message.type === 'activity_typing' && parseInt(message.sender) !== parseInt(myId)) {
                    var activity_msg = message.name + ' is typing..';
                    $('#is-typig-status').html(activity_msg).fadeIn();
                    clearTimeout(is_typing_indicator);
                    is_typing_indicator = setTimeout(function () {
                        $('#is-typig-status').fadeOut();
                    }, 2000);
                }
            }
            prueba = function (enviar) {
                //public function prueba(){
                enviar.type = 'prueba';
                //alert(enviar.type);
                socket.send(JSON.stringify(enviar));
            }
            function totalcoins() {
                var money_total = {
                    type: 'money_ws'
                }
                //alert(enviar.type);
                socket.send(JSON.stringify(money_total));
            }
            function coinslabel(coins) {
                //   alert(coins);
                //$('#money-hidden').val(coins);
                $('#total_coins').html(coins);
            }
            function openjg(coins) {
                //   alert(coins);
                //$('#money-hidden').val(coins);
               // $('#total_jg').html(coins);
                //free_gameslot = coins;
            }
        });
        
          function jugarGratis(tipo){
                console.log("Jugada Gratis 2");
                console.log(tipo);
                if(tipo == 5){
                console.log("tipo igual a 1");
                  var options = {
                            "backdrop": "static"
                        }
                    console.log("Levantar Ventana");    
                    $('#jgModal').modal(options);
                    console.log("Jugar tipo 1");    
                    $('#jg-button1').click();
                }
                if(tipo == 10){
                console.log("tipo igual a 1");
                  var options = {
                            "backdrop": "static"
                        }
                    console.log("Levantar Ventana");    
                    $('#jgModal').modal(options);
                    console.log("Jugar tipo 1");    
                    $('#jg-button2').click();
                }
                if(tipo == 20){
                console.log("tipo igual a 1");
                  var options = {
                            "backdrop": "static"
                        }
                    console.log("Levantar Ventana");    
                    $('#jgModal').modal(options);
                    console.log("Jugar tipo 1");    
                    $('#jg-button2').click();
                }
    }
        
    </script>
    <div id="marino" class="container-fluid sin-padding fondo-game" style="background: #0E6E96 !important;">
        <!-- Trigger the modal with a button -->
        <div class="container sin-padding">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sin-padding">    
                <?php     
                        $valores = array();
                        $x=1;
                            while ($x<4) {
                              $num_aleatorio = rand(1,3);
                              if (!in_array($num_aleatorio,$valores)) {
                                array_push($valores,$num_aleatorio);
                                $x++;
                              }
                            }
                            
                         ?>
                        
                    <div class="content-canvas">
                            
                         <div class="numb-free">
                                        <p id="cantidad"></p>
                            </div>
                        <canvas id="canvas" class='ani_hack' width="1024" height="768"> </canvas>
                    </div>  
                </div>
            </div>
        </div>
        <button style="display: none;" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Cargar Saldo</button>
        <!-- Modal -->
        <div class="modal fade box-cargar-saldo" id="myModal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content firstmodal">
                    <div class="modal-header">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="saldo-carga">
                                    <div class="col-xs-4">
                                    <p class="ficha">Fichas Disponibles:</p> 
                                        <div class="mount">
                                            <p><label id="total_coins"></label></p>
                                        </div>
                                    </div> 
                                <div class="col-xs-6 ">
                                    <p class="ficha">Ingrese el monto de fichas:</p> 
                                        <!--<label >Cargar Saldo: </label>-->
                                        <!--     <input type="hidden" name="money-hidden" id="money-hidden" name="money-hidden"> -->
                                        <input type="numeric" name="money-text" id="money-text" maxlength="5" class="money-text" title="0" placeholder="Fichas a recargar">
                                        <button type="button" class="btn btn-default btn-submit"  id="money-button">Aceptar</button>
                                    </div>    
                                </div>    
                                </div>
                            </div>
                                
                                
                    </div>
                    <div class="modal-body">
                        
                    </div>
                    <div class="modal-footer"> 
                         <!-- Casino4as: Recuerda siempre cerrar sesion si no estas jugando en una maquina de confianza. -->
                         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
                    </div>
                </div>

            </div>
        </div>


        <!-- modal para los juegos gratis-->
        <button style="display: none;" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#jgModal">Jugar Gratis</button>

        <!-- Modal -->
        <div class="modal fade" id="jgModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content freeplaymodal">
                    <div class="modal-header">
                        <!--ca
                        <!--<label>HA GANADO JUGADA GRATIS</label>-->
                    </div>
                        
                    <div class="modal-body">
                        
                        <?php
                        $z = 1;
                        foreach($valores as $v) { ?>
                        
                            <div class="col-xs-4">
                                <div class="item-free">
                                    <img id="jg-button<?php echo $v; ?>" 
                                    src="./interface/images/marino/<?php echo $z; ?>.png"
                                    <?php if($z== 1) { ?>
                                    style="margin-top:30px;"
                                    <?php } ?>        
                                    <?php if($z== 2) { ?>
                                     style="margin-top:3px;"
                                    <?php } ?>
                                    <?php if($z== 3) { ?>
                                    style="margin-top:25px;"
                                    <?php } ?>
                                    />
                                </div>
                            </div>
                        <?php 
                        $z++; 
                        } ?> 
                    </div>
                    <div class="modal-footer">
                         <label id="total_jg" style="display: none;"></label>
                         <p id="text-win"></p>
                    
 <!--<button type="button" class="btn btn-default myButton"  >Jugar 5 x 20</button>-->
                        <!--<button type="button" class="btn btn-default myButton"  >Jugar 10 x 10</button>-->
                        <!--<button type="button" class="btn btn-default myButton"  id="jg-button3">Jugar 20 x 5</button>-->
                        
                    </div>
                </div>

            </div>
        </div>
        <!-- fin de modal juegos gratis-->



    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 hidden-xs" id="">
        <div class="a-lert alert-danger" style="display: none;" role="alert" id="connection-lost-message">Se ha perdido la conexión. intente <a class="btn btn-default link-error" id="buttonreconect">Reconectar...</a></div>

    </div>
    </div>
    <?php $this->load->view('page/footer'); ?>
</body>
</html>