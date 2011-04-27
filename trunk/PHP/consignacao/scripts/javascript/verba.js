// JavaScript Document
function validarVerForm(id){
	switch(id){
		case "tfVerba" : descricaoExpReg = /^[0-9]{3,10}$/; break;
		case "tfVerDesc" : descricaoExpReg = /^([a-z]|[A-Z]|[0-9]| |[¡·…ÈÕÌ‘Ù⁄˙ ÍÁ„ı]){2,100}$/; break;
		case "slEmpRef" : case "slBancRef" : case "slProRef" : case "slVerRef" : descricaoExpReg = /[^---]/; break;
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

function validarVerCadSubmit(){
	lista = new Array("tfVerDesc", "slEmpRef", "slBancRef", "slProRef", "tfVerba");
	return comum(lista);
}

function validarVerAltSubmit(){
	lista = new Array("tfVerDesc", "slEmpRef", "slBancRef", "slProRef", "tfVerba", "slVerRef");
	return comum(lista);
}

function comum(l){
	for(x=0; x<l.length; x++){
		if(!validarVerForm(l[x]))
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

function carregarEmpresas(){
	xmlRequest = getXMLHttp();

	xmlRequest.open("GET",'../pesquisar/getEmpresasSL.php',true);
	
	if (xmlRequest.readyState == 1) {
		document.getElementById("carregando").innerHTML = "<img src='../../imagens/rotating_arrow.gif' width='20px' height='20px' />";
	}
	xmlRequest.onreadystatechange = function () {
			if (xmlRequest.readyState == 4){
				document.getElementById("carregando").innerHTML = "";
				document.getElementById('slEmpRef').innerHTML = xmlRequest.responseText;
				carregarBancos();
			}
	}
	xmlRequest.send(null);
}
function carregarBancos(){
	xmlRequest = getXMLHttp();

	xmlRequest.open("GET",'../pesquisar/getBancosSL.php',true);
	
	if (xmlRequest.readyState == 1) {
		document.getElementById("carregando").innerHTML = "<img src='../../imagens/rotating_arrow.gif' width='20px' height='20px' />";
	}
	xmlRequest.onreadystatechange = function () {
			if (xmlRequest.readyState == 4){
				document.getElementById("carregando").innerHTML = "";
				document.getElementById('slBancRef').innerHTML = xmlRequest.responseText;
				carregarProdutos();
			}
	}
	xmlRequest.send(null);
}
function carregarProdutos(){
	xmlRequest = getXMLHttp();

	xmlRequest.open("GET",'../pesquisar/getProdutosSL.php',true);
	
	if (xmlRequest.readyState == 1) {
		document.getElementById("carregando").innerHTML = "<img src='../../imagens/rotating_arrow.gif' width='20px' height='20px' />";
	}
	xmlRequest.onreadystatechange = function () {
			if (xmlRequest.readyState == 4){
				document.getElementById("carregando").innerHTML = "";
				document.getElementById('slProRef').innerHTML = xmlRequest.responseText;
			}
	}
	xmlRequest.send(null);
}