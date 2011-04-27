<?php
	$toRoot = isset($toRoot)? $toRoot : "../";
	include_once($toRoot."beans/FormaPagamento.class.php");
	include_once($toRoot."dao/DAOFormaPagamento.class.php");
	include_once($toRoot."utils/ConectarMySQL.class.php");
	
	$conexao	= new ConectarMySql($toRoot); 
	$bean		= new FormaPagamento();
	$dao		= new DAOFormaPagamento($bean, $conexao);
	$array		= $dao->getFormaPagamentoLista();
	
	if($array != NULL){
		echo('<option value="---" selected="selected" >----------</option>');
		foreach($array as $temp){
			$bean = $temp;
			if($bean->periodo > 0){
				$complemento = " - ".$bean->periodo."x";
			}else{
				$complemento = "";
			}
			echo('<option value="'.$bean->codigo.'" >'.$bean->descricao.$complemento.'</option>');
		}
	}else{
		echo('<option value="---" selected="selected" >Não há forma de pagamentos cadastradas!</option>');
	}
	$conexao->fechar();
?>