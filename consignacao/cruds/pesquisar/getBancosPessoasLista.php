<?php
	include_once("../../utils/ConectarMySQL.class.php");
	
	$conexao = new ConectarMySQL();
	
	$ordem = isset($_GET["ordem"]) ? $_GET["ordem"] : "%";
	$key = isset($_GET["key"]) ? $_GET["key"] : "%";
	
	if($ordem == "P"){
		$resultado = $conexao->selecionar("SELECT * FROM bancos_pessoas WHERE pes_codigo LIKE '".$key."'");
	}else if($ordem == "B"){
		$resultado = $conexao->selecionar("SELECT * FROM bancos_pessoas WHERE ban_codigo LIKE '".$key."'");
	}else{
		$resultado = $conexao->selecionar("SELECT * FROM bancos_pessoas");
	}
		
	if($resultado == false){
		die("N�o foi possivel realizar a busca!");
	}
	
	$contador = 1;
	while($linha = mysqli_fetch_array($resultado)){
		echo('<div id="BP'.$contador.'"><div id="cB'.$contador.'">'.$linha["ban_codigo"].'</div><div id="cP'.$contador.'">'.$linha["pes_codigo"].'</div></div>');
		$contador++;
	}
	$contador--;
	echo('<div id="BPQuantidade">'.$contador.'</div>');
?>