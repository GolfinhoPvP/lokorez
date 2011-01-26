<?php
	session_start();
	include_once("../utils/funcoes.php");
	$periodo = antiSQLisset(isset($_GET["per"]) ? $_GET["per"] : NULL);
	$nome = "Relatório Analítico geral por periodo ".$_SESSION["banco_nome"];
	$nome = str_replace(" ","_",$nome);
	header("Content-type: application/vnd.ms-excel");
	header("Content-type: application/force-download");
	header("Content-Disposition: attachment; filename=".$nome.".xls");
	header("Pragma: no-cache");
	include_once("../utils/ConectarMySQL.class.php");
	$conexao = new ConectarMySQL();
	$sql = "SELECT pes.pes_nome, pes.pes_cpf, ser.ser_matricula, emp.emp_descricao, ave.ave_numero_externo, ave.ave_data_criacao, ave.ave_numero_parcelas, ave.ave_montante, ave.ave_taxa_juros, par.par_numero_parcela, par.par_periodo_parcela, par.par_valor, sta.sta_descricao FROM averbacoes ave INNER JOIN servidores ser ON ave.pes_codigo=ser.pes_codigo INNER JOIN pessoas pes ON ave.pes_codigo=pes.pes_codigo INNER JOIN empresas emp ON ave.emp_codigo=emp.emp_codigo INNER JOIN parcelas par ON ave.ave_numero_externo=par.ave_numero_externo INNER JOIN status sta ON par.sta_codigo=sta.sta_codigo WHERE ave.ban_codigo='".$_SESSION["banco"]."' AND par.par_periodo_parcela='".$periodo."' ORDER BY pes.pes_nome, par.par_numero_parcela";
	$resultadoLinha = $conexao->selecionar($sql);
	if($resultadoLinha == false){
		echo($sql);
		die();
	}
	echo('
<table border="1">');
	while($linha = mysqli_fetch_array($resultadoLinha)){
		echo("
		<tr>
			<td>".$linha["pes_nome"]."</td>
			<td>".$linha["pes_cpf"]."</td>
			<td>".$linha["ser_matricula"]."</td>
			<td>".$linha["emp_descricao"]."</td>
			<td>".$linha["ave_numero_externo"]."</td>
			<td>".$linha["ave_data_criacao"]."</td>
			<td>".$linha["ave_numero_parcelas"]."</td>
			<td>".$linha["ave_montante"]."</td>
			<td>".$linha["ave_taxa_juros"]."</td>
			<td>".$linha["par_numero_parcela"]."</td>
			<td>".$linha["par_periodo_parcela"]."</td>
			<td>".$linha["par_valor"]."</td>
			<td>".$linha["sta_descricao"]."</td>
		</tr>");
	}
echo("
</table>
	");
?>