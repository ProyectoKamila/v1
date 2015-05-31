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
    console.log(cont);

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
                connection.chatroom = 37;
                //// hasta q se guarde el toquen se comenta
                //var string = 'SELECT * FROM user_session WHERE user_token= "' + connection.token + '"';
                var string = 'SELECT * FROM user WHERE id_user= ' + 37 ;
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
                            if (row[0]['id_user'] == rooms[connection.chatroom]) {
                                console.log('sendmessageuser1');
                                
                                if(clients >0){
                                    sendmessageuser(connection, 'readyconect', 'Ya se encuentra conectado, verifique los dispositivos1');
                                    connection.close();
                                }else {
                                    rooms[connection.chatroom] = connection.id_user;   
                                    rooms[connection.token] = connection.token;
                        
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

                message_to_send = JSON.parse(message.utf8Data);
                message_to_send['sender'] = connection.id.toString();
                message_to_send = JSON.stringify(message_to_send);

                //console.log(message_to_send)
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
        //var usersall = clientsconectionall;
        clients = clients - 1;
        var newarrayclient = {};
        var newarrayallclient = {};
        //delete rooms[connection.token];
        //delete rooms[connection.chatroom];
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
        console.log(message.type);

        connection.sendUTF(JSON.stringify({
            type: message.type,
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

 
    function sendmessageuser(usersend, type, forsend) {
        //message_to_send = JSON.parse(forsend.utf8Data); 
        //console.log('forsend');
        //console.log(forsend);

        var message_to_send = {};
        message_to_send['sender'] = connection.id.toString();
        message_to_send = JSON.stringify({
            type: type,
            userId: connection.id,
            message: forsend,
            clients: clients

        });
        //console.log('message_to_send');
        broadcast_message(message_to_send, usersend.chatroom);
    }
    

 


});