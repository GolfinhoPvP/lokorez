//Exemplo de um servidor usando o protocolo TCP com o Node.js
//Instanciar o pacote para trabalhar com o TCP, o "net.js"
var net = require("net");

//criando um array para guardar todos os clientes "sockets" conectados
var listaClientes = [];

//criando um servidor apartir de um objeto "net" 
var servidor =  net.createServer(function(cliente){
	//adicionando todos os clientes que se conectarem ao servidor ao array
	listaClientes.push(cliente);
	
	//Mandando uma mensgem aos clientes que acabam de se conectar
	console.log("Bem vindo ao Chat!/n");
	
	//evento acionado sempre que um cliente conecta-se ao servidor
	cliente.on("connect", function(){
		//imprimindo no servidor o id do cliente conectado
		console.log(cliente.fd+" conectado!");
	});
	
	//evento acionado sempre que aluguém envia dados ao servidor
	cliente.on("data", function(dados){
		//implementação de um broadcast
		for(var i=0; i < listaClientes.length; i++){
			//impedindo que um dado seja enviado para quem o enviou
			if(listaClientes[i] == cliente){
				continue;
			}
			//enviando o dado para o referido cliente na posição i do array
			listaClientes[i].write(dados);
		}
	});
	
	//evento acionado sempre que um cliente desconecta-se do servidor
	cliente.on("end", function(){
		//achando a posição do cliente que desconectou no array
		var i = listaClientes.indexOf(cliente);
		//retirando o cliete da lista
		listaClientes.splice(i, 1);
		//imprimindo uma mensagem que o cliente com este id desconectou-se
		console.log(cliente.fd+" desconectado!");
	});
});

//setando a porta a qual este servidor deve ficar escutando
servidor.listen(8000);

//imprimindo um aviso que o servidor está rodando
console.log("Servidor TCP conectado em 127.0.0.1 porta 8000, aguardando conecxões!!!");
