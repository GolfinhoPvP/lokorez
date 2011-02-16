<?php
	session_start();
	$toRoot = "../";
	$nivelAcesso = $toRoot.":1:3:4";
	include_once($toRoot."utils/controladorAcesso.php");
	include_once($toRoot."utils/funcoes.php");
	
	setVoltar("selecionarEmpresa.php");
	$voltar = $_SESSION["voltar"];
	
	$selecionar = isset($_GET["selecionar"]) ? $_GET["selecionar"] : NULL;	 		
	
	if($selecionar == "sim"){
		include_once($toRoot."beans/Empresa.class.php");
		include_once($toRoot."dao/DAOEmpresa.class.php");
		include_once($toRoot."utils/ConectarMySQL.class.php");
		
		foreach($_POST as $nomeCampo => $valor){
			$comando = "\$".$nomeCampo."= antiSQL(isset(\$_POST['$nomeCampo']) ? '".$valor."' : NULL);";
			eval($comando);
		}
		
		$conexao		= new ConectarMySql($toRoot);
	
		$bean 	= new Empresa();
		$dao	= new DAOEmpresa($bean, $conexao);
		$bean	= $dao->getEmpresa($slEmp);
		
		$_SESSION["empresa"] 		= $bean->codigo;
		$_SESSION["empresaNome"] 	= $bean->nome;
		
		$conexao->fechar();
		
		$selecionar = "ok";	
	}
?>