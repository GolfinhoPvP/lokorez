<?php
	session_start();
	$toRoot = "";
	include_once($toRoot."utils/funcoes.php");
	
	$tfNomUsu 	= antiSQL(isset($_POST["tfNomUsu"]) ? $_POST["tfNomUsu"] 	: NULL);
	$tfSen 		= antiSQL(isset($_POST["tfSen"]) 	? $_POST["tfSen"] 		: NULL);
	
	if($tfNomUsu != NULL && $tfSen != NULL){
		include_once($toRoot."utils/ConectarMySQL.class.php");
		include_once($toRoot."beans/Cliente.class.php");
		include_once($toRoot."beans/Log.class.php");
		include_once($toRoot."dao/DAOCliente.class.php");
		include_once($toRoot."dao/DAOLog.class.php");
		
		$conexao 	= new ConectarMySQL();
		
		$cliente 	= new Cliente();
		$daoCli	 	= new DAOCliente($cliente, $conexao);
		
		$cliente = $daoCli->getCliente($tfNomUsu);
		
		if($cliente != NULL && $cliente->nomeUsuario == $tfNomUsu && decodificar($cliente->senha) == $tfSen){
			$_SESSION["codigo"] 		= $cliente->codigo;
			$_SESSION["nivel"] 			= $cliente->nivel;
			$_SESSION["pesCodigo"] 		= $cliente->pesCodigo;
			$_SESSION["codigoPai"] 		= $cliente->codigoPai;
			$_SESSION["nomeUsuario"] 	= $cliente->nomeUsuario;
			$_SESSION["sennha"] 		= $cliente->sennha;
			
			$log		= new Log(1, 1, $_SESSION["nomeUsuario"]." realizou log-in no sistema!");
			$daoLog 	= new DAOLog($log, $conexao);
			$daoLog->cadastrar();
			
			$conexao->fechar();
			header("Location: ".$toRoot."main.php");
			die();
		}
		$conexao->fechar();
		$login = false;
	}else{
		$login = true;
	}
?>