<?php
	$key = isset($_GET["key"]) ? $_GET["key"] : NULL;
	if($key != NULL){
		include_once("../dao/DAOEmpresa.class.php");
		$dao = new DAOEmpresa(NULL, "../");
		$linha = mysql_fetch_array($dao->pesquisar($key));
		echo('<div id="A">'.$linha["emp_descricao"].'</div>');
	}else{
		echo("ERRO!");
	}
?>