<?php
	session_start();
	$toRoot = "../../";
	if(!isset($_SESSION["empresa"])){
		header("Location: ".$toRoot."utils/selecionarEmpresa.php?selecionar=nao");
		die();
	}
	include_once($toRoot."beans/LivroCaixa.class.php");
	include_once($toRoot."dao/DAOLivroCaixa.class.php");
	include_once($toRoot."utils/controladorAcesso.php");
	include_once($toRoot."utils/funcoes.php");
	include_once($toRoot."utils/ConectarMySQL.class.php");
	
	$nivelAcesso = $toRoot.":1:3:4";
	
	$conexao = new ConectarMySQL($toRoot);
		
	$bean 			= new LivroCaixa();
	$daoLog			= new DAOLivroCaixa($bean, $conexao);
	$matriz 		= $daoLog->getLivroCaixaLista();
	
	$conexao->fechar();
?>