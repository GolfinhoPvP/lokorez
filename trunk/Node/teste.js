//aquivo teste.js
var circulo = require('./circulo.js');

function exibir(){
	this.propriedade = 200;
	this.escrever = function(mensagem){
		console.log(mensagem);
	}
}

exb = new exibir();

exb.escrever( 'Variável do modulo: ' + circulo.nome);
exb.escrever( 'A área de um circulo de raio 4 é: ' + circulo.area(4));
