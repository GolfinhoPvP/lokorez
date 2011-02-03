<?php
	session_start();
	$toRoot = "";
	
	if(isset($_SESSION["master"]))
		$_SESSION["master"] = "noOK";
	
	$conectar = isset($_GET["conectar"]) ? $_GET["conectar"] : NULL;	 		
	
	if($conectar == "sim"){
		include_once($toRoot."utils/funcoes.php");
		
		foreach($_POST as $nomeCampo => $valor){
			$comando = "\$".$nomeCampo."= antiSQL(isset(\$_POST['$nomeCampo']) ? '".$valor."' : NULL);";
			eval($comando);
		}
		
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
			
			if($_SESSION["nivel"] == 3 || $_SESSION["nivel"] == 4){
				include_once($toRoot."beans/FuncionarioEmpresa.class.php");
				include_once($toRoot."dao/DAOFuncionarioEmpresa.class.php");
		
				$funcionarioEmpresa 	= new FuncionarioEmpresa();
				$DAOFuncionarioEmpresa	= new DAOFuncionarioEmpresa($funcionarioEmpresa, $conexao);
				$array = $DAOFuncionarioEmpresa->getFuncionarioEmpresaLista($_SESSION["codigo"]);
				
				foreach($array as $temp){
					$funcionarioEmpresa = $temp;
					$_SESSION["empresa"] = $funcionarioEmpresa->empCodigo;
				}
			}
			
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