// JavaScript Document
function validarCadastro(){
	lista = new Array("tfNom", "tfRG", "tfCPF", "tfRG", "tfFonNum", "tfFonNot", "tfEmlURL", "tfEmlNot", "tfNomUsu", "tfSen1", "tfSen2", "slEmp", "slCla");
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