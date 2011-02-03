<?php
	session_start();
	$toRoot = "../../";
	$nivelAcesso = $toRoot.":1";
	include_once($toRoot."beans/Lancamento.class.php");
	include_once($toRoot."dao/DAOLancamento.class.php");
	include_once($toRoot."utils/controladorAcesso.php");
	include_once($toRoot."utils/funcoes.php");
	include_once($toRoot."utils/ConectarMySQL.class.php");
	
	$cadastrar = isset($_GET["cadastrar"]) ? $_GET["cadastrar"] : NULL;
	$conexao	= new ConectarMySql($toRoot);
	$bean		= new Lancamento();
	$dao 		= new DAOLancamento($bean, $conexao); 		
	
	if($cadastrar == "sim"){
		foreach($_POST as $nomeCampo => $valor){
			$comando = "\$".$nomeCampo."= antiSQL(isset(\$_POST['$nomeCampo']) ? '".$valor."' : NULL);";
			eval($comando);
		}
		
		include_once($toRoot."beans/Log.class.php");
		include_once($toRoot."dao/DAOLog.class.php");

		$bean->codigo 		= $tfCod;
		$bean->tecCodigo 	= $slTec;
		$bean->proCodigo 	= $slPro;
		$bean->pcCodigo 	= $slPlaCon;
		$bean->serCodigo 	= $slSer;
		$bean->forCodigo 	= $slForPag;
		$bean->quantidade 	= $tfQua;
		$bean->valor 		= $tfVal2;
		
		$dao->setLancamento($bean);
		$dao->cadastrar();
		
		$log 			= new Log(3, 11, $tfCod." cadastrado!");
		$daoLog			= new DAOLog($log, $conexao);
		$daoLog->cadastrar();
		
		$chave = $dao->getChave();
		$conexao->fechar();
		$cadastrar = true;	
	}else{
		$chave = $dao->getChave();
		$conexao->fechar();
	}
?>