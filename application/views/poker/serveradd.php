<?php include('./interface/header.php'); ?>
<div class="container-fluid ">
    <div class="row" id='rowsales'>
        <div class="col-lg-9 col-md-9 col-sm-9 hidden-xs content-game poker" id="">
            <div class="container-fluid" id="torbo">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 hidden-xs" id="">
                        <div class="alert alert-danger" style="display: none;" role="alert" id="user-conect">!!Aff, Ya se encuentra conectado, revise los dispositivos conectados <a class="btn btn-default link-error" id="" href="./dispositivos">AQUI...</a></div>
                        <div class="alert alert-info" style="display: none;" role="alert" id="boxsitdown"> 

                            <span class="input-group-addon glyphicon glyphicon-usd" id="sizing-addon3"></span>
                            <input type="range" oninput="outputUpdate(value)" step="1" class="form-control" placeholder="Minimo de coin para apostar" min="" max="" aria-describedby="sizing-addon3" id="inputapos">
                            <output for=fader id=volume>50</output>
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
                    <div class="col-lg-12 col-md-12 col-sm-12 hidden-xs" id="sales">

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
            </div>
            <section class="create-salas register-form col-lg-6 col-md-6 col-sm-6 col-lg-offset-3 col-md-offset-3 col-sm-offset-3" id="creating-sale">
                <span class="glyphicon glyphicon-remove-circle close" onclick="ocultar_create_sala();"></span>
                <div class="col-xs-12 ">
                    <h2>Crear una sala <span class="label label-default"> Diviertete!</span></h2>                    
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
                <div class="container-fluid">
                    <div class="row" id='rowgame' >
                        <div class="col-lg-12 col-md-12 col-sm-12 hidden-xs content-game " id="">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class=" col-lg-4 col-md-4 col-sm-4 hidden-xs " id='player1' ondblclick="seeplayer('#player1', 0);">
                                        <div class="player player1">
                                            <div class="caption name"><h3 id='player1name'>PLAYER1</h3></div>
                                            <div class="caption money" title="Saldo En Juego"><p id='player1apos'>apos</p></div>
                                            <div class="caption money" title="Saldo En Cuenta"><p id='player1coin'>1.000.000.000</p></div>
                                            <div class="img-profile">
                                                <img id='player1imageprofile' class='imagenprofile' src="https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xpf1/v/t1.0-1/p160x160/11241623_10206268773619839_5686855401427795827_n.jpg?oh=3259d2bcbeb060418918dc131287704f&oe=56085CC3&__gda__=1441758651_cbdaf177271a90b92a775fdbe2a2b610" alt="..." id='player1image'>
                                            </div>   
                                            <div class="caption tiempo"><p id='player1time'>TIME</p></div>
                                            <div class="cartas">
                                                <div class="carta1"></div>
                                                <div class="carta2"></div>
                                            </div>  
                                            <a class="thumbnail">
                                                <img src="./imagen/poker/cartas.png" alt="..." id='player1cartas'>
                                            </a>
                                            <a class="thumbnail">
                                                <img src="./imagen/poker/corazon/10co.png" alt="..." id='player1cartasplay'>
                                                <img src="./imagen/poker/pica/8pic.png" alt="..." id='player1cartasplay2'>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 hidden-xs" id='crupier'>
                                        <div class="curpie men">

                                        </div>
                                    </div>
                                    <div class=" col-lg-4 col-md-4 col-sm-4 hidden-xs " id='player2' ondblclick="seeplayer('#player2', 1);" >
                                        <div class="player player2">
                                            <div class="caption name"><h3 id='player2name'>PLAYER1</h3></div>
                                            <div class="caption money"><p id='player2coin'>13123</p></div>
                                            <div class="caption money"><p id='player2apos'>apos</p></div>
                                            <div class="img-profile">
                                                <img id='player2imageprofile' class='imagenprofile' src="https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xpf1/v/t1.0-1/p160x160/11241623_10206268773619839_5686855401427795827_n.jpg?oh=3259d2bcbeb060418918dc131287704f&oe=56085CC3&__gda__=1441758651_cbdaf177271a90b92a775fdbe2a2b610" alt="..." id='player1image'>
                                            </div> 
                                            <div class="caption tiempo"><h3 id='player2time'>TIME</h3></div>
                                            <div class="cartas">
                                                <div class="carta1"></div>
                                                <div class="carta2"></div>
                                            </div> 
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
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 hidden-xs" >
                                    <div class=" col-lg-4 col-md-4 col-sm-4 hidden-xs" id='player3'>
                                        <div class="player player3">
                                            <div class="caption name"><h3 id='player3name'>PLAYER1</h3></div>
                                            <div class="caption money"><p id='player3coin'>13123</p></div>
                                            <div class="caption money"><p id='player3apos'>apos</p></div>
                                            <div class="img-profile">
                                                <img id='player3imageprofile' class='imagenprofile' src="https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xpf1/v/t1.0-1/p160x160/11241623_10206268773619839_5686855401427795827_n.jpg?oh=3259d2bcbeb060418918dc131287704f&oe=56085CC3&__gda__=1441758651_cbdaf177271a90b92a775fdbe2a2b610" alt="..." id='player1image'>
                                            </div>
                                            <div class="caption tiempo"><h3 id='player3time'>TIME</h3></div>
                                            <div class="cartas">
                                                <div class="carta1"></div>
                                                <div class="carta2"></div>
                                            </div> 
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
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 hidden-xs" id='crupier'>
                                        <!--<a class="thumbnail">-->
                                            <!--<img src="./imagen/poker/mesa-poker.png" alt="..." id='crupier'>-->
                                        <!--</a>-->
                                    </div>
                                    <div class=" col-lg-4 col-md-4 col-sm-4 hidden-xs" id='player4'>
                                        <div class="player player4">
                                            <div class="caption name"><h3 id='player4name'>PLAYER1</h3></div>
                                            <div class="caption money"><p id='player4coin'>13123</p></div>
                                            <div class="caption money"><h3 id='player4apos'>apos</h3></div>
                                            <div class="img-profile">
                                                <img id='player4imageprofile' class='imagenprofile' src="https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xpf1/v/t1.0-1/p160x160/11241623_10206268773619839_5686855401427795827_n.jpg?oh=3259d2bcbeb060418918dc131287704f&oe=56085CC3&__gda__=1441758651_cbdaf177271a90b92a775fdbe2a2b610" alt="..." id='player1image'>
                                            </div>
                                            <div class="caption tiempo"><h3 id='player4time'>TIME</h3></div>
                                            <div class="cartas">
                                                <div class="carta1"></div>
                                                <div class="carta2"></div>
                                            </div> 
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

                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 hidden-xs">
                                    <div class=" col-lg-4 col-md-4 col-sm-4 hidden-xs" id='player5'>
                                        <div class="player player5">
                                            <div class="caption name"><h3 id='player5name'>PLAYER1</h3></div>
                                            <div class="caption money"><p id='player5coin'>13123</p></div>
                                            <div class="caption money"><h3 id='player5apos'>apos</h3></div>
                                            <div class="img-profile">
                                                <img id='player5imageprofile' class='imagenprofile' src="https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xpf1/v/t1.0-1/p160x160/11241623_10206268773619839_5686855401427795827_n.jpg?oh=3259d2bcbeb060418918dc131287704f&oe=56085CC3&__gda__=1441758651_cbdaf177271a90b92a775fdbe2a2b610" alt="..." id='player1image'>
                                            </div>
                                            <div class="caption tiempo"><h3 id='player5time'>TIME</h3></div>
                                            <div class="cartas">
                                                <div class="carta1"></div>
                                                <div class="carta2"></div>
                                            </div> 
                                            <a class="thumbnail">
                                                <img id='player5imageprofile' class='imagenprofile' src="https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xpf1/v/t1.0-1/p160x160/11241623_10206268773619839_5686855401427795827_n.jpg?oh=3259d2bcbeb060418918dc131287704f&oe=56085CC3&__gda__=1441758651_cbdaf177271a90b92a775fdbe2a2b610" alt="..." id='player1image'>
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
                                    <div class=" col-lg-4 col-md-4 col-sm-4 hidden-xs" id='player6' onclick='seeplayer("player1");'>
                                        <div class="player player6">
                                            <div class="caption name"><h3 id='player6name'>PLAYER1</h3></div>
                                            <div class="caption money"><p id='player6coin'>13123</p></div>
                                            <div class="caption money"><h3 id='player6apos'>apos</h3></div>
                                            <div class="img-profile">
                                                <img id='player6imageprofile' class='imagenprofile' src="https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xpf1/v/t1.0-1/p160x160/11241623_10206268773619839_5686855401427795827_n.jpg?oh=3259d2bcbeb060418918dc131287704f&oe=56085CC3&__gda__=1441758651_cbdaf177271a90b92a775fdbe2a2b610" alt="..." id='player1image'>
                                            </div>
                                            <div class="caption tiempo"><h3 id='player6time'>TIME</h3></div>
                                            <div class="cartas">
                                                <div class="carta1"></div>
                                                <div class="carta2"></div>
                                            </div> 
                                            <a class="thumbnail">
                                                <img id='player6imageprofile' class='imagenprofile' src="https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xpf1/v/t1.0-1/p160x160/11241623_10206268773619839_5686855401427795827_n.jpg?oh=3259d2bcbeb060418918dc131287704f&oe=56085CC3&__gda__=1441758651_cbdaf177271a90b92a775fdbe2a2b610" alt="..." id='player1image'>
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
                                    <div class=" col-lg-4 col-md-4 col-sm-4 hidden-xs" id='player7'>
                                      <div class="player player7">
                                            <div class="caption name"><h3 id='player7name'>PLAYER1</h3></div>
                                            <div class="caption money"><p id='player7coin'>13123</p></div>
                                            <div class="caption money"><h3 id='player7apos'>apos</h3></div>
                                            <div class="img-profile">
                                                <img id='player7imageprofile' class='imagenprofile' src="https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xpf1/v/t1.0-1/p160x160/11241623_10206268773619839_5686855401427795827_n.jpg?oh=3259d2bcbeb060418918dc131287704f&oe=56085CC3&__gda__=1441758651_cbdaf177271a90b92a775fdbe2a2b610" alt="..." id='player1image'>
                                            </div>
                                            <div class="caption tiempo"><h3 id='player7time'>TIME</h3></div>
                                            <div class="cartas">
                                                <div class="carta1"></div>
                                                <div class="carta2"></div>
                                            </div> 
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
                </div>
            </section>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 hidden-xs sidebar-game"></div>

    </div>
    <!--<div class="row" id='rowgame'>--> 


</div>
<script>
    function sales(arraycon, clients) {
        var content = " <table class='table table-striped list-sales '><tr class='titulo'><th class=''>SALA</th><th>APUESTA</th><th>MIN/MAX</th><th>MAX JUG</th></tr>";
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
        content += "<tr><td><p></p><p><span id='clients'> " + clients + "</span> Jugadores están conectados</p></td><td><a class='btn btn-default btn-crear-sala'  id='newsale' onclick='mostrar_create_sala();'>Crear sala</a><a class='btn btn-default'  id='buttonrefresh' onclick='Javascript:refresh();' >refrescar lista</a><a class='btn btn-default btn-play'  id='play' ><span class='glyphicon glyphicon-play-circle'></span>PLAY</a></td></tr>";
        content += "</tablet>";
        $('#sales').html(content);
    }

</script>
<?php include('./interface/footer.php'); ?>
