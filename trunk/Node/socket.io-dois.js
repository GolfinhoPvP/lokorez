var io = require('/usr/lib/node/socket.io');

var socket = new io.Socket("127.0.0.1", {port: 8080});;

socket.on('connection', function(client){
	socket.broadcast(client.sessionId+" conectou-se!", client.sessionId);
	client.on('message', function(msg){
		socket.broadcast(client.sessionId+" disse:</br><p align='center'>"+msg+"</p>");
	});
	client.on('disconnect', function(){
		socket.broadcast(client.sessionId+" desconectou-se!", client.sessionId);
	});
});
