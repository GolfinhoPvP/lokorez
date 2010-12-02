// JavaScript Document
function validarTelefone(idCampo, e){
	idTecla = (window.event) ? event.keyCode : e.keyCode;
	
	if(idTecla != 8){ //se não for um BACKSPACE ele entra, se for, ele deixa apagar um caracter
		//116 é o botão F5
		//37, 38, 39, 40 são as setas direcionais
		if((idTecla == 116) || (idTecla >= 37 && idTecla <= 40)){
			return true;
		}
		if(idTecla < 48 || idTecla > 57){
			if(idTecla < 96 || idTecla > 105){
				return false;
			}
		}
		
		campo = document.getElementById(idCampo);
		if(campo.value.length == 0){
			campo.value = campo.value + "(";
		}
		if(campo.value.length == 3){
			campo.value = campo.value + ") ";
		}
		if(campo.value.length == 9){
			campo.value = campo.value + "-";
		}
	}
	return true;
}

/*function validarIP(idCampo, e){
	idTecla = (window.event) ? event.keyCode : e.keyCode;
	
	if(idTecla != 8){ //se não for um BACKSPACE ele entra, se for, ele deixa apagar um caracter
		//116 é o botão F5
		//37, 38, 39, 40 são as setas direcionais
		if((idTecla == 116) || (idTecla >= 37 && idTecla <= 40)){
			return true;
		}
		if(idTecla < 48 || idTecla > 57){
			if(idTecla < 96 || idTecla > 105){
				return false;
			}
		}
		
		campo = document.getElementById(idCampo);
		if(campo.value.length == 3 || campo.value.length == 7 || campo.value.length == 11){
			campo.value = campo.value + ".";
		}
	}
	return true;
}*/

function validarCliente(idCampo){
	campo = document.getElementById(idCampo);
	
	if(campo.tf_nome.value.length == 0){
		alert("Insira um nome");
		campo.tf_nome.focus();
		return false;
	}
	
	if(campo.tf_telefone.value.length == 0){
		alert("Insira um telefone");
		campo.tf_telefone.focus();
		return false;
	}
	
	if(campo.tf_ip.value.length == 0){
		alert("Insira um ip");
		campo.tf_ip.focus();
		return false;
	}
	
	return true;
}