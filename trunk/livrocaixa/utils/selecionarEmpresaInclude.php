<?php
	session_start();
	$toRoot = "../";
	$nivelAcesso = $toRoot.":1:3:4";
	include_once($toRoot."utils/controladorAcesso.php");
	include_once($toRoot."utils/funcoes.php");
	
	$selecionar = isset($_GET["selecionar"]) ? $_GET["selecionar"] : NULL;	 		
	
	if($selecionar == "sim"){
		foreach($_POST as $nomeCampo => $valor){
			$comando = "\$".$nomeCampo."= antiSQL(isset(\$_POST['$nomeCampo']) ? '".$valor."' : NULL);";
			eval($comando);
		}
		
		$_SESSION["empresa"] = $slEmp;
		
		$selecionar = true;	
	}
?>