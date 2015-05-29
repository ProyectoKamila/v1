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

    var port = 8804;
    var server_start_message = (new Date()) + ' Springle server is listening on port ' + port;
}

var messagesend = [];
var clients = 0;
var cont = 0;
var clientsconection = {};
var clientsconectionall = [];
var rooms = {};
//clientsconection['all'] = {};


var allowed_origins = [
    'localhost',
    'springle.rebugged.com',
    'sky.rebugged.com',
    'developer.cdn.mozilla.net',
    '192.168.0.118'
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
var string = 'DELETE FROM  `salespoker` WHERE  `user_create` <>0;';

mysqlc.query(string, function(err, row, fields) {
    if (typeof(row)) {

    }

});
var string = 'SELECT id,name,boolpass,apu_min,apu_max,max_jug,jug_min,jug_max FROM salespoker';

mysqlc.query(string, function(err, row, fields) {
    if (typeof(row)) {
        rooms = row;
    }

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
    console.log(cont);

    clientsconectionall[cont] = connection;


    connection.on('message', function(message) {
        if (message.type === 'utf8') {
            var msgObj = JSON.parse(message.utf8Data);
            //datos del usuario


            //para acceder y devolver datos del tokken
            if (msgObj.type === 'join') {
                clients = clients + 1;
                connection.token = msgObj.token;
                if (clientsconection[connection.token] !== undefined) {
                    sendmessageuser(connection, 'readyconect', 'Ya se encuentra conectado, verifique los dispositivos');
                    connection.close();
                } else {

                    clientsconection[connection.token] = connection.token;


                    var string = 'SELECT * FROM user_session WHERE user_token= "' + connection.token + '"';



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
            else if (msgObj.type === 'newsale') {
                newsales(msgObj);



            }
            else if (msgObj.type === 'intro') {
                connection.nickname = msgObj.nickname;
                connection.chatroom = msgObj.chatroom;

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

                console.log(message_to_send)
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
        delete clientsconection[connection.token];
        delete clientsconection[connection.id_user];
//saca de la conexion al cliente si esta conectado
        for (var i in clientsconection) {
            if (clientsconection[i] !== undefined) {
                newarrayclient[clientsconection[i]] = clientsconection[i];
            }
        }

        clientsconection = newarrayclient;

//aqui borro en el arreglo la conexion del usuario que se fue
        for (var i in usersall) {
            if (connection.id === usersall[i].id) {
                clientsconectionall.splice(i, 1);
            }
        }
        for (var i in users) {
            if (connection.id === users[i].id) {
                rooms[chatroom].splice(i, 1);
                broadcast_chatters_list(connection.chatroom);
            }
        }
        console.log((new Date()) + ' Peer ' + connection.remoteAddress + ' disconnected.');
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

    function sendmessageuser(usersend, type, forsend) {
        usersend.sendUTF(JSON.stringify({
            type: type,
            userId: connection.id,
            messagesend: forsend,
            clients: clients

        }));
    }
    function newsales(ins) {
        var boolpass = 1;
        if (ins.clave == '' || ins.clave == undefined) {
            boolpass = 0;

        }

        var mysqlc = mysql.createConnection(
                {
                    host: '23.229.215.154',
                    user: 'v1',
                    password: 'Temporal01',
                    database: 'v1',
                }
        );
        mysqlc.connect();
        var string = 'INSERT INTO `v1`.`salespoker` (`id`, `name`, `password`, `boolpass`, `apu_min`, `apu_max`, `max_jug`, `user_create`, `jug_min`, `jug_max`) VALUES (NULL, \'' + ins.namesale + '\', \'' + ins.clave + '\', \'' + boolpass + '\', \'' + ins.minapos + '\', \'' + ins.maxapos + '\', \'' + ins.maxus + '\', \'' + connection.id_user + '\', \'' + ins.minci + '\', \'' + ins.maxci + '\');';

        mysqlc.query(string, function(err, row) {
            if (typeof(row)) {
                var numsale = rooms.length;
                numsale = numsale++;
                var newrow = {
                    'id': row.insertId,
                    'name': ins.namesale,
                    'password': ins.clave,
                    'boolpass': boolpass,
                    'apu_min': ins.minapos,
                    'apu_max': ins.maxapos,
                    'max_jug': ins.maxus,
                    'user_create': connection.id_user,
                    'jug_min': ins.minci,
                    'jug_max': ins.maxci

                };
                rooms[numsale] = newrow;
                sendsales();
            }
//            consigo el numero de salas para añadir una al arreglo


        });
        mysqlc.end();
        return rooms;
    }

    function sendsales() {
        var users = clientsconectionall;

        for (var i in users) {
//            console.log(clientsconection['all'][i].token);
            sendmessageuser(clientsconectionall[i], 'sales', rooms)
        }
    }

});