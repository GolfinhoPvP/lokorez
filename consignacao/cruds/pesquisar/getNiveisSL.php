<?php
	session_start();
	include_once("../../utils/ConectarMySQL.class.php");
	
	$conexao = new ConectarMySQL();
	
	switch($_SESSION["nivel"]){
		case 1 : $sql = "WHERE niv_codigo LIKE '%'"; break;
		case 2 : $sql = "WHERE niv_codigo = 2"; break;
		case 3 : $sql = "WHERE niv_codigo = 3 OR _codigo = 4"; break;
		case 4 : $sql = "WHERE niv_codigo = 4"; break;
		default : echo("Acesso negado!"); break;
	}
	$resultado = $conexao->selecionar("SELECT * FROM niveis ".$sql." ORDER BY niv_codigo");
	if($resultado == false){
		die("Não foi possivel realizar a busca!");
	}
	
	echo('<option value="---">-----------------------------</option>');
	while($linha = mysqli_fetch_array($resultado)){
		echo('<option value="'.$linha["niv_codigo"].'">'.utf8_encode($linha["niv_descricao"]).'</option>');
	}
?>