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

function userLoginValider(v){
	camp = document.getElementById(v);
	
	if(camp.slSelect.value == "Escolha"){
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
	
	if(camp.tfDate1.value.length == 0){
		alert("Informe uma data inicial.");
		camp.tfDate1.focus();
		return false;
	}else if(camp.tfDate2.value.length == 0){
		alert("Informe uma data final.");
		camp.tfDate2.focus();
		return false;
	}
	return camp.submit();
}

function dateValider(v, e){
	keyID = (window.event) ? event.keyCode : e.keyCode;
	//alert(keyID);
	if(keyID != 8){
		if((keyID == 116) || (keyID >= 37 && keyID <= 40)){
			return true;
		}
		if(keyID < 48 || keyID > 57){
			if(keyID < 96 || keyID > 105){
				return false;
			}
		}
		camp = document.getElementById(v);
		if(camp.value.length == 2 || camp.value.length == 5){
			camp.value = camp.value+"-";
		}
		if((camp.value.length == 10) && (v == 'tfDate1')){
			camp.tfDate2.focus();
		}
	}
	return true;
}