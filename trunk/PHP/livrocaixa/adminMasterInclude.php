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
	
	$alterar = isset($_GET["alterar"]) ? $_GET["alterar"] : NULL;	 		
	
	if($alterar == "banco"){
		foreach($_POST as $nomeCampo => $valor){
			$comando = "\$".$nomeCampo."= antiSQL(isset(\$_POST['$nomeCampo']) ? '".$valor."' : NULL);";
			eval($comando);
		}
		
		if($tfBanHos != NULL && $tfBanSen != NULL && $tfBanNomUsu != NULL && $tfBanNomBan != NULL && $tfSenMas == decodificar($_SESSION["masterSenha"])){
			$xml->bancoDeDados->host		= $tfBanHos;
			$xml->bancoDeDados->nomeUsuario	= $tfBanNomUsu;
			$xml->bancoDeDados->senha		= $tfBanSen;
			$xml->bancoDeDados->nomeBanco	= $tfBanNomBan;
			
			file_put_contents($toRoot."configuracao.xml",$xml->asXML());
			$alterar = "sim";
		}else{
			$alterar = "nao";
		}	
	}else if($alterar == "status"){
		foreach($_POST as $nomeCampo => $valor){
			$comando = "\$".$nomeCampo."= antiSQL(isset(\$_POST['$nomeCampo']) ? '".$valor."' : NULL);";
			eval($comando);
		}
		
		if($slSta != NULL && $tfSenMas == decodificar($_SESSION["masterSenha"])){
			
			$xml->status = $slSta;
			file_put_contents($toRoot."configuracao.xml",$xml->asXML());
			$alterar = "sim";
		}else{
			$alterar = "nao";
		}	
	}else if($alterar == "master"){
		foreach($_POST as $nomeCampo => $valor){
			$comando = "\$".$nomeCampo."= antiSQL(isset(\$_POST['$nomeCampo']) ? '".$valor."' : NULL);";
			eval($comando);
		}
		
		if($tfNomUsu != NULL && $tfSen1 != NULL && $tfSen2 != NULL && $tfSenMas == decodificar($_SESSION["masterSenha"])){
			$xml->adminMaster->nomeUsuario	= $tfNomUsu;
			$xml->adminMaster->senha		= codificar($tfSen2);
			
			file_put_contents($toRoot."configuracao.xml",$xml->asXML());
			$alterar = "sim";
		}else{
			$alterar = "nao";
		}	
	}
	
?>