<?php
	$toRoot = isset($toRoot)? $toRoot : "../";
	include_once($toRoot."beans/Classe.class.php");
	include_once($toRoot."dao/DAOClasse.class.php");
	include_once($toRoot."utils/ConectarMySQL.class.php");
	
	$conexao	= new ConectarMySql(); 
	$classe 	= new Classe();
	$DAOClasse	= new DAOClasse($classe, $conexao);
	$array = $DAOClasse->getClasseLista();
	
	if($array != NULL){
		echo('<option value="---" selected="selected" >----------</option>');
		foreach($array as $temp){
			$classe = $temp;
			echo('<option value="'.$classe->codigo.'" >'.$classe->descricao.'</option>');
		}
	}else{
		echo('<option value="---" selected="selected" >Não há classes cadastradas!</option>');
	}
	$conexao->fechar();
?>