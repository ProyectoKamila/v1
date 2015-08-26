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
            var idgame = 4; //aqui debe llevarse el nombre del juego que selecciono
            var idgame_free = 1; 
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

                    var options = {
                        "backdrop": "static"
                    }

                    $('#jgModal').modal(options);
                }
                       if (free > 0) {
                            setTimeout(function() {
                                
                           free=free-1;
                           NUM_PAYLINES=freeselect;

               s_oGame.onMaxBetjgXxx();
                                
                            },3000);

                }
                else{
                    freeselect=20;
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

            $('#jg-button1').click(function () {
                           free_gameslot = 0;
                  freeselect=20;
                setTimeout(function() {
                    console.log('el timeup');
                      $('#jgModal').modal('toggle');
               
                var intro = {
                    type: 'playfreegame',
                    free: 5

                }
                            socket.send(JSON.stringify(intro));
        }, 3000);
                
            document.getElementById('text-win').innerHTML = 'Has Ganado 5 juegos por 20 Lineas';
                



        
            });
            //10 x 10
            $('#jg-button2').click(function () {
              free_gameslot = 0;
              freeselect=10;
                var intro = {
                    type: 'playfreegame',
                    free: 10

                }
                socket.send(JSON.stringify(intro));
                $('#jgModal').modal('toggle');
            document.getElementById('text-win').innerHTML = 'Has Ganado 10 juegos por 10 Lineas';
            });
             $('#jg-button3').click(function () {
              free_gameslot = 0;
              freeselect=5;
                var intro = {
                    type: 'playfreegame',
                    free: 20

                }
                 document.getElementById('text-win').innerHTML = 'Has Ganado 20 juegos por 5 Lineas';
                socket.send(JSON.stringify(intro));
                $('#jgModal').modal('toggle');
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
                   free_gameslot = 1;
                   //ar freg = message.messagesend;
                   //openjg(freg);

                }
                      else if (message.type === 'free_game_play') {
                          console.log('aqui paso');
                         myId = message.userId;
                            if(free > 0){
                                console.log('aqui');
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



    </script>