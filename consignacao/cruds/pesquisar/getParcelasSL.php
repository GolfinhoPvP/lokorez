<?php
	include_once("../../utils/ConectarMySQL.class.php");
	
	$key = isset($_GET["key"]) ? $_GET["key"] : NULL;
	
	$conexao = new ConectarMySQL();
	
	$resultado = $conexao->selecionar("SELECT * FROM verbas v INNER JOIN produtos p ON v.pro_codigo = p.pro_codigo WHERE v.ver_verba='".$key."'");
	
	if($resultado == false){
		die("Não foi possivel realizar a busca!");
	}
	
	echo('<option value="---">---</option>');
	$linha = mysqli_fetch_array($resultado);
	for($x=1; $x<=$linha["pro_prazo_maximo"]; $x++){
		echo('<option value="'.$x.'">'.$x.'</option>');
	}
?>