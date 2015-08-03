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

    var port = 8806;
    var server_start_message = (new Date()) + ' Springle server with SSL is listening on port ' + port;
} else {
    var http = require('http');

    var server = http.createServer(function(request, response) {
        response.writeHead(404);
        response.end();
    });

    var port = 8806;
    var server_start_message = (new Date()) + ' Springle server is listening on port ' + port;
}

var messagesend = [];
var clients = 0;
var cont = 0;
var clientsconection = {};
var clientsconectionall = [];
var rooms = {};
var saleonline = {};//los que estan sentados son con os datos del usuario
var play = {};
var saleonlineconex = {};//los que estan sentados con conexon
var saleonlineconexall = {};//todos los usuarios que estan conectados en una sala
var roomespejo = 0;
//variable para permitir acceder a una sala si se encontro la password en la base de datos
var accesstrue = false;
//clientsconection['all'] = {};
var pos = [1, 2, 4, 7, 6, 5, 3];
var card2 = new Array(
        "02tre",
        "03tre",
        '04tre',
        "05tre",
        "06tre",
        "07tre",
        "08tre",
        "09tre",
        "10tre",
        "11tre",
        "12tre",
        "13tre",
        "14tre",
        "02pic",
        "03pic",
        "04pic",
        "05pic",
        "06pic",
        "07pic",
        "08pic",
        "09pic",
        "10pic",
        "11pic",
        "12pic",
        "13pic",
        "14pic",
        "02dia",
        "03dia",
        "04dia",
        "05dia",
        "06dia",
        "07dia",
        "08dia",
        "09dia",
        "10dia",
        "11dia",
        "12dia",
        "13dia",
        "14dia",
        "02co",
        "03co",
        "04co",
        "05co",
        "06co",
        "07co",
        "08co",
        "09co",
        "10co",
        "11co",
        "12co",
        "13co",
        "14co"
        );
var card = [];
//trebol
card["02tre"] = {'image': '2tre.png', 'carpeta': 'trebol'};
card["03tre"] = {'image': '3tre.png', 'carpeta': 'trebol'};
card["04tre"] = {'image': '4tre.png', 'carpeta': 'trebol'};
card["05tre"] = {'image': '5tre.png', 'carpeta': 'trebol'};
card["06tre"] = {'image': '6tre.png', 'carpeta': 'trebol'};
card["07tre"] = {'image': '7tre.png', 'carpeta': 'trebol'};
card["08tre"] = {'image': '8tre.png', 'carpeta': 'trebol'};
card["09tre"] = {'image': '9tre.png', 'carpeta': 'trebol'};
card["10tre"] = {'image': '10tre.png', 'carpeta': 'trebol'};
card["11tre"] = {'image': 'jtre.png', 'carpeta': 'trebol'};
card["12tre"] = {'image': 'qtre.png', 'carpeta': 'trebol'};
card["13tre"] = {'image': 'ktre.png', 'carpeta': 'trebol'};
card["14tre"] = {'image': 'as.png', 'carpeta': 'trebol'};
//trebol
card["02pic"] = {'image': '2pic.png', 'carpeta': 'pica'};
card["03pic"] = {'image': '3pic.png', 'carpeta': 'pica'};
card["04pic"] = {'image': '4pic.png', 'carpeta': 'pica'};
card["05pic"] = {'image': '5pic.png', 'carpeta': 'pica'};
card["06pic"] = {'image': '6pic.png', 'carpeta': 'pica'};
card["07pic"] = {'image': '7pic.png', 'carpeta': 'pica'};
card["08pic"] = {'image': '8pic.png', 'carpeta': 'pica'};
card["09pic"] = {'image': '9pic.png', 'carpeta': 'pica'};
card["10pic"] = {'image': '10pic.png', 'carpeta': 'pica'};
card["11pic"] = {'image': 'jpic.png', 'carpeta': 'pica'};
card["12pic"] = {'image': 'qpic.png', 'carpeta': 'pica'};
card["13pic"] = {'image': 'kpic.png', 'carpeta': 'pica'};
card["14pic"] = {'image': 'as.png', 'carpeta': 'pica'};

