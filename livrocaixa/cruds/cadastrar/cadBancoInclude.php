<?php
	session_start();
	$toRoot = "../../";
	$nivelAcesso = $toRoot.":1:3:4";
	include_once($toRoot."utils/controladorAcesso.php");
	include_once($toRoot."utils/funcoes.php");
	
	setVoltar("cadBanco.php");
	$voltar = $_SESSION["voltar"];
	
	$cadastrar = isset($_GET["cadastrar"]) ? $_GET["cadastrar"] : NULL;	 		
	
	if($cadastrar == "sim"){
		foreach($_POST as $nomeCampo => $valor){
			$comando = "\$".$nomeCampo."= antiSQL(isset(\$_POST['$nomeCampo']) ? '".$valor."' : NULL);";
			eval($comando);
		}
		
		include_once($toRoot."utils/ConectarMySQL.class.php");
		include_once($toRoot."beans/Banco.class.php");
		include_once($toRoot."beans/Log.class.php");
		include_once($toRoot."dao/DAOBanco.class.php");
		include_once($toRoot."dao/DAOLog.class.php");
		
		$conexao		= new ConectarMySql($toRoot);

		$tfNomBan 		= strtoupper($tfNomBan);
		$banco 			= new Banco($tfNomBan);
		$daoBanco		= new DAOBanco($banco, $conexao);
		$daoBanco->cadastrar();
		
		$log 			= new Log(3, 18, $tfNomBan." cadastrado!");
		$daoLog			= new DAOLog($log, $conexao);
		$daoLog->cadastrar();
		
		$conexao->fechar();
		$cadastrar = true;	
	}
?>