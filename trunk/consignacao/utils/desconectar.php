<?php
	session_start();
	include_once("../dao/DAOLog.class.php");
	$log = new DAOLog(2, $_SESSION["nivel"], $_SESSION["codigo"], "Realizou log-off no sistema!", "../");
	$log->cadastrar();
	session_destroy();
	header("Location: ../main.php");
?>