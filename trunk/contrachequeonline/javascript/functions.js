// JavaScript Document
function getUserDate(){
	var today = new Date();
	var dateCamps = new Array(3);
	
	dateCamps[0] = today.getDate();
	dateCamps[1] = today.getMonth();
	dateCamps[2] = today.getFullYear();
	
	return dateCamps[0]+"-"+dateCamps[1]+"-"+dateCamps[2];
}

function show(v){
	camp = document.getElementById(v);
	camp.style.visibility = 'visible';
}

function hide(v){
	camp = document.getElementById(v);
	camp.style.visibility = 'hidden';
}

function userLoginValider(v){
	camp = document.getElementById(v);
	
	if(camp.slSelect.value == "0"){
		alert("Selecione a sua folha.");
		camp.slSelect.focus();
		return false;
	}else if(camp.tfMatricula.value.length == 0){
		alert("Informe sua Matricula.");
		camp.tfMatricula.focus();
		return false;
	}else if(camp.tfPassword.value.length == 0){
		alert("Informe a sua senha.");
		camp.tfPassword.focus();
		return false;
	}
	return camp.submit();
}

function userSearchValider(v){
	camp = document.getElementById(v);
	
	if(camp.slDate1.value == 0){
		alert("Informe um mês.");
		camp.slDate1.focus();
		return false;
	}if(camp.slDate2.value == 0){
		alert("Informe um mês.");
		camp.slDate2.focus();
		return false;
	}else if(camp.tfDate1.value.length == 0){
		alert("Informe uma data inicial.");
		camp.tfDate1.focus();
		return false;
	}else if(camp.tfDate2.value.length == 0){
		alert("Informe uma data final.");
		camp.tfDate2.focus();
		return false;
	}
	
	if(camp.tfDate1.value > camp.tfDate2.value){
		alert("A primeira data deve ser menor que a segunda.");
		camp.tfDate1.focus();
		return false;
	}

	return camp.submit();
}

function dateVerifier(v){
	camp = document.getElementById(v);
	
	if(camp.slDate.value.length == 0){
		alert("Insira um mês!");
		camp.slDate.focus();
		return false;
	}else if(camp.tfDate.value.length == 0){
		alert("Insira um ano!");
		camp.tfDate.focus();
		return false;
	}
	return confirm("Tem certeza que essa data é a correta, é muito importante que essa informação esteja correta!");
}

function adminSiginValider(v){
	camp = document.getElementById(v);
	if(camp.tfUserName.value.length == 0){
		alert("Insira um nome para o usuário!");
		camp.tfUserName.focus();
		return false;
	}
	if(camp.tfPassword.value.length == 0){
		alert("Insira uma senha para o usuário!");
		camp.tfPassword.focus();
		return false;
	}
	if(camp.tfPassword2.value.length == 0){
		alert("A confirmação de senha é necessária!");
		camp.tfPassword2.focus();
		return false;
	}
	if(camp.tfPassword.value != camp.tfPassword2.value){
		alert("A senha e sua confirmação não conferem!");
		camp.tfPassword.focus();
		return false;
	}
	return true;
}

function folhaValider(v){
	camp = document.getElementById(v);
	
	if(camp.tfNome.value.length == 0){
		alert("Insira um nome para a folha!");
		camp.tfNome.focus();
		return false;
	}
	if(camp.tdDescricao.value.length == 0){
		alert("Insira uma descrição para a folha!");
		camp.tdDescricao.focus();
		return false;
	}
}

function changePassValider(v){
	camp = document.getElementById(v);
	
	if(camp.tfOldPass.value.length == 0){
		alert("Digite sua antiga senha!");
		camp.tfOldPass.focus();
		return false;
	}
	if(camp.tfNewPass1.value.length == 0){
		alert("Digite sua nova senha!");
		camp.tfNewPass1.focus();
		return false;
	}
	if(camp.tfNewPass2.value.length == 0){
		alert("Confirme sua nova senha!");
		camp.tfNewPass2.focus();
		return false;
	}
	if(camp.tfNewPass1.value != camp.tfNewPass2.value){
		alert("A senha e sua confirmação não são iguais!");
		camp.tfNewPass1.focus();
		return false;
	}
	return true;
}

function onlyNums(v, e){
	keyID = (window.event) ? event.keyCode : e.keyCode;
	if((keyID == 116) || (keyID >= 37 && keyID <= 40) || (keyID == 8) || (keyID == 9)){
		return true;
	}
	if(keyID < 48 || keyID > 57){
		if(keyID < 96 || keyID > 105){
			return false;
		}
	}
	return true;
}

function findPosX(obj){
	var curleft = 0;
	if (obj.offsetParent){
		while (obj.offsetParent){
			curleft += obj.offsetLeft;
			obj = obj.offsetParent;
		}
	}
	else if (obj.x)
		curleft += obj.x;
	return curleft;
}

function findPosY(obj){
	var curtop = 0;
	if (obj.offsetParent){
		curtop += obj.offsetHeight;
		while (obj.offsetParent){
			curtop += obj.offsetTop;
			obj = obj.offsetParent;
		}
	}
	else if (obj.y){
		curtop += obj.y;
		curtop += obj.height;
	}
	return curtop;
}