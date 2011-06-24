require.paths.unshift("/usr/lib/node/");
var http = require("http");
var io = require("socket.io");
var Cliente = require("mysql").Client;

var servidor = http.createServer(function(requisicao, resposta){
	resposta.end();
});
servidor.listen(8080);

var listener = io.listen(servidor);

var client = new Cliente();
client.host     = 'localhost';
client.user     = 'root';
client.password = '';
var TEST_DATABASE = 'teste_development';
var TEST_TABLE    = 'auctions';

client.connect();

client.query('USE '+TEST_DATABASE, function (error, results, fields){
	if(error){
	  throw error;
	}
});

listener.on("connection", function(cliente){
	
	cliente.on("message", function(mensagem){
		var obj = {};
		client.query("SELECT value FROM auctions WHERE id = "+mensagem, function (error, results, fields) {
				if(error){
				  throw error;
				}
				obj.valor = results[0].value;
				client.query("UPDATE auctions SET value = ("+obj.valor+"+0.01) WHERE id = "+mensagem, function (error, results, fields) {
						if(error){
							throw error;
						}
						obj.valor += 0.01;
						obj.id = mensagem;
						listener.broadcast(obj);
					}
				);
			}
		);
	});
	cliente.on("disconnect", function(){
	});
});

//client.end();


