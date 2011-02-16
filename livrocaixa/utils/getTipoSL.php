<?php
	$toRoot = isset($toRoot)? $toRoot : "../";
	include_once($toRoot."beans/Tipo.class.php");
	include_once($toRoot."dao/DAOTipo.class.php");
	include_once($toRoot."utils/ConectarMySQL.class.php");
	
	$conexao	= new ConectarMySql($toRoot); 
	$bean 		= new Tipo();
	$dao		= new DAOTipo($bean, $conexao);
	$array 		= $dao->getTipoLista();
	
	if($array != NULL){
		echo('<option value="---" selected="selected" >----------</option>');
		foreach($array as $temp){
			$bean = $temp;
			echo('<option value="'.$bean->codigo.'" >'.$bean->descricao.'</option>');
		}
	}else{
		echo('<option value="---" selected="selected" >Não há tipos cadastrados!</option>');
	}
	$conexao->fechar();
?>