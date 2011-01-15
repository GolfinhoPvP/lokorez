<?php
	$key = isset($_GET["key"]) ? $_GET["key"] : NULL;
	if($key != NULL){
		include_once("../../dao/DAOBanco.class.php");
		include_once("../../beans/Banco.class.php");
		$dao = new DAOBanco(NULL, NULL, "../../");
		$banco = new Banco(NULL, NULL);
		$banco = $dao->getBanco($key);
		echo('<div id="A">'.$banco->getCodigo().'</div>');
		echo('<div id="B">'.utf8_encode($banco->getDescricao()).'</div>');
	}else{
		echo("ERRO!");
	}
?>