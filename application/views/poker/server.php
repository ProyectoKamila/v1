<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<title>Poker</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row" id='rowsales'>
            <div class="col-lg-8 col-md-8 col-sm-8 hidden-xs content-game" id="">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 hidden-xs" id="">

                            <div class="alert alert-danger" style="display: none;" role="alert" id="user-conect">!!Aff, Ya se encuentra conectado, revise los dispositivos conectados <a class="btn btn-default link-error" id="" href="./dispositivos">AQUI...</a></div>
                            <div class="alert alert-info" style="display: none;" role="alert" id="boxsitdown"> <span class="input-group-addon glyphicon glyphicon-usd" id="sizing-addon3"></span>
                                <input type="range" oninput="outputUpdate(value)" step="1" class="form-control" placeholder="Minimo de coin para apostar" min="" max="" aria-describedby="sizing-addon3" id="inputapos">
                                <output for=fader id=volume>50</output>
                                <a class="btn btn-default link-error" id="buttonsitdown">SENTARSE</a>
                            </div>
                        </div>




                        <div class="col-lg-12 col-md-12 col-sm-12 hidden-xs" id="">
                            <div class="alert alert-danger" style="display: none;" role="alert" id="connection-lost-message">Se ha perdido la conexión. intente <a class="btn btn-default link-error" id="buttonreconect">reconectar...</a></div>

                        </div>
                        <div class="clearfix"></div>
                        <div class="col-lg-12 col-md-12 col-sm-12 hidden-xs" id="game">
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-lg-12 col-md-12 col-sm-12 hidden-xs" id="sales">
                            <div class="clearfix"></div>



                        </div>
                        <div class="clearfix"></div>
                        <div class="input-group input-group-sm col-lg-12 col-md-12 col-sm-12 hidden-xs" style="display: none" id="boxpass">
                            <div class="input-group input-group-sm col-lg-12 col-md-12 col-sm-12 hidden-xs">
                                <div class="alert alert-danger" style="display: none;" role="alert" id="passloss"></div>

                                <input type="password" class="form-control" placeholder="Clave" aria-describedby="sizing-addon3" id="passbox">
                                <a class="btn btn-default link-error" id="buttonjoingame">Acceder.</a>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-4 hidden-xs sidebar-game"></div>
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
                        <a class="btn btn-default link-error" id="buttoncreate">Crear.</a>
                    </div>

                </div>
            </div>


        </div>
        <!--<div class="row" id='rowgame'>-->
        <div class="row" id='rowgame' style='display: none'>
            <div class="col-lg-8 col-md-8 col-sm-8 hidden-xs content-game" id="">
                <div class="col-lg-12 col-md-12 col-sm-12 hidden-xs">
                    <div class=" col-lg-4 col-md-4 col-sm-4 hidden-xs" id='player1' ondblclick="seeplayer('#player1', 0);">
                        <div class="caption"><h3 id='player1name'>PLAYER1</h3></div>
                        <div class="caption"><h3 id='player1coin'>13123</h3></div>
                        <div class="caption"><h3 id='player1time'>TIME</h3></div>
                        <div class="caption"><h3 id='player1apos'>apos</h3></div>
                        <a class="thumbnail">
                            <img id='player1imageprofile' class='imagenprofile' src="https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xpf1/v/t1.0-1/p160x160/11241623_10206268773619839_5686855401427795827_n.jpg?oh=3259d2bcbeb060418918dc131287704f&oe=56085CC3&__gda__=1441758651_cbdaf177271a90b92a775fdbe2a2b610" alt="..." id='player1image'>
                        </a>
                        <a class="thumbnail">
                            <img src="./imagen/poker/cartas.png" alt="..." id='player1cartas'>
                        </a>
                        <a class="thumbnail">
                            <img src="./imagen/poker/corazon/10co.png" alt="..." id='player1cartasplay'>
                            <img src="./imagen/poker/pica/8pic.png" alt="..." id='player1cartasplay2'>
                        </a>

                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 hidden-xs" id='crupier'>
                        <a class="thumbnail">
                            <img src="./imagen/poker/dealer.png" alt="..." id='crupier'>
                        </a>
                    </div>
                    <div class=" col-lg-4 col-md-4 col-sm-4 hidden-xs" id='player2'ondblclick="seeplayer('#player2', 1);" >
                        <div class="caption"><h3 id='player2name'>PLAYER1</h3></div>
                        <div class="caption"><h3 id='player2coin'>13123</h3></div>
                        <div class="caption"><h3 id='player2time'>TIME</h3></div>
                        <div class="caption"><h3 id='player2apos'>apos</h3></div>
                        <a class="thumbnail" >
                            <img id='player2imageprofile' class='imagenprofile' src="https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xpf1/v/t1.0-1/p160x160/11241623_10206268773619839_5686855401427795827_n.jpg?oh=3259d2bcbeb060418918dc131287704f&oe=56085CC3&__gda__=1441758651_cbdaf177271a90b92a775fdbe2a2b610" alt="..." id='player1image'>
                        </a>
                        <a class="thumbnail">
                            <img src="./imagen/poker/cartas.png" alt="..." id='player2cartas'>
                        </a>
                        <a class="thumbnail">
                            <img src="./imagen/poker/corazon/10co.png" alt="..." id='player2cartasplay'>
                            <img src="./imagen/poker/pica/8pic.png" alt="..." id='player2cartasplay2'>
                        </a>

                    </div>

                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 hidden-xs" >
                    <div class=" col-lg-4 col-md-4 col-sm-4 hidden-xs" id='player3'>
                        <div class="caption"><h3 id='player3name'>PLAYER1</h3></div>
                        <div class="caption"><h3 id='player3coin'>13123</h3></div>
                        <div class="caption"><h3 id='player3time'>TIME</h3></div>
                        <div class="caption"><h3 id='player3apos'>apos</h3></div>
                        <a class="thumbnail" >
                            <img id='player3imageprofile' class='imagenprofile' src="https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xpf1/v/t1.0-1/p160x160/11241623_10206268773619839_5686855401427795827_n.jpg?oh=3259d2bcbeb060418918dc131287704f&oe=56085CC3&__gda__=1441758651_cbdaf177271a90b92a775fdbe2a2b610" alt="..." id='player1image'>
                        </a>
                        <a class="thumbnail">
                            <img src="./imagen/poker/cartas.png" alt="..." id='player3cartas'>
                        </a>
                        <a class="thumbnail">
                            <img src="./imagen/poker/corazon/10co.png" alt="..." id='player3cartasplay'>
                            <img src="./imagen/poker/pica/8pic.png" alt="..." id='player3cartasplay2'>
                        </a>

                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 hidden-xs" id='crupier'>
                        <a class="thumbnail">
                            <img src="./imagen/poker/mesa-poker.png" alt="..." id='crupier'>
                        </a>
                    </div>
                    <div class=" col-lg-4 col-md-4 col-sm-4 hidden-xs" id='player4'>
                        <div class="caption"><h3 id='player4name'>PLAYER1</h3></div>
                        <div class="caption"><h3 id='player4coin'>13123</h3></div>
                        <div class="caption"><h3 id='player4time'>TIME</h3></div>
                        <div class="caption"><h3 id='player4apos'>apos</h3></div>
                        <a class="thumbnail">
                            <img id='player4imageprofile' class='imagenprofile' src="https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xpf1/v/t1.0-1/p160x160/11241623_10206268773619839_5686855401427795827_n.jpg?oh=3259d2bcbeb060418918dc131287704f&oe=56085CC3&__gda__=1441758651_cbdaf177271a90b92a775fdbe2a2b610" alt="..." id='player1image'>
                        </a>
                        <a class="thumbnail">
                            <img src="./imagen/poker/cartas.png" alt="..." id='player4cartas'>
                        </a>
                        <a class="thumbnail">
                            <img src="./imagen/poker/corazon/10co.png" alt="..." id='player4cartasplay'>
                            <img src="./imagen/poker/pica/8pic.png" alt="..." id='player4cartasplay2'>
                        </a>

                    </div>

                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 hidden-xs">
                    <div class=" col-lg-4 col-md-4 col-sm-4 hidden-xs" id='player5'>
                        <div class="caption"><h3 id='player5name'>PLAYER1</h3></div>
                        <div class="caption"><h3 id='player5coin'>13123</h3></div>
                        <div class="caption"><h3 id='player5time'>TIME</h3></div>
                        <div class="caption"><h3 id='player5apos'>apos</h3></div>
                        <a class="thumbnail" >
                            <img id='player5imageprofile' class='imagenprofile' src="https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xpf1/v/t1.0-1/p160x160/11241623_10206268773619839_5686855401427795827_n.jpg?oh=3259d2bcbeb060418918dc131287704f&oe=56085CC3&__gda__=1441758651_cbdaf177271a90b92a775fdbe2a2b610" alt="..." id='player1image'>
                        </a>
                        <a class="thumbnail">
                            <img src="./imagen/poker/cartas.png" alt="..." id='player5cartas'>
                        </a>
                        <a class="thumbnail">
                            <img src="./imagen/poker/corazon/10co.png" alt="..." id='player5cartasplay'>
                            <img src="./imagen/poker/pica/8pic.png" alt="..." id='player5cartasplay2'>
                        </a>

                    </div>
                    <div class=" col-lg-4 col-md-4 col-sm-4 hidden-xs" id='player6' onclick='seeplayer("player1");'>
                        <div class="caption"><h3 id='player6name'>PLAYER1</h3></div>
                        <div class="caption"><h3 id='player6coin'>13123</h3></div>
                        <div class="caption"><h3 id='player6time'>TIME</h3></div>
                        <div class="caption"><h3 id='player6apos'>apos</h3></div>
                        <a class="thumbnail">
                            <img id='player6imageprofile' class='imagenprofile' src="https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xpf1/v/t1.0-1/p160x160/11241623_10206268773619839_5686855401427795827_n.jpg?oh=3259d2bcbeb060418918dc131287704f&oe=56085CC3&__gda__=1441758651_cbdaf177271a90b92a775fdbe2a2b610" alt="..." id='player1image'>
                        </a>
                        <a class="thumbnail">
                            <img src="./imagen/poker/cartas.png" alt="..." id='player6cartas'>
                        </a>
                        <a class="thumbnail">
                            <img src="./imagen/poker/corazon/10co.png" alt="..." id='player6cartasplay'>
                            <img src="./imagen/poker/pica/8pic.png" alt="..." id='player6cartasplay2'>
                        </a>

                    </div>
                    <div class=" col-lg-4 col-md-4 col-sm-4 hidden-xs" id='player7'>
                        <div class="caption"><h3 id='player7name'>PLAYER1</h3></div>
                        <div class="caption"><h3 id='player7coin'>13123</h3></div>
                        <div class="caption"><h3 id='player7time'>TIME</h3></div>
                        <div class="caption"><h3 id='player7apos'>apos</h3></div>
                        <a class="thumbnail">
                            <img id='player7imageprofile' class='imagenprofile' src="https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xpf1/v/t1.0-1/p160x160/11241623_10206268773619839_5686855401427795827_n.jpg?oh=3259d2bcbeb060418918dc131287704f&oe=56085CC3&__gda__=1441758651_cbdaf177271a90b92a775fdbe2a2b610" alt="..." id='player1image'>
                        </a>
                        <a class="thumbnail">
                            <img src="./imagen/poker/cartas.png" alt="..." id='player7cartas'>
                        </a>
                        <a class="thumbnail">
                            <img src="./imagen/poker/corazon/10co.png" alt="..." id='player7cartasplay'>
                            <img src="./imagen/poker/pica/8pic.png" alt="..." id='player7cartasplay2'>
                        </a>

                    </div>

                </div>
            </div>

        </div>

                        </div>
                       

    </div>
    <style>.sin-pading{padding-left: 0px;padding-right: 0px;}.imagenprofile {
            width: 100px;
            height: 100px;
            border-radius: 50px;
            -moz-border-radius: 50px;
            -webkit-border-radius: 50px;
            -khtml-border-radius: 50px;
            overflow: hidden;
            float: right;
        }</style>
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
                        var socket;
