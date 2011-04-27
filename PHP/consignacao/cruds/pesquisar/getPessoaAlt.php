<?php
	include_once("../../utils/funcoes.php");
	$key = antiSQL(isset($_GET["key"]) ? $_GET["key"] : NULL);
	
	if($key != NULL){
		include_once("../../utils/ConectarMySQL.class.php");
		$conexao = new ConectarMySQL();
		
		include_once("../../dao/DAOPessoa.class.php");
		include_once("../../beans/Pessoa.class.php");
		$dao = new DAOPessoa(NULL, NULL, NULL, "../../", $conexao);
		$pessoa = new Pessoa(NULL, NULL, NULL, NULL);
		$pessoa = $dao->getPessoa($key);
		$conexao->commit();
		echo('<div id="A">'.$pessoa->getCodigo().'</div>');
		echo('<div id="B">'.utf8_encode($pessoa->getNome()).'</div>');
		echo('<div id="C">'.$pessoa->getCPF().'</div>');
		echo('<div id="D">'.$pessoa->getClasse().'</div>');
	}else{
		echo("ERRO!");
	}
?>