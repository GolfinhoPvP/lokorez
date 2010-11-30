// JavaScript Document

function gerarProtocolo(){
	var protocolo = new String();
	
	data = getDate();
	protocolo = concat(data.getFullYear(), data.getMonth(), data.getDate(),  data.getHours(), data.getMinutes(), data.getSeconds(),	Math.floor(Math.random()*11), Math.floor(Math.random()*11));
	
	return protocolo;
}