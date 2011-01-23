<?php
	include_once("../../utils/ConectarMySQL.class.php");
	session_start();
	$nivelAcesso = "../../:2:3:4";
	include_once("../../utils/controladorAcesso.php");
	
	$conexao = new ConectarMySQL();
	
	$resultado = $conexao->selecionar("SELECT * FROM empresas ORDER BY emp_descricao");
	if($resultado == false){
		echo("Não foi possivel realizar a busca!");
	}
	
	echo('<option value="---">-----------------------------</option>');
	while($linha = mysqli_fetch_array($resultado)){
		echo('<option value="'.$linha["emp_codigo"].'">'.utf8_encode($linha["emp_descricao"]).'</option>');
	}
	$conexao->commit();
?>