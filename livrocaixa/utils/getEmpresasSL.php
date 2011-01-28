<?php 
	$toRoot = isset($toRoot)? $toRoot : "../";
	include_once($toRoot."beans/FuncionarioEmpresa.class.php");
	include_once($toRoot."dao/DAOFuncionarioEmpresa.class.php");
	include_once($toRoot."utils/ConectarMySQL.class.php");
	
	$conexao				= new ConectarMySql(); 
	$funcionarioEmpresa 	= new FuncionarioEmpresa();
	$DAOFuncionarioEmpresa	= new DAOFuncionarioEmpresa($funcionarioEmpresa, $conexao);
	$array = $DAOFuncionarioEmpresa->getFuncionarioEmpresaLista($_SESSION["codigo"]);
	
	if($array != NULL){
		echo('<option value="---" selected="selected" >---</option>');
		foreach($array as $temp){
			if($temp = NULL)
				continue;
			$funcionarioEmpresa = $temp;
			echo('<option value="'.$funcionarioEmpresa->empCodigo.'" >'.$funcionarioEmpresa->nome.'</option>');
		}
	}else{
		echo('<option value="0" selected="selected" >º-º</option>');
	}
	$conexao->fechar();
?>