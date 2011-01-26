<?php
	session_start();
	$nivelAcesso = "../../:4";
	include_once("../../utils/controladorAcesso.php");
	$periodo = isset($_POST["slPer"]) ? $_POST["slPer"] : NULL;
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
No banco: <?php echo($_SESSION["banco_nome"]); ?> <br />
<br />
<table width="623" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="309" height="80" valign="top"><div align="center"><span class="texto2">Relat&oacute;rio anal&iacute;tico geral por periodo em .xls<br />
        </span> <img src="../../imagens/xls.png" width="50" height="51" onclick="javascript: window.location = '../relatorioGeralXLS.php?per=<?php echo($periodo); ?>';" style="cursor:pointer"/> <br />
        Periodo: <?php echo($periodo); ?></div></td>
        <td width="314" valign="top"><div align="center"><span class="texto2">Veja o esquema desse arquivo em PDF aqui<br />
        </span><img src="../../imagens/pdf.png" width="50" height="77" onclick="javascript: window.location = '../../downloads/esquema-arquivo-xls.pdf';" style="cursor:pointer"/> </div></td>
      </tr>
</table>
<br />
Voltar <img src="../../imagens/voltar.png" width="40" height="30" onclick="javascript: history.back(-1);" style="cursor:pointer"/>
<br />
<?php
	$sql = "SELECT pes.pes_nome, pes.pes_cpf, emp.emp_descricao, ave.ave_numero_externo FROM averbacoes ave INNER JOIN pessoas pes ON ave.pes_codigo = pes.pes_codigo INNER JOIN empresas emp ON ave.emp_codigo = emp.emp_codigo WHERE ave.ban_codigo = '".$_SESSION["banco"]."' AND ave.par_periodo='".$periodo."' ORDER BY pes.pes_nome";
	$resultadoLinha = $conexao->selecionar($sql);
	while($linha = mysqli_fetch_array($resultadoLinha)){
		$sql = "SELECT count(*) FROM parcelas par WHERE par.ave_numero_externo='".$linha["ave_numero_externo"]."' AND par.par_periodo_parcela='".$periodo."'";
		$resultado = $conexao->selecionar($sql);
		$valor = mysqli_fetch_array($resultado);
		$quantParcelas = strlen($valor[0]) != 0? $valor[0] : 0;
		
		$sql = "SELECT count(*) FROM parcelas par WHERE par.ave_numero_externo='".$linha["ave_numero_externo"]."' AND par.par_periodo_parcela='".$periodo."' AND par.sta_codigo=4";
		$resultado = $conexao->selecionar($sql);
		$valor = mysqli_fetch_array($resultado);
		$quantParcelasPagas = strlen($valor[0]) != 0? $valor[0] : 0;
		
		$quantParcelasFaltando = $quantParcelas - $quantParcelasPagas;
		
		$sql = "SELECT FORMAT(sum(par.par_valor),2) FROM parcelas par WHERE par.ave_numero_externo='".$linha["ave_numero_externo"]."' AND par.par_periodo_parcela='".$periodo."'";
		$resultado = $conexao->selecionar($sql);
		$valor = mysqli_fetch_array($resultado);
		$valorTotal = strlen($valor[0]) != 0? $valor[0] : 0;
		$valorTotal = str_replace(",","",$valorTotal);
		
		$sql = "SELECT FORMAT(sum(par.par_valor),2) FROM parcelas par WHERE par.ave_numero_externo='".$linha["ave_numero_externo"]."' AND par.sta_codigo=4 AND par.par_periodo_parcela='".$periodo."'";
		$resultado = $conexao->selecionar($sql);
		$valor = mysqli_fetch_array($resultado);
		$valorPago = strlen($valor[0]) != 0? $valor[0] : 0.00;
		
		$valorFaltaPagar = $valorTotal - $valorPago;
		
		include("../modeloAnalitico.php");
	}	
?>
<br />
Voltar <img src="../../imagens/voltar.png" width="40" height="30" onclick="javascript: history.back(-1);" style="cursor:pointer"/>
</body>
</html>
