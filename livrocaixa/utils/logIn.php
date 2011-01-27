<?php
	session_start();
	include_once("funcoes.php");
	
	$tfNomUsu 	= antiSQL(isset($_POST["tfNomUsu"]) ? $_POST["tfNomUsu"] 	: NULL);
	$tfSen 		= antiSQL(isset($_POST["tfSen"]) 	? $_POST["tfSen"] 		: NULL);
	
	if($tfNomUsu != NULL && $tfSen != NULL){
		include_once("ConectarMySQL.class.php");
		include_once("../beans/Cliente.class.php");
		include_once("../beans/Log.class.php");
		include_once("../dao/DAOCliente.class.php");
		include_once("../dao/DAOLog.class.php");
		
		$conexao 	= new ConectarMySQL();
		$cliente 	= new Cliente();
		$log		= new Log(1, 1, $_SESSION["nomeUsuario"]." realizou log-in no sistema!");
		$daoCli	 	= new DAOCliente($cliente, $conexao);
		$daoLog 	= new DAOLog($log, $conexao);
		
		$cliente = $daoCli->getCliente($tfNomUsu);
		
		if($cliente != NULL && $cliente->nomeUsuario == $tfNomUsu && decodificar($cliente->senha) == $tfSen){
			$_SESSION["codigo"] 		= $cliente->codigo;
			$_SESSION["pesCodigo"] 		= $cliente->pesCodigo;
			$_SESSION["codigoPai"] 		= $cliente->codigoPai;
			$_SESSION["nomeUsuario"] 	= $cliente->nomeUsuario;
			$_SESSION["sennha"] 		= $cliente->sennha;
			
			if($daoLog->cadastrar())
				$conexao->commit();
			else
				$conexao->rollback();
				
			header("Location: ../main.php");
			die();
		}
		$conexao->commit();
	}
	header("Location: ../login.php?login=erro");
?>