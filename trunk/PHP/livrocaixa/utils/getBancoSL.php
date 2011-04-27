<?php
	$toRoot = isset($toRoot)? $toRoot : "../";
	include_once($toRoot."beans/Banco.class.php");
	include_once($toRoot."dao/DAOBanco.class.php");
	include_once($toRoot."utils/ConectarMySQL.class.php");
	
	$conexao	= new ConectarMySql($toRoot); 
	$bean 		= new Banco();
	$dao		= new DAOBanco($bean, $conexao);
	$array 		= $dao->getBancoLista();
	
	if($array != NULL){
		echo('<option value="---" selected="selected" >----------</option>');
		foreach($array as $temp){
			$bean = $temp;
			echo('<option value="'.$bean->codigo.'" >'.$bean->nome.'</option>');
		}
	}else{
		echo('<option value="---" selected="selected" >Não há bancos cadastrados!</option>');
	}
	$conexao->fechar();
?>