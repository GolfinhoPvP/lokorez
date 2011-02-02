<?php
	session_start();
	$toRoot = "";
	
	if(isset($_SESSION["master"]))
		$_SESSION["master"] = "noOK";
	
	$conectar = isset($_GET["conectar"]) ? $_GET["conectar"] : NULL;	 		
	
	if($conectar == "sim"){
		include_once($toRoot."utils/funcoes.php");
		
		foreach($_POST as $nomeCampo => $valor){
			$comando = "\$".$nomeCampo."= antiSQL(isset(\$_POST['$nomeCampo']) ? '".$valor."' : NULL);";
			eval($comando);
		}
		
		if(!$xml = simplexml_load_file($toRoot."configuracao.xml")){
			trigger_error('Erro ao ler o arquivo XML',E_USER_ERROR);
		}
		
		if($xml->adminMaster->nomeUsuario == $tfNomUsu && decodificar($xml->adminMaster->senha) == $tfSen){
			$_SESSION["master"] 		= "ok";
			$_SESSION["masterSenha"] 	= (string) $xml->adminMaster->senha;
			
			header("Location: ".$toRoot."adminMaster.php");
			die();
		}
		$conectar = "nao";
	}
?>