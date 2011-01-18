// JavaScript Document
// JavaScript Document
function validarProdutoForm(id){
	switch(id){
		case "tfProDesc" : descricaoExpReg = /^([a-z]|[A-Z]|[0-9]| |[¡·…ÈÕÌ‘Ù⁄˙ ÍÁ„ı]){2,100}$/; break;
		case "tfProPrazMax" : descricaoExpReg = /^[0-9]{2,2}$/; break;
		case "slProRef" : descricaoExpReg = /[^---]/; break;
		case "slBancRef" : descricaoExpReg = /^[0-9]{3,3}$/; break;
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

function validarProdutoCadSubmit(){
	lista = new Array("tfProDesc", "tfProPrazMax");
	return comum(lista);
}

function validarProdutoAltSubmit(){
	lista = new Array("slProRef", "tfProDesc", "tfProPrazMax");
	return comum(lista);
}

function validarProdutoDelSubmit(id){
	lista = new Array("slProRef");
	return comum(lista);
}

function comum(l){
	for(x=0; x<l.length; x++){
		if(!validarBancoForm(l[x]))
			return false;
	}
	return true;
}

function mostrar(id){
		document.getElementById(id).style.visibility = "visible";
		document.getElementById(id).style.height = "auto";
}

function esconder(id){
		document.getElementById(id).style.visibility = "hidden";
		document.getElementById(id).style.height = "0px";
}

function inverter(id){
	if(document.getElementById(id).value == "velho"){
		mostrar('pessoa');
		esconder('seletor');
		document.getElementById(id).value = "novo";
	}else{
		mostrar('seletor');
		esconder('pessoa');
		document.getElementById(id).value = "velho";
	}
}
function addTel(id){
	document.getElementById("tfFoneCont").value = parseInt(document.getElementById("tfFoneCont").value) + 1;
	cont = document.getElementById("tfFoneCont").value;
	document.getElementById(id).innerHTML += 'Telefone para contato: <input name="tfPesFone'+cont+'" type="text" id="tfPesFone'+cont+'" size="12" maxlength="12" onkeyup="javascript: validarBancoForm(\'tfPesFone'+cont+'\');"/><label> Ex: XX-XXXX-XXXX </label><br />';
}