//diamante
card["02dia"] = {'image': '2dia.png', 'carpeta': 'diamante'};
card["03dia"] = {'image': '3dia.png', 'carpeta': 'diamante'};
card["04dia"] = {'image': '4dia.png', 'carpeta': 'diamante'};
card["05dia"] = {'image': '5dia.png', 'carpeta': 'diamante'};
card["06dia"] = {'image': '6dia.png', 'carpeta': 'diamante'};
card["07dia"] = {'image': '7dia.png', 'carpeta': 'diamante'};
card["08dia"] = {'image': '8dia.png', 'carpeta': 'diamante'};
card["09dia"] = {'image': '9dia.png', 'carpeta': 'diamante'};
card["10dia"] = {'image': '10dia.png', 'carpeta': 'diamante'};
card["101dia"] = {'image': 'jdia.png', 'carpeta': 'diamante'};
card["12dia"] = {'image': 'qdia.png', 'carpeta': 'diamante'};
card["13dia"] = {'image': 'kdia.png', 'carpeta': 'diamante'};
card["14dia"] = {'image': 'as.png', 'carpeta': 'diamante'};
//diamante
card["02co"] = {'image': '2co.png', 'carpeta': 'corazon'};
card["03co"] = {'image': '3co.png', 'carpeta': 'corazon'};
card["04co"] = {'image': '4co.png', 'carpeta': 'corazon'};
card["05co"] = {'image': '5co.png', 'carpeta': 'corazon'};
card["06co"] = {'image': '6co.png', 'carpeta': 'corazon'};
card["07co"] = {'image': '7co.png', 'carpeta': 'corazon'};
card["08co"] = {'image': '8co.png', 'carpeta': 'corazon'};
card["09co"] = {'image': '9co.png', 'carpeta': 'corazon'};
card["10co"] = {'image': '10co.png', 'carpeta': 'corazon'};
card["11co"] = {'image': 'jco.png', 'carpeta': 'corazon'};
card["12co"] = {'image': 'qco.png', 'carpeta': 'corazon'};
card["13co"] = {'image': 'kco.png', 'carpeta': 'corazon'};
card["14co"] = {'image': 'as2.png', 'carpeta': 'corazon'};


