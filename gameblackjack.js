    //poker
    var WebSocketServer = require('websocket').server;
    var mysql = require('mysql');



    // Check if SSL support is enabled
    if (process.argv.indexOf('--enable-ssl') !== -1) {
        //mensaje a enviar en los query

        var https = require('https');
        var fs = require('fs');

        var options = {
            key: fs.readFileSync('/home/conf/ssl.key'),
            cert: fs.readFileSync('/home/conf/ssl.crt')
        };

        var server = https.createServer(options, function(request, response) {
            response.writeHead(404);
            response.end();
        });

        var port = 8805;
        var server_start_message = (new Date()) + ' Springle server with SSL is listening on port ' + port;
    } else {
        var http = require('http');

        var server = http.createServer(function(request, response) {
            response.writeHead(404);
            response.end();
        });

        var port = 8810;
        var server_start_message = (new Date()) + ' Springle server is listening on port ' + port;
    }

    var messagesend = [];
    var clients = 0;
    var cont = 0;
    var clientsconection = {};
    var clientsconectionall = [];
    var rooms = {};
    var jackpot =  0;
    var debt =  0;
    var percent = 0.0;
    //clientsconection['all'] = {};



    var allowed_origins = [
    'localhost',
    'springle.rebugged.com',
    'sky.rebugged.com',
    'developer.cdn.mozilla.net',
    '192.168.0.118',
    'casino4as.com',
    'localhost:8888'
    ];


    var mysqlc = mysql.createConnection(
    {
        host: '23.229.215.154',
        user: 'v1',
        password: 'Temporal01',
        database: 'v1',
    }
    );

    mysqlc.connect();
    var string = 'SELECT * FROM v1.casino_jackpot where id_jackpot=1';

    mysqlc.query(string, function(err, row, fields) {

            //console.log('verificar la variable row' + row);

            if (typeof(row)) {
              //  console.log('entre a jackpotcall' + row[0]['jackpot']);
             //   console.log('entre a debt' + row[0]['debt']);
             //   console.log('entre a jackpotcall' + row[0]['percent']);
             jackpot =  row[0]['jackpot'];
             debt =  row[0]['debt'];
             percent =  row[0]['percent'];

      //  console.log('jackpot' + jackpot);
      //  console.log('debt' + debt);
      //  console.log('percent' + percent);
  }

        //console.log(jackpot);
    });

    mysqlc.end();

    var allowed_protocol = 'server';

    var connection_id = 0;

    server.listen(port, function() {
      //  console.log(server_start_message);
  });

    wsServer = new WebSocketServer({
        httpServer: server,
        autoAcceptConnections: false
    });

    function originIsAllowed(origin) {
        var origin_trimmed = origin.replace('http://', '')
        .replace('https://', '');

        if (allowed_origins.indexOf(origin_trimmed) > -1) {
            return true;
        }

        return false;
    }

    wsServer.on('request', function(request) {
        if (!originIsAllowed(request.origin)) {
            // Make sure we only accept requests from an allowed origin
            request.reject();
            return;
        }

        if (request.requestedProtocols.indexOf(allowed_protocol) === -1) {
            request.reject();
            return false;
        }

        var connection = request.accept('server', request.origin);
        connection.id = connection_id++;
        cont = cont + 1;
      //  console.log(cont);

      clientsconectionall[cont] = connection;

      connection.on('message', function(message) {
        if (message.type === 'utf8') {
            var msgObj = JSON.parse(message.utf8Data);
                //datos del usuario


                //para acceder y devolver datos del tokken
                if (msgObj.type === 'join') {
                    clients = clients + 1;
                    connection.token = msgObj.token;
                    connection.id_game = msgObj.idgame;
                    connection.sitcoins = 0;
                    connection.coins_i = 0;
                    connection.coins_f = 0;
                    connection.date_i = getDateTime();
                    connection.date_f = '0/0/0 0:0:0'

                    if (clientsconection[connection.token] !== undefined) {
                        sendmessageuser(connection, 'readyconect', 'Ya se encuentra conectado, verifique los dispositivos');
                        connection.close();
                    } else {

                        clientsconection[connection.token] = connection.token;


                        var string = 'SELECT * FROM active_session INNER JOIN user_data WHERE user_data.id_user = active_session.id_user AND active_session.token= "' + connection.token + '"';


                        console.log(string);

                        var mysqlc = mysql.createConnection(
                        {
                            host: '23.229.215.154',
                            user: 'v1',
                            password: 'Temporal01',
                            database: 'v1',
                        }
                        );
                        mysqlc.connect();
                        mysqlc.query(string, function(err, row, fields) {
                            if (typeof(row)) {
                                connection.id_user = row[0]['id_user'];

                                if (row[0]['id_user'] == clientsconection[connection.id_user]) {

                                    sendmessageuser(connection, 'readyconect', 'Ya se encuentra conectado, verifique los dispositivos');
                                    connection.close();
                                }
                                else {
                                    clientsconection[connection.id_user] = connection.id_user;


                                    sendmessageuser(connection, 'welcome', row);
                                }
                            }
                            else {
                                sendmessageuser(connection, 'welcome', 'aqui falso');
                            }
                        });

                        sendmessageuser(connection, 'sales', rooms);

                        mysqlc.end();
                    }


                }
                else if (msgObj.type === 'money_ws') {


                    getmoneyuser(msgObj);



                }
                else if (msgObj.type === 'sitmoney') {


                    setmoneyuser(msgObj);



                }

                else if (msgObj.type === 'prueba') {
                    pruebaserver(msgObj);



                }

                 else if (msgObj.type === 'dealer') {
                    dealingnode(msgObj);



                }


                else if (msgObj.type === 'intro') {
                    connection.nickname = msgObj.nickname;
                    connection.chatroom = msgObj.chatroom;
                    connection.idgame = msgObj.idgame;


                    if (rooms[msgObj.chatroom] !== undefined) {
                        rooms[msgObj.chatroom].push(connection);
                    } else {
                        rooms[msgObj.chatroom] = [connection];
                    }

                    connection.sendUTF(JSON.stringify({
                        type: 'welcome',
                        userId: connection.id
                    }));

                    broadcast_chatters_list(msgObj.chatroom);
                } else if (msgObj.type === 'message') {

                    message_to_send = JSON.parse(message.utf8Data);
                    message_to_send['sender'] = connection.id.toString();
                    message_to_send = JSON.stringify(message_to_send);

                   // console.log(message_to_send)
                   broadcast_message(message_to_send, msgObj.chatroom);
               } else if (msgObj.type.match(/^activity_/)) {
                    // echo back any message type that start with activity_
                    message_to_send = JSON.parse(message.utf8Data);
                    message_to_send['sender'] = connection.id.toString();
                    message_to_send = JSON.stringify(message_to_send);

                    broadcast_message(message_to_send, msgObj.chatroom);
                }
            } else if (message.type === 'binary') {
                // At the moment, we are handling only text messages - no binary
                connection.sendUTF('Invalid message');
            }
        });


    connection.on('close', function(reasonCode, description) {
        var chatroom = connection.chatroom;
        var users = rooms[chatroom];
        var usersall = clientsconectionall;
        clients = clients - 1;
        var newarrayclient = {};
        var newarrayallclient = {};
        updtclose(connection.sitcoins , connection.coins);
        delete clientsconection[connection.token];
        delete clientsconection[connection.id_user];
        delete clientsconection[connection.sitcoins];
        delete clientsconection[connection.coins];
        delete clientsconection[connection.id_game];

    //saca de la conexion al cliente si esta conectado
    for (var i in clientsconection) {
        if (clientsconection[i] !== undefined) {
            newarrayclient[clientsconection[i]] = clientsconection[i];
        }
    }

    clientsconection = newarrayclient;

    //aqui borro en el arreglo la conexion del usuario que se fue
            /*for (var i in usersall) {
                if (connection.id === usersall[i].id) {
                    clientsconectionall.splice(i, 1);
                }
            }*/
            for (var i in users) {
                if (connection.id === users[i].id) {
                    rooms[chatroom].splice(i, 1);
                    broadcast_chatters_list(connection.chatroom);
                }
            }
           // console.log((new Date()) + ' Peer ' + connection.remoteAddress + ' disconnected.');
       });

    function broadcast_message(message, chatroom) {
        var users = rooms[chatroom];

        for (var i in users) {
            users[i].sendUTF(message);
        }
    }

    function broadcast_chatters_list(chatroom) {
        var nicklist = [];
        var msg_to_send;
        var users = rooms[chatroom];

        for (var i in users) {
            nicklist.push(users[i].nickname);
        }

        msg_to_send = JSON.stringify({
            type: 'nicklist',
            nicklist: nicklist
        });

        broadcast_message(msg_to_send, chatroom);
    }

    function send_poke() {
        var msg = JSON.stringify({
            type: 'message',
            nickname: 'Bot',
            message: 'This is an automated message from the server.'
        });

        broadcast_message(msg);
    }

    function menssageforsend(message) {
        messagesend = message;
    }

    function mysqlcreate() {
        var mysqlconect = mysql.createConnection(
        {
            host: '23.229.215.154',
            user: 'v1',
            password: 'Temporal01',
            database: 'v1',
        }
        );

        return mysqlconect;

    }
    function getDateTime() {
      var now     = new Date(); 
      var year    = now.getFullYear();
      var month   = now.getMonth()+1; 
      var day     = now.getDate();
      var hour    = now.getHours();
      var minute  = now.getMinutes();
      var second  = now.getSeconds(); 
      if(month.toString().length == 1) {
          var month = '0'+month;
      }
      if(day.toString().length == 1) {
          var day = '0'+day;
      }   
      if(hour.toString().length == 1) {
          var hour = '0'+hour;
      }
      if(minute.toString().length == 1) {
          var minute = '0'+minute;
      }
      if(second.toString().length == 1) {
          var second = '0'+second;
      }   
      var dateTime = year+'/'+month+'/'+day+' '+hour+':'+minute+':'+second;   
      return dateTime;
  }

  //////////////////////////////////////////////  Incio de clase cgamesetting 
  function CGameSettings(){
    
    var _aCardDeck;
    var _aShuffledCardDecks;
    var _aCardValue;
    var _aFichesValue;
    
    this._init = function(){
        _aCardValue=new Array();
        _aCardDeck=new Array();
        for(var i=0;i<2;i++){
            for(var j=0;j<52;j++){
                _aCardDeck.push(j);
                var iRest=(j+1)%13;
                if(iRest>10 || iRest === 0){
                        iRest=10;
                }
                if(iRest === 1){
                        iRest=11;
                }
                _aCardValue.push(iRest);
            }
        }
        
        _aFichesValue=new Array(0.1,1,5,10,25,100);
    };
        
    this.getFichesValues = function(){
            return _aFichesValue;
    };
        
    this.getFichesValueAt = function(iIndex){
            return _aFichesValue[iIndex];
    };
        
    this.getIndexForFiches = function(iValue){
        var iRes=0;
        for(var i=0;i<_aFichesValue.length;i++){
                if(_aFichesValue[i] === iValue){
                        iRes=i;
                }
        }
        return iRes; 
    };
        
    this.generateFichesPile = function(iFichesValue){
        var aFichesPile=new Array();
        var iValueRest;
        var iCont=_aFichesValue.length-1;
        var iCurMaxFicheStake=_aFichesValue[iCont];


        do{
                iValueRest=iFichesValue%iCurMaxFicheStake;
                iValueRest=CMath.roundDecimal(iValueRest,1);

                var iDivision=Math.floor(iFichesValue/iCurMaxFicheStake);

                for(var i=0;i<iDivision;i++){
                        aFichesPile.push(iCurMaxFicheStake);
                }

                iCont--;
                iCurMaxFicheStake=_aFichesValue[iCont];
                iFichesValue=iValueRest;
        }while(iValueRest>0 && iCont>-1);

        return aFichesPile;
    };
        
    this.timeToString = function( iMillisec ){      
        iMillisec = Math.round((iMillisec/1000));

        var iMins = Math.floor(iMillisec/60);
        var iSecs = iMillisec-(iMins*60);

        var szRet = "";

        if ( iMins < 10 ){
                szRet += "0" + iMins + ":";
        }else{
                szRet += iMins + ":";
        }

        if ( iSecs < 10 ){
                szRet += "0" + iSecs;
        }else{
                szRet += iSecs;
        } 

        return szRet;   
    };
        
    this.getShuffledCardDeck = function(){
        var aTmpDeck=new Array();

        for(var i=0;i<_aCardDeck.length;i++){
                aTmpDeck[i]=_aCardDeck[i];
        }

        _aShuffledCardDecks = new Array();
        while (aTmpDeck.length > 0) {
                _aShuffledCardDecks.push(aTmpDeck.splice(Math.round(Math.random() * (aTmpDeck.length - 1)), 1)[0]);
        }

        return _aShuffledCardDecks; 
    };
        
    this.getCardValue = function(iId){
            return _aCardValue[iId];
    };
                
    this._init();
}


//////////////////////////////////////////////////////////////77//fin de clase cgamesettings


//////////////////////////////////////////////////////////////////funcion dealing inicio

   function dealingnode(objeto){

var _iCardIndexToDeal= objeto._iCardIndexToDeal;
   var          _aCurActiveCardOffset= objeto._aCurActiveCardOffset;
     var        _iCardDealedToDealer= objeto._iCardDealedToDealer;
      var       _iCardDealedToPlayer= objeto._iCardDealedToPlayer;
        var     _iNextCardForDealer= objeto._iNextCardForDealer;
          var   _iNextCardForPlayer= objeto._iNextCardForPlayer;


        if(_iCardIndexToDeal<_aCurActiveCardOffset){
           /* var oCard = new CCard(_oStartingCardOffset.getX(),_oStartingCardOffset.getY(),_oCardContainer);

            var pStartingPoint = new CVector2(_oStartingCardOffset.getX(),_oStartingCardOffset.getY());
            var pEndingPoint;*/

                //THIS CARD IS FOR THE DEALER
                if((_iCardIndexToDeal%_aCurActiveCardOffset.length) === 1){
                    _iCardDealedToDealer++;
                   // pEndingPoint=new CVector2(_oDealerCardOffset.getX()+(CARD_WIDTH+2)*(_iCardIndexToDeal > 1?1:0),_oDealerCardOffset.getY());

                    var e = 0;

                    while (s_oGameSettings.getCardValue(_aCardsInCurHandForDealer[_iNextCardForDealer + e])!==11) {

                       e = e + 1; 

                       console.log(s_oGameSettings.getCardValue(_aCardsInCurHandForDealer[_iNextCardForDealer]) + ' carta dealer');
                        // valor que es necesario enviar
                       s_oGameSettings.getCardValue(_aCardsInCurHandForDealer[_iNextCardForDealer + e]);

                   }
/*  oCard.setInfo(pStartingPoint,pEndingPoint,_aCardsInCurHandForDealer[_iNextCardForDealer + e],
                    s_oGameSettings.getCardValue(_aCardsInCurHandForDealer[_iNextCardForDealer + e]),
                    true,_iCardDealedToDealer);*/
                  var sendcardealer = {
                    carta: _aCardsInCurHandForDealer[_iNextCardForDealer + e],
                    valor: s_oGameSettings.getCardValue(_aCardsInCurHandForDealer[_iNextCardForDealer + e])
                  }

                
                

                  _iNextCardForDealer++;
                  /* if(_iCardDealedToDealer === 2){
                   // oCard.addEventListener(ON_CARD_SHOWN,this._onCardShown);
                }*/
            }else{
                _iCardDealedToPlayer++;
                var f = 0;
                while (s_oGameSettings.getCardValue(_aCardsInCurHandForPlayer[_iNextCardForPlayer + f])!==11) {

                   f = f + 1; 

                   console.log(s_oGameSettings.getCardValue(_aCardsInCurHandForPlayer[_iNextCardForPlayer  + f]) + ' carta player');
                   s_oGameSettings.getCardValue(_aCardsInCurHandForPlayer[_iNextCardForPlayer + f]);

               }                    
              /* oCard.setInfo(pStartingPoint,_oSeat.getAttachCardOffset(),_aCardsInCurHandForPlayer[_iNextCardForPlayer + f],
                s_oGameSettings.getCardValue(_aCardsInCurHandForPlayer[_iNextCardForPlayer + f]),
                false,_oSeat.newCardDealed());*/
             var sendcarplayer = {
                    carta: _aCardsInCurHandForDealer[_iNextCardForDealer + e],
                    valor: s_oGameSettings.getCardValue(_aCardsInCurHandForDealer[_iNextCardForDealer + e])
                  }

              


             //  _iNextCardForPlayer++;
             /*  if(_iCardDealedToPlayer === 2){
                //oCard.addEventListener(ON_CARD_SHOWN,this._onCardShown);
            }  */ 
        }

        


        //oCard.addEventListener(ON_CARD_ANIMATION_ENDING,this.cardFromDealerArrived);
        //oCard.addEventListener(ON_CARD_TO_REMOVE,this._onRemoveCard);

        /*if(DISABLE_SOUND_MOBILE === false || s_bMobile === false){
            createjs.Sound.play("card");
        }*/
    }else{
        //this._checkAvailableActionForPlayer();

        console.log('enviar');
 //sendmessageuser(connection, 'dealer', sendcardealer /*,_aFinalSymbolCombo*/);
          // sendmessageuser(connection, 'player', sendcardplayer /*,_aFinalSymbolCombo*/);
    }

}

//////////////////////////////////////////////////////////////////funcion dealing fin




  function pruebaserver(objeto){

    //var objeto = JSON.parse(obj);
    var  _bPlayerTurn = objeto._bPlayerTurnEnviar ;
    var  _bSplitActive = objeto._bSplitActiveEnviar ;
    var  _bDoubleForPlayer = objeto._bDoubleForPlayerEnviar ;
    var  _iInsuranceBet = objeto._iInsuranceBetEnviar ;
    var  _iTimeElaps = objeto._iTimeElapsEnviar ;
    var  _iCardIndexToDeal = objeto._iCardIndexToDealEnviar ;
    var  _iDealerValueCard = objeto._iDealerValueCardEnviar ;
    var  _iCardDealedToDealer = objeto._iCardDealedToDealerEnviar ;
    var  _iCardDealedToPlayer = objeto._iCardDealedToPlayerEnviar ;
    var  _iAcesForDealer = objeto._iAcesForDealerEnviar ;
    var  _iCurFichesToWait = objeto._iCurFichesToWaitEnviar ;
   // var  _oSeat = objeto._oSeatEnviar ;
    var  _aCardsDealing = objeto._aCardsDealingEnviar ;
    var  _aDealerCards = objeto._aDealerCardsEnviar ;
   // var  _oInterface = objeto._oInterfaceEnviar ;
    var  acarddealer  = objeto.acarddealerEnviar ;
    var  acardplayer = objeto.acardplayerEnviar ;
    var  ncardd = objeto.ncarddEnviar ;
    var  ncardp = objeto.ncardpEnviar ;
    var  _aCardDeck = objeto._aCardDeckEnviar ;
    var  _aCardsInCurHandForPlayer = objeto._aCardsInCurHandForPlayerEnviar ;
    var  _aCardsInCurHandForDealer = objeto._aCardsInCurHandForDealerEnviar ;
    //var s_oGameSettings=  objeto.s_oGameSettingsEnviar;
   var s_oGameSettings=new CGameSettings();


    console.log( _bPlayerTurn+  ' _bPlayerTurn');
    console.log( _bSplitActive+  ' _bSplitActive');
    console.log( _bDoubleForPlayer+  ' _bDoubleForPlayer');
    console.log( _iInsuranceBet+  ' _iInsuranceBet');
    console.log( _iTimeElaps+  ' _iTimeElaps');
    console.log( _iCardIndexToDeal+  ' _iCardIndexToDeal');
    console.log( _iDealerValueCard+  ' _iDealerValueCard');
    console.log( _iCardDealedToDealer+  ' _iCardDealedToDealer');
    console.log( _iCardDealedToPlayer+  ' _iCardDealedToPlayer');
    console.log( _iAcesForDealer+  ' _iAcesForDealer');
    console.log( _iCurFichesToWait+  ' _iCurFichesToWait');
   // console.log( _oSeat+  ' _oSeat');
    console.log( _aCardsDealing+  ' _aCardsDealing');
    console.log( _aDealerCards+  ' _aDealerCards');
    //console.log( _oInterface+  ' _oInterface');
    console.log( acarddealer +  ' acarddealer ');
    console.log( acardplayer+  ' acardplayer');
    console.log( ncardd+  ' ncardd');
    console.log( ncardp+  ' ncardp');
    console.log( _aCardDeck+  ' _aCardDeck');
    console.log( _aCardsInCurHandForPlayer+  ' _aCardsInCurHandForPlayer');
    console.log( _aCardsInCurHandForDealer+  ' _aCardsInCurHandForDealer');
    console.log( s_oGameSettings+  ' s_oGameSettings');

   
            for(var k=0;k<_aCardDeck.length;k++){
                if(k%2 === 0){

                    _aCardsInCurHandForPlayer.push(_aCardDeck[k]);
                    acardplayer.push(s_oGameSettings.getCardValue(_aCardDeck[k])); // aca gaurdo del valor de la carta
                }else{
                    _aCardsInCurHandForDealer.push(_aCardDeck[k]);
                    acarddealer.push(s_oGameSettings.getCardValue(_aCardDeck[k])); // aca gaurdo del valor de la carta
                }
            }
            console.log(_aCardsInCurHandForPlayer + "mazo player");
            console.log(acardplayer + "mazo vAlortes player");
            console.log('+++++++++++++++++++++++++++++++++');
            console.log(_aCardsInCurHandForDealer + "mazo dealer");
            console.log(acarddealer + "mazo valores dealer");


            _iNextCardForPlayer=0;
            _iNextCardForDealer=0;

             sendmessageuser(connection, 'prueba', _aCardsInCurHandForPlayer /*,_aFinalSymbolCombo*/);
             sendmessageuser2(connection, 'prueba2', _aCardsInCurHandForDealer /*,_aFinalSymbolCombo*/);

        }


        function sendmessageuser(usersend, type, forsend) {
          // console.log('forsend ' + forsend);
          usersend.send(JSON.stringify({
            type: type,
            userId: connection.id,
            messagesend: forsend,
            clients: clients

        }));
      }


      function sendmessageuser2(usersend, type, forsend) {
           // console.log(forsend+'DOS');
           usersend.send(JSON.stringify({
            type: type,
            userId: connection.id,
            messagesend: forsend,
            clients: clients

        }));
       }

       function sendcarddealer(usersend, type, forsend) {
          // console.log('forsend ' + forsend);
          usersend.send(JSON.stringify({
            type: type,
            userId: connection.id,
            messagesend: forsend,
            clients: clients

        }));
      }
      function sendcardplayer(usersend, type, forsend) {
          // console.log('forsend ' + forsend);
          usersend.send(JSON.stringify({
            type: type,
            userId: connection.id,
            messagesend: forsend,
            clients: clients

        }));
      }


       function update_jackpot(jack,debito){

        var mysqlc = mysql.createConnection(
        {
            host: '23.229.215.154',
            user: 'v1',
            password: 'Temporal01',
            database: 'v1',
        }
        );

        mysqlc.connect();

        var string = 'UPDATE `v1`.`casino_jackpot` SET `jackpot` = ' + jack+ ', `debt` = ' + debito + ' WHERE `casino_jackpot`.`id_jackpot` = 1;';

        mysqlc.query(string, function(err, row, fields) {
            if (typeof(row)) {


            }


        });

     //console.log(string);

     mysqlc.end();
     setTimeout(function () {select_jackpot()}, 1000);


 }


 function select_jackpot(){

    var mysqlc = mysql.createConnection(
    {
        host: '23.229.215.154',
        user: 'v1',
        password: 'Temporal01',
        database: 'v1',
    }
    );

    mysqlc.connect();

    var string = 'SELECT * FROM v1.casino_jackpot where id_jackpot=1';

    mysqlc.query(string, function(err, row, fields) {

            //console.log('verificar la variable row' + row);

            if (typeof(row)) {
             //   console.log('entre a jackpotcall' + row[0]['jackpot']);
             //   console.log('entre a debt' + row[0]['debt']);
             //   console.log('entre a jackpotcall' + row[0]['percent']);
             jackpot =  row[0]['jackpot'];
             debt =  row[0]['debt'];
             percent =  row[0]['percent'];

      //  console.log('jackpot ' + jackpot);

      //  console.log('percent ' + percent);
  }

});
      //  console.log(string);

      mysqlc.end();


  }


  function getmoneyuser(){

    var mysqlc = mysql.createConnection(
    {
        host: '23.229.215.154',
        user: 'v1',
        password: 'Temporal01',
        database: 'v1',
    }
    );
    mysqlc.connect();
    var string = 'SELECT coins FROM v1.user_data where id_user=' + connection.id_user + ';';
      //  console.log(string);
      mysqlc.query(string, function(err, row, fields) {
        if (typeof(row)) {
           connection.coins = 0;
           connection.coins =  row[0]['coins'];




           sendmessageuser(connection, 'money_total', connection.coins);

         //    console.log('coins ' + connection.coins);

     }
 });

      mysqlc.end();


  }


  function setmoneyuser(objeto){
    connection.coinsinit = parseFloat(objeto.sitmoney);
    connection.sitcoins = connection.sitcoins + parseFloat(objeto.sitmoney);
    connection.coins = connection.coins - objeto.sitmoney;

    var mysqlc = mysql.createConnection(
    {
        host: '23.229.215.154',
        user: 'v1',
        password: 'Temporal01',
        database: 'v1',
    }
    );
    mysqlc.connect();
    if (connection.coins!= null)
        var string = 'UPDATE `v1`.`user_data` SET `coins` = ' + connection.coins +  ' WHERE `user_data`.`id_user` ='+ connection.id_user  +';';

    mysqlc.query(string, function(err, row, fields) {
        if (typeof(row)) {


        }


    });

    var string = 'INSERT INTO `temp_bet`(`id_user`, `id_game`, `coins_game` , `date` ) VALUES (' + connection.id_user + ',' + connection.id_game + ',' + connection.sitcoins + ', NOW() );';



    mysqlc.query(string, function(err, row, fields) {
        if (typeof(row)) {


        }


    });

    mysqlc.end();


}

function updatetemp(coins_temp){


    // console.log('updatetemp' + coins_temp);
    var mysqlc = mysql.createConnection(
    {
        host: '23.229.215.154',
        user: 'v1',
        password: 'Temporal01',
        database: 'v1',
    }
    );
    mysqlc.connect();
    var string = 'UPDATE `v1`.`temp_bet` SET `coins_game` = ' + coins_temp + ' WHERE `temp_bet`.`id_user` = '+ connection.id_user +  ' and `temp_bet`.`id_game` = ' + connection.id_game + ';';
     //console.log('string de updatetemp' + string);
     mysqlc.query(string, function(err, row, fields) {
        if (typeof(row)) {


        }


    });


     mysqlc.end();


 }



 function updtclose(sitc,coin){


   console.log('sitcoins' + sitc);
   console.log('coins' + coin);
   var cointotal = coin + sitc;
   var mysqlc = mysql.createConnection(
   {
    host: '23.229.215.154',
    user: 'v1',
    password: 'Temporal01',
    database: 'v1',
}
);
   mysqlc.connect();
   if (connection.coins!= null)
    var string = 'UPDATE `v1`.`user_data` SET `coins` = ' + cointotal +  ' WHERE `user_data`.`id_user` ='+ connection.id_user  +';';
    //console.log('update close' + string);
    mysqlc.query(string, function(err, row, fields) {
        if (typeof(row)) {


        }


    });

    var string = 'INSERT INTO `activity_bet`(`coins_i`, `coins_f`, `id_user`, `id_game`, `time_i`, `time_f`) VALUES ("' + connection.coinsinit + '","' +connection.sitcoins + '","' + connection.id_user +'","' + connection.id_game + '","' + connection.date_i +  '", NOW() );';
    //console.log('update close' + string);
    mysqlc.query(string, function(err, row, fields) {
        if (typeof(row)) {


        }
    });


    var string = 'DELETE FROM `v1`.`temp_bet`  WHERE `temp_bet`.`id_user` = '+ connection.id_user +  ' and `temp_bet`.`id_game` = ' + connection.id_game + ';';
    //console.log('delete close' + string);
    mysqlc.query(string, function(err, row, fields) {
        if (typeof(row)) {


        }


    });

    mysqlc.end();

}

});