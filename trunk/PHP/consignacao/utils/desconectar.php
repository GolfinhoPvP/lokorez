<?php
	session_start();
	include_once("ConectarMySQL.class.php");
	$conexao = new ConectarMySQL();
	include_once("../dao/DAOLog.class.php");
	$log = new DAOLog($_SESSION["pessoa"], 2, $_SESSION["nivel"], $_SESSION["codigo"], 1, "Realizou log-off no sistema!", "../", $conexao);
	$log->cadastrar();
	$conexao->commit();
	session_destroy();
	header("Location: ../index.php");
?>