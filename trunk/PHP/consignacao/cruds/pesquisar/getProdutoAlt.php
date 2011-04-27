<?php
	session_start();
	$nivelAcesso = "../../:2:3:4";
	include_once("../../utils/controladorAcesso.php");
	include_once("../../utils/funcoes.php");
	$key = antiSQL(isset($_GET["key"]) ? $_GET["key"] : NULL);
	if($key != NULL){
		include_once("../../utils/ConectarMySQL.class.php");
		$conexao = new ConectarMySQL();
		include_once("../../dao/DAOProduto.class.php");
		include_once("../../beans/Produto.class.php");
		$dao = new DAOProduto(NULL, NULL, "../../", $conexao);
		$produto = new Produto(NULL, NULL, NULL);
		$produto = $dao->getProduto($key);
		$conexao->commit();
		echo('<div id="A">'.$produto->getCodigo().'</div>');
		echo('<div id="B">'.utf8_encode($produto->getDescricao()).'</div>');
		echo('<div id="C">'.$produto->getPrazoMaximo().'</div>');
	}else{
		echo("ERRO!");
	}
?>