<?php
	$toRoot = isset($toRoot)? $toRoot : "../";
	include_once($toRoot."beans/PlanoConta.class.php");
	include_once($toRoot."dao/DAOPlanoConta.class.php");
	include_once($toRoot."utils/ConectarMySQL.class.php");
	
	$conexao	= new ConectarMySql(); 
	$bean		= new PlanoConta();
	$dao		= new DAOPlanoConta($bean, $conexao);
	$array		= $dao->getPlanoContaLista();
	
	if($array != NULL){
		echo('<option value="---" selected="selected" >----------</option>');
		foreach($array as $temp){
			$bean = $temp;
			echo('<option value="'.$bean->codigo.'" >'.$bean->descricao.'</option>');
		}
	}else{
		echo('<option value="---" selected="selected" >Não há plano de conta cadastrado!</option>');
	}
	$conexao->fechar();
?>