var allowed_origins = [
    'localhost',
    'springle.rebugged.com',
    'sky.rebugged.com',
    'developer.cdn.mozilla.net',
    '192.168.0.118',
    'usuario-pc',
    'casino4as.com'
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
var string = 'ALTER TABLE  `salespoker` AUTO_INCREMENT 7;';

mysqlc.query(string, function(err, row, fields) {
    if (typeof(row)) {

    }

});
var string = 'DELETE FROM  `salespoker` WHERE  `user_create` <>0;';

mysqlc.query(string);
var string = 'SELECT id,name,boolpass,apu_min,apu_max,max_jug,jug_min,jug_max FROM salespoker';

mysqlc.query(string, function(err, row, fields) {
    if (typeof(row)) {
        rooms = row;
        for (i in rooms) {
            var maxjug = rooms[i].max_jug;
            for (i2 = 0; i2 < maxjug; i2++) {
                if (saleonline[i] !== undefined) {
                    var conexarray = {
                        name: undefined,
                        coin: undefined,
                        apos: undefined,
                        id: undefined,
                        imageprofile: undefined,
                    }
                    saleonline[i].push(conexarray);
                    saleonlineconex[i].push(undefined);
                }
                else {
                    var conexarray = {
                        name: undefined,
                        coin: undefined,
                        apos: undefined,
                        id: undefined,
                        imageprofile: undefined
                    }
                    saleonline[i] = [conexarray];
                    saleonlineconex[i] = [undefined];

                }

//                }

            }
        }

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
    console.log(request.origin);
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
                    var mysqlc = mysql.createConnection(
                            {
                                host: '23.229.215.154',
                                user: 'v1',
                                password: 'Temporal01',
                                database: 'v1',
                            }
                    );
                    mysqlc.connect();
                    var string = 'SELECT * FROM active_session INNER JOIN user_data WHERE user_data.id_user = active_session.id_user AND active_session.token= "' + connection.token + '"';
                    mysqlc.query(string, function(err, row, fields) {
                        if (typeof(row)) {
                            if (row !== undefined && row[0].id_user !== undefined) {
//                                console.log(row);
//                                console.log(string);
                                connection.id_user = row[0]['id_user'];
                                connection.imageprofile = row[0]['imageprofile'];
                                connection.first_name = row[0]['first_name'];
                                connection.last_name = row[0]['last_name'];
                                connection.gender = row[0]['gender'];
                                connection.country = row[0]['country'];
                                connection.city = row[0]['city'];
                                connection.nationality = row[0]['nationality'];
                                connection.coin = row[0]['coin'];
                                if (row[0]['id_user'] == clientsconection[connection.id_user]) {
                                    sendmessageuser(connection, 'readyconect', 'Ya se encuentra conectado, verifique los dispositivos');
                                    connection.close();
                                }
                                else {
                                    cont = cont + 1;
                                    clientsconectionall[cont] = connection;
                                    clientsconection[connection.id_user] = connection.id_user;
                                    sendmessageuser(connection, 'welcome', row);
                                }
                            }
                            else {
                                sendmessageuser(connection, 'welcome', 'aqui falso');
                                connection.close();
                            }
                        }
                        else {
                            sendmessageuser(connection, 'welcome', 'aqui falso');
                            connection.close();
                        }
                    });
                    sendmessageuser(connection, 'sales', rooms);
                    mysqlc.end();
                }


            }
            else if (msgObj.type === 'newsale') {
                newsales(msgObj);
            }
            else if (msgObj.type === 'apost') {
                console.log(msgObj);
                var montoapos = 0;
                if ((connection.idsale !== undefined) && (connection.idsit !== undefined)) {
                    console.log('Conection ' + connection.idsit + '/' + connection.idsale + ' EnEspera ' + play[connection.idsale].jugadorenespera)
                    if (connection.idsit === play[connection.idsale].jugadorenespera) {
                        if ((parseFloat(msgObj.montapost) > 0) && (parseFloat(msgObj.montapost) > parseFloat(saleonline[connection.idsale][connection.idsit].apos))) {
                            console.log('if');
                            montoapos = parseFloat(saleonline[connection.idsale][connection.idsit].apos);
                        } else {
                            console.log('else');
                            montoapos = parseFloat(msgObj.montapost);
                        }
                        updatesaleapost(connection.idsale, connection.idsit, montoapos);
                        play[connection.idsale].roomapost[connection.idsit] = parseFloat(play[connection.idsale].roomapost[connection.idsit]) + montoapos;
                        play[connection.idsale].pote1 = parseFloat(play[connection.idsale].pote1) + montoapos;
                        play[connection.idsale].potefu();
                        clearTimeout(play[connection.idsale].enespera);
                        play[connection.idsale].play();
                    }
                }
////                console.log(' Idsale: ' + connection.idsale+ ' Idsit: ' + connection.idsit);
//                console.log(saleonline[connection.idsale][connection.idsit].apos);
                console.log(montoapos);
            }
            else if (msgObj.type === 'sitdown') {
                if (connection.idsit > 6) {
                    desconectadesala();
                }
//                connection.idsit=undefined;
                if (connection.idsit == undefined && rooms[connection.idsale] !== undefined && rooms[connection.idsale].apu_min <= msgObj.inputapos && rooms[connection.idsale].apu_max >= msgObj.inputapos) {
                    var mysqlc = mysql.createConnection({
                        host: '23.229.215.154',
                        user: 'v1',
                        password: 'Temporal01',
                        database: 'v1',
                    });
                    mysqlc.connect();
                    var string = 'SELECT coins FROM user_data WHERE id_user= "' + connection.id_user + '"';
                    mysqlc.query(string, function(err, row, fields) {
                        if (typeof(row)) {
                            connection.coin = row[0].coins;
                            var coin = {
                                coin: connection.coin,
                                apu_min: rooms[connection.idsale].apu_min,
                                apu_max: rooms[connection.idsale].apu_max
                            };
                            if (rooms[connection.idsale] !== undefined && rooms[connection.idsale].apu_min && connection.coin >= msgObj.inputapos) {
                                connection.idsit = msgObj.idsit;
                                connection.apos = msgObj.inputapos;
                                var mysqlc = mysql.createConnection({
                                    host: '23.229.215.154',
                                    user: 'v1',
                                    password: 'Temporal01',
                                    database: 'v1',
                                });
                                mysqlc.connect();
                                var query = 'UPDATE user_data SET coins = (coins -' + parseInt(connection.apos) + ') WHERE id_user = "' + connection.id_user + '"';
                                mysqlc.query(query, function(err, row, fields) {
                                    if (typeof(row)) {

                                    }
                                });
                                mysqlc.end();
                                joinsale(connection, connection.idsale, 'true', msgObj.idsit);
                            }
                            else {
                                sendmessageuser(connection, 'numcoin', coin, clients);
                            }
                        }
                    });
                    mysqlc.end();
                }

            }
            else if (msgObj.type === 'numcoin') {
                var mysqlc = mysql.createConnection(
                        {
                            host: '23.229.215.154',
                            user: 'v1',
                            password: 'Temporal01',
                            database: 'v1',
                        }
                );
                mysqlc.connect();
                var string = 'SELECT coins FROM user_data WHERE id_user= "' + connection.id_user + '"';
                mysqlc.query(string, function(err, row, fields) {
                    if (typeof(row)) {
                        connection.coin = row[0].coins;
                        var coin = {
                            coin: connection.coin,
                            apu_min: rooms[connection.idsale].apu_min,
                            apu_max: rooms[connection.idsale].apu_max
                        };
                        sendmessageuser(connection, 'numcoin', coin, clients);
                    }

                });
                mysqlc.end();
            }
            //exitgame
            else if (msgObj.type === 'gmover') {
                play[connection.idsale].gameover();
            }
            else if (msgObj.type === 'leave') {
//                console.log(connection.idsale);
                play[connection.idsale].leaveplay(connection.idsit);
                console.log('leave');
            }
            else if (msgObj.type === 'exitgame') {
                console.log('exitgame');
                desconectadesala();
            }
            else if (msgObj.type === 'comentglobal') {
                if ((msgObj.text).length < 256) {

                    var enviar = {
                        first_name: connection.first_name,
                        last_name: connection.last_name,
                        mensaje: msgObj.text,
                    }
                    var users = clientsconectionall;
                    for (var i in users) {
//                    console.log(connection);
                        sendmessageuser(clientsconectionall[i], 'comentglobal', enviar)
                    }
                } else {
                    sendmessageuser(connection, 'alert', 'Estamos verificando que usted esta mandando un mensaje con mas de 255 caraxcteres, por favor recargue su cliente, ya hemos enviado un mensaje de alerta a nuestro servidor');
                }
            }
//con esto accede a la sala selecionada
            else if (msgObj.type === 'joingame') {

//falta enviar tambien que al salirse revise la jugada
//pendient                
//pendient                
//pendient                
//pendient                
//pendient                
//pendient                


                desconectadesala();
                if (rooms[msgObj.idsale].boolpass == 1) {
                    var mysqlc = mysql.createConnection(
                            {
                                host: '23.229.215.154',
                                user: 'v1',
                                password: 'Temporal01',
                                database: 'v1',
                            }
                    );
                    mysqlc.connect();
                    var string = 'SELECT password,apu_min,apu_max FROM salespoker WHERE id=' + rooms[msgObj.idsale].id + '';
                    mysqlc.query(string, function(err, row, fields) {
                        if (typeof(row)) {
                            accesstrue = false;
                            if (row[0].password == msgObj.pass) {
                                accesstrue = true;
                            }
                            if (!accesstrue) {
                                connection.idsale = msgObj.idsale;
                                sendmessageuser(connection, 'passfalse', 'Intente de nuevo');
                            }
                            else {
                                connection.idsale = msgObj.idsale;
                                joinsale(connection, msgObj.idsale, 'find', msgObj.idsale);
                            }
                        }


                    });
                    mysqlc.end();
                }
//si la sala no tiene password
                else {
                    connection.idsale = msgObj.idsale;
                    joinsale(connection, msgObj.idsale, 'find', msgObj.idsale);
                }
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
                //  console.log(message_to_send)
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
        var usersallinsale = saleonlineconexall[connection.idsale];
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
        for (var i in usersallinsale) {
            console.log(i);
            if (connection.id === usersallinsale[i].id) {
                saleonlineconexall[connection.idsale].splice(i, 1);
            }
        }
        desconectadesala();
        //  console.log((new Date()) + ' Peer ' + connection.remoteAddress + ' disconnected.');
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
//                var numsale = rooms.length;
//                numsale = numsale++;
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
                rooms[row.insertId] = newrow;
//                var numsale = rooms.length - 1;
                connection.idsale = row.insertId;
                sendsales();
                joinsale(connection, connection.idsale, 'false', row.insertId);
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
//function para actualizar todas las salas
    function updatewin(room, sit, apos) {
        if (saleonline[room][sit]) {
            saleonline[room][sit].apos = parseFloat(saleonline[room][sit].apos) + parseFloat(apos);
//            saleonlineconex[room][sit].apos = parseFloat(saleonline[room][sit].apos) + parseFloat(apos);
//            saleonlineconexall[room][sit].apos = parseFloat(saleonline[room][sit].apos) + parseFloat(apos);
            for (i in saleonlineconexall[room]) {
                sendmessageuser(saleonlineconexall[room][i], 'joinsale', saleonline[room]);
            }
        }
    }
    function updatesaleapost(room, sit, apos) {
        if (saleonline[room][sit]) {
            saleonline[room][sit].apos = parseFloat(saleonline[room][sit].apos) - parseFloat(apos);
//            saleonlineconex[room][sit].apos = parseFloat(saleonline[room][sit].apos) - parseFloat(apos);
//            saleonlineconexall[room][sit].apos = parseFloat(saleonline[room][sit].apos) - parseFloat(apos);
            for (i in saleonlineconexall[room]) {
                sendmessageuser(saleonlineconexall[room][i], 'joinsale', saleonline[room]);
            }
        }
    }
    function updatesale(id) {
//        var send = 0;
        for (i in saleonlineconex[id]) {
            if (saleonlineconex[id][i] !== undefined) {
                sendmessageuser(saleonlineconex[id][i], 'joinsale', saleonline[id]);
            }
        }
    }
//funcion para meter a un usuario en una sala
    function joinsale(conex, idsale, idsit, idkey) {
//si eligio la silla lo ubico en la silla y envio a todos los usuarios la conexion
//        conex.apos = con.apxos;
//si yo elgi sentarme
        console.log(conex.apos);
        if (idsit == 'true') {
            console.log(saleonline[idsale][idkey]['name']);
            if (saleonline[idsale][idkey]['name'] == undefined || saleonline[idsale][idkey]['name'] == 0) {
                var conexarray = {
                    name: conex.first_name + " " + conex.last_name,
                    coin: conex.coin,
                    apos: conex.apos,
                    id: conex.id,
                    imageprofile: conex.imageprofile
                }
                saleonline[idsale][idkey] = conexarray;
                saleonlineconex[idsale][idkey] = conex;
//            var send = 0;
                var sitdown = 0;
                //verifica cuantos usuarios sentados existen
                for (i in saleonlineconex[idsale]) {
//                se le coloco esto ya que automaticamente le añade el ++;
//                send = i - 1;
                    if (saleonlineconex[idsale][i] !== undefined) {
                        sitdown++;
                    }
                }
                //envia a todos aunque sean espectadores la accion del que se sento
                for (i in saleonlineconexall[idsale]) {
                    sendmessageuser(saleonlineconexall[idsale][i], 'joinsale', saleonline[idsale]);
                }
                if (sitdown == 2) {
//                    console.log("logicpokerstart");
                    logicpokerstart(idsale);
                }
            }
            else {
                connection.idsit = undefined;
            }
        }
        else if (idsit == 'false') {
//            if (saleonline[idsale] == undefined) {
            var maxjug = rooms[idkey].max_jug;
            for (i = 0; i < maxjug; i++) {
                if (saleonline[idsale] !== undefined) {
                    var conexarray = {
                        name: undefined,
                        coin: undefined,
                        apos: undefined,
                        id: undefined,
                        imageprofile: undefined,
                    }
                    saleonline[idsale].push(conexarray);
                    saleonlineconex[idsale].push(conex);
                }
                else {
                    var conexarray = {
                        name: undefined,
                        coin: undefined,
                        apos: undefined,
                        id: undefined,
                        imageprofile: undefined
                    }
                    saleonline[idsale] = [conexarray];
                    saleonlineconex[idsale] = [conex];
                }

//                }

            }
//        if (saleonline[idsale] !== undefined) {
//            saleonline[idsale].push(conex);
//        } else {
//            saleonline[idsale] = [conex];
//        }
            sendmessageuser(connection, 'joinsale', saleonline[idsale]);
        }
//solo envia los que estan conctado en la sala
        else if (idsit == 'find') {
            if (saleonlineconexall[idsale] !== undefined) {

                saleonlineconexall[idsale].push(conex);
            }
            else {
                saleonlineconexall[idsale] = [conex];
            }
//            buscar cuando se crea ya que no esta creando cada uno de los campos tampoco crea saleonline
//            console.log(saleonlineconex[idsale]);
//            var cant = saleonlineconex[idsale].length;
//            connection.idsit = cant;
//            saleonlineconex[idsale].push(conex);
            sendmessageuser(connection, 'joinsale', saleonline[idsale]);
        }
    }
    function desconectadesala() {
        if (connection.idsale !== undefined) {
            var conexarray = {
                name: undefined,
                coin: undefined,
                apos: undefined,
                id: undefined,
                imageprofile: undefined,
            }
            if (saleonline[connection.idsale][connection.idsit] !== undefined) {
                var prearray = saleonline[connection.idsale][connection.idsit];
                saleonline[connection.idsale][connection.idsit] = [conexarray];
            }
            if (connection.idsit !== undefined) {
                var mysqlc = mysql.createConnection(
                        {
                            host: '23.229.215.154',
                            user: 'v1',
                            password: 'Temporal01',
                            database: 'v1',
                        }
                );
                mysqlc.connect();
//                for (i = 0; i < 7; i++) {
//                    console.log('---------------------- Pos ' + i + '----------------------');
//                    console.log(saleonline[connection.idsale][i]);
//                }
                var query = 'UPDATE user_data SET coins = (coins +' + parseInt(prearray.apos) + ') WHERE id_user = "' + connection.id_user + '"';
//                console.log(query);
                mysqlc.query(query, function(err, row, fields) {
                    if (typeof(row)) {
                    }
                });
                //                console.log(saleonlineconex[connection.idsale]);
                mysqlc.end();
                saleonlineconex[connection.idsale][connection.idsit] = undefined;
//                saleonlineconex[connection.idsale].splice(connection.idsit, 1);
//                console.log(saleonlineconex[connection.idsale]);
                if (connection.idsit < 7) {
                    if (typeof play[connection.idsale] && play[connection.idsale] !== undefined && typeof play[connection.idsale] && play[connection.idsale].numjugactivos > 1) {
                        play[connection.idsale].gameover();
                        clearInterval(play[connection.idsale].enespera);
                        delete play[connection.idsale];
                    }
                    updatesale(connection.idsale);
                }
//                setea a undefined para que no se vuelva a sentar el wey
                connection.idsit = undefined;
            }
        }
    }
    function apost(montapost) {
//        console.log(connection);
        play[connection.idsale].newapost[connection.idsit] = montapost;
        updatesaleapost(connection.idsale, connection.idsit, montapost);
    }
    function Sala(room) {
        this.room = room;
        this.minci = rooms[room].jug_min;
        this.maxci = rooms[room].jug_max;
        this.max_jug = rooms[room].max_jug;
        this.name = rooms[room].name;
        this.enespera = "";
        //numero de jugadores activos
        this.jugactivos = [];
        this.numjugactivos = 0;
        this.jugadorenespera = 0;
        this.pote1 = 0;
        this.pote2 = 0;
        this.pote3 = 0;
        this.pote4 = 0;
        this.pote5 = 0;
        this.pote6 = 0;
        this.card = [];
        this.numcard = 0;
        this.diler = 0;
        this.cardmesa = [];
        this.newapost = [];
        this.roomapost = [];
        this.ciegamin = 0;
        this.ciegamax = 0;
    }
//aqui seleciono los jugadores activos en la sala
    Sala.prototype.jugadoresactivos = function() {
        var x = 0;
        //creo todos los puestos
        while (x < 7) {
            var coarray = {
                'first_name': undefined,
                'apost': 0
            };
            this.jugactivos[x] = coarray;
            this.roomapost[x] = 0;
            this.newapost[x] = 0;
            x++;
        }
        //    console.log(this.jugactivos);
//        console.log(this.jugactivos[6]);
        for (i in saleonlineconex[this.room]) {
            if (saleonlineconex[this.room][i] !== undefined && i < 7) {
                this.jugactivos[i] = saleonlineconex[this.room][i];
                this.numjugactivos++;
            }
        }
        //console.log(this.jugactivos);
    };
    Sala.prototype.leaveplay = function(payer) {
        if (payer === this.jugadorenespera) {
            var coarray = {
                'first_name': undefined,
                'apost': 0
            };
            this.jugactivos[payer] = coarray;
            this.roomapost[payer] = 0;
            this.newapost[payer] = 0;
            this.numjugactivos--;
            if (this.numjugactivos === 1) {
                for (i in this.jugactivos) {
                    if (this.jugactivos[i]['first_name'] !== undefined) {
                        this.jugactivos[i]['apost'] = parseFloat(this.jugactivos[i]['apost']) + parseFloat(this.pote1);
                        updatewin(this.room, i, this.pote1);
                        play[this.room].gameover();
                        logicpokerstart(this.room);
                    }
                }
            }
            if (payer === this.diler) {
                this.diler++;
                while (this.jugactivos[this.diler]['first_name'] == undefined) {
                    this.diler++;
                    if (this.diler == 7) {
                        this.diler = 0;
                    }
                }
            }
            clearTimeout(this.enespera);
            play[this.room].play();
        }
    };
    //revuelvo las cartas
    Sala.prototype.cardfu = function() {
        this.card = card2;
        this.card.sort(function() {
            return Math.random() - 0.5;
        });
    };
    //doy las cartas a cada uno de los jugadores
    Sala.prototype.repartircard = function() {
        var namecard = "";
        for (i2 = 1; i2 < 3; i2++) {
            for (i in this.jugactivos) {
                //aqui creo una variable con el nombre de la carta
                if (this.jugactivos[i]['first_name'] !== undefined) {
                    namecard = "card" + i2;
//                    this.jugactivos[i][namecard] = card2[this.numcard];
                    this.jugactivos[i][namecard] = this.card[this.numcard];
                    sendmessageuser(this.jugactivos[i], namecard, card2[this.numcard]);
                    this.numcard++;
                }
            }
        }
    };
    Sala.prototype.repartircardmesa = function() {
        var count = this.cardmesa.length;
        if (count === 3) {
            this.cardmesa[3] = this.card[this.numcard];
            this.numcard++;
        } else if (count === 4) {
            this.cardmesa[4] = this.card[this.numcard];
            this.numcard++;
        } else if (count < 4) {
            for (i = 0; i < 3; i++) {
                this.cardmesa[i] = this.card[this.numcard];
                this.numcard++;
            }
        }
        for (i in saleonlineconexall[this.room]) {
            sendmessageuser(saleonlineconexall[this.room][i], 'cardmesa', this.cardmesa);
        }
    };
    Sala.prototype.gameover = function() {
        this.cardmesa = [];
        this.roomapost = [];
        clearTimeout(this.enespera);
        for (i in saleonlineconexall[this.room]) {
            sendmessageuser(saleonlineconexall[this.room][i], 'gameover', this.cardmesa);
        }
    };
    Sala.prototype.nextdiler = function() {
        this.diler = 0;
        while (this.jugactivos[this.diler]['first_name'] == undefined) {
            this.diler++;
            if (this.diler == 7) {
                this.diler = 0;
            }
        }
        this.ciegamin = this.diler + 1;
        while (this.jugactivos[this.ciegamin]['first_name'] == undefined) {
            this.ciegamin++;
            if (this.ciegamin == 7) {
                this.ciegamin = 0;
            }
        }
        this.roomapost[this.ciegamin] = this.minci;
        updatesaleapost(this.room, this.ciegamin, this.minci);
        this.ciegamax = this.ciegamin + 1;
        while (this.jugactivos[this.ciegamax]['first_name'] == undefined) {
            this.ciegamax++;
            if (this.ciegamax == 7) {
                this.ciegamax = 0;
            }
        }
        this.roomapost[this.ciegamax] = this.maxci;
        updatesaleapost(this.room, this.ciegamax, this.maxci);
        this.jugadorenespera = this.ciegamax + 1;
        while (this.jugactivos[this.jugadorenespera]['first_name'] == undefined) {
            this.jugadorenespera++;
            if (this.jugadorenespera == 7) {
                this.jugadorenespera = 0;
            }
        }
        this.dilerfu();
        this.ciegaminfu();
        this.ciegamaxfu();
        this.minapost();
        this.potefu();
//        this.repartircardmesa();
    };
    Sala.prototype.play = function() {
        var x = this.jugadorenespera + 1;
        if (x == 7) {
            this.jugadorenespera = 0;
            x = 0;
        }
        while (this.jugactivos[x]['first_name'] == undefined) {
            x++;
            if (x == 7) {
                x = 0;
            }
        }
        this.jugadorenespera = x;
        if (this.jugactivos[this.jugadorenespera] !== undefined) {
            var maxapost = 0;
            for (i in this.roomapost) {
                if (this.roomapost[i] > maxapost) {
                    maxapost = parseFloat(this.roomapost[i]);
                }
            }
            var cadmesa = 0;
            for (i in this.roomapost) {
                if ((this.jugactivos[i]['first_name'] !== undefined) && (this.roomapost[i] !== maxapost)) {
                    var cadmesa = 1;
                }
            }
            console.log('MaxApost: ' + maxapost + ' All=: ' + cadmesa + ' CardMesa: ' + this.cardmesa.length);
            if ((cadmesa === 0) && (x === this.diler) && (this.cardmesa.length < 5)) {
                play[this.room].repartircardmesa();
//                console.log('if');
            } else {
                if (this.cardmesa.length === 5) {
//                    console.log('else');
                    play[this.room].gameover();
                    logicpokerstart(this.room);
                }
            }

            play[this.room].minapost();
            play[this.room].enesperafu();
            play[this.room].potefu();
            play[this.room].intervalo();

        }
    };
    Sala.prototype.enesperafu = function() {
        //   console.log(this.jugadorenespera);
        //   console.log(pos[this.jugadorenespera]);
        for (i in saleonlineconexall[this.room]) {
            sendmessageuser(saleonlineconexall[this.room][i], 'enespera', this.jugadorenespera);
        }
    };
    Sala.prototype.dilerfu = function() {
        for (i in saleonlineconexall[this.room]) {
            sendmessageuser(saleonlineconexall[this.room][i], 'diler', this.diler);
        }
    };
    Sala.prototype.ciegaminfu = function() {
        this.pote1 = this.pote1 + this.minci;
        for (i in saleonlineconexall[this.room]) {
            sendmessageuser(saleonlineconexall[this.room][i], 'ciegamin', this.ciegamin);
        }
    };
    Sala.prototype.ciegamaxfu = function() {
        this.pote1 = this.pote1 + this.maxci;
        for (i in saleonlineconexall[this.room]) {
            sendmessageuser(saleonlineconexall[this.room][i], 'ciegamax', this.ciegamax);
        }
    };
    Sala.prototype.montapost = function(user, apost) {
        this.jugactivos[user].apost = apost;
    };
    Sala.prototype.minapost = function() {

        var maxapost = 0;
        for (i in this.roomapost) {
            if (this.roomapost[i] > maxapost) {
                maxapost = parseFloat(this.roomapost[i]);
            }
        }
        var minapost = maxapost - parseFloat(this.roomapost[this.jugadorenespera]);
//        console.log('apuesta maxima:' + maxapost + ' puesto: ' + this.jugadorenespera + ' minapost: ' + minapost);
        sendmessageuser(saleonlineconex[this.room][this.jugadorenespera], 'minapost', minapost);

    }
    Sala.prototype.potefu = function() {
        var send = {
            'pote': this.pote1,
            'apost': this.roomapost
        }
        console.log(this.roomapost);
        for (i in saleonlineconexall[this.room]) {
            sendmessageuser(saleonlineconexall[this.room][i], 'pote', send);
        }
    };

    Sala.prototype.intervalo = function() {
        //seteo para que aa los 20 segundos llame a la funcion play
        var espejo = this.room;
        clearTimeout(this.enespera);
        this.enespera = setTimeout(function() {
//            console.log('en espera');
            if (typeof  play[espejo] && play[espejo] !== undefined) {
                play[espejo].play();
//                play[espejo].minapost()
            }
//            this.minapost();
        }, 5000);
//        console.log(this.room);
//        this.enespera = setInterval(function(){ console.log(room);}, 5000);
    };
    function logicpokerstart(idsale) {
        play[idsale] = new Sala(idsale);
        play[idsale].jugadoresactivos();
        play[idsale].cardfu();
        play[idsale].repartircard();
        play[idsale].nextdiler();
        play[idsale].intervalo();
        play[idsale].enesperafu();
//        console.log(play[idsale]);
    }

});