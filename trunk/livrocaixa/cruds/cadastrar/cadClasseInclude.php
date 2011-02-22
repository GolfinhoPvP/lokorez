<?php
	session_start();
	$toRoot = "../../";
	$nivelAcesso = $toRoot.":1:4";
	include_once($toRoot."utils/controladorAcesso.php");
	include_once($toRoot."utils/funcoes.php");
	
	setVoltar("cadClasse.php");
	$voltar = $_SESSION["voltar"];
	
	$cadastrar = isset($_GET["cadastrar"]) ? $_GET["cadastrar"] : NULL;	 		
	
	if($cadastrar == "sim"){
		foreach($_POST as $nomeCampo => $valor){
			$comando = "\$".$nomeCampo."= antiSQL(isset(\$_POST['$nomeCampo']) ? '".$valor."' : NULL);";
			eval($comando);
		}
		
		include_once($toRoot."utils/ConectarMySQL.class.php");
		include_once($toRoot."beans/Classe.class.php");
		include_once($toRoot."beans/Log.class.php");;
		include_once($toRoot."dao/DAOClasse.class.php");
		include_once($toRoot."dao/DAOLog.class.php");
		
		$conexao		= new ConectarMySql($toRoot);

		$tfPor 			= converterValor($tfPor);
		$classe 		= new Classe($tfDes, $tfPor);
		$daoClasse		= new DAOClasse($classe, $conexao);
		$daoClasse->cadastrar();
		
		$log 			= new Log(3, 8, $tfDes." cadastrado!");
		$daoLog			= new DAOLog($log, $conexao);
		$daoLog->cadastrar();
		
		$conexao->fechar();
		$cadastrar = true;
	}
?>