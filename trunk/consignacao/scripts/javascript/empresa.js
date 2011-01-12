// JavaScript Document
function validarCadastroEmpresa(id){
	descricaoExpReg = /^([a-z]|[A-Z]|[0-9]| ){2,100}$/;
	if(!document.getElementById(id).tfEmpDesc.value.match(descricaoExpReg)){
		document.getElementById(id).tfEmpDesc.style.background = "#FF0000";
		return false;
	}else{
		document.getElementById(id).tfEmpDesc.style.background = "#FFFFFF";
		return true;
	}
	return false;
}