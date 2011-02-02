<?php
	$toRoot = isset($toRoot)? $toRoot : "../";
	include_once($toRoot."beans/FuncionarioEmpresa.class.php");
	include_once($toRoot."dao/DAOFuncionarioEmpresa.class.php");
	include_once($toRoot."utils/ConectarMySQL.class.php");
	
	$conexao				= new ConectarMySql($toRoot); 
	$funcionarioEmpresa 	= new FuncionarioEmpresa();
	$DAOFuncionarioEmpresa	= new DAOFuncionarioEmpresa($funcionarioEmpresa, $conexao);
	$array = $DAOFuncionarioEmpresa->getFuncionarioEmpresaLista($_SESSION["codigo"]);
	
	if($array != NULL){
		echo('<option value="---" selected="selected" >----------</option>');
		foreach($array as $temp){
			$funcionarioEmpresa = $temp;
			echo('<option value="'.$funcionarioEmpresa->empCodigo.'" >'.$funcionarioEmpresa->nome.'</option>');
		}
	}else{
		echo('<option value="---" selected="selected" >N�o h� empresas cadastradas!</option>');
	}
	$conexao->fechar();
?>