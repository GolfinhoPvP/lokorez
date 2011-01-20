<?php
	include_once("../../utils/ConectarMySQL.class.php");
	
	$conexao = new ConectarMySQL();
	
	$resultado = $conexao->selecionar("SELECT * FROM servidores s INNER JOIN pessoas p ON s.pes_codigo = p.pes_codigo ORDER BY p.pes_nome");
	
	if($resultado == false){
		die("Não foi possivel realizar a busca!");
	}
	
	echo('<option value="---">-----------------------------</option>');
	while($linha = mysqli_fetch_array($resultado)){
		echo('<option value="'.$linha["ser_matricula"].'">'.utf8_encode($linha["pes_nome"]).'</option>');
	}
?>