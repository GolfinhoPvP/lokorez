<?php
	session_start();
	$nivelAcesso = "../../:4";
	include_once("../../utils/controladorAcesso.php");
	include_once("../../utils/ConectarMySQL.class.php");
	$conexao = new ConectarMySQL();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
No banco: 
<?php
	echo($_SESSION["banco_nome"]);
	$sql = "SELECT par_periodo FROM parametros ORDER BY par_data_corte DESC";
	$resultadoLinha = $conexao->selecionar($sql);
	while($linha = mysqli_fetch_array($resultadoLinha)){
		$sql = "SELECT count(distinct p.ave_numero_externo ) FROM parcelas p INNER JOIN averbacoes a ON a.ave_numero_externo = p.ave_numero_externo WHERE a.ban_codigo = '".$_SESSION["banco"]."' AND p.par_periodo_parcela='".$linha["par_periodo"]."'";
		$resultado = $conexao->selecionar($sql);
		$valor = mysqli_fetch_array($resultado);
		$quantContratos = strlen($valor[0]) != 0? $valor[0] : 0;
		
		$sql = "SELECT count(distinct p.ave_numero_externo ) FROM parcelas p INNER JOIN averbacoes a ON a.ave_numero_externo = p.ave_numero_externo WHERE a.ban_codigo = '".$_SESSION["banco"]."' AND p.sta_codigo = 4 AND p.par_periodo_parcela='".$linha["par_periodo"]."'";
		$resultado = $conexao->selecionar($sql);
		$valor = mysqli_fetch_array($resultado);
		$quantFinalizados = strlen($valor[0]) != 0? $valor[0] : 0;
		
		$quantNaoFinalizada = $quantContratos - $quantFinalizados;
		
		$sql = "SELECT FORMAT(sum(par.par_valor), 2) FROM averbacoes ave INNER JOIN parcelas par ON ave.ave_numero_externo = par.ave_numero_externo WHERE ave.ban_codigo = '".$_SESSION["banco"]."' AND par_periodo='".$linha["par_periodo"]."'";
		$resultado = $conexao->selecionar($sql);
		$valor = mysqli_fetch_array($resultado);
		$valorTotal = strlen($valor[0]) != 0? $valor[0] : 0;
		$valorTotal = str_replace(",","",$valorTotal);
		
		$sql = "SELECT FORMAT(sum(par.par_valor), 2)  FROM averbacoes ave INNER JOIN parcelas par ON ave.ave_numero_externo = par.ave_numero_externo WHERE ave.ban_codigo = '".$_SESSION["banco"]."' AND par.sta_codigo = 4 AND par_periodo='".$linha["par_periodo"]."'";
		$resultado = $conexao->selecionar($sql);
		$valor = mysqli_fetch_array($resultado);
		$valorPago = strlen($valor[0]) != 0? $valor[0] : 0.00;
		$valorFaltaPagar = $valorTotal - $valorPago;
		include("../modeloSintetico.php");
	}
?>
<br />
Voltar <img src="../../imagens/voltar.gif" width="40" height="35" onclick="javascript: history.back(-1);" style="cursor:pointer"/>
</body>
</html>
