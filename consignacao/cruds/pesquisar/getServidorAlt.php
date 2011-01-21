<?php
	$key = isset($_GET["key"]) ? $_GET["key"] : NULL;
	if($key != NULL){
		include_once("../../utils/ConectarMySQL.class.php");
		$conexao = new ConectarMySQL();
		
		include_once("../../dao/DAOServidor.class.php");
		include_once("../../beans/Servidor.class.php");
		$dao = new DAOServidor(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, "../../", $conexao);
		$servidor = new Servidor(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
		$servidor = $dao->getServidor($key);
		
		include_once("../../dao/DAOPessoa.class.php");
		include_once("../../beans/Pessoa.class.php");
		$dao = new DAOPessoa(NULL, NULL, NULL, "../../", $conexao);
		$pessoa = new Pessoa(NULL, NULL, NULL, NULL);
		$pessoa = $dao->getPessoa($servidor->getPesCodigo());
		
		$conexao->commit();
		echo('<div id="A">CPF: '.$pessoa->getCPF().'</div>');
		echo('<div id="B">Matr&iacute;cula: '.$servidor->getMatricula().'</div>');
		echo('<div id="C">Valor consignavel: R$ '.$servidor->getConsignavel().'</div>');
		echo('<div id="D">Valor utilizado: R$ '.$servidor->getUtilizada().'</div>');
		echo('<div id="E">Valor dispon&iacute;vel: R$ '.$servidor->getDisponivel().'</div>');
		echo('<div id="valDisp" style="visibility:hidden;">'.$servidor->getDisponivel().'</div>');
	}else{
		echo("ERRO!");
	}
?>