<?php
	include_once("../../utils/ConectarMySQL.class.php");
	
	$conexao = new ConectarMySQL();
	
	$resultado = $conexao->selecionar("SELECT * FROM bancos ORDER BY ban_descricao");
	if($resultado == false){
		die("Não foi possivel realizar a busca!");
	}
	
	echo('<option value="---">-----------------------------</option>');
	while($linha = mysqli_fetch_array($resultado)){
		if($linha["ban_codigo"] == "000")
			continue;
		echo('<option value="'.$linha["ban_codigo"].'">'.utf8_encode($linha["ban_descricao"]).'</option>');
	}
?>