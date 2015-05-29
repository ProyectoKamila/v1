<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<title>Poker</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-8 hidden-xs content-game" id="">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 hidden-xs" id="">

                            <div class="alert alert-danger" style="display: none;" role="alert" id="user-conect">!!Aff, Ya se encuentra conectado, revise los dispositivos conectados <a class="btn btn-default link-error" id="" href="./dispositivos">AQUI...</a></div>

                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 hidden-xs" id="">
                            <div class="alert alert-danger" style="display: none;" role="alert" id="connection-lost-message">Se ha perdido la conexión. intente <a class="btn btn-default link-error" id="buttonreconect">reconectar...</a></div>

                        </div>
                        <div class="clearfix"></div>
                        <div class="col-lg-12 col-md-12 col-sm-12 hidden-xs" id="game">
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-lg-12 col-md-12 col-sm-12 hidden-xs" id="sales">

                        </div>
                    </div>
                </div>


            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 hidden-xs sidebar-game"></div>
        </div>

    </div>


=======
                            <div class="clearfix"></div>



                        </div>
                        <div class="clearfix"></div>

                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-4 hidden-xs sidebar-game"></div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 hidden-xs sin-pading" id="newsale">

                    <div class="input-group input-group-sm col-lg-12 col-md-12 col-sm-12 hidden-xs">
                        <span class="input-group-addon glyphicon glyphicon-ok" id="sizing-addon3"></span>
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
        <style>.sin-pading{padding-left: 0px;padding-right: 0px;}</style>
    </div>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            'use strict';
            var socket;
            var protocol_identifier = 'server';
            var myId;
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


//si le dan click a reconectar
            $('#buttonreconect').click(function() {
                hideConnectionLostMessage();
                connetserver();

            });

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

            //si no soporta websocket
            if (!is_websocket_supported()) {
                $('#game').html('Your browser <strong>doesnt</strong> support '
                        + 'websockets :( <br/>Por favor cambie a otro explorador '
                        + 'a uno moderlo, sugerimos este <a href="http://www.firefox.com/">Firefox</a> '
                        + 'o <a href="http://www.google.com/chrome">Google Chrome</a>.');
            }

            connetserver();

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
                    var myObj = newvar

                    var array = $.map(myObj, function(value, index) {
                        return [value];
                    });

                    sales(array, message.clients);
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

            //construye la tabla
            function sales(arraycon, clients) {
                var content = " <table class='table table-striped'><tr><th>SALA</th><th>APUESTA</th><th>MIN/MAX</th><th>MAX JUG</th></tr>";
                var recorrido = arraycon;
                for (var i in recorrido) {
                    content += "<tr><th>" + recorrido[i].name + "</th><th>" + recorrido[i].apu_min + "/" + recorrido[i].apu_max + "</th><th>" + recorrido[i].jug_min + "/" + recorrido[i].jug_max + "</th><th>" + recorrido[i].max_jug + "</th></tr>"
                }
                content += "<tr><td><p></p><p><span id='clients'>" + clients + "</span> Jugadores están conectados</p></td><td><a class='btn btn-default'  id='newsale' >Crear sala</a><a class='btn btn-default'  id='buttonrefresh' onclick='Javascript:refresh();' >refrescar lista</a><a class='btn btn-default btn-play'  id='play' ><span class='glyphicon glyphicon-play-circle'></span>PLAY</a></td></tr>";

                var classtyle = "";
                    if (recorrido[i].boolpass !== 0) {
                        classtyle = "glyphicon glyphicon-lock";
                    }


                    content += "<tr><th><span class='"+classtyle+"'> </span>" + recorrido[i].name + "</th><th>" + recorrido[i].apu_min + "/" + recorrido[i].apu_max + "</th><th>" + recorrido[i].jug_min + "/" + recorrido[i].jug_max + "</th><th>" + recorrido[i].max_jug + "</th></tr>"
                }
                content += "<tr><td><p></p><p><span id='clients'> " + clients + "</span> Jugadores están conectados</p></td><td><a class='btn btn-default'  id='newsale' >Crear sala</a><a class='btn btn-default'  id='buttonrefresh' onclick='Javascript:refresh();' >refrescar lista</a><a class='btn btn-default btn-play'  id='play' ><span class='glyphicon glyphicon-play-circle'></span>PLAY</a></td></tr>";

                content += "</tablet>";
                $('#sales').html(content);
            }



        });
             function refresh() {
            $('#buttonreconect').click();
            }

    </script>

</body>