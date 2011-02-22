<?php
	session_start();
	$toRoot = "../../";
	$nivelAcesso = $toRoot.":1:3:4";
	include_once($toRoot."utils/controladorAcesso.php");
	include_once($toRoot."utils/funcoes.php");
	
	setVoltar("cadTecnico.php");
	$voltar = $_SESSION["voltar"];
	
	$cadastrar = isset($_GET["cadastrar"]) ? $_GET["cadastrar"] : NULL;	 		
	
	if($cadastrar == "sim"){
		foreach($_POST as $nomeCampo => $valor){
			$comando = "\$".$nomeCampo."= antiSQL(isset(\$_POST['$nomeCampo']) ? '".$valor."' : NULL);";
			eval($comando);
		}
		
		include_once($toRoot."utils/ConectarMySQL.class.php");
		include_once($toRoot."beans/Email.class.php");
		include_once($toRoot."beans/Log.class.php");
		include_once($toRoot."beans/Pessoa.class.php");
		include_once($toRoot."beans/Tecnico.class.php");
		include_once($toRoot."beans/Telefone.class.php");
		include_once($toRoot."dao/DAOEmail.class.php");
		include_once($toRoot."dao/DAOLog.class.php");
		include_once($toRoot."dao/DAOPessoa.class.php");
		include_once($toRoot."dao/DAOTecnico.class.php");
		include_once($toRoot."dao/DAOTelefone.class.php");
		
		$conexao		= new ConectarMySql($toRoot);
		
		$log 			= new Log(3, NULL, NULL);
		$daoLog			= new DAOLog($log, $conexao);

		if($cbSel == "novo"){
			$pessoa 		= new Pessoa($tfNom, $tfCPF, $tfRG);
			$daoPessoa		= new DAOPessoa($pessoa, $conexao);
			$daoPessoa->cadastrar();
			$pessoa = $daoPessoa->getAtual();
			
			$log->alvCodigo = 3;
			$log->descricao = $tfNom." cadastrado!";
			$daoLog->setLog($log);
			$daoLog->cadastrar();
			
			if(strlen($tfEmlURL) > 0){
				$email 			= new Email($pessoa->codigo, $tfEmlURL, $tfEmlNot);
				$daoEmail		= new DAOEmail($email, $conexao);
				$daoEmail->cadastrar();
				
				$log->alvCodigo = 4;
				$log->descricao = $tfEmlURL." cadastrado!";
				$daoLog->setLog($log);
				$daoLog->cadastrar();
			}
			
			if(strlen($tfFonNum) > 0){
				$telefone 		= new Telefone($pessoa->codigo, $tfFonNum, $tfFonNot);
				$daoTelefone	= new DAOTelefone($telefone, $conexao);
				$daoTelefone->cadastrar();
				
				$log->alvCodigo = 5;
				$log->descricao = $tfFonNum." cadastrado!";
				$daoLog->setLog($log);
				$daoLog->cadastrar();
			}
			$pesReferencia = $pessoa->codigo;
		}else{
			$pesReferencia = $slPes;
		}

		$tecnico 		= new Tecnico($slBancRef, $pesReferencia, $slCla, $tfDes, $tfAgen, $tfCont);
		$daoTecnico		= new DAOTecnico($tecnico, $conexao);
		$daoTecnico->cadastrar();
		
		$log->alvCodigo = 15;
		$log->descricao = $tfDes." cadastrado!";
		$daoLog->setLog($log);
		$daoLog->cadastrar();
		
		$conexao->fechar();
		$cadastrar = true;	
	}
?>