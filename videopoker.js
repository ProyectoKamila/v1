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

    var port = 8084;
    var server_start_message = (new Date()) + ' Springle server with SSL is listening on port ' + port;
} else {
    var http = require('http');

    var server = http.createServer(function(request, response) {
        response.writeHead(404);
        response.end();
    });

    var port = 8084;
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
    'localhost:8888',
    'casino4as-krondon.c9.io'
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
var string = 'SELECT * FROM v1.casino_jackpot where id_jackpot=3';

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
console.log(server_start_message);
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
                        if (typeof(row) && row !== undefined && row[0].id_user !== undefined) {
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
            else if (msgObj.type === 'dealcards') {
                dealCards(msgObj);
            }
            else if (msgObj.type === 'createcards') {
                createCardsDek(msgObj);
            }
            else if (msgObj.type === 'checkhandeal') {
                checkHandDealed(msgObj);
            }
            else if (msgObj.type === 'cambiarinfo') {
                change_info(msgObj);
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

        var string = 'UPDATE `v1`.`casino_jackpot` SET `jackpot` = ' + jack+ ', `debt` = ' + debito + ' WHERE `casino_jackpot`.`id_jackpot` = 3;';

        mysqlc.query(string, function(err, row, fields) {
            if (typeof(row)) {    

            }
        });

     //console.log(string);

         mysqlc.end();
         setTimeout(function () {select_jackpot()}, 1500);
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
        var string = 'SELECT * FROM v1.casino_jackpot where id_jackpot=3';
        mysqlc.query(string, function(err, row, fields) {
            //console.log('verificar la variable row' + row);
            if (typeof(row)  && row !== undefined && row[0].jackpot !== undefined) {
             //   console.log('entre a jackpotcall' + row[0]['jackpot']);
             //   console.log('entre a debt' + row[0]['debt']);
             //   console.log('entre a jackpotcall' + row[0]['percent']);
               jackpot =  row[0]['jackpot'];
               debt =  row[0]['debt'];
               percent =  row[0]['percent'];
              //  console.log('jackpot ' + jackpot);
              //  console.log('percent ' + percent);
            }
            else {
                mysqlc.end();
                select_jackpot();
            }
        });
  //  console.log(string);
        mysqlc.end();
    }
/*   function getmoneyuser(){
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
                console.log('coins del query ' + connection.coins);
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
    
}*/

/////
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
         //    console.log('coins ' + connection.coins)
     }
 });
      var string = 'select coins_game FROM `v1`.`temp_bet`  WHERE `temp_bet`.`id_user` = '+ connection.id_user +  ' and `temp_bet`.`id_game` = ' + connection.id_game + ';';
    console.log('select coins_game' + string);
    mysqlc.query(string, function(err, row, fields) {
        if (typeof(row) && row.length>0) { 
            connection.temp_coins = 0;
          //  for (var i=0;i=row.length;i++){
                connection.temp_coins = connection.temp_coins + row[0]['coins_game'];
                console.log('select coins_game ' + row[0]['coins_game']);
            //}
        connection.coins = connection.coins + connection.temp_coins;
         sendmessageuser(connection, 'money_total', connection.coins);
        } else{
        console.log('ELSE');
        sendmessageuser(connection, 'money_total', connection.coins);
    }
   });
    var string = 'DELETE FROM `v1`.`temp_bet`  WHERE `temp_bet`.`id_user` = '+ connection.id_user +  ' and `temp_bet`.`id_game` = ' + connection.id_game + ';';
    //console.log('delete close' + string);
    mysqlc.query(string, function(err, row, fields) {
        if (typeof(row)) {
        }
    });
    var string = 'UPDATE `v1`.`user_data` SET `coins` = ' + connection.coins +  ' WHERE `user_data`.`id_user` ='+ connection.id_user  +';';
    mysqlc.query(string, function(err, row, fields) {
        if (typeof(row)) {
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
    });
    mysqlc.connect();
  var string = 'DELETE FROM `v1`.`temp_bet`  WHERE `temp_bet`.`id_user` = '+ connection.id_user +  ' and `temp_bet`.`id_game` = ' + connection.id_game + ';';
    //console.log('delete close' + string);
    mysqlc.query(string, function(err, row, fields) {
        if (typeof(row)) {
        }
    });
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

/////

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
    var mysqlc = mysql.createConnection({
                        host: '23.229.215.154',
                        user: 'v1',
                        password: 'Temporal01',
                        database: 'v1',
        });
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

var _iCurIndexDeck=0;
////////////////////////////////////////////////////////////////////////////dealhand
function dealCards(objeto){
    /*console.log('DealCards');
    connection._aCardDeck = new Array();
    var _oGameSettings = new CGameSettings();
    connection._aCardDeck = _oGameSettings.getShuffledCardDeck();
    //tomar las variasbles del msje
    var  _aCurHand= new Array();
    var  _aCurHandValue= new Array();;
    //connection._aCardDeck= objeto._aCardDeckE;
    //var  _oCardAttach= objeto._oCardAttachE;*/
    connection._iCurIndexDeck = 0;
    var iX = 0;
    var iY = 0;
        cehckhandeal();
        //do{
            console.log(_oHandEvaluator.evaluate(_aCurHandValue));
            console.log(JACKS_OR_BETTER);
        while(_oHandEvaluator.evaluate(_aCurHandValue) !== JACKS_OR_BETTER){
            console.log("resethand deal cards");
            _oCardAttach.removeAllChildren();
            resetHandInit();
            cehckhandeal();
        }
        console.log("sale del while");
           /////
        //var iX = 0;
        //var iY = 0;
        _aCurHand = new Array();
        //_aCurHandValue = new Array(); //arreglo para evaluar mano
            for(var n=0;n<5;n++){
                var oCard = _aCurHandValue[n];
                oCard.addEventListener(ON_CARD_SHOWN,this._onCardShown);
                oCard.addEventListener(ON_CARD_HIDE,this._onCardHide);
                //_aCurHandValue.push(oCard);
                _aCurHand.push(oCard);
                //_iCurIndexDeck++;
                //iX += 180;
                oCard.showCard();
                //console.log('acardfotogram'+_aCardDeck[_iCurIndexDeck].fotogram+ ' - '+ 'acardked'+_aCardDeck[_iCurIndexDeck].rank);
            }
        
        //DECREASE MONEY
        _iMoney -= _iCurBet;
        _iMoney = parseFloat(_iMoney.toFixed(2));
        _oInterface.refreshMoney(_iMoney,_iCurBet);
        
        if(DISABLE_SOUND_MOBILE === false || s_bMobile === false){
            createjs.Sound.play("card");
        }
        
        _iCurState = STATE_GAME_DEAL;
    };
///////////////////////////////////////////////////////////////////////end dealhand

///////////////////////////////////////////////////////////////////////check hand dealed
function checkHandDealed(obj){

    //connection._iCurIndexDeck = 0;
    BET_TYPE = obj.bet_typeE;
    COMBO_PRIZES =  obj.combo_prizesE;
    TOTAL_MONEY = obj.total_moneyE;
    AUTOMATIC_RECHARGE =  obj.automatic_rechargeE;
    connection._iCurCreditIndex = obj._iCurCreditIndexE;
    connection._iCurBet = obj._iCurBetE;
    _iCurBet = connection._iCurBet;
            var iX = 0;
            var iY = 0;
    consulta_saldo_disp();


    if( connection._iCurIndexDeck != 0){
        createCardsDek();
    }
    var availiable_jp= connection.availiable_jp;
    var debito= connection.debito;
    
    /*connection._aCardDeck = new Array();
    var _oGameSettings = new CGameSettings();
    connection._aCardDeck = _oGameSettings.getShuffledCardDeck();*/
        connection._aCurHandValue = new Array(); //arreglo para evaluar mano
        var card = new Array();
        connection.indexcard = new Array();
            check_win_hand();
            connection.win = checkassignWin(connection._aCurHandValue);
            //h=0;
            while(parseFloat(connection.win) > parseFloat(connection.availiable_jp)) { //&& h<5) {
            createCardsDek();
            connection._iCurIndexDeck = 0;
            check_win_hand();
            consulta_saldo_disp(); 
            connection.win = checkassignWin(connection._aCurHandValue);
            console.log('while deal');
            //h++;
            }

            console.log('handreturn'+connection.indexcard);
             console.log('handreturn rank'+connection._aCurHandValue);
            sendmessageuser(connection, 'handreturnindex', connection.indexcard);
            sendmessageuser(connection, 'handreturn', connection._aCurHandValue);

        console.log('para chekear el win');
        checkassignWin(connection._aCurHandValue);        
}
////////////////////////////////////////////////////////////////////////////end check dealhand
////////////////////////////////////////////////////////////// check win hand
function check_win_hand(){
    for(var i=0;i<5;i++){
                card = [
                    connection._aCardDeck[connection._iCurIndexDeck].fotogram,
                    connection._aCardDeck[connection._iCurIndexDeck].rank,
                    connection._aCardDeck[connection._iCurIndexDeck].suit,
                    ];
                connection.indexcard.push(connection._iCurIndexDeck);
                console.log( 'indexcard'+connection._iCurIndexDeck);
                console.log( 'acardek fotogram'+connection._aCardDeck[connection._iCurIndexDeck].fotogram);
                console.log( 'acardek rank'+connection._aCardDeck[connection._iCurIndexDeck].rank);
                console.log( 'acardek suit'+connection._aCardDeck[connection._iCurIndexDeck].suit);
                connection._aCurHandValue.push(card);
                connection._iCurIndexDeck++;                
            }
}
////////////////////////////////////////////////////////////// end check win hand
/////////////////////////////////////////////////////////////*assignwin check*/
    function checkassignWin(hand){
        var _checkiCurWin=0;
        var s_oPayTableSettings;
        _iCurBet = connection._iCurBet;
       _iCurCreditIndex = connection._iCurCreditIndex;
        s_oPayTableSettings = new CPayTableSettings();
        var _oHandEvaluator;
        _oHandEvaluator = new CHandEvaluator();
        console.log('_iCurCreditIndex' + _iCurCreditIndex);
        //console.log('hand' +hand);
        console.log('o hand evaluate'+_oHandEvaluator.evaluate(hand));
        
        _checkiCurWin = s_oPayTableSettings.getWin(_iCurCreditIndex,_oHandEvaluator.evaluate(hand)) * _iCurBet;
        _checkiCurWin = isNaN(_checkiCurWin) ? 0 : _checkiCurWin;
        console.log('***************************************');
         console.log('_iCurCreditIndex' + _iCurCreditIndex);
        var availiable_jp= jackpot+(_iCurBet-(_iCurBet*percent));
        //var win = availiable_jp - 
        var debito= debt + (_iCurBet*percent);
        console.log('debt' + debt);
        console.log('percent' + percent);
        console.log('_iCurBet' + _iCurBet);
        console.log('checkiwin '+_checkiCurWin);
        console.log('el jackpot' + jackpot);
        console.log('debito '+debito);
        console.log('availiable_jp' + availiable_jp);
        console.log('***************************************');
        return _checkiCurWin;
          
     };
/////////////////////////////////////////////////////////////////*check assignwin end*/

/////////////////////////////////////////////////////////////////*change_info*/
    function change_info(obj){
         consulta_saldo_disp();
        console.log('posiciones del obj'+obj.handholdedE.length)
           connection._iCurBet = obj._iCurBetE;
           _iCurBet = connection._iCurBet;
        var availiable_jp= connection.availiable_jp;
        var debito= connection.debito;
        connection.win = checkassignWin(connection._aCurHandValue);
        pote = connection.availiable_jp-connection.win;
        console.log('!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!');
        console.log('aviable jackpot'+availiable_jp);
        console.log('lo que ganaria'+connection.win);
        console.log('lo que queda'+pote);
        console.log('!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!');

        win_change_info(obj);
        //j=0;
        while(parseFloat(connection.win) > parseFloat(connection.availiable_jp)) { //&& j<5) {
            win_change_info(obj);
            createCardsDek();
            consulta_saldo_disp();
            connection.win = checkassignWin(connection._aCurHandValue);
            connection._iCurIndexDeck = 0;
            console.log('while drawd');

            //j++;
        }
        pote = connection.availiable_jp-connection.win;
        connection.sitcoins = connection.sitcoins + connection.win;
        update_jackpot(pote,connection.debito);
        updatetemp(connection.sitcoins);
        /*var _checkiCurWin=0;
        var s_oPayTableSettings;
        _iCurBet = connection._iCurBet;
       _iCurCreditIndex = connection._iCurCreditIndex;
        s_oPayTableSettings = new CPayTableSettings();
        var _oHandEvaluator;
        _oHandEvaluator = new CHandEvaluator();
        console.log('_iCurCreditIndex' + _iCurCreditIndex);
        //console.log('hand' +hand);
        console.log('o hand evaluate'+_oHandEvaluator.evaluate(hand));
        console.log('_iCurBet' + _iCurBet);
        _checkiCurWin = s_oPayTableSettings.getWin(_iCurCreditIndex,_oHandEvaluator.evaluate(hand)) * _iCurBet;
        
        console.log('checkiwin '+_checkiCurWin);*/
        console.log('acurhandvaule drwa'+connection._aCurHandValue);
        console.log('para chekear el win');
        checkassignWin(connection._aCurHandValue);  
        sendmessageuser(connection, 'drawreturn', connection._aCurHandValue);
    };
///////////////////////////////////////////////////////////////////*change_info end*/
function consulta_saldo_disp(){
    select_jackpot();
    connection.availiable_jp= jackpot+(connection._iCurBet-(connection._iCurBet*percent));
    connection.debito= debt + (connection._iCurBet*percent);
}
////////////////////////////////////// change info win attached a bote
function win_change_info(obj){
   for(k=0;k<obj.handholdedE.length;k++){
            console.log('objeto '+k+obj.handholdedE[k].rankE);
            console.log('objeto fotogram'+k+obj.handholdedE[k].fotogramE);
            for(var i=0;i<5;i++){
                console.log('objeto en if'+obj.handholdedE[k].fotogramE);
                if(connection._aCurHandValue[i][0]==obj.handholdedE[k].fotogramE){
                    connection._iCurIndexDeck++;
                    connection._aCurHandValue[i][0]=connection._aCardDeck[connection._iCurIndexDeck].fotogram;
                    connection._aCurHandValue[i][1]=connection._aCardDeck[connection._iCurIndexDeck].rank;
                    connection._aCurHandValue[i][2]=connection._aCardDeck[connection._iCurIndexDeck].suit;

                }
                connection._iCurIndexDeck ++;
                connection.indexcard.push(connection._iCurIndexDeck);
                console.log( 'indexcard'+connection._iCurIndexDeck);
                ///console.log( 'acardek fotogram'+connection._aCardDeck[connection._iCurIndexDeck].fotogram);
                //console.log( 'acardek rank'+connection._aCardDeck[connection._iCurIndexDeck].rank);
                //console.log( 'acardek suit'+connection._aCardDeck[connection._iCurIndexDeck].suit);
                //connection._aCurHandValue.push(card);
                //connection._iCurIndexDeck++;                
            }
        }
}

////////////////////////////////////// end change info win attached a bote
//////////////////////////////////////*function para crear mazo*///////////////////////////////
function createCardsDek(){
    console.log('DealCards');
    connection._aCardDeck = new Array();
    var _oGameSettings = new CGameSettings();
    connection._aCardDeck = _oGameSettings.getShuffledCardDeck();
    //tomar las variasbles del msje
    var  _aCurHand= new Array();
    var  _aCurHandValue= new Array();;
    //connection._aCardDeck= objeto._aCardDeckE;
    //var  _oCardAttach= objeto._oCardAttachE;
    connection._iCurIndexDeck = 0;

}

///////////////////////////////////*end funcion para crear mazo*//////////////////////////////

///////////////////////////////////////////////////////////////////////////////Cgame Settings
function CGameSettings(){
    
    var _aCardDeck;
    var _aShuffledCardDecks;
    var _aCardValue;
    
    this._init = function(){
        var iSuit = -1;
        _aCardDeck=new Array();
        for(var j=0;j<52;j++){
            
            var iRest=(j+1)%13;
            if(iRest === 1){
                iRest=14;
                iSuit++;
            }else if(iRest === 0){
                iRest = 13;
            }
             console.log('acardekPush'+ 'fotogram:'+j +'rank:'+iRest+ 'suit:'+iSuit);
            _aCardDeck.push({fotogram:j,rank:iRest,suit:iSuit});
        }
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
//////////////////////////////////////////////////////////////////////////////end Cgame Settings

//////////////////////////////////////////////////////////////////////////// reset hand init
    function resetHandInit(){
        _iCurWin = 0;
        //SHUFFLE CARD DECK EVERYTIME A NEW HAND STARTS
        _iCurIndexDeck = 0;
        _aCardDeck = new Array();
        _aCardDeck = getShuffledCardDeck();
        for(var i=0;i<_aCurHand.length;i++){
            _aCurHand[i].reset();
        }

    }
///////////////////////////////////////////////////////////////////////////end reset hand init

////////////////////////////////*evaluador de manos*///////////////////////////////////////
function CHandEvaluator(){
    /**/
var ROYAL_FLUSH     = 0;
var STRAIGHT_FLUSH  = 1;
var FOUR_OF_A_KIND  = 2;
var FULL_HOUSE      = 3;
var FLUSH           = 4;
var STRAIGHT        = 5;
var THREE_OF_A_KIND = 6;
var TWO_PAIR        = 7;
var JACKS_OR_BETTER = 8;
var HIGH_CARD       = 9;

var CARD_TWO = 2;
var CARD_THREE = 3;
var CARD_FOUR = 4;
var CARD_FIVE = 5;
var CARD_SIX = 6;
var CARD_SEVEN = 7;
var CARD_EIGHT = 8;
var CARD_NINE = 9;
var CARD_TEN = 10;
var CARD_JACK = 11;
var CARD_QUEEN = 12;
var CARD_KING = 13;
var CARD_ACE = 14;

var SUIT_HEARTS = 0;
var SUIT_DIAMONDS = 1;
var SUIT_CLUBS = 2;
var SUIT_SPADES = 3;
    /**/
    var _aSortedHand;
    var _aCardIndexInCombo;
    
    this.evaluate = function(aHand){
        _aSortedHand = new Array();
        for(var i=0;i<aHand.length;i++){
            //console.log(aHand[i]);
            _aSortedHand[i] = {rank:aHand[i][1], suit:aHand[i][2]}; //rank suit
        }
        
        _aSortedHand.sort(this.compareRank);
        
        _aCardIndexInCombo = new Array(0,1,2,3,4);
        
        return this.rankHand();
    };
    
    this.rankHand = function(){
        if(this._checkForRoyalFlush()){
            return ROYAL_FLUSH;
        }else if(this._checkForStraightFlush()){
            return STRAIGHT_FLUSH;
        }else if(this._checkForFourOfAKind()){
            return FOUR_OF_A_KIND;
        }else if(this._checkForFullHouse()){
            return FULL_HOUSE;
        }else if(this._checkForFlush()){
            return FLUSH;
        }else if(this._checkForStraight()){
            return STRAIGHT;
        }else if(this._checkForThreeOfAKind()){
            return THREE_OF_A_KIND;
        }else if(this._checkForTwoPair()){
            return TWO_PAIR;
        }else if(this._checkForOnePair()){
            return JACKS_OR_BETTER;
        }else{
            this._identifyHighCard();
            return HIGH_CARD;
        }
    };
    
    this._checkForRoyalFlush = function(){
        if(this._isRoyalStraight() && this._isFlush()){
            
            return true;
        }else{
            return false;
        }
     };

    this._checkForStraightFlush = function(){
        if(this._isStraight() && this._isFlush()){
            return true;
        }else {
            return false;
        }
    };

    this._checkForFourOfAKind = function(){
        if(_aSortedHand[0].rank === _aSortedHand[3].rank){
            _aSortedHand.splice(4,1);
            _aCardIndexInCombo.splice(4,1);
            return true;
        }else if(_aSortedHand[1].rank === _aSortedHand[4].rank){
            _aSortedHand.splice(0,1);
            _aCardIndexInCombo.splice(0,1);
            return true;
        }else{
            return false;
        }
    };

    this._checkForFullHouse = function(){
        if((_aSortedHand[0].rank === _aSortedHand[1].rank && _aSortedHand[2].rank === _aSortedHand[4].rank) || 
                                                                                            (_aSortedHand[0].rank === _aSortedHand[2].rank
                                                                                                        && _aSortedHand[3].rank === _aSortedHand[4].rank)){
            return true;
        }else{
            return false;
        }
    };

    this._checkForFlush = function(){
        if(this._isFlush()){
            return true;
        } else{
            return false;
        }
    };

    this._checkForStraight = function(){
        if(this._isStraight()){
            return true;
        } else{
            return false;
        }
     };

    this._checkForThreeOfAKind = function() {
        if(_aSortedHand[0].rank === _aSortedHand[1].rank && _aSortedHand[0].rank === _aSortedHand[2].rank){
            _aSortedHand.splice(3,1);
            _aSortedHand.splice(3,1);
            //_aSortedHand.splice(4,1);
            _aCardIndexInCombo.splice(3,1);
            _aCardIndexInCombo.splice(3,1);
            return true;
        } else if(_aSortedHand[1].rank === _aSortedHand[2].rank && _aSortedHand[1].rank === _aSortedHand[3].rank){
            _aSortedHand.splice(0,1);
            _aSortedHand.splice(3,1);
            //_aSortedHand.splice(4,1);
            _aCardIndexInCombo.splice(0,1);
            _aCardIndexInCombo.splice(3,1);

            return true;
        }else if(_aSortedHand[2].rank === _aSortedHand[3].rank && _aSortedHand[2].rank === _aSortedHand[4].rank){
            _aSortedHand.splice(0,1);
            _aSortedHand.splice(0,1);
            //_aSortedHand.splice(1,1);
            _aCardIndexInCombo.splice(0,1);
            _aCardIndexInCombo.splice(0,1);
            return true;
        }else{
            return false;
        }
    };

    this._checkForTwoPair = function(){
        if(_aSortedHand[0].rank === _aSortedHand[1].rank && _aSortedHand[2].rank === _aSortedHand[3].rank){
            _aSortedHand.splice(4,1);
            _aCardIndexInCombo.splice(4,1);
            return true;
        }else if(_aSortedHand[1].rank === _aSortedHand[2].rank && _aSortedHand[3].rank === _aSortedHand[4].rank){
            _aSortedHand.splice(0,1);
            _aCardIndexInCombo.splice(0,1);
            return true;
        }else if(_aSortedHand[0].rank === _aSortedHand[1].rank && _aSortedHand[3].rank === _aSortedHand[4].rank){
            _aSortedHand.splice(2,1);
            _aCardIndexInCombo.splice(2,1);
            return true;
        } else{
            return false;
        }
    };

    this._checkForOnePair = function(){
        for(var i = 0; i < 4; i++){
            if(_aSortedHand[i].rank === _aSortedHand[i + 1].rank && _aSortedHand[i].rank > CARD_TEN){
                var p1 = _aSortedHand[i];
                var p2 = _aSortedHand[i + 1];
                _aSortedHand = new Array();
                _aSortedHand.push(p1);
                _aSortedHand.push(p2);
                
                _aCardIndexInCombo = new Array(i,i+1);
                return true;
            }
        }

        return false;
    };

    this._identifyHighCard = function(){
        for(var i = 0; i < 4; i++){
            _aSortedHand.splice(0,1);
        }
    };
    
    this._isFlush = function(){
        if(_aSortedHand[0].suit === _aSortedHand[1].suit
            && _aSortedHand[0].suit === _aSortedHand[2].suit
            && _aSortedHand[0].suit === _aSortedHand[3].suit
            && _aSortedHand[0].suit === _aSortedHand[4].suit){
            return true;
        }else{
            return false;
        }
    };

    this._isRoyalStraight = function(){
        if(_aSortedHand[0].rank === CARD_TEN
            && _aSortedHand[1].rank === CARD_JACK
            && _aSortedHand[2].rank === CARD_QUEEN
            && _aSortedHand[3].rank === CARD_KING
            && _aSortedHand[4].rank === CARD_ACE){
            return true;
        }else{
            return false;
        }
    };

    this._isStraight = function(){
        var bFirstFourStraight = _aSortedHand[0].rank + 1 === _aSortedHand[1].rank && _aSortedHand[1].rank + 1 === _aSortedHand[2].rank
                                                    && _aSortedHand[2].rank + 1 === _aSortedHand[3].rank;

        if(bFirstFourStraight && _aSortedHand[0].rank === CARD_TWO && _aSortedHand[4].rank === CARD_ACE){
            return true;
        }else if(bFirstFourStraight && _aSortedHand[3].rank + 1 === _aSortedHand[4].rank){
            return true;
        } else{
            return false;
        }
    };
    
    this.compareRank = function(a,b) {
        if (a.rank < b.rank)
           return -1;
        if (a.rank > b.rank)
          return 1;
        return 0;
    };
    
    this.getSortedHand = function(){
        return _aSortedHand;
    };
    
    this.getCardIndexInCombo = function(){
        return _aCardIndexInCombo;
    };

}
//////////////////////////////////////////////*fin evaluador de manos*/////////////////////////////////////

//////////////////////////////////////////////////*paytable settings*/////////////////////////////////////
function CPayTableSettings(){
     var NUM_BETS = 5;
     var WIN_COMBINATIONS = 9;

    var _aWins;
    
    this._init = function(){
        
        _aWins = new Array();
        for(var i=0;i<NUM_BETS;i++){
            _aWins[i] = new Array();
            for(var j=0;j<WIN_COMBINATIONS;j++){
                _aWins[i][j] = COMBO_PRIZES[j] * (i+1);
            }
        }
        
    };
    
    this.getWin = function(iBet,iCombo){
        return _aWins[iBet][iCombo];
    };
    
    this._init();
}
/////////////////////////////////////////////*END paytablesettings*//////////////////////////////////////
});


