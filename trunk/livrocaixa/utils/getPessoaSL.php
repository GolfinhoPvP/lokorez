<?php
	$toRoot = isset($toRoot)? $toRoot : "../";
	include_once($toRoot."beans/Pessoa.class.php");
	include_once($toRoot."dao/DAOPessoa.class.php");
	include_once($toRoot."utils/ConectarMySQL.class.php");
	
	$conexao	= new ConectarMySql($toRoot); 
	$bean		= new Pessoa();
	$dao		= new DAOPessoa($bean, $conexao);
	$array		= $dao->getPessoaLista();
	
	if($array != NULL){
		echo('<option value="---" selected="selected" >----------</option>');
		foreach($array as $temp){
			$bean = $temp;
			echo('<option value="'.$bean->codigo.'" >'.$bean->nome.'</option>');
		}
	}else{
		echo('<option value="---" selected="selected" >Não há produtos cadastrados!</option>');
	}
	$conexao->fechar();
?>