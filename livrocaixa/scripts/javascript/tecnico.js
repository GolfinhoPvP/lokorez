// JavaScript Document
function validarCadastro(){
	if(document.getElementById("cbSel").checked == true){
		lista = new Array("tfNom", "tfRG", "tfCPF", "tfRG", "tfFonNum", "tfFonNot", "tfEmlURL", "tfEmlNot", "slCla", "tfDes");
	}else{
		lista = new Array("slPes", "slCla", "tfDes");
	}
	return comum(lista);
}

function alternar(){
	if(document.getElementById("cbSel").checked == true){
		document.getElementById("cadTecPesRef").style.visibility = "hidden";
		
		document.getElementById("cadTecPes").style.visibility 	= "visible";
		document.getElementById("cadTecTel").style.visibility 	= "visible";
		document.getElementById("cadTecEml").style.visibility 	= "visible";
	}else{
		document.getElementById("cadTecPes").style.visibility 	= "hidden";
		document.getElementById("cadTecTel").style.visibility 	= "hidden";
		document.getElementById("cadTecEml").style.visibility 	= "hidden";
		
		document.getElementById("cadTecPesRef").style.visibility = "visible";
	}
}