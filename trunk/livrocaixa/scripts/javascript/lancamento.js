// JavaScript Document
function validarCadastro(){
	lista = new Array();
	return comum(lista);
}

function carregarProduto(id, target){
	comandos = "document.getElementById(id).value = document.getElementById(\"A\").innerHTML; ";
	$array = new Array("../../utils/getProdutoAlt.php?valRef="+document.getElementById(id).value,target,"../../");
	carregar($array);
}