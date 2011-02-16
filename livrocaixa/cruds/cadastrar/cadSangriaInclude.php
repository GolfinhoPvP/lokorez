<?php
	session_start();
	$toRoot = "../../";
	$nivelAcesso = $toRoot.":1:3:4";
	include_once($toRoot."utils/controladorAcesso.php");
	include_once($toRoot."utils/funcoes.php");
	
	haEmpresa($toRoot);
	
	$cadastrar = isset($_GET["cadastrar"]) ? $_GET["cadastrar"] : NULL;	 		
	
	if($cadastrar == "sim"){
		foreach($_POST as $nomeCampo => $valor){
			$comando = "\$".$nomeCampo."= antiSQL(isset(\$_POST['$nomeCampo']) ? '".$valor."' : NULL);";
			eval($comando);
		}
		
		include_once($toRoot."utils/ConectarMySQL.class.php");
		include_once($toRoot."beans/Log.class.php");
		include_once($toRoot."beans/Sangria.class.php");
		include_once($toRoot."beans/SangriaBanco.class.php");
		include_once($toRoot."beans/SangriaCofre.class.php");
		include_once($toRoot."dao/DAOLog.class.php");
		include_once($toRoot."dao/DAOSangria.class.php");
		include_once($toRoot."dao/DAOSangriaBanco.class.php");
		include_once($toRoot."dao/DAOSangriaCofre.class.php");
		
		$conexao		= new ConectarMySql($toRoot);
		
		$tfData = converterData($tfData);
		$tfVal 	= converterValor($tfVal);
		$sangria 		= new Sangria($slTipo, $tfData, $tfVal);
		$daoSangria		= new DAOSangria($sangria, $conexao);
		$daoSangria->cadastrar();
		$sangria = $daoSangria->getAtual();
		
		if($slTipo ==1){
			$sangriaBanco 		= new SangriaBanco($sangria->codigo, $slBancRef);
			$daoSangriaBanco	= new DAOSangriaBanco($sangriaBanco, $conexao);
			$daoSangriaBanco->cadastrar();
		}else if($slTipo ==2){
			$sangriaCofre 		= new SangriaCofre($sangria->codigo, $tfNumEnv);
			$daoSangriaCofre	= new DAOSangriaCofre($sangriaCofre, $conexao);
			$daoSangriaCofre->cadastrar();
		}
		
		$log 			= new Log(3, 17, $sangria->codigo." cadastrada!");
		$daoLog			= new DAOLog($log, $conexao);
		$daoLog->cadastrar();
		
		$conexao->fechar();
		$cadastrar = true;	
	}
?>