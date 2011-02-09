<?php
	require_once("utils/Connect.class.php");
	include_once("beans/Variables.class.php");
	
	$variables = new Variables();
	$connect = new Connect($variables->dbHost, $variables->dbUser, $variables->dbPassword, $variables->dbName);
	$connect->start();
	
	session_start();
	
	if((isset($_SESSION["usuario"]) == NULL) && (isset($_SESSION["senha"]) == NULL) && (isset($_SESSION["nivel"]) > 2)){
		header("Location: admin.php");
		die();
	}
	
	$cadastrar = isset($_GET["cadastrar"]) ? $_GET["cadastrar"] : NULL;	 		
	
	if($cadastrar == "sim"){
		foreach($_POST as $nomeCampo => $valor){
			$comando = "\$".$nomeCampo."= antiSQL(isset(\$_POST['$nomeCampo']) ? '".$valor."' : NULL);";
			eval($comando);
		}
	}
?>