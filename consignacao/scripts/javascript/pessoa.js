// JavaScript Document
function validarPessoaForm(id){
	switch(id){
		case "tfNome" : descricaoExpReg = /^([a-z]|[A-Z]|[0-9]| |[¡·…ÈÕÌ‘Ù⁄˙ ÍÁ„ı]){2,100}$/; break;
		case "tfCPF" : descricaoExpReg = /^([ ]{0,14}|[0-9]{3,3}\.[0-9]{3,3}\.[0-9]{3,3}-[0-9]{2,2})$/; break;
		case "slBancRef" : descricaoExpReg = /[^---]/; break;
		default : descricaoExpReg = /^([ ]{0,14}|[0-9]{2,2}-[0-9]{4,4}-[0-9]{4,4})$/; break;
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

function validarPessoaCadSubmit(){
	lista = new Array("tfNome", "tfCPF", "slBancRef");
	cont = parseInt(document.getElementById("tfFoneCont").value);
	for(x=0; x < cont; x++){
		index = x+3;
		num = x+1;
		eval("lista["+index+"] = 'tfPesFone"+num+"'");
	}
	return comum(lista);
}

function comum(l){
	for(x=0; x<l.length; x++){
		if(!validarPessoaForm(l[x]))
			return false;
	}
	return true;
}

function addTel(id){
	document.getElementById("tfFoneCont").value = parseInt(document.getElementById("tfFoneCont").value) + 1;
	cont = document.getElementById("tfFoneCont").value;
	document.getElementById(id).innerHTML += 'Telefone para contato: <input name="tfPesFone'+cont+'" type="text" id="tfPesFone'+cont+'" size="12" maxlength="12" onkeyup="javascript: validarPessoaForm(\'tfPesFone'+cont+'\');"/><label> Ex: XX-XXXX-XXXX </label><br />';
}

function mostrar(id){
		document.getElementById(id).style.visibility = "visible";
		document.getElementById(id).style.height = "auto";
}

function esconder(id){
		document.getElementById(id).style.visibility = "hidden";
		document.getElementById(id).style.height = "0px";
}