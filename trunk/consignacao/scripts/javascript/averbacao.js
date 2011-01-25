// JavaScript Document
function validarForm(id){
	switch(id){
		case "tfValor" : case "tfMon" : descricaoExpReg = /^([0-9]{0,12}\.[0-9]{1,2}|[0-9]{0,15})$/; break;
		case "tfTxJ" : descricaoExpReg = /^[0-9]{1,2}$/; break;
		case "slPer" : case "slPro" : case "slPar" : case"slSerRef" : descricaoExpReg = /[^---]/; break;
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

function validarNumExt(id){
	if(!document.getElementById(id).value.length == 0){
		document.getElementById(id).style.background = "#FF0000";
		return false;
	}else{
		document.getElementById(id).style.background = "#FFFFFF";
		return true;
	}
	return false;
}
function ajustarValores(){
	if(document.getElementById('tfValor').value > parseFloat(document.getElementById('valDisp').innerHTML)){
		document.getElementById('tfValor').style.background = "#FF0000";
		retorno = false;
	}else{
		document.getElementById('tfValor').style.background = "#FFFFFF";
		retorno = true;
	}
	return retorno;
}

function ajustarMontante(){
	val = parseFloat(document.getElementById('tfValor').value) * parseInt(document.getElementById('slPar').value);
	document.getElementById('tfMon').value = val.toFixed(2);
	ajustarValores();
}

function validarAveCadSubmit(){
	lista = new Array("slSerRef", "slPer", "slPro", "tfValor", "slPar", "tfTxJ", "tfMon");
	if(comum(lista) && ajustarValores() && validarNumExt('tfNumExt'))
		return true;
	else
		return false;
}

function comum(l){
	for(x=0; x<l.length; x++){
		if(!validarForm(l[x]))
			return false;
	}
	return true;
}

function mostrar(id){
		document.getElementById(id).style.visibility = "visible";
		document.getElementById(id).style.height = "auto";
}

function esconder(id){
		document.getElementById(id).style.visibility = "hidden";
		document.getElementById(id).style.height = "0px";
}