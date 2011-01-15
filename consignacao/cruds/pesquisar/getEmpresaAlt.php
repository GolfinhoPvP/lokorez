<?php
	$key = isset($_GET["key"]) ? $_GET["key"] : NULL;
	if($key != NULL){
		include_once("../../dao/DAOEmpresa.class.php");
		include_once("../../beans/Empresa.class.php");
		$dao = new DAOEmpresa(NULL, "../../");
		$empresa = new Empresa(NULL, NULL);
		$empresa = $dao->getEmpresa($key);
		echo('<div id="A">'.utf8_encode($empresa->getDescricao()).'</div>');
	}else{
		echo("ERRO!");
	}
?>