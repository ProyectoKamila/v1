<<<<<<< HEAD
     <!--http://localhost/v1/games/slot-egipcio/game_1024x768/-->
     <!DOCTYPE html>
     <html>
     <head>
        <title>Slot machine Egipcia</title>
        <?php $this->load->view('page/header');?>
        <link rel="stylesheet" href="./games/slot-egipcio/game_1024x768/css/reset.css" type="text/css">
        <link rel="stylesheet" href="./games/slot-egipcio/game_1024x768/css/main.css" type="text/css">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" />
        <meta name="msapplication-tap-highlight" content="no"/>
        <script type="text/javascript" src="./games/slot-egipcio/game_1024x768/js/jquery-2.0.3.min.js"></script>
        <script type="text/javascript" src="./games/slot-egipcio/game_1024x768/js/createjs-2013.12.12.min.js"></script>
        <script type="text/javascript" src="./games/slot-egipcio/game_1024x768/js/ctl_utils.js"></script>
        <script type="text/javascript" src="./games/slot-egipcio/game_1024x768/js/sprite_lib.js"></script>
        <script type="text/javascript" src="./games/slot-egipcio/game_1024x768/js/CSlotSettings.js"></script>
        <script type="text/javascript" src="./games/slot-egipcio/game_1024x768/js/CLang.js"></script>
        <script type="text/javascript" src="./games/slot-egipcio/game_1024x768/js/CPreloader.js"></script>
        <script type="text/javascript" src="./games/slot-egipcio/game_1024x768/js/CMain.js"></script>
        <script type="text/javascript" src="./games/slot-egipcio/game_1024x768/js/CTextButton.js"></script>
        <script type="text/javascript" src="./games/slot-egipcio/game_1024x768/js/CGfxButton.js"></script>
        <script type="text/javascript" src="./games/slot-egipcio/game_1024x768/js/CToggle.js"></script>
        <script type="text/javascript" src="./games/slot-egipcio/game_1024x768/js/CBetBut.js"></script>
        <script type="text/javascript" src="./games/slot-egipcio/game_1024x768/js/CMenu.js"></script>
        <script type="text/javascript" src="./games/slot-egipcio/game_1024x768/js/CGame.js"></script>
        <script type="text/javascript" src="./games/slot-egipcio/game_1024x768/js/CReelColumn.js"></script>
        <script type="text/javascript" src="./games/slot-egipcio/game_1024x768/js/CInterface.js"></script>
        <script type="text/javascript" src="./games/slot-egipcio/game_1024x768/js/CPayTablePanel.js"></script>
        <script type="text/javascript" src="./games/slot-egipcio/game_1024x768/js/CStaticSymbolCell.js"></script>
        <script type="text/javascript" src="./games/slot-egipcio/game_1024x768/js/CTweenController.js"></script>

    
    </head>
    <body ondragstart="return false;" ondrop="return false;" >
        <div class="fondo-game" style="background:#EDBD5B;">
        <?php $this->load->view('page/navegation/header');?>
        <?php $this->load->view('page/navegation/notification');?>
    </div>
    
        <script>
        $(document).ready(function(){
         var oMain = new CMain({
                                        min_reel_loop:2,          //NUMBER OF REEL LOOPS BEFORE SLOT STOPS  
                                        reel_delay: 6,            //NUMBER OF FRAMES TO DELAY THE REELS THAT START AFTER THE FIRST ONE
                                        time_show_win:2000,       //DURATION IN MILLISECONDS OF THE WINNING COMBO SHOWING
                                        time_show_all_wins: 2000, //DURATION IN MILLISECONDS OF ALL WINNING COMBO
                                        money:0                //STARING CREDIT FOR THE USER
                                    });
         'use strict';
         var socket;
         var protocol_identifier = 'server';
         var myId;
         var idgame=4; //aqui debe llevarse el nombre del juego que selecciono
         var free_gameslot=0;
         var nicklist;
         var is_typing_indicator;
         var window_has_focus = true;
         var actual_window_title = document.title;
         var flash_title_timer;
         var connected = false;
         var connection_retry_timer;
         var server_url = 'ws://162.252.57.97:8808/';
//          var server_url = 'ws://localhost:8808/';
         var token = "<?php
         if (isset($_COOKIE['token'])) {
=======
<!--http://localhost/v1/games/slot-sensual/game_1024x768/-->
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <?php $this->load->view('page/header'); ?>
        <link rel="stylesheet" href="./games/slot-sensual/game_1024x768/css/reset.css" type="text/css">
        <link rel="stylesheet" href="./games/slot-sensual/game_1024x768/css/main.css" type="text/css">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" />
        <meta name="msapplication-tap-highlight" content="no"/>

        <script type="text/javascript" src="./games/slot-sensual/game_1024x768/js/jquery-2.0.3.min.js"></script>
        <script type="text/javascript" src="./games/slot-sensual/game_1024x768/js/createjs-2013.12.12.min.js"></script>
        <script type="text/javascript" src="./games/slot-sensual/game_1024x768/js/ctl_utils.js"></script>
        <script type="text/javascript" src="./games/slot-sensual/game_1024x768/js/sprite_lib.js"></script>
        <!--      <?php // $this->load->view('slotmachine/CSSettings');   ?> -->
        <script type="text/javascript" src="./games/slot-sensual/game_1024x768/js/CSlotSettings.js"></script>
        <script type="text/javascript" src="./games/slot-sensual/game_1024x768/js/CLang.js"></script>
        <script type="text/javascript" src="./games/slot-sensual/game_1024x768/js/CPreloader.js"></script>
        <script type="text/javascript" src="./games/slot-sensual/game_1024x768/js/CMain.js"></script>
        <script type="text/javascript" src="./games/slot-sensual/game_1024x768/js/CTextButton.js"></script>
        <script type="text/javascript" src="./games/slot-sensual/game_1024x768/js/CGfxButton.js"></script>
        <script type="text/javascript" src="./games/slot-sensual/game_1024x768/js/CToggle.js"></script>
        <script type="text/javascript" src="./games/slot-sensual/game_1024x768/js/CBetBut.js"></script>
        <script type="text/javascript" src="./games/slot-sensual/game_1024x768/js/CMenu.js"></script>
        <script type="text/javascript" src="./games/slot-sensual/game_1024x768/js/CGame.js"></script>
        <script type="text/javascript" src="./games/slot-sensual/game_1024x768/js/CReelColumn.js"></script>
        <script type="text/javascript" src="./games/slot-sensual/game_1024x768/js/CInterface.js"></script>
        <script type="text/javascript" src="./games/slot-sensual/game_1024x768/js/CPayTablePanel.js"></script>
        <script type="text/javascript" src="./games/slot-sensual/game_1024x768/js/CStaticSymbolCell.js"></script>
        <script type="text/javascript" src="./games/slot-sensual/game_1024x768/js/CTweenController.js"></script>


    </head>
    <body ondragstart="return false;" ondrop="return false;" style="background: url(./games/slot-sensual/game_1024x768/sprites/fondo.jpg) top center no-repeat; background-size: cover;">
        <?php $this->load->view('page/navegation/header'); ?>
        <?php $this->load->view('page/navegation/notification'); ?>
    </div>
    <script>
        $(document).ready(function () {
            var oMain = new CMain({
                min_reel_loop: 2, //NUMBER OF REEL LOOPS BEFORE SLOT STOPS  
                reel_delay: 6, //NUMBER OF FRAMES TO DELAY THE REELS THAT START AFTER THE FIRST ONE
                time_show_win: 2000, //DURATION IN MILLISECONDS OF THE WINNING COMBO SHOWING
                time_show_all_wins: 2000, //DURATION IN MILLISECONDS OF ALL WINNING COMBO
                money: 0                //STARING CREDIT FOR THE USER
            });
            'use strict';
            var socket;
            var protocol_identifier = 'server';
            var myId;
            var idgame = 10; //aqui debe llevarse el nombre del juego que selecciono
            var free_gameslot = 0;
            var nicklist;
            var is_typing_indicator;
            var window_has_focus = true;
            var actual_window_title = document.title;
            var flash_title_timer;
            var connected = false;
            var connection_retry_timer;
            var server_url = 'ws://162.252.57.97:8808/';
//          var server_url = 'ws://localhost:8808/';
            var token = "<?php
        if (isset($_COOKIE['token'])) {
>>>>>>> origin/master
            echo $_COOKIE['token'];
        } elseif ($this->session->userdata('token')) {
            echo $this->session->userdata('token');
        }
        ?>";

<<<<<<< HEAD
        $(oMain).on("game_start", function(evt) {

            totalcoins();
            var options = {
                "backdrop" : "static"
            }

            $('#myModal').modal(options);
                                // alert("game_start");
                            });

        $(oMain).on("end_bet", function(evt,iMoney,iBetWin) {
                                // alert("juegos gratis: "+ free_gameslot + " Win:"+iBetWin);
                  if (free_gameslot>0){

                                  var options = {
                "backdrop" : "static"
            }

            $('#jgModal').modal(options);
                            }


                             });

        $(oMain).on("restart", function(evt) {
                                 //alert("restart");
                             });
        $('#money-text').keyup(function(event) {

            this.value = this.value.replace(/[^0-9\.]/g,'');

        });

        $('#buttonreconect').click(function() {
            hideConnectionLostMessage();
            connetserver();
        });

        $('#money-button').click(function() {

            var value_mt=  $('#money-text').val();
            var total_money= $('#total_coins').html();
    //alert(total_money);
    //alert(value_mt);
          if (value_mt>10 && value_mt < parseFloat(total_money)) {
          // alert('llega aqui');
            iMoney=value_mt;
            s_oGame.TOTAL_MONEY=value_mt;
            s_oGame._iMoney= value_mt;
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

          } else if (value_mt <10)
          {
            alert('Monto mínimo.');
          } else
          {
            alert('saldo insuficiente.');
        }



    });

        // CONFIG DEL BOTON JUEGOS GRATIS

        $('#jg-button').click(function() {


        // var value_mt=  10;
         
   
   // s_oGame.moneyref(parseFloat(value_mt));
     //   alert('si pasa por aqui');

    //s_oInterface.refreshMoney(parseFloat(iMoney));
        console.log('aqui es la primera');

          s_oGame.onMaxBetjgXxx();

          free_gameslot = 0;

        $('#jgModal').modal('toggle');

      



    });

//totalcoins();
connetserver();
function connetserver() {
=======
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

                    var options = {
                        "backdrop": "static"
                    }

                    $('#jgModal').modal(options);
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

                } else if (value_mt < 10)
                {
                    alert('Monto mínimo.');
                } else
                {
                    alert('saldo insuficiente.');
                }



            });

            // CONFIG DEL BOTON JUEGOS GRATIS

            $('#jg-button').click(function () {


                // var value_mt=  10;


                // s_oGame.moneyref(parseFloat(value_mt));
                //   alert('si pasa por aqui');

                //s_oInterface.refreshMoney(parseFloat(iMoney));
                console.log('aqui es la primera');

                s_oGame.onMaxBetjgXxx();

                free_gameslot = 0;

                $('#jgModal').modal('toggle');





            });

//totalcoins();
            connetserver();
            function connetserver() {
>>>>>>> origin/master
                //muestra el tiempo de espera al servidor revisar la funcion para que cargue si no hay conexion
                // show_timer();
                //abrir la conexion
                open_connection();
            }

            function open_connection() {

//             socket = new WebSocket('ws://localhost:8808/', 'server');

<<<<<<< HEAD
              socket = new WebSocket('ws://162.252.57.97:8808/', 'server');
=======
                socket = new WebSocket('ws://162.252.57.97:8808/', 'server');
>>>>>>> origin/master

                socket.addEventListener("open", connection_established);
            }
            //cuando la conexion se establece
            function connection_established(event) {
                connected = true;
                //hideConnectionLostMessage();
                clearInterval(connection_retry_timer);
<<<<<<< HEAD
               // alert(token);
               introduce(token);
               socket.addEventListener('message', function(event) {
                message_received(event.data);
            });
               socket.addEventListener('close', function(event) {
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
            idgame: idgame

        }

        socket.send(JSON.stringify(intro));
    }
    function is_websocket_supported() {
        if ('WebSocket' in window) {
            return true;
        }
        return false;
    }


    message_received= function(message) {
        var message;
        message = JSON.parse(message);
=======
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
                    idgame: idgame

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
>>>>>>> origin/master
                //trae las salas actuales
                if (message.type === 'sales') {
                    myId = message.userId;
                    // $('#chat-container').fadeIn();
                    //$('#loading-message').hide();
                    var newvar = {};
                    newvar = new Object();
                    newvar = message.messagesend;
                    var myObj = newvar;

<<<<<<< HEAD
                    var array = $.map(myObj, function(value, index) {
=======
                    var array = $.map(myObj, function (value, index) {
>>>>>>> origin/master
                        return [value];
                    });
                    //sales(array, message.clients);
                }
                //                si ya esta conectado
                else if (message.type === 'prueba') {
                    myId = message.userId;
                    // $('#chat-container').fadeIn();
                    //$('#loading-message').hide();
<<<<<<< HEAD
                    
                    var  newvar = message.messagesend;
=======

                    var newvar = message.messagesend;
>>>>>>> origin/master


                    s_oGame.pruebacgame(newvar);

                }
                else if (message.type === 'money_total') {
                    myId = message.userId;

<<<<<<< HEAD
                    var  coinsvar = message.messagesend;
                    coinslabel(coinsvar);

                }
                 else if (message.type === 'free_game') {
                    myId = message.userId;
                    free_gameslot=0;
                    var  freg = message.messagesend;
=======
                    var coinsvar = message.messagesend;
                    coinslabel(coinsvar);

                }
                else if (message.type === 'free_game') {
                    myId = message.userId;
                    free_gameslot = 0;
                    var freg = message.messagesend;
>>>>>>> origin/master
                    openjg(freg);

                }

                else if (message.type === 'prueba2') {
                    myId = message.userId;
                    // $('#chat-container').fadeIn();
                    //$('#loading-message').hide();
<<<<<<< HEAD
                    
                    var  newvar = message.messagesend;


                    s_oGame.pruebacgame2(newvar);
                    
=======

                    var newvar = message.messagesend;


                    s_oGame.pruebacgame2(newvar);

>>>>>>> origin/master

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
<<<<<<< HEAD
                    is_typing_indicator = setTimeout(function() {
=======
                    is_typing_indicator = setTimeout(function () {
>>>>>>> origin/master
                        $('#is-typig-status').fadeOut();
                    }, 2000);
                }

            }
<<<<<<< HEAD
         
            prueba = function(enviar){
          //public function prueba(){
           enviar.type='prueba';

              //alert(enviar.type);

              socket.send(JSON.stringify(enviar));
          }
          function totalcoins(){

           var money_total = {

            type: 'money_ws'
        }


              //alert(enviar.type);

              socket.send(JSON.stringify(money_total));
          }
          function coinslabel(coins){

     //   alert(coins);
    //$('#money-hidden').val(coins);
     $('#total_coins').html(coins);
     


 }

 function openjg(coins){


 
     //   alert(coins);
    //$('#money-hidden').val(coins);
     $('#total_jg').html(coins);

    
 free_gameslot=coins;
     


 }

});



     </script>
     <div class="container-fluid sin-padding fondo-game" style="background: url(./games/slot-egipcio/game_1024x768/sprites/landscape.jpg) top center no-repeat; background-size: cover;">
      <!-- Trigger the modal with a button -->
      <div class="container sin-padding">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sin-padding">    
                <div class="content-canvas">
                    <canvas id="canvas" class='ani_hack' width="1024" height="768"> </canvas>
                </div>  
            </div>
        </div>
    </div>

    <button style="display: none;" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Cargar Saldo</button>

    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            Ingrese el monto para recargar su saldo. Saldo Disponible:  <label id="total_coins"></label>
          </div>
          <div class="modal-body">

           <label>Cargar Saldo: </label>
           <!--     <input type="hidden" name="money-hidden" id="money-hidden" name="money-hidden"> -->
           <input type="numeric" name="money-text" id="money-text" maxlength="5" class="" title="0">
           <button type="button" class="btn btn-default"  id="money-button">Aceptar</button>


         </div>
         <div class="modal-footer">
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
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
               <label>HA GANADO JUGADA GRATIS</label>
          </div>
          <div class="modal-body">

          
       <!--     <input type="hidden" name="money-hidden" id="money-hidden" name="money-hidden"> -->
           <label id="total_jg" style="display: none;"></label>
           <button type="button" class="btn btn-default"  id="jg-button">Jugar</button>


       </div>
       <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
  </div>

</div>
</div>
<!-- fin de modal juegos gratis-->



</div>
    
<div class="col-lg-12 col-md-12 col-sm-12 hidden-xs" id="">
    <div class="alert alert-danger" style="display: none;" role="alert" id="connection-lost-message">Se ha perdido la conexión. intente <a class="btn btn-default link-error" id="buttonreconect">Reconectar...</a></div>

</div>
</div>
<?php $this->load->view('page/footer');?>
<?php $this->load->view('page/pie');?>
=======

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
                $('#total_jg').html(coins);


                free_gameslot = coins;



            }

        });



    </script>

    <div class="container-fluid sin-padding">

        <!-- Trigger the modal with a button -->


        <div class="container sin-padding">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sin-padding">    
                    <div class="content-canvas">
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
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <p>Ingrese el monto para recargar sus fichas.</p>
                        <h2>Fichas Disponibles</h2>
                        <label id="total_coins"></label>
                    </div>
                    <div class="modal-body">

                        <label>Cargar Saldo: </label>
                        <!--     <input type="hidden" name="money-hidden" id="money-hidden" name="money-hidden"> -->
                        <input type="numeric" name="money-text" id="money-text" maxlength="5" class="" title="0">
                        <button type="button" class="btn btn-default"  id="money-button">Aceptar</button>


                    </div>
                    <div class="modal-footer">
                        Casino4as: Recuerda siempre cerrar sesion si no estas jugando en una maquina de confianza.
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
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <label>HA GANADO JUGADA GRATIS</label>
                    </div>
                    <div class="modal-body">


<!--     <input type="hidden" name="money-hidden" id="money-hidden" name="money-hidden"> -->
                        <label id="total_jg" style="display: none;"></label>
                        <button type="button" class="btn btn-default"  id="jg-button">Jugar</button>


                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>
        <!-- fin de modal juegos gratis-->



    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 hidden-xs" id="">
        <div class="alert alert-danger" style="display: none;" role="alert" id="connection-lost-message">Se ha perdido la conexión. intente <a class="btn btn-default link-error" id="buttonreconect">Reconectar...</a></div>

    </div>
    <?php $this->load->view('page/footer'); ?>
>>>>>>> origin/master
</body>
</html>
