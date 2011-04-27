// JavaScript Document
function validarDescricaoEmpresa(id){
	descricaoExpReg = /^([a-z]|[A-Z]|[0-9]| |[¡·…ÈÕÌ‘Ù⁄˙ ÍÁ„ı]|-|:|_|\.){2,100}$/;
	document.getElementById("confirmar").style.visibility = "hidden";
	if(!document.getElementById(id).tfEmpDesc.value.match(descricaoExpReg)){
		document.getElementById(id).tfEmpDesc.style.background = "#FF0000";
		return false;
	}else{
		document.getElementById(id).tfEmpDesc.style.background = "#FFFFFF";
		return true;
	}
	return false;
}

function validarDeletarEmpresa(id){
	document.getElementById("confirmar").style.visibility = "hidden";
	if(document.getElementById(id).slEmpRef.value == "---"){
		document.getElementById(id).slEmpRef.style.background = "#FF0000";
		return false;
	}else{
		document.getElementById(id).slEmpRef.style.background = "#FFFFFF";
	}
	return true;
}

function validarAlterarEmpresa(id){
	if(!validarDescricaoEmpresa(id)){
		return false;
	}
	if(!validarDeletarEmpresa(id)){
		return false;
	}
	return true;
}