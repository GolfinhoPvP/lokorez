<?php
	$toRoot = isset($toRoot)? $toRoot : "../";
	include_once($toRoot."beans/Servico.class.php");
	include_once($toRoot."dao/DAOServico.class.php");
	include_once($toRoot."utils/ConectarMySQL.class.php");
	
	$conexao	= new ConectarMySql(); 
	$bean		= new Servico();
	$dao		= new DAOServico($bean, $conexao);
	$array		= $dao->getServicoLista();
	
	if($array != NULL){
		echo('<option value="---" selected="selected" >----------</option>');
		foreach($array as $temp){
			$bean = $temp;
			echo('<option value="'.$bean->codigo.'" >'.$bean->descricao.'</option>');
		}
	}else{
		echo('<option value="---" selected="selected" >Não há serviços cadastrados!</option>');
	}
	$conexao->fechar();
?>