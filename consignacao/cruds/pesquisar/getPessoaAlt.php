<?php
	$key = isset($_GET["key"]) ? $_GET["key"] : NULL;
	$tipo = isset($_GET["tipo"]) ? $_GET["tipo"] : NULL;
	
	if($key != NULL && $tipo != NULL){
		include_once("../../utils/ConectarMySQL.class.php");
		$conexao = new ConectarMySQL();
		
		include_once("../../dao/DAOPessoa.class.php");
		include_once("../../beans/Pessoa.class.php");
		$dao = new DAOPessoa(NULL, NULL, NULL, "../../", $conexao);
		$pessoa = new Pessoa(NULL, NULL, NULL, NULL);
		$pessoa = $dao->getPessoa($key);
		
		switch($tipo){
			case "A" :
				break;
			case "C" :
				include_once("../../dao/DAOBancoPessoa.class.php");
				include_once("../../beans/BancoPessoa.class.php");
				$dao = new DAOBancoPessoa(NULL, NULL, "../../", $conexao);
				$bancoPessoa = new BancoPessoa(NULL, NULL);
				$bancoPessoa = $dao->getBancoPessoa($key);
				break;
			default : break;
		}
		include_once("../../dao/DAOProduto.class.php");
		include_once("../../beans/Produto.class.php");
		$dao = new DAOProduto(NULL, NULL, "../../", $conexao);
		$produto = new Produto(NULL, NULL, NULL);
		$produto = $dao->getProduto($key);
		$conexao->commit();
		echo('<div id="A">'.$produto->getCodigo().'</div>');
		echo('<div id="B">'.utf8_encode($produto->getDescricao()).'</div>');
		echo('<div id="C">'.$produto->getPrazoMaximo().'</div>');
	}else{
		echo("ERRO!");
	}
?>