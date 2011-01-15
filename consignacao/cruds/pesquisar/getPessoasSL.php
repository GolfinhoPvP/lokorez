<?php
	include_once("../../utils/ConectarMySQL.class.php");
	
	$conexao = new ConectarMySQL();
	
	$resultado = $conexao->selecionar("SELECT * FROM pessoas");
	if($resultado == false){
		die("Não foi possivel realizar a busca!");
	}
	
	echo('<option value="---">-----------------------------</option>');
	while($linha = mysql_fetch_array($resultado)){
		echo('<option value="'.$linha["pes_codigo"].'">'.utf8_encode($linha["pes_nome"]).'</option>');
	}
?>