<?php
	session_start();
	$toRoot = "../../";
	
	$nivelAcesso = $toRoot.":1";
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
		include_once($toRoot."beans/Solicitacao.class.php");
		include_once($toRoot."beans/Log.class.php");
		include_once($toRoot."dao/DAOSolicitacao.class.php");
		include_once($toRoot."dao/DAOLog.class.php");
		
		$conexao		= new ConectarMySql($toRoot);
		
		$tfVen = converterData($tfVen);
		
		$tfVal = converterValor($tfVal);
		$solicitacao 	= new Solicitacao(1, $tfDes, $tfVen, $tfVal, $tfCDB, -1);
		$daoSolicitacao	= new DAOSolicitacao($solicitacao, $conexao);
		$daoSolicitacao->cadastrar();
		
		$log 			= new Log(3, 14, $tfCDB." Cadastrado");
		$daoLog			= new DAOLog($log, $conexao);
		$daoLog->cadastrar();
		
		$conexao->fechar();
		$cadastrar = true;	
	}
?>