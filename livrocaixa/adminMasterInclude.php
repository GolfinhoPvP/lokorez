<?php
	session_start();
	$toRoot = "";
	
	if(isset($_SESSION["master"]) != "ok"){
		header("Location: login.php");
		die();
	}
	
	include_once($toRoot."utils/funcoes.php");
	
	if(!$xml = simplexml_load_file($toRoot."configuracao.xml")){
		trigger_error('Erro ao ler o arquivo XML',E_USER_ERROR);
	}
	
	$cadastrar = isset($_GET["cadastrar"]) ? $_GET["cadastrar"] : NULL;	 		
	
	if($alterar == "banco"){
		foreach($_POST as $nomeCampo => $valor){
			$comando = "\$".$nomeCampo."= antiSQL(isset(\$_POST['$nomeCampo']) ? '".$valor."' : NULL);";
			eval($comando);
		}
		
		if(!$xml = simplexml_load_file($toRoot."configuracao.xml")){
			trigger_error('Erro ao ler o arquivo XML',E_USER_ERROR);
		}
		
		if($tfBanHos != NULL && $tfBanSen != NULL && $tfBanNomUsu != NULL && $tfBanNomBan != NULL && $tfSenMas == decodificar($_SESSION["masterSenha"])){
			
			$xml->bancoDeDados->host		= $tfBanHos;
			$xml->bancoDeDados->nomeUsuario	= $tfBanNomUsu;
			$xml->bancoDeDados->senha		= $tfBanSen;
			$xml->bancoDeDados->nomeBanco	= $tfBanNomBan;
		}
		
		$alterar = true;	
	}
?>