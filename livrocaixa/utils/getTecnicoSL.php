<?php
	$toRoot = isset($toRoot)? $toRoot : "../";
	include_once($toRoot."beans/Tecnico.class.php");
	include_once($toRoot."dao/DAOTecnico.class.php");
	include_once($toRoot."utils/ConectarMySQL.class.php");
	
	$conexao	= new ConectarMySql($toRoot); 
	$bean		= new Tecnico();
	$dao		= new DAOTecnico($bean, $conexao);
	$array		= $dao->getTecnicoLista();
	
	if($array != NULL){
		echo('<option value="---" selected="selected" >----------</option>');
		foreach($array as $temp){
			$bean = $temp;
			echo('<option value="'.$bean->codigo.'" >'.$bean->descricao.'</option>');
		}
	}else{
		echo('<option value="---" selected="selected" >Não há técnicos cadastrados!</option>');
	}
	$conexao->fechar();
?>