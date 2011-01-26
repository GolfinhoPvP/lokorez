<?php
	include_once("../../utils/ConectarMySQL.class.php");
	
	$conexao = new ConectarMySQL();
	$data = date("Y-m-d");
	$dataMenor = $data." 00:00:00";
	$dataMaior = $data."24:59:59";
	
	$resultado = $conexao->selecionar("SELECT ave_numero_externo FROM averbacoes WHERE ave_data_criacao > '".$dataMenor."' AND ave_data_criacao < '".$dataMaior."'");
	echo($sql);
	if($resultado == false){
		die("Não foi possivel realizar a busca!");
	}
	
	echo('<option value="---">-------------------------------------------------------</option>');
	while($linha = mysqli_fetch_array($resultado)){
		echo('<option value="'.$linha["ave_numero_externo"].'">'.$linha["ave_numero_externo"].'</option>');
	}
?>