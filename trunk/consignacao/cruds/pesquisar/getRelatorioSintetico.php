<?php
	session_start();
	include_once("../../utils/ConectarMySQL.class.php");
	$conexao = new ConectarMySQL();
	
	$sql = "SELECT count(distinct ave_numero_externo ) FROM averbacoes WHERE ban_codigo = '".$_SESSION["banco"]."'";
	$resultado = $conexao->selecionar($sql);
	$valor = mysqli_fetch_array($resultado);
	$quantContratos = strlen($valor[0]) != 0? $valor[0] : 0;
	
	$sql = "SELECT count(distinct ave_numero_externo ) FROM averbacoes WHERE ban_codigo = '".$_SESSION["banco"]."' AND sta_codigo = 3";
	$resultado = $conexao->selecionar($sql);
	$valor = mysqli_fetch_array($resultado);
	$quantFinalizados = strlen($valor[0]) != 0? $valor[0] : 0;
	
	$quantNaoFinalizada = $quantContratos - $quantFinalizados;
	
	$sql = "SELECT FORMAT(sum(par.par_valor), 2)  FROM averbacoes ave INNER JOIN parcelas par ON ave.ave_numero_externo = par.ave_numero_externo WHERE ave.ban_codigo = '".$_SESSION["banco"]."'";
	$resultado = $conexao->selecionar($sql);
	$valor = mysqli_fetch_array($resultado);
	$valorTotal = strlen($valor[0]) != 0? $valor[0] : 0;
	
	$sql = "SELECT FORMAT(sum(par.par_valor), 2)  FROM averbacoes ave INNER JOIN parcelas par ON ave.ave_numero_externo = par.ave_numero_externo WHERE ave.ban_codigo = '".$_SESSION["banco"]."' AND par.sta_codigo = 4";
	$resultado = $conexao->selecionar($sql);
	$valor = mysqli_fetch_array($resultado);
	$valorPago = strlen($valor[0]) != 0? $valor[0] : 0;
	
	$valorFaltaPagar = $valorTotal - $valorPago;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
No banco: <?php echo($_SESSION["banco_nome"]); ?>
<table width="100%" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td width="15%">Quant. de contratos </td>
    <td width="16%">Qaunt. contratos finalizados </td>
    <td width="16%">Qaunt. contratos pendentes </td>
    <td width="13%">Valor total averbado </td>
    <td width="12%">Valor j&aacute; pago </td>
    <td width="18%">Valor que falta pagar </td>
  </tr>
  <tr>
    <td><div align="center"><?php echo($quantContratos); ?></div></td>
    <td><div align="center"><?php echo($quantFinalizados); ?></div></td>
    <td><div align="center"><?php echo($quantNaoFinalizada); ?></div></td>
    <td><div align="center">R$ <?php echo($valorTotal); ?></div></td>
    <td><div align="center">R$ <?php echo($valorPago); ?></div></td>
    <td><div align="center">R$ <?php echo($valorFaltaPagar); ?></div></td>
  </tr>
</table>
<br />
Voltar <img src="../../imagens/voltar.gif" width="40" height="35" onclick="javascript: history.back(-1);" style="cursor:pointer"/>
</body>
</html>
