<?php
	$key = isset($_GET["key"]) ? $_GET["key"] : NULL;
	if($key != NULL){
		include_once("../dao/DAOBanco.class.php");
		$dao = new DAOBanco(NULL, NULL, NULL, NULL, "../");
		$linha = mysql_fetch_array($dao->pesquisar($key));
		echo('<div id="A">'.$linha["ban_codigo"].'</div>');
		echo('<div id="B">'.$linha["ban_descricao"].'</div>');
		echo('<div id="C">'.$linha["ban_contato"].'</div>');
		echo('<div id="D">'.$linha["ban_fone"].'</div>');
	}else{
		echo("ERRO!");
	}
?>