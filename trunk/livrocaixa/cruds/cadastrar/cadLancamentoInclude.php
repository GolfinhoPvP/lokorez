<?php
	session_start();
	$toRoot = "../../";
	$nivelAcesso = $toRoot.":1";
	
	if(!isset($_SESSION["empresa"])){
		header("Location: ".$toRoot."utils/selecionarEmpresa.php?selecionar=nao");
		die();
	}
	
	include_once($toRoot."beans/Lancamento.class.php");
	include_once($toRoot."dao/DAOLancamento.class.php");
	include_once($toRoot."utils/controladorAcesso.php");
	include_once($toRoot."utils/funcoes.php");
	include_once($toRoot."utils/ConectarMySQL.class.php");
	
	$cadastrar = isset($_GET["cadastrar"]) ? $_GET["cadastrar"] : NULL;
	$conexao	= new ConectarMySql($toRoot);
	$lancamento	= new Lancamento();
	$dao 		= new DAOLancamento($lancamento, $conexao); 		
	
	if($cadastrar == "sim"){
		foreach($_POST as $nomeCampo => $valor){
			$comando = "\$".$nomeCampo."= antiSQL(isset(\$_POST['$nomeCampo']) ? '".$valor."' : NULL);";
			eval($comando);
		}
		
		include_once($toRoot."beans/Log.class.php");
		include_once($toRoot."dao/DAOLog.class.php");

		$lancamento->codigo 	= $tfCod;
		$lancamento->forCodigo 	= $slForPag;
		if(($slPro != "---") && ($slSer != "---")){
			$lancamento->tipCodigo = 103;
		}else if(($slPro != "---") && ($slSer == "---")){
			$lancamento->tipCodigo = 101;
		}else if(($slPro == "---") && ($slSer != "---")){
			$lancamento->tipCodigo = 102;
		}
		$lancamento->pcCodigo 	= $slPlaCon;
		$lancamento->valor 		= converterValor($tfValTot);
		
		$dao->setLancamento($lancamento);
		$dao->cadastrar();
		
		if($lancamento->tipCodigo == 101 || $lancamento->tipCodigo == 103){
			include_once($toRoot."beans/LancamentoProduto.class.php");
			include_once($toRoot."dao/DAOLancamentoProduto.class.php");
			
			$lancamentoProduto	= new LancamentoProduto($tfCod, $slPro, $tfQua, converterValor($tfValPro));
			$daoP 				= new DAOLancamentoProduto($lancamentoProduto, $conexao);
			
			$daoP->cadastrar();
		}
		
		if($lancamento->tipCodigo == 102 || $lancamento->tipCodigo == 103){
			include_once($toRoot."beans/LancamentoServico.class.php");
			include_once($toRoot."dao/DAOLancamentoServico.class.php");
			
			$lancamentoServico	= new LancamentoServico($tfCod, $slSer, $slTec, converterValor($tfValSer));
			$daoS 				= new DAOLancamentoServico($lancamentoServico, $conexao);
			
			$daoS->cadastrar();
		}
		
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