<?php
	session_start();
	$toRoot = "../";
	include_once($toRoot."beans/Produto.class.php");
	include_once($toRoot."dao/DAOProduto.class.php");
	include_once($toRoot."utils/ConectarMySQL.class.php");
	include_once($toRoot."utils/funcoes.php");
	
	$valRef = antiSQL(isset($_GET["valRef"]) ? $_GET["valRef"] : NULL);
	
	if($valRef != NULL){
		$conexao	= new ConectarMySql($toRoot); 
		$bean		= new Produto();
		$dao		= new DAOProduto($bean, $conexao);
		$bean 		= $dao->getProduto($valRef);
		$conexao->fechar();
		echo('<div id="A">'.$bean->codigo.'</div>');
		echo('<div id="B">'.$bean->empCodigo.'</div>');
		echo('<div id="C">'.utf8_encode($bean->descricao).'</div>');
		echo('<div id="D">'.utf8_encode($bean->modelo).'</div>');
		echo('<div id="E">'.inverterValor($bean->valorVenda).'</div>');
	}else{
		echo("ERRO!");
	}
?>