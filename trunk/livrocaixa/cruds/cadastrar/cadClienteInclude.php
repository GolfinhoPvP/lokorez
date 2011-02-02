<?php
	session_start();
	$toRoot = "../../";
	$nivelAcesso = $toRoot.":4";
	include_once($toRoot."utils/controladorAcesso.php");
	include_once($toRoot."utils/funcoes.php");
	
	$cadastrar = isset($_GET["cadastrar"]) ? $_GET["cadastrar"] : NULL;	 		
	
	if($cadastrar == "sim"){
		foreach($_POST as $nomeCampo => $valor){
			$comando = "\$".$nomeCampo."= antiSQL(isset(\$_POST['$nomeCampo']) ? '".$valor."' : NULL);";
			eval($comando);
		}
		
		include_once($toRoot."utils/ConectarMySQL.class.php");
		include_once($toRoot."beans/Cliente.class.php");
		include_once($toRoot."beans/Email.class.php");
		include_once($toRoot."beans/Funcionario.class.php");
		include_once($toRoot."beans/Log.class.php");
		include_once($toRoot."beans/Pessoa.class.php");
		include_once($toRoot."beans/Telefone.class.php");
		include_once($toRoot."dao/DAOCliente.class.php");
		include_once($toRoot."dao/DAOEmail.class.php");
		include_once($toRoot."dao/DAOFuncionario.class.php");
		include_once($toRoot."dao/DAOLog.class.php");
		include_once($toRoot."dao/DAOPessoa.class.php");
		include_once($toRoot."dao/DAOTelefone.class.php");
		
		$conexao		= new ConectarMySql($toRoot);

		$pessoa 		= new Pessoa($tfNom, $tfCPF, $tfRG);
		$daoPessoa		= new DAOPessoa($pessoa, $conexao);
		$daoPessoa->cadastrar();
		$pessoa = $daoPessoa->getAtual();
		
		$log 			= new Log(3, 3, $tfNom." cadastrado!");
		$daoLog			= new DAOLog($log, $conexao);
		$daoLog->cadastrar();
		
		if(strlen($tfEmlURL) > 0){
			$email 			= new Email($pessoa->codigo, $tfEmlURL, $tfEmlNot);
			$daoEmail		= new DAOEmail($email, $conexao);
			$daoEmail->cadastrar();
			
			$log->alvo 		= 4;
			$log->descricao = $tfEmlURL." cadastrado!";
			$daoLog->setLog($log);
			$daoLog->cadastrar();
		}
		
		if(strlen($tfFonNum) > 0){
			$telefone 		= new Telefone($pessoa->codigo, $tfFonNum, $tfFonNot);
			$daoTelefone	= new DAOTelefone($telefone, $conexao);
			$daoTelefone->cadastrar();
			
			$log->alvo 		= 5;
			$log->descricao = $tfFonNum." cadastrado!";
			$daoLog->setLog($log);
			$daoLog->cadastrar();
		}
		
		if(!isset($cadCliFunCla)){
			$cadCliFunCla = 2;
		}else if($cadCliFunCla == 1 || $cadCliFunCla == 2){
			$$cadCliFunCla = 3;
		}
		
		if($_SESSION["codigo"] = 1)
			$slCla = 2;

		$cliente 		= new Cliente($pessoa->codigo, $slCla, $tfNomUsu, codificar($tfSen1));
		$daoCliente		= new DAOCliente($cliente, $conexao);
		$daoCliente->cadastrar();
		$cliente = $daoCliente->getAtual();
		
		$log->alvo 		= 2;
		$log->descricao = $tfNomUsu." cadastrado!";
		$daoLog->setLog($log);
		$daoLog->cadastrar();
		
		if($_SESSION["nivel"] != 1){
			$funcionario 	= new Funcionario($slEmp, $cliente->codigo);
			$daoFuncionario	= new DAOFuncionario($funcionario, $conexao);
			$daoFuncionario->cadastrar();
			
			$log->alvo 		= 6;
			$log->descricao = "funcionario cadastrado!";
			$daoLog->setLog($log);
			$daoLog->cadastrar();
		}
		
		$conexao->fechar();
		$cadastrar = true;	
	}
?>