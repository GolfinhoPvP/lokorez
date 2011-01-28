<?php
	session_start();
	$toRoot = "../";
	include_once($toRoot."beans/Log.class.php");
	include_once($toRoot."dao/DAOLog.class.php");
	include_once($toRoot."utils/ConectarMySQL.class.php");
	
	$conexao = new ConectarMySQL();
	
	$log		= new Log(1, 1, $_SESSION["nomeUsuario"]." desconectou log-in no sistema!");
	$daoLog 	= new DAOLog($log, $conexao);
	$daoLog->cadastrar();
	
	$conexao->fechar();
	session_destroy();
	header("Location: ".$toRoot."login.php");
?>