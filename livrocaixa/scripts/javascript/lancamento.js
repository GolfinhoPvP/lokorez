// JavaScript Document
function validarCadastro(){
	lista = new Array("tfCod", "slPlaCon", "slPro", "tfMod", "tfVal1", "slSer", "tfVal2", "tfQua", "slForPag", "slTec");
	return comum(lista);
}

function carregarProduto(){
	comandos = "document.getElementById(\"tfMod\").value = document.getElementById(\"D\").innerHTML; document.getElementById(\"tfVal1\").value = document.getElementById(\"E\").innerHTML;";
	$array = new Array("../../utils/getProdutoAlt.php?valRef="+document.getElementById("slPro").value,"alterar","../../", comandos);
	carregar($array);
}