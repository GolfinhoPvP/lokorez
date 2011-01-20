<?php
	include_once("../../utils/ConectarMySQL.class.php");
	
	$key = isset($_GET["key"]) ? $_GET["key"] : NULL;
	
	if($key == "tudo"){
		$key = "%";
	}else{
		$key = 1;
	}
	
	$conexao = new ConectarMySQL();
	
	$resultado = $conexao->selecionar("SELECT * FROM parametros WHERE sta_codigo LIKE '".$key."'");
	
	if($resultado == false){
		die("Não foi possivel realizar a busca!");
	}
	
	echo('<option value="---">-------------------------------------------------------</option>');
	while($linha = mysqli_fetch_array($resultado)){
		echo('<option value="'.$linha["par_periodo"].'">'.$linha["par_periodo"].", Data de corte: ".substr($linha["par_data_corte"],8,2)."/".substr($linha["par_data_corte"],5,2)."/".substr($linha["par_data_corte"],0,4).'</option>');
	}
?>