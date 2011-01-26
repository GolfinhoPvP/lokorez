// JavaScript Document
function centralizador(id, w, h){
	document.getElementById(id).style.left 	= ((screen.availWidth - w)/2)+"px";
	document.getElementById(id).style.top 	= ((screen.availHeight*0.9 - h)/2)+"px";
}

function validarForm(id){
	switch(id){
		case "tfNomUsu" : descricaoExpReg = /^([a-z]|[A-Z]|[0-9]| |\.|_|-|@){4,15}$/; break;
		case "tfSen" : descricaoExpReg = /^([a-z]|[A-Z]|[0-9]){4,15}$/; break;
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

function comum(lista){
	for(x=0; x<lista.length; x++){
		if(!validarForm(lista[x]))
			return false;
	}
	return true;
}