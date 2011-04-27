<?php
	session_start();
	$toRoot = "../../";
	
	if(!isset($_SESSION["empresa"])){
		header("Location: ".$toRoot."utils/selecionarEmpresa.php?selecionar=nao");
		die();
	}
	
	include_once($toRoot."utils/funcoes.php");
	include_once($toRoot."utils/ConectarMySQL.class.php");
	include_once($toRoot."beans/Solicitacao.class.php");
	include_once($toRoot."beans/Log.class.php");
	include_once($toRoot."dao/DAOSolicitacao.class.php");
	include_once($toRoot."dao/DAOLog.class.php");
	
	$conexao	= new ConectarMySql($toRoot);
	
	$valRef 	= antiSQL(isset($_GET["valRef"]) ? $_GET["valRef"] : NULL);
	$alterar 	= isset($_GET["alterar"]) ? $_GET["alterar"] : NULL;
	
	if($valRef == NULL)
		$valRef = antiSQL($_POST["valRef"]);
		
	if($alterar == "sim"){		
		foreach($_POST as $nomeCampo => $valor){
			$comando = "\$".$nomeCampo."= antiSQL(isset(\$_POST['$nomeCampo']) ? '".$valor."' : NULL);";
			eval($comando);
		}
				
		$solicitacao 	= new Solicitacao();
		$daoSolicitacao	= new DAOSolicitacao($solicitacao, $conexao);
		$daoSolicitacao->getSolicitacao($valRef);
		$solicitacao->valorPago = $tfVal2;
		if($solicitacao->valor == $tfVal2){
			$solicitacao->staCodigo = 2;
		}else{
			$solicitacao->staCodigo = 3;
		}
		$daoSolicitacao->setSolicitacao($solicitacao);
		$daoSolicitacao->alterar($valRef);
		
		$log 			= new Log(4, 14, $valRef." Alterado");
		$daoLog			= new DAOLog($log, $conexao);
		$daoLog->cadastrar();
		
		$conexao->fechar();
		$alterar = true;
		
		$_SESSION["solicitacoes"] -= 1;
		
		if($_SESSION["solicitacoes"] == 0){
			$tirarAlerta = "sim";
		}
	}else{
		if($valRef != NULL){
			$bean		= new Solicitacao();
			$dao		= new DAOSolicitacao($bean, $conexao);
			$bean 		= $dao->getSolicitacao($valRef);
			$conexao->fechar();
		}
	}
?>