<?php
	session_start();
	$toRoot = "../../";
	$nivelAcesso = $toRoot.":1:3:4";
	include_once($toRoot."utils/controladorAcesso.php");
	include_once($toRoot."utils/funcoes.php");
	
	setVoltar("cadEmpresa.php");
	$voltar = $_SESSION["voltar"];
	
	$cadastrar = isset($_GET["cadastrar"]) ? $_GET["cadastrar"] : NULL;	 		
	
	if($cadastrar == "sim"){
		foreach($_POST as $nomeCampo => $valor){
			$comando = "\$".$nomeCampo."= antiSQL(isset(\$_POST['$nomeCampo']) ? '".$valor."' : NULL);";
			eval($comando);
		}
		
		include_once($toRoot."utils/ConectarMySQL.class.php");
		include_once($toRoot."beans/Empresa.class.php");
		include_once($toRoot."beans/Funcionario.class.php");
		include_once($toRoot."beans/Log.class.php");
		include_once($toRoot."dao/DAOEmpresa.class.php");
		include_once($toRoot."dao/DAOFuncionario.class.php");
		include_once($toRoot."dao/DAOLog.class.php");
		
		$conexao		= new ConectarMySql($toRoot);

		$empresa 		= new Empresa($tfNomEmp);
		$daoEmpresa		= new DAOEmpresa($empresa, $conexao);
		$daoEmpresa->cadastrar();
		$empresa = $daoEmpresa->getAtual();
		
		$log 			= new Log(3, 7, $tfNomEmp." cadastrado!");
		$daoLog			= new DAOLog($log, $conexao);
		$daoLog->cadastrar();
		
		$funcionario 		= new Funcionario($empresa->codigo, $_SESSION["codigo"]);
		$daoFuncionario		= new DAOFuncionario($funcionario, $conexao);
		$daoFuncionario->cadastrar();
		
		$log->alvCodigo = 6;
		$log->descricao = "Empresa cadastrado!";
		$daoLog->setLog($log);
		$daoLog->cadastrar();
		
		$conexao->fechar();
		$cadastrar = true;	
	}
?>