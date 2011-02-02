<?php
	$toRoot = isset($toRoot)? $toRoot : "../";
	include_once($toRoot."beans/Produto.class.php");
	include_once($toRoot."dao/DAOProduto.class.php");
	include_once($toRoot."utils/ConectarMySQL.class.php");
	
	$conexao	= new ConectarMySql($toRoot); 
	$bean		= new Produto();
	$dao		= new DAOProduto($bean, $conexao);
	$array		= $dao->getProdutoLista($_SESSION["empresa"]);
	
	if($array != NULL){
		echo('<option value="---" selected="selected" >----------</option>');
		foreach($array as $temp){
			$bean = $temp;
			echo('<option value="'.$bean->codigo.'" >'.$bean->descricao.'</option>');
		}
	}else{
		echo('<option value="---" selected="selected" >Não há produtos cadastrados!</option>');
	}
	$conexao->fechar();
?>