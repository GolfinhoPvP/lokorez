//Exemplo de um servidor usando o protocolo HTTP com o Node.js
//Instanciar o pacote para trabalhar com o HTTP, o "http.js"
var http = require("http");

//criando um servidor apartir de um objeto "http" 
var servidor = http.createServer(
	//Funçaõ interna que trata as requisições e respostas de cada cliente
	function(requisicao, resposta){
		//escrevendo o cabeçalho
		resposta.writeHead(200, {"content-type" : "text-plain"});
		//escrevendo o corpo
		resposta.write("<html><head></head><body>");
		resposta.write("<p>Hello World</p>", "utf8");
		resposta.write("</body></html>");
		//avisando que a resposta acabou
		resposta.end();
	}
);

//setando a porta a qual este servidor deve ficar escutando
servidor.listen(8080);

//imprimindo um aviso que o servidor está rodando
console.log("Servidor rodando em http://127.0.0.1:8080");
