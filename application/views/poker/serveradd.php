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
    <script>
                        function sales(arraycon, clients) {
                            var content = " <table class='table table-striped'><tr><th>SALA</th><th>APUESTA</th><th>MIN/MAX</th><th>MAX JUG</th></tr>";
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


                                    content += "<tr class='general'  ondblclick='joingame(" + i + "," + recorrido[i].boolpass + ")'><th><span class='" + classtyle + "' id=''> </span>" + recorrido[i].name + "</th><th>" + recorrido[i].apu_min + "/" + recorrido[i].apu_max + "</th><th>" + recorrido[i].jug_min + "/" + recorrido[i].jug_max + "</th><th>" + recorrido[i].max_jug + "</th></tr>"
                                    ide++;

                                }
                            }
                            content += "<tr><td><p></p><p><span id='clients'> " + clients + "</span> Jugadores están conectados</p></td><td><a class='btn btn-default'  id='newsale' >Crear sala</a><a class='btn btn-default'  id='buttonrefresh' onclick='Javascript:refresh();' >refrescar lista</a><a class='btn btn-default btn-play'  id='play' ><span class='glyphicon glyphicon-play-circle'></span>PLAY</a></td></tr>";
                            content += "</tablet>";
                            $('#sales').html(content);
                        }

    </script>