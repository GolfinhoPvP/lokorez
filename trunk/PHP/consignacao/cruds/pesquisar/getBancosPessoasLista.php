<?php
	include_once("../../utils/ConectarMySQL.class.php");
	session_start();
	$nivelAcesso = "../../:2:3:4";
	include_once("../../utils/controladorAcesso.php");
	
	$conexao = new ConectarMySQL();
	include_once("../../utils/funcoes.php");
	$ordem = antiSQL(isset($_GET["ordem"]) ? $_GET["ordem"] : "%");
	$key = antiSQL(isset($_GET["key"]) ? $_GET["key"] : "%");
	
	if($ordem == "contato"){
		$resultado = $conexao->selecionar("SELECT * FROM bancos_pessoas WHERE pes_codigo LIKE '".$key."'");
	}else if($ordem == "admin"){
		$resultado = $conexao->selecionar("SELECT * FROM bancos_pessoas WHERE ban_codigo LIKE '".$key."'");
	}else{
		$resultado = $conexao->selecionar("SELECT * FROM bancos_pessoas");
	}
		
	if($resultado == false){
		die("Não foi possivel realizar a busca!");
	}
	
	$contador = 1;
	while($linha = mysqli_fetch_array($resultado)){
		echo('<div id="BP'.$contador.'"><div id="cB'.$contador.'">'.$linha["ban_codigo"].'</div><div id="cP'.$contador.'">'.$linha["pes_codigo"].'</div></div>');
		$contador++;
	}
	$contador--;
	echo('<div id="BPQuantidade">'.$contador.'</div>');
	$conexao->commit();
?>