var http  = require("http");
var url   = require("url");
var fs    = require("fs");
var io    = require("/usr/lib/node/socket.io");
var nome;

server = http.createServer(function(req, res){
	var path = url.parse(req.url).pathname;
	nome = url.parse(req.url).query;
	switch (path){
	  	case "/":
		case "/index.html":
			fs.readFile(__dirname + "/index.html", function(err, data){
				if(err){
				  console.log(err);
					return send404(res);
				}
				res.writeHead(200, {"Content-Type": "text/html"});
				res.write(data, "utf8");
				res.end();
			});
			break;
		case "/pagina.html":
			fs.readFile(__dirname + path, function(err, data){
				if(err){
					return send404(res);
				}
				res.writeHead(200, {"Content-Type": "text/html"});
				res.write(data, "utf8");
				res.end();
			});
			break;
		case "/resposta.json":
			fs.readFile(__dirname + path, function(err, data){
				if(err){
					return send404(res);
				}
				res.writeHead(200, {"Content-Type": "text/javascript"});
				res.write(data, "utf8");
				res.end();
			});
			break;
		default: send404(res);
	} 
});

send404 = function(res){
	res.writeHead(404, {"Content-Type": "text/plain"});
	res.write("404 - Página não encontrada!", "utf8");
	res.end();
}; 

server.listen(8080);

var objListener = io.listen(server);

objListener.on("connection", function(objClient){
	var nick;
	objClient.send("Digite seu nome de usuário!");
	objClient.on("message", function(mensagem){
		if(!nick){
			nick = mensagem;
			objClient.send("Bem vindo "+nick);
			objListener.broadcast(nick+" conectou-se!", objClient.sessionId);
		}else{
			objListener.broadcast(nick+" disse: "+mensagem);
		}
	});
	objClient.on("disconnect", function(){
		objListener.broadcast(nick+" desconectou-se!", objClient.sessionId);
	});
});

