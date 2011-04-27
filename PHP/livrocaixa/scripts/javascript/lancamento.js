// JavaScript Document
function validarCadastro(){
	lista = new Array("tfCod", "slPlaCon", "slPro", "tfMod", "tfVal1", "slSer", "tfValPro", "tfValSer", "tfValTot", "tfQua", "slForPag", "slTec", "tfOrdSer", "tfValDesc");
	return comum(lista);
}

function carregarProduto(){
	comandos = "document.getElementById(\"tfMod\").value = document.getElementById(\"D\").innerHTML; document.getElementById(\"tfVal1\").value = document.getElementById(\"E\").innerHTML;";
	$array = new Array("../../utils/getProdutoAlt.php?valRef="+document.getElementById("slPro").value,"alterar","../../", comandos);
	carregar($array);
}

function calcularValorProduto(id){
	document.getElementById(id).value = inverterValor(converterValor(document.getElementById("tfVal1").value) * document.getElementById("tfQua").value);
}

function calcularValorTotal(id){
	document.getElementById(id).value = inverterValor(parseFloat(converterValor(document.getElementById("tfValPro").value)) + parseFloat(converterValor(document.getElementById("tfValSer").value)));
}