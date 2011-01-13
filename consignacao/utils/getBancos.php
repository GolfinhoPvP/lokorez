<?php
	include_once("ConectarMySQL.class.php");
	
	$conexao = new ConectarMySQL();
	
	$resultado = $conexao->selecionar("SELECT ban_codigo, ban_descricao FROM bancos");
	if($resultado == false){
		echo("Não foi possivel realizar a busca!");
	}
	
	echo('<option value="---">-----------------------------</option>');
	while($linha = mysql_fetch_array($resultado)){
		echo('<option value="'.$linha["ban_codigo"].'">'.utf8_encode($linha["ban_descricao"]).'</option>');
	}
?>