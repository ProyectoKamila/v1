<!DOCTYPE html>
<html>
    <head>
        <base href="<?php echo base_url(); ?>" />
        <title></title>
        <link rel="stylesheet" href="./games/game-roulette/game750x600/css/reset.css" type="text/css">
        <link rel="stylesheet" href="./games/game-roulette/game750x600/css/main.css" type="text/css">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" />
	<meta name="msapplication-tap-highlight" content="no"/>

        <script type="text/javascript" src="./games/game-roulette/game750x600/js/jquery-2.0.3.min.js"></script>
        <script type="text/javascript" src="./games/game-roulette/game750x600/js/createjs-2014.12.12.min.js"></script>
        <script type="text/javascript" src="./games/game-roulette/game750x600/js/ctl_utils.js"></script>
        <script type="text/javascript" src="./games/game-roulette/game750x600/js/sprite_lib.js"></script>
        
        <script type="text/javascript" src="./games/game-roulette/game750x600/js/CRouletteSettings.js"></script>
        <script type="text/javascript" src="./games/game-roulette/game750x600/js/CFichesController.js"></script>
        <script type="text/javascript" src="./games/game-roulette/game750x600/js/CLang.js"></script>
        <script type="text/javascript" src="./games/game-roulette/game750x600/js/CPreloader.js"></script>
        <script type="text/javascript" src="./games/game-roulette/game750x600/js/CMain.js"></script>
        <script type="text/javascript" src="./games/game-roulette/game750x600/js/CTextButton.js"></script>
        <script type="text/javascript" src="./games/game-roulette/game750x600/js/CGfxButton.js"></script>
        <script type="text/javascript" src="./games/game-roulette/game750x600/js/CFicheBut.js"></script>
        <script type="text/javascript" src="./games/game-roulette/game750x600/js/CBetTableButton.js"></script>
        <script type="text/javascript" src="./games/game-roulette/game750x600/js/CBetTextButton.js"></script>
        <script type="text/javascript" src="./games/game-roulette/game750x600/js/CToggle.js"></script>
        <script type="text/javascript" src="./games/game-roulette/game750x600/js/CMenu.js"></script>
        <script type="text/javascript" src="./games/game-roulette/game750x600/js/CGame.js"></script>
        <script type="text/javascript" src="./games/game-roulette/game750x600/js/CInterface.js"></script>
        <script type="text/javascript" src="./games/game-roulette/game750x600/js/CMsgBox.js"></script>
        <script type="text/javascript" src="./games/game-roulette/game750x600/js/CTweenController.js"></script>
        <script type="text/javascript" src="./games/game-roulette/game750x600/js/CSeat.js"></script>
        <script type="text/javascript" src="./games/game-roulette/game750x600/js/CTableController.js"></script>
        <script type="text/javascript" src="./games/game-roulette/game750x600/js/CRouletteSettings.js"></script>
        <script type="text/javascript" src="./games/game-roulette/game750x600/js/CEnlight.js"></script>
        <script type="text/javascript" src="./games/game-roulette/game750x600/js/CWheelTopAnim.js"></script>
        <script type="text/javascript" src="./games/game-roulette/game750x600/js/CFiche.js"></script>
        <script type="text/javascript" src="./games/game-roulette/game750x600/js/CHistoryRow.js"></script>
        <script type="text/javascript" src="./games/game-roulette/game750x600/js/CWheelAnim.js"></script>
        <script type="text/javascript" src="./games/game-roulette/game750x600/js/CFinalBetPanel.js"></script>
        <script type="text/javascript" src="./games/game-roulette/game750x600/js/CNeighborsPanel.js"></script>
        <script type="text/javascript" src="./games/game-roulette/game750x600/js/CGameOver.js"></script>
        <?php $this->load->view('page/header');?>
    </head>
    <body ondragstart="return false;" ondrop="return false;" >
       <?php $this->load->view('page/navegation/header');?>
        <?php $this->load->view('page/navegation/notification');?>
	
          <script>
            $(document).ready(function(){
                     var oMain = new CMain({
                                            money: 0,      //STARING CREDIT FOR THE USER
                                            min_bet: 0.1,     //MINIMUM BET
                                            max_bet: 100,     //MAXIMUM BET
                                            time_bet: 10000,  //TIME TO WAIT FOR A BET IN MILLISECONDS
                                            time_winner: 3000, //TIME FOR WINNER SHOWING IN MILLISECONDS    
                                            win_occurrence: 100, //Win occurrence percentage (100 = always win). 
                                                                //SET THIS VALUE TO -1 IF YOU WANT WIN OCCURRENCE STRICTLY RELATED TO PLAYER BET ( SEE DOCUMENTATION)
                                            casino_cash:1    //The starting casino cash that is recharged by the money lost by the user
                                });
         var socket;
         var protocol_identifier = 'server';
         var myId;
         var idgame=1; //aqui debe llevarse el nombre del juego que selecciono
         var nicklist;
         var is_typing_indicator;
         var window_has_focus = true;
         var actual_window_title = document.title;
         var flash_title_timer;
         var connected = false;
         var connection_retry_timer;
         var server_url = 'ws://162.252.57.97:8809/';
         var token = "<?php
         if (isset($_COOKIE['token'])) {
            echo $_COOKIE['token'];
        } elseif ($this->session->userdata('token')) {
            echo $this->session->userdata('token');
        }
        ?>";

                     $(oMain).on("game_start", function(evt) {
                      totalcoins();
            var options = {
                "backdrop" : "static"
            }

            $('#myModal').modal(options);
                             //alert("game_start");
                     });

                     $(oMain).on("end_bet", function(evt,iMoney,iBetWin) {
                             //alert("iMoney: "+iMoney + " Win:"+iBetWin);
                     });

                     $(oMain).on("restart", function(evt) {
                             //alert("restart");
                     });
                     
                     $(oMain).on("recharge", function(evt) {
                             //alert("recharge");
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



connetserver();
function connetserver() {
               
                open_connection();
            }

            function open_connection() {

             //   socket = new WebSocket('ws://162.252.57.97:8808/', 'server');
             socket = new WebSocket('ws://localhost:8809/', 'server');


                socket.addEventListener("open", connection_established);
            }
            //cuando la conexion se establece
            function connection_established(event) {
                connected = true;
                //hideConnectionLostMessage();
                clearInterval(connection_retry_timer);
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
                //trae las salas actuales
                if (message.type === 'sales') {
                    myId = message.userId;
                    // $('#chat-container').fadeIn();
                    //$('#loading-message').hide();
                    var newvar = {};
                    newvar = new Object();
                    newvar = message.messagesend;
                    var myObj = newvar;

                    var array = $.map(myObj, function(value, index) {
                        return [value];
                    });
                    //sales(array, message.clients);
                }
                //                si ya esta conectado
               
                else if (message.type === 'money_total') {
                    myId = message.userId;

                    var  coinsvar = message.messagesend;
                    coinslabel(coinsvar);

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
                    console.log(message.messagesend);
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
                    is_typing_indicator = setTimeout(function() {
                        $('#is-typig-status').fadeOut();
                    }, 2000);
                }

            }
         
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
});
        </script>
    <div class="container-fluid sin-padding">
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
    <?php $this->load->view('page/footer'); ?>
    

    </body>
</html>