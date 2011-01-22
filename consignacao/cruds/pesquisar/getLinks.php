<?php
	include_once("../../utils/ConectarMySQL.class.php");
	
	$conexao = new ConectarMySQL();
	
	$resultado = $conexao->selecionar("SELECT * FROM parametros WHERE sta_codigo = 3 ORDER BY par_data_corte DESC");
	if($resultado == false){
		die("Não foi possivel realizar a busca!");
	}
	
	echo('<option value="---">-----------------------------</option>');
	while($linha = mysqli_fetch_array($resultado)){
		echo('<div><a href="../../'.$linha["par_link"].'">Arquivo .DBF do periodo '.$linha["par_periodo"].'</a></div>');
	}
	$conexao->commit();
?>