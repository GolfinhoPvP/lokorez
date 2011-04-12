// JavaScript Document
function validarCadastro(){
	if(document.getElementById("cbSel").checked == true){
		lista = new Array("tfNom", "tfRG", "tfCPF", "tfRG", "tfFonNum", "tfFonNot", "tfEmlURL", "tfEmlNot", "tfNomUsu", "tfSen1", "tfSen2", "slEmp", "slCla");
	}else{
		lista = new Array("slPes", "tfNomUsu", "tfSen1", "tfSen2", "slEmp", "slCla");
	}
	if(comum(lista) == true)
		return true
	else
		return false;
}