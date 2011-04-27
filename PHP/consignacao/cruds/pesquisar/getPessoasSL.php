<?php
	include_once("../../utils/ConectarMySQL.class.php");
	
	$conexao = new ConectarMySQL();
	include_once("../../utils/funcoes.php");
	$classe = antiSQL(isset($_GET["classe"]) ? $_GET["classe"] : "%");
	
	switch($classe){
		case "B" : case "contato" :
			$sql = "SELECT distinct p.pes_codigo, p.pes_nome FROM pessoas p INNER JOIN bancos_pessoas bp ON p.pes_codigo = bp.pes_codigo ORDER BY pes_nome";
			break;
		case "A" : case "admin" :
			$sql = "SELECT * FROM pessoas p INNER JOIN administradores a ON p.pes_codigo = a.pes_codigo ORDER BY pes_nome";
			break;
		default : 
			$sql = "SELECT * FROM pessoas ORDER BY pes_nome";
			break;
	}
	
	$resultado = $conexao->selecionar($sql);
	if($resultado == false){
		die("Não foi possivel realizar a busca!");
	}
	
	echo('<option value="---">-----------------------------</option>');
	while($linha = mysqli_fetch_array($resultado)){
		echo('<option value="'.$linha["pes_codigo"].'">'.utf8_encode($linha["pes_nome"]).'</option>');
	}
?>