//                        guarda el idde la silla
                        var idsit;
                        var protocol_identifier = 'server';
                        var myId;
                        var idsale;
                        var nicklist;
                        var is_typing_indicator;
                        var window_has_focus = true;
                        var actual_window_title = document.title;
                        var flash_title_timer;
                        var connected = false;
                        var connection_retry_timer;
                        var server_url = 'ws://localhost:8804/';
                        var token = "<?php
if (isset($_COOKIE['token'])) {
    echo $_COOKIE['token'];
} elseif ($this->session->userdata('token')) {
    echo $this->session->userdata('token');
}
?>";
                        var msg_bubble_colors = [
                            '#FFFFFF',
                            '#E2EBC0',
                            '#F3F1DC',
                            '#F6E1E1',
                            '#EDF9FC',
                            '#EBF3EC',
                            '#F4EAF1',
                            '#FCF1F8',
                            '#FBFAEF',
                            '#EFF2FC'
                        ];
                        $(document).ready(function() {
                            'use strict';

                            //si le dan click a reconectar
                            $('#buttonreconect').click(function() {
                                hideConnectionLostMessage();
                                connetserver();
                            });
                            $('#buttoncreate').click(function() {
                                var namesale = $('#namesale').val();
                                var clave = $('#passsale').val();
                                var minapos = $('#minapos').val();
                                var maxapos = $('#maxapos').val();
                                var minci = $('#minci').val();
                                var maxci = $('#maxci').val();
                                var maxus = $('#maxus').val();
                                var intro = {
                                    type: 'newsale',
                                    namesale: namesale,
                                    clave: clave,
                                    minapos: minapos,
                                    maxapos: maxapos,
                                    minci: minci,
                                    maxci: maxci,
                                    maxus: maxus
                                }

                                socket.send(JSON.stringify(intro));
                            });
                            $('#buttonsitdown').click(function() {
                                var min = $('#inputapos').attr('min');
                                var max = $('#inputapos').attr('max');
                                var inputapos = $('#inputapos').val();
                                if (min <= inputapos && max >= inputapos) {

                                    $('#boxsitdown').slideUp();


                                    var intro = {
                                        type: 'sitdown',
                                        inputapos: inputapos,
                                        idsale: idsale,
                                        idsit: idsit
                                    }

                                    socket.send(JSON.stringify(intro));
                                }
                            });

                            //boton para acceder al juego
                            $('#buttonjoingame').click(function() {
                                $('#passloss').slideUp();

                                var passbox = $('#passbox').val();
                                $('#passbox').val('');
                                conexgame(passbox);
                            });
                            //si no soporta websocket
                            if (!is_websocket_supported()) {
                                $('#game').html('Your browser <strong>doesnt</strong> support '
                                        + 'websockets :( <br/>Por favor cambie a otro explorador '
                                        + 'a uno moderlo, sugerimos este <a href="http://www.firefox.com/">Firefox</a> '
                                        + 'o <a href="http://www.google.com/chrome">Google Chrome</a>.');
                            }

                            connetserver();




                        });

                        function connetserver() {
                            //muestra el tiempo de espera al servidor revisar la funcion para que cargue si no hay conexion
                            // show_timer();
                            //abrir la conexion
                            open_connection();
                        }

                        function open_connection() {
                            socket = new WebSocket('ws://localhost:8804/', 'server');
                            socket.addEventListener("open", connection_established);
                        }
                        //cuando la conexion se establece
                        function connection_established(event) {
                            connected = true;
                            //hideConnectionLostMessage();
                            clearInterval(connection_retry_timer);
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

                        function introduce(nickname) {
                            var intro = {
                                type: 'join',
                                token: nickname
                            }

                            socket.send(JSON.stringify(intro));
                        }
                        //segun el mensaje que llegue realiza un caso especifico
                        function message_received(message) {
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
                                sales(array, message.clients);
                            }
                            //                accede al juego para elegir una silla
                            else if (message.type === 'joinsale') {
//             $('#chat-container').fadeIn();
//            $('#loading-message').hide();
                                var newvar = {};
                                newvar = new Object();
                                newvar = message.messagesend;
                                var myObj = newvar;
                                console.log(myObj);
//                                if (myObj.lenght !== undefined){
                                var array = $.map(myObj, function(value, index) {
                                    return [value];
                                });
//                                }
//                                else{
//                                    var array = [];
//                                }
                                console.log(array);
                                gameposition(array);

//            $('#rowsales').slideUp();
                                $('#rowgame').slideDown();
                                // $('#chat-container').fadeIn();
                                //$('#loading-message').hide();
                                //$('#game').html(message.messagesend);
                            }
                            else if (message.type === 'numcoin') {
                                $('#inputapos').attr('min', message.messagesend.apu_min);
                                $('#inputapos').attr('max', message.messagesend.apu_max);
                                $('#boxsitdown').slideDown();
                            }
//                            /si el password es falso
                            else if (message.type === 'passfalse') {

                                $('#passloss').html(message.messagesend);
                                $('#passloss').slideDown();
                                $('#boxpass').slideDown();
                            }
                            //                si ya esta conectado
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

                        //muestra el tiempo de espera al servidor
                        function show_timer() {
                            if (connected == false) {
                                var time_start = 5;
                                var time_string;
                                var connection_retry_timer = window.setInterval(function() {
                                    if (time_start-- > 0) {
                                        time_string = time_start + ' seconds';
                                    } else {
                                        time_string = '..ahem ahem, a little more..';
                                    }

                                    $('#game').html(time_string);
                                }, 1000);
                            }
                        }

                        //funcion para saber si funciona el websocket
                        function is_websocket_supported() {
                            if ('WebSocket' in window) {
                                return true;
                            }
                            return false;
                        }

                        function joingame(id, pass) {
                            idsale = id;
                            if (pass == 1) {
                                $('#boxpass').slideDown();
                            }
                            else {
                                conexgame();
                            }
                        }

                        function conexgame(pass) {
                            var intro = {
                                type: 'joingame',
                                idsale: idsale,
                                pass: pass
                            }

                            socket.send(JSON.stringify(intro));
                        }
                        //construye la tabla
                        function sales(arraycon, clients) {
                            var content = " <table class='table table-striped'><tr><th>SALA</th><th>APUESTA</th><th>MIN/MAX</th><th>MAX JUG</th></tr>";
                            var recorrido = arraycon;
                            var ide = 0;
                            for (var i in recorrido) {
                                var classtyle = "";
                                if (recorrido[i].boolpass !== 0) {
                                    classtyle = "glyphicon glyphicon-lock";
                                }


                                content += "<tr class='general'  ondblclick='joingame(" + ide + "," + recorrido[i].boolpass + ")'><th><span class='" + classtyle + "' id=''> </span>" + recorrido[i].name + "</th><th>" + recorrido[i].apu_min + "/" + recorrido[i].apu_max + "</th><th>" + recorrido[i].jug_min + "/" + recorrido[i].jug_max + "</th><th>" + recorrido[i].max_jug + "</th></tr>"
                                ide++;
                            }
                            content += "<tr><td><p></p><p><span id='clients'> " + clients + "</span> Jugadores están conectados</p></td><td><a class='btn btn-default'  id='newsale' >Crear sala</a><a class='btn btn-default'  id='buttonrefresh' onclick='Javascript:refresh();' >refrescar lista</a><a class='btn btn-default btn-play'  id='play' ><span class='glyphicon glyphicon-play-circle'></span>PLAY</a></td></tr>";
                            content += "</tablet>";
                            $('#sales').html(content);
                        }
                        function gameposition(arraycon) {
                            var con = 0;
//                            if (arraycon.length !== undefined) {
//                                con = arraycon.length;
//                            }
                            con = arraycon.length;
                            for (i = 0; i < con; i++) {
                                if (arraycon[i].name == undefined) {
                                    elementprofile(i, undefined, arraycon[i]);
                                }
                                else {
                                    elementprofile(i, true, arraycon[i]);
                                }
                            }
                        }
                        function elementprofile(i, disponible, arraycon) {
                            i++;
                            var elem = "#player" + i;
                            var name = elem + 'name';
                            var coin = elem + 'coin';
                            var time = elem + 'time';
                            var apos = elem + apos;
                            var imageprofile = elem + 'imageprofile';
                            var cartas = elem + 'cartas';
                            var cartasplay = elem + 'cartasplay';
                            var cartasplay2 = elem + 'cartasplay2';
                            if (disponible == undefined) {

                                $(name).html('disponible');
                                $(coin).html('');
                                $(time).html('');
                                $(apos).html('');
                                $(imageprofile).attr('src', './imagen/poker/jugador.png');
                                $(cartas).slideUp();
                                $(cartasplay).slideUp();
                                $(cartasplay2).slideUp();
                            }
                            else {
                                console.log(arraycon.imageprofile);
                                $(name).html(arraycon.name);
                                $(coin).html(arraycon.coin);
                                $(time).html('');
                                $(apos).html(arraycon.apos);
                                $(imageprofile).attr('src', arraycon.imageprofile);
                                $(cartas).slideDown();
                                $(cartasplay).slideUp();
                                $(cartasplay2).slideUp();
                            }
                        }
                        function refresh() {
                            socket.close();
                            $('#buttonreconect').click();
                        }
//    function para ver el perfil del usuario o para sentarse en el puesto
                        function seeplayer(player, idsit2) {
                            idsit = idsit2;
                            var elem = player;
                            var name = elem + 'name';
                            var disp = $(name).html();
                            if (disp == "disponible") {
                                var intro = {
                                    type: 'numcoin',
                                    inputapos: inputapos,
                                    idsale: idsale
                                }
                                socket.send(JSON.stringify(intro));
                                $('#sitdown').slideUp();
                            }
                            else {
                                $('#thisprofile').slideUp();
                            }
                        }
//                        funcion para mostrar el value al darle sentar input range
                        function outputUpdate(vol) {
                            document.querySelector('#volume').value = vol;
                        }

</script>


</body>