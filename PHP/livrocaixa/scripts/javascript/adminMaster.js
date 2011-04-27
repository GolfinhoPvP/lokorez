// JavaScript Document
function validarAlterarBanco(){
	lista = new Array("tfBanHos", "tfBanSen", "tfBanNomUsu", "tfBanNomBan", "tfSenMas");
	return comum(lista);
}

function validarAlterarStatus(){
	lista = new Array("slSta", "tfSenMas");
	return comum(lista);
}

function validarAlterarMaster(){
	lista = new Array("tfNom", "tfSen1", "tfSen2", "tfSenMas");
	if(comum(lista) == true && validarSenhas() == true)
		return true
	else
		return false;
}

function validarSenhas(){
	if(document.getElementById("tfSen1").value != document.getElementById("tfSen2").value){
		document.getElementById("tfSen1").style.background = "#FF0000";
		document.getElementById("tfSen2").style.background = "#FF0000";
		return false;
	}else{
		document.getElementById("tfSen1").style.background = "#FFFFFF";
		document.getElementById("tfSen2").style.background = "#FFFFFF";
		return true;
	}
}