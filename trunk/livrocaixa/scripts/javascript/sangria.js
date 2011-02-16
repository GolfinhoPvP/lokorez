// JavaScript Document
function validarCadastro(){
	lista = new Array("slTipo", "tfData", "tfVal");
	switch(document.getElementById("slTipo").value){
		case "1" :
				lista.push("slBancRef");
				break;
				
		case "2" :
				lista.push("tfNumEnv");
				break;
	}
	return comum(lista);
}

function alternar(){
	switch(document.getElementById("slTipo").value){
		case "1" :
				document.getElementById("cadSanNumEnv").style.visibility 	= "hidden";
				document.getElementById("cadSanBan").style.visibility		= "visible";
				break;
				
		case "2" :
				document.getElementById("cadSanBan").style.visibility 		= "hidden";
				document.getElementById("cadSanNumEnv").style.visibility 	= "visible";
				break;
	}
}