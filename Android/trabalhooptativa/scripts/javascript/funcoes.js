// JavaScript Document
function validarTelefone(idCampo, e){
	var idTecla = (window.event) ? event.keyCode : e.keyCode;
	
	//se não for um BACKSPACE ele entra, se for, ele deixa apagar um caracter
	//116 é o botão F5
	//37, 38, 39, 40 são as setas direcionais
	if((idTecla == 116) || (idTecla >= 37 && idTecla <= 40) || (idTecla == 8) || (idTecla == 9)){
		return true;
	}
	
	if(idTecla < 48 || idTecla > 57){
		if(idTecla < 96 || idTecla > 105){
			return false;
		}
	}
	
	var campo = document.getElementById(idCampo);
	if(campo.value.length == 0){
		campo.value = campo.value + "(";
	}else if(campo.value.length == 3){
		campo.value = campo.value + ") ";
	}else if(campo.value.length == 9){
		campo.value = campo.value + "-";
	}
	return true;
}

function validarIP(idCampo, e){
	idTecla = (window.event) ? event.keyCode : e.keyCode;
	
	//se não for um BACKSPACE ele entra, se for, ele deixa apagar um caracter
	//116 é o botão F5
	//37, 38, 39, 40 são as setas direcionais
	if((idTecla == 116) || (idTecla >= 37 && idTecla <= 40) || (idTecla == 8) || (idTecla == 9) || (idTecla == 46) || (idTecla == 190) || (idTecla == 194)){
		return true;
	}
	if(idTecla < 48 || idTecla > 57){
		if(idTecla < 96 || idTecla > 105){
			return false;
		}
	}
	return true;
}

function validarCliente(idCampo){
	var campo = document.getElementById(idCampo);
	
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
	
	var RegExPattern = /^((25[0-5]|2[0-4][0-9]|1[0-9][0-9]|[1-9][0-9]|[0-9])\.){3}(25[0-5]|2[0-4][0-9]|1[0-9][0-9]|[1-9][0-9]|[0-9])$/;

	if( (!(campo.tf_ip.value.match(RegExPattern)) && (campo.tf_ip.value!="")) || campo.tf_ip.value=='0.0.0.0' || campo.tf_ip.value=='255.255.255.255' ) {
	   alert('IP inv&aacute;lido.');
	   campo.tf_ip.focus();
	   return false;
	}
	
	return true;
	
}

function  mostrar(idCampo){
	campo = document.getElementById(idCampo);
	campo.style.visibility = "visible";
	campo.style.height = "auto";
}

function  esconder(idCampo){
	campo = document.getElementById(idCampo);
	campo.style.visibility = "hidden";
	campo.style.height = "0px";
}

/*

var eventSubj=document.createEventObject();
eventSubj.ctrlKey=true;
eventSubj.keyCode=70;
elementId.fireEvent('onkeydown',eventSubj);

*/