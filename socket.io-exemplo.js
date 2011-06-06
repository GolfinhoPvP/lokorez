var http = require('http');
var io = require('/usr/lib/node/socket.io');

servidor = http.createServer(function(requisicao, resposta){
});
servidor.listen(8080);

var socket = io.listen(servidor);

socket.on('connection', function(cliente){
	socket.broadcast(cliente.sessionId+" conectou-se!", cliente.sessionId);
	cliente.on('message', function(mensagem){
		socket.broadcast(cliente.sessionId+" disse:</br><p align='center'>"+mensagem+"</p>");
	});
	cliente.on('disconnect', function(){
		socket.broadcast(cliente.sessionId+" desconectou-se!", cliente.sessionId);
	});
});
