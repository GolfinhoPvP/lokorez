// JavaScript Document
function validarParametroForm(id){
	switch(id){
		case "tfAno" : descricaoExpReg = /^[0-9]{4,4}$/; break;
		case "tfDia" : descricaoExpReg = /^[0-9]{1,2}$/; break;
		case "ffPlanilha" : descricaoExpReg = /^$/; break;
		case "slMes" : case "slPer" : descricaoExpReg = /[^---]/; break;
	}
	
	if(!document.getElementById(id).value.match(descricaoExpReg)){
		document.getElementById(id).style.background = "#FF0000";
		return false;
	}else{
		document.getElementById(id).style.background = "#FFFFFF";
		return true;
	}
	return false;
}

function validarParametroCadSubmit(){
	lista = new Array("tfAno", "tfDia", "slMes");
	return comum(lista);
}

function validarParametroAltSubmit(){
	lista = new Array("slPer");
	return comum(lista);
}

function validarParametroPlaSubmit(){
	lista = new Array("ffPlanilha");
	return comum(lista);
}

function comum(l){
	for(x=0; x<l.length; x++){
		if(!validarParametroForm(l[x]))
			return false;
	}
	return true;
}