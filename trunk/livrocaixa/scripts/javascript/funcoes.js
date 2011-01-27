// JavaScript Document
function validarForm(id){
	switch(id){
		case "tfFonNot" :	
			case "tfEmlNot" : descricaoExpReg = /^[ ]{4,50}|([a-z]|[A-Z]|[0-9]| |[¡·…ÈÕÌ‘Ù⁄˙ ÍÁ„ı]){4,50}$/; break;
		case "tfNom" : descricaoExpReg = /^([a-z]|[A-Z]|[0-9]| |[¡·…ÈÕÌ‘Ù⁄˙ ÍÁ„ı]){4,150}$/; break;
		case "tfRG" : descricaoExpReg = /^([ ]{0,30}|([0-9]|\.|-){0,30})$/; break;
		case "tfCPF" : descricaoExpReg = /^([ ]{0,14}|[0-9]{3,3}\.[0-9]{3,3}\.[0-9]{3,3}-[0-9]{2,2})$/; break;
		case "tfFonNum" : descricaoExpReg = /^[0-9]{2,2}-[0-9]{4,4}-[0-9]{4,4}$/; break;
		case "slPesRef" :
			case "slBancRef" :
			case "slNivel" :
			case "slTipo" : descricaoExpReg = /[^---]/; break;
		case "tfSen" :
			case "tfSen1" :
			case "tfSen2" : descricaoExpReg = /^([a-z]|[A-Z]|[0-9]){5,15}$/; break;
		case "tfNomUsu" : descricaoExpReg = /^([a-z]|[A-Z]|[0-9]| |\.|_|-|@){4,15}$/; break;
		case "tfEmlURL" : descricaoExpReg = /^([0-9a-zA-Z]+([_.-]?[0-9a-zA-Z]+)*@[0-9a-zA-Z]+[0-9,a-z,A-Z,.,-]*(.){1}[a-zA-Z]{2,4})+$/; break;
	}
	document.getElementById("confirmar").style.visibility = "hidden";
	
	if(document.getElementById(id).value.match(descricaoExpReg)){
		document.getElementById(id).style.background = "#FFFFFF";
		return true;
	}else{
		document.getElementById(id).style.background = "#FF0000";
	}
	return false;
}

function centralizador(id, w, h){
	document.getElementById(id).style.left 	= ((screen.availWidth - w)/2)+"px";
	document.getElementById(id).style.top 	= "10px";
	//document.getElementById(id).style.top 	= ((screen.availHeight*0.9 - h)/2)+"px";
}

function centralizador2(id, w, h){
	document.getElementById(id).style.left 	= ((950 - w)/2)+"px";
	document.getElementById(id).style.top 	= ((600 - h)/2)+"px";
}

function comum(lista){
	for(x=0; x<lista.length; x++){
		if(!validarForm(lista[x]))
			return false;
	}
	return true;
}