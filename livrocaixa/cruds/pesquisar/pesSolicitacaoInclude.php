<?php
	session_start();
	$toRoot = "../../";
	
	if(!isset($_SESSION["empresa"])){
		header("Location: ".$toRoot."utils/selecionarEmpresa.php?selecionar=nao");
		die();
	}
	
	$nivelAcesso = $toRoot.":1:3:4";
	include_once($toRoot."beans/Solicitacao.class.php");
	include_once($toRoot."dao/DAOSolicitacao.class.php");
	include_once($toRoot."utils/controladorAcesso.php");
	include_once($toRoot."utils/funcoes.php");		
	include_once($toRoot."utils/ConectarMySQL.class.php");
		
	$conexao		= new ConectarMySql($toRoot);
	
	$solicitacao 	= new Solicitacao();
	$daoSolicitacao	= new DAOSolicitacao($solicitacao, $conexao);
	$matriz 		= $daoSolicitacao->getSolicitacaoLista();
	
	$conexao->fechar();
?>