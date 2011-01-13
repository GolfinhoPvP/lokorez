<?php
	include_once("ConectarMySQL.class.php");
	
	$conexao = new ConectarMySQL();
	
	$resultado = $conexao->selecionar("SELECT * FROM empresas");
	if($resultado == false){
		echo("Não foi possivel realizar a busca!");
	}
	
	echo('<option value="---">-----------------------------</option>');
	while($linha = mysql_fetch_array($resultado)){
		echo('<option value="'.$linha["emp_codigo"].'">'.utf8_encode($linha["emp_descricao"]).'</option>');
	}
?>