<?php
	include_once("../../utils/ConectarMySQL.class.php");
	
	$conexao = new ConectarMySQL();
	
	$classe = isset($_GET["classe"]) ? $_GET["classe"] : "%";
	
	$resultado = $conexao->selecionar("SELECT * FROM pessoas WHERE pes_classe LIKE '".$classe."' ORDER BY pes_nome");
	if($resultado == false){
		die("Não foi possivel realizar a busca!");
	}
	
	echo('<option value="---">-----------------------------</option>');
	while($linha = mysqli_fetch_array($resultado)){
		echo('<option value="'.$linha["pes_codigo"].'">'.utf8_encode($linha["pes_nome"]).'</option>');
	}
?>