<?php
	session_start();
	$toRoot = "../../";
	
	if(!isset($_SESSION["empresa"])){
		header("Location: ".$toRoot."utils/selecionarEmpresa.php?selecionar=nao");
		die();
	}
	
	$nivelAcesso = $toRoot.":1";
	include_once($toRoot."utils/controladorAcesso.php");
	include_once($toRoot."utils/funcoes.php");
	
	$pesquisar = isset($_GET["pesquisar"]) ? $_GET["pesquisar"] : NULL;	 		
	
	if($pesquisar == "sim"){
		foreach($_POST as $nomeCampo => $valor){
			$comando = "\$".$nomeCampo."= antiSQL(isset(\$_POST['$nomeCampo']) ? '".$valor."' : NULL);";
			eval($comando);
		}
	}
?>