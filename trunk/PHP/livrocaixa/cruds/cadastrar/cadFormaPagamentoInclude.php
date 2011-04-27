<?php
	session_start();
	$toRoot = "../../";
	$nivelAcesso = $toRoot.":1:4";
	include_once($toRoot."utils/controladorAcesso.php");
	include_once($toRoot."utils/funcoes.php");
	
	setVoltar("cadFormaPagamento.php");
	$voltar = $_SESSION["voltar"];
	
	$cadastrar = isset($_GET["cadastrar"]) ? $_GET["cadastrar"] : NULL;	 		
	
	if($cadastrar == "sim"){
		foreach($_POST as $nomeCampo => $valor){
			$comando = "\$".$nomeCampo."= antiSQL(isset(\$_POST['$nomeCampo']) ? '".$valor."' : NULL);";
			eval($comando);
		}
		
		include_once($toRoot."utils/ConectarMySQL.class.php");
		include_once($toRoot."beans/FormaPagamento.class.php");
		include_once($toRoot."beans/Log.class.php");;
		include_once($toRoot."dao/DAOFormaPagamento.class.php");
		include_once($toRoot."dao/DAOLog.class.php");
		
		$conexao		= new ConectarMySql($toRoot);

		$formaPagamento 		= new FormaPagamento($tfPer, $tfDes);
		$daoFormaPagamento		= new DAOFormaPagamento($formaPagamento, $conexao);
		$daoFormaPagamento->cadastrar();
		
		$log 			= new Log(3, 9, $tfNom." cadastrado!");
		$daoLog			= new DAOLog($log, $conexao);
		$daoLog->cadastrar();
		
		$conexao->fechar();
		$cadastrar = true;	
	}
?>