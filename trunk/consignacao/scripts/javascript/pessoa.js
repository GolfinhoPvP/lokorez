// JavaScript Document
function validarPessoaForm(id){
	switch(id){
		case "tfNome" : descricaoExpReg = /^([a-z]|[A-Z]|[0-9]| |[���������������]){2,100}$/; break;
		case "tfCPF" : descricaoExpReg = /^([ ]{0,14}|[0-9]{3,3}\.[0-9]{3,3}\.[0-9]{3,3}-[0-9]{2,2})$/; break;
		case "slPesRef" : case "slBancRef" : case "slNivel" : case "slTipo" : descricaoExpReg = /[^---]/; break;
		case "tfSenha1" : case "tfSenha2" : descricaoExpReg = /^([a-z]|[A-Z]|[0-9]){5,15}$/; break;
		case "tfNomeUsuario" : descricaoExpReg = /^([a-z]|[A-Z]|[0-9]|-|\.|_){5,25}$/; break;
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

function verificarIgualdade(){
	if(document.getElementById("slTipo").value != "admin")
		return true

	if(document.getElementById("tfSenha1").value != document.getElementById("tfSenha2").value){
		document.getElementById("tfSenha2").style.background = "#FF0000";
		return false;
	}else{
		document.getElementById("tfSenha2").style.background = "#FFFFFF";
		return true;
	}
}

function validarPessoaCadSubmit(){
	switch(document.getElementById("slTipo").value){
		case "admin" :
			lista = new Array("tfNome", "tfCPF", "tfNomeUsuario" , "tfSenha1" , "tfSenha2" , "slNivel");
			ponteiro = 6;
			break;
		case "contato" :
			lista = new Array("tfNome", "tfCPF", "slBancRef");
			ponteiro = 3;
			break;
		default : lista = new Array("slTipo");
			ponteiro = 1;
			break;
	}
	cont = parseInt(document.getElementById("tfFoneCont").value);
	for(x=0; x < cont; x++){
		index = x+ponteiro;
		num = x+1;
		eval("lista["+index+"] = 'tfPesFone"+num+"'");
	}
	if(comum(lista) && verificarIgualdade())
		return true;
	else
		return false;
}

function validarPessoaAltSubmit(){
	switch(document.getElementById("slTipo").value){
		case "admin" :
			lista = new Array("tfNome", "tfCPF", "tfNomeUsuario" , "tfSenha1" , "tfSenha2" , "slNivel");
			ponteiro = 6;
			break;
		case "contato" :
			lista = new Array("tfNome", "tfCPF", "slBancRef");
			ponteiro = 3;
			break;
		default : lista = new Array("slTipo");
			ponteiro = 1;
			break;
	}
	cont = parseInt(document.getElementById("tfFoneCont").value);
	for(x=0; x < cont; x++){
		index = x+ponteiro;
		num = x+1;
		eval("lista["+index+"] = 'tfPesFone"+num+"'");
	}
	if(comum(lista) && verificarIgualdade())
		return true;
	else
		return false;
}

function validarPessoaDelSubmit(){
	lista = new Array("slTipo", "slPesRef");
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
	document.getElementById(id).innerHTML += '<span class="texto2">Telefone para contato: </span><input name="tfPesFone'+cont+'" type="text" class="tf1" id="tfPesFone'+cont+'" size="12" maxlength="12" onkeyup="javascript: validarBancoForm(\'tfPesFone'+cont+'\');"/><label class="alerta1"> Ex: XX-XXXX-XXXX </label><br />';
}

function addBan(id){
	document.getElementById("tfBanCont").value = parseInt(document.getElementById("tfBanCont").value) + 1;
	cont = document.getElementById("tfBanCont").value;
	document.getElementById(id).innerHTML += '<span class="texto2">Adicionar contato ao banco: </span><select name="slBan'+cont+'" class="tf1" id="slBan'+cont+'" onkeyup="javascript: validarPessoaForm(\'tfPesFone1\');"><option value="---" selected="selected">-----------------------------</option></select><br/>';
	document.getElementById("slBan"+cont).innerHTML = document.getElementById("bancosAlt").innerHTML;
}

function mostrar(id){
		document.getElementById(id).style.visibility = "visible";
		document.getElementById(id).style.height = "auto";
}

function esconder(id){
		document.getElementById(id).style.visibility = "hidden";
		document.getElementById(id).style.height = "0px";
}