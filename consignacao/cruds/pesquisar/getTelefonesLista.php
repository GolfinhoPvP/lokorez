<?php
	include_once("../../utils/ConectarMySQL.class.php");
	$conexao = new ConectarMySQL();
	
	$key = isset($_GET["key"]) ? $_GET["key"] : "%";
	
	$resultado = $conexao->selecionar("SELECT * FROM telefones WHERE pes_codigo=".$key);
		
	if($resultado == false){
		die("Não foi possivel realizar a busca!");
	}
	
	$contador = 1;
	while($linha = mysqli_fetch_array($resultado)){
		echo('<div id="T'.$contador.'"><div id="tC'.$contador.'">'.$linha["tel_codigo"].'</div><div id="tPC'.$contador.'">'.$linha["pes_codigo"].'</div><div id="tN'.$contador.'">'.$linha["tel_numero"].'</div></div>');
		$contador++;
	}
	$contador--;
	echo('<div id="TQuantidade">'.$contador.'</div>');
?>