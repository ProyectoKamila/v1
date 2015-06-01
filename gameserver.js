//games
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

    var port = 8804;
    var server_start_message = (new Date()) + ' Springle server is listening on port ' + port;
}

var player = [];
var clients = 0;
var cont = 0;
var clientsconection = {};
//var clientsconectionall = [];
var rooms = {};
clientsconection['all'] = {};

var allowed_origins = [
    'localhost',
    'springle.rebugged.com',
    'sky.rebugged.com',
    'developer.cdn.mozilla.net',
    '192.168.0.118'
];

var allowed_protocol = 'server';

var connection_id = 0;

var mysqlc = mysql.createConnection(
        {
            host: '23.229.215.154',
            user: 'v1',
            password: 'Temporal01',
            database: 'v1',
        }
);

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
    //conecciones
    cont = cont + 1;
    console.log('a'+cont);

    //clientsconectionall[cont] = connection;


    connection.on('message', function(message) {
        console.log('msgObj.utf8')
         console.log(JSON.parse(message.utf8Data));
        if (message.type === 'utf8') {
            var msgObj = JSON.parse(message.utf8Data)
            //datos del usuario traerlos de la vista            
            //para acceder y devolver datos del tokken
            console.log('msgObj.type');
            console.log(msgObj.type);
            if (msgObj.type === 'intro') {
                connection.token = msgObj.token;
                //rooms[connection.token] = connection.token;
                //connection.chatroom = 37;
                //// hasta q se guarde el toquen se comenta
                var string = 'SELECT * FROM user_session WHERE user_token= "' + connection.token + '"';
                //var string = 'SELECT * FROM user WHERE id_user= ' + 37 ;
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
                            //aqui debo evaluar la la cookie
                            connection.id_user = row[0]['id_user'];
                            connection.chatroom = row[0]['id_user'];
                            if (row[0]['id_user'] == rooms[connection.chatroom]) {
                                console.log('sendmessageuser1');
                                
                                if(clients >0){
                                    sendmessageuser(connection, 'readyconect', 'Ya se encuentra conectado, verifique los dispositivos1');
                                    connection.type='readyconet';
                                    connection.close();
                                }else {
                                    rooms[connection.chatroom] = connection.id_user;   
                                    rooms[connection.token] = connection.token;
                                    connection.type='welcome';
                                    sendmessageuser(connection, 'welcome', row);
                                }
                            }
                            else {
                            console.log('sendmessageuser2');
                                rooms[connection.chatroom] = connection.id_user;   
                                rooms[connection.token] = connection.token;
                        
                                sendmessageuser(connection, 'welcome', row);
                            }
                        }
                        else {
                             console.log('sendmessageuser3');
                             connection.type='welcome';
                            sendmessageuser(connection, 'welcome', 'aqui falso');
                        }
                    });
                 

                    mysqlc.end();
                ////
                //connection.chatroom = msgObj.chatroom;
                console.log('rooms[connection.chatroom]');
                console.log(rooms[connection.chatroom]);
                if (rooms[connection.chatroom] !== undefined) {
                    //rooms[msgObj.token].push(connection);
                    //rooms[msgObj.chatroom].push(connection);

                     if(clients >0){
                            sendmessageuser(connection, 'readyconect', 'Ya se encuentra conectado, verifique los dispositivos2');
                            connection.type='readyconet';
                            connection.close();
                    }

                } else {
                    clients = clients + 1;
                    rooms[msgObj.chatroom] = [connection];
                    
                }

                    connection.sendUTF(JSON.stringify({
                    type: 'welcome',
                    userId: connection.id
                }));

               broadcast_chatters_list(msgObj.chatroom);
            } else if (msgObj.type === 'message') {
                console.log('mesasje');
                console.log(message);
                message_to_send = JSON.parse(message.utf8Data);
                message_to_send['sender'] = connection.id.toString();
                 connection.type = 'message';
                message_to_send = JSON.stringify(message_to_send);

                //console.log(message_to_send)
                broadcast_message(message_to_send, msgObj.chatroom);
            } else if (msgObj.type.match(/^activity_/)) {
                // echo back any message type that start with activity_
                message_to_send = JSON.parse(message.utf8Data);
                message_to_send['sender'] = connection.id.toString();
                message_to_send = JSON.stringify(message_to_send);

                broadcast_message(message_to_send, msgObj.chatroom);
            } else if (msgObj.type === 'prueba') {
                message_to_send = pruebaserver(msgObj);

                message_to_send = JSON.parse(message.utf8Data);
                message_to_send['sender'] = connection.id.toString();
               connection.type = 'prueba';
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
        //var usersall = clientsconectionall;
        clients = clients - 1;
        var newarrayclient = {};
        var newarrayallclient = {};
        //delete rooms[connection.token];
        //delete rooms[connection.chatroom];
        //delete rooms[connection.id_user];
//saca de la conexion al cliente si esta conectado
        for (var i in rooms) {
            if (rooms[i] !== undefined) {
                newarrayclient[rooms[i]] = rooms[i];
            }
        }

        rooms = newarrayclient;


        for (var i in users) {
            if (connection.id === users[i].id) {
                rooms[chatroom].splice(i, 1);
                broadcast_chatters_list(connection.chatroom);
            }
        }
        console.log((new Date()) + ' Peer ' + connection.remoteAddress + ' disconnected.');
    });

    function broadcast_message(message, chatroom) {
        console.log('messagexxxxxxxx');
        console.log(message);
        console.log('chatroomxxxxxxx');
        console.log(rooms[chatroom]);
        console.log('typexxxxxxxxx');
        console.log(connection.type);

        connection.sendUTF(JSON.stringify({
            type: connection.type,
            userId: connection.id,
            message: message,
            clients: clients

        }));

        var users = rooms[chatroom];
        for (var i in users) {

            users[i].message;
        }
    }



    function broadcast_message_user(message, chatroom,type) {
        console.log('messagexxxxxxxx');
        console.log(message);
        console.log('chatroomxxxxxxx');
        console.log(rooms[chatroom]);
        console.log('typexxxxxxxxx');
        console.log(type);

        connection.sendUTF(JSON.stringify({
            type: type,
            userId: connection.id,
            message: message,
            clients: clients

        }));

        var users = rooms[chatroom];
        for (var i in users) {

            users[i].message;
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
    function pruebaserver(objeto){
         
    var contador=0;
    var s_aRandSymbols=objeto.rands;
    var NUM_ROWS =  objeto.nrows;
   var NUM_REELS= objeto.nreels;
   var s_aRandSymbols=  objeto.rands;
   var _aWinningLine=  objeto.winingl;
   var s_aPaylineCombo=  objeto.payline;
   var _aFinalSymbolCombo=  objeto.finalcombo;
   var s_aSymbolWin= objeto.symbolwin;
   var _oPayTable= objeto.paytable;
   var _iCurBet= objeto.curbet;
   var _iTotBet= objeto.totalbet;
   var _iLastLineActive= objeto.lastline;
   var WILD_SYMBOL= objeto.wsymb;


       do { //symbolos finales, a modificar
            _anterior= new Array();
            _aFinalSymbolCombo = new Array();
            for(var i=0;i<NUM_ROWS;i++){
                _aFinalSymbolCombo[i] = new Array();
                _anterior[i]= new Array();
                for(var j=0;j<NUM_REELS;j++){
                    var iRandIndex = Math.floor(Math.random()* s_aRandSymbols.length);
                    var iRandSymbol = s_aRandSymbols[iRandIndex];
                    _aFinalSymbolCombo[i][j] = iRandSymbol;
                    _anterior[i][j] = iRandSymbol;
                   // if(j<2)
                 //   alert(_anterior[i][j]);
                     console.log(_anterior[i][j]);

               }

           }
           
         //alert(NUM_REELS);   j=0-4  i=0-2

         // sergio. revisa la matriz y muestra un alert si hay 
         var ejecutar=false;
         if(ejecutar==true){
         for(var j=0;j<NUM_REELS;j++){

            for(var i=0;i<NUM_ROWS;i++){
              //  _rvs= new Array();
                if (_aFinalSymbolCombo[i][j]==8){
                    _aFinalSymbolCombo[i][j]=_aFinalSymbolCombo[i][j]-1;
                }
              //  _rvs[i]= _aFinalSymbolCombo[i][j];
                if (j==1){
                    for (var b=0;b<NUM_ROWS;b++){


                        if(_aFinalSymbolCombo[i][j]==_anterior[b][j-1]){

                          //  alert(_aFinalSymbolCombo[i][j]+' '+_anterior[b][j-1]+' '+b+(j-1)+' '+i+j);
                          var p=i;
                          var q=b;

                           do { //while para quitar las combinaciones ganadoras... cada vez que cambia un numero se reinicia el contador para vlver a revisar...

                            var iRandIndex = Math.floor(Math.random()* (s_aRandSymbols.length-1));
                            var iRandSymbol = s_aRandSymbols[iRandIndex];
                            _aFinalSymbolCombo[i][j] = iRandSymbol;
                            
                            i=0;
                            b=0;

                        }
                        while(_aFinalSymbolCombo[i][j]==_anterior[b][j-1])
                            console.log(_anterior[q][j-1]+' '+ _aFinalSymbolCombo[p][j]+' '+q+(j-1)+' '+p+j);
         }
          }
      }
    }
    }
    }
        console.log('corteeeeeeeeeeeeeeeeeeeeeeeeeeeee');
            //CHECK IF THERE IS ANY COMBO
            _aWinningLine = new Array();//linea ganadora arreglo
            for(var k=0;k<_iLastLineActive;k++){ //desde 0 hasta el numero de lineas activas
                var aCombos = s_aPaylineCombo[k];
                    console.log(s_aPaylineCombo[k]);// carga la linea ganadora de cslotsettings.js
               // alert(aCombos[0].row +' ' +aCombos[0].col);
                var aCellList = new Array();  //lista de celdas
                var iValue = _aFinalSymbolCombo[aCombos[0].row][aCombos[0].col];  //guarda el valor de la celda de la matriz que coincide con la posicion de la linea ganadora que está activa
               // alert(iValue);
                var iNumEqualSymbol = 1;
                var iStartIndex = 1;
           aCellList.push({row:aCombos[0].row,col:aCombos[0].col,value:_aFinalSymbolCombo[aCombos[0].row][aCombos[0].col]});
                
                while(iValue === WILD_SYMBOL && iStartIndex<NUM_REELS){
                    iNumEqualSymbol++;
                    iValue = _aFinalSymbolCombo[aCombos[iStartIndex].row][aCombos[iStartIndex].col];
                    aCellList.push({row:aCombos[iStartIndex].row,col:aCombos[iStartIndex].col,
                        value:_aFinalSymbolCombo[aCombos[iStartIndex].row][aCombos[iStartIndex].col]});
                    iStartIndex++;
                }
                
                for(var t=iStartIndex;t<aCombos.length;t++){  //mientras el simbolo de la columna siguiente sea igual al anterior o el comodin lo guarda
                    if(_aFinalSymbolCombo[aCombos[t].row][aCombos[t].col] === iValue || 
                        _aFinalSymbolCombo[aCombos[t].row][aCombos[t].col] === WILD_SYMBOL){
                        iNumEqualSymbol++;

                    aCellList.push({row:aCombos[t].row,col:aCombos[t].col,value:_aFinalSymbolCombo[aCombos[t].row][aCombos[t].col]});
                }else{
                    break;
                }
            }

            if(s_aSymbolWin[iValue-1][iNumEqualSymbol-1] > 0){ //guarda la linea ganadora, siempre y cuando sea de dos en adelante
                _aWinningLine.push({line:k+1,amount:s_aSymbolWin[iValue-1][iNumEqualSymbol-1],
                    num_win:iNumEqualSymbol,value:iValue,list:aCellList});
               
            }
             //alert(_aWinningLine.line);
        }
//verificar el monto ganado antes de salir de esta función
        var iTotWin = 0;
            //INCREASE MONEY IF THERE ARE COMBOS
            if(_aWinningLine.length > 0){
                //HIGHLIGHT WIN COMBOS IN PAYTABLE
                for(var i=0;i<_aWinningLine.length;i++){
                   // _oPayTable.highlightCombo(_aWinningLine[i].value,_aWinningLine[i].num_win);
                   // _oInterface.showLine(_aWinningLine[i].line);
                    var aList = _aWinningLine[i].list;
                    for(var k=0;k<aList.length;k++){
                      //  _aStaticSymbols[aList[k].row][aList[k].col].show(aList[k].value);
                    }
                    
                    iTotWin += _aWinningLine[i].amount;
                   //  alert(iTotWin);   //sergio suma el monto de a gana por cada línea
                }
                
                iTotWin *=_iCurBet;  // multiplica el monto a ganar por cada linea apostada
               // _iMoney += iTotWin;
              

               /*  if (iTotWin >_iTotBet)  {
                    alert(_iTotBet);
                    alert(iTotWin);
                }
*/
             } 
             contador=contador+1;
                
            }
             
                        while(iTotWin >_iTotBet)   //verificar el monto antes de salir de esta función

       // var vuelta = nrows.token*3;
       console.log('while!!!!!!!!!!!!!!!!: '+contador+ ' '+ iTotWin + ' '+ _iTotBet);
 for(var i=0;i<NUM_ROWS;i++){
                
                for(var j=0;j<NUM_REELS;j++){
                  
                   // if(j<2)
                 //   alert(_anterior[i][j]);

                     console.log(_aFinalSymbolCombo[i][j]);

               }

           }



    }

 
    function sendmessageuser(usersend, type, forsend) {
        //message_to_send = JSON.parse(forsend.utf8Data); 
        //console.log('forsend');
        console.log(connection);

        var message_to_send = {};
        message_to_send['sender'] = connection.id.toString();
        message_to_send.type =type;
        message_to_send = JSON.stringify({
            type: type,
            userId: connection.id,
            message: forsend,
            clients: clients

        });
        //console.log('message_to_send');
        broadcast_message_user(message_to_send, usersend,type);
    }
    

 


});