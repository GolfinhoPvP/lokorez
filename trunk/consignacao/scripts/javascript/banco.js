// JavaScript Document
function validarBancoForm(id){
	switch(id){
		case "tfBanCod" : descricaoExpReg = /^[0-9]{3,3}$/; break;
		case "tfBanDesc" : descricaoExpReg = /^([a-z]|[A-Z]|[0-9]| |[¡·…ÈÕÌ‘Ù⁄˙ ÍÁ„ı]){2,100}$/; break;
		case "tfBanContat" : descricaoExpReg = /^([a-z]|[A-Z]|[0-9]| |[¡·…ÈÕÌ‘Ù⁄˙ ÍÁ„ı]){2,100}$/; break;
		case "tfBanFone" : descricaoExpReg = /^[0-9]{2,2}-[0-9]{4,4}-[0-9]{4,4}$/; break;
		case "slBancRef" : descricaoExpReg = /^[0-9]{3,3}$/; break;
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

function validarBancoCadSubmit(){
	lista = new Array("tfBanCod", "tfBanDesc", "tfBanContat", "tfBanFone");
	return comum(lista);
}

function validarBancoAltSubmit(){
	lista = new Array("slBancRef", "tfBanCod", "tfBanDesc", "tfBanContat", "tfBanFone");
	return comum(lista);
}

function comum(l){
	for(x=0; x<l.length; x++){
		if(!validarBancoForm(l[x]))
			return false;
	}
	return true;
}