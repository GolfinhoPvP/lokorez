<?php
	session_start();
	include_once("../utils/ConectarMySQL.class.php");
	include_once("../utils/funcoes.php");
	$conexao = new ConectarMySQL();
	$sql = "SELECT distinct pes.pes_nome, pes.pes_cpf, ser.ser_matricula, ser.ser_cargo, ser.ser_vinculo, emp.emp_descricao, ave.ave_data_criacao, ave.ave_numero_parcelas, ave.ave_taxa_juros, ave.ave_montante, par.par_valor, ave.par_periodo FROM averbacoes ave INNER JOIN servidores ser ON ave.pes_codigo = ser.pes_codigo INNER JOIN empresas emp ON ser.emp_codigo = emp.emp_codigo INNER JOIN pessoas pes ON ser.pes_codigo = pes.pes_codigo INNER JOIN parcelas par ON ave.ave_numero_externo = par.ave_numero_externo WHERE ave.ave_numero_externo = '".$_SESSION["numeroExt"]."'";
	$resultado = $conexao->selecionar($sql);
	$linha = mysqli_fetch_array($resultado);
	$conexao->commit();
	$periodoFinal = $linha["par_periodo"];
	for($x=1; $x<intval($linha["ave_numero_parcelas"]); $x++){
		$periodoFinal = avancarPeriodo($periodoFinal);
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Comprovante da averba&ccedil;&atilde;o <?php echo($_SESSION["numeroExt"]); ?></title>
<style type="text/css">
			<!--
			@import url("../scripts/css/geral.css");
			#imprimir{
				position:absolute;
				left: 508px;
				top: 8px;
				width: 112px;
			}
			#tabela{
				position:absolute;
				left: 16px;
				top: 4px;
			}
			#logo{
				position:absolute;
				left: 19px;
				top: 9px;
				width: 96px;
			}
			#logoText{
				position:absolute;
				left: 118px;
				top: 10px;
				width: 406px;
			}
			-->
		</style>
</head>

<body>
<table id="tabela" width="588" height="301" border="1" cellpadding="0" cellspacing="0">
      <tr>
        <td height="84" colspan="3"><div id="logo" align="center" class="texto2"><img src="../imagens/prefeitura_timon_logo.png" /></div>
		<div id="logoText" align="center" class="texto2">Estado do Maranh&atilde;o<br />
		  Prefeitura Municipal de Timon<br />
		  <br />
		Documento de averba&ccedil;&atilde;o de consigna&ccedil;&atilde;o em folha </div></td>
      </tr>
      <tr>
        <td height="21" colspan="2" class="texto2">Nome: <?php echo($linha["pes_nome"]); ?></td>
        <td width="158" class="texto2">CPF: <?php echo($linha["pes_cpf"]); ?></td>
      </tr>
      <tr>
        <td height="21" colspan="3" class="texto2">C&oacute;digo do contrato:<br />
        <?php echo($_SESSION["numeroExt"]); ?></td>
      </tr>
      <tr>
        <td width="309" height="21" class="texto2">Empresa: <?php echo($linha["emp_descricao"]); ?></td>
        <td colspan="2" class="texto2">Matr&iacute;cula: <?php echo($linha["ser_matricula"]); ?></td>
      </tr>
      <tr>
        <td height="21" class="texto2">Cargo: <?php echo($linha["ser_cargo"]); ?></td>
        <td colspan="2" class="texto2">V&iacute;nculo: <?php echo($linha["ser_vinculo"]); ?></td>
      </tr>
      <tr>
        <td height="21" class="texto2">Data: <?php echo($linha["ave_data_criacao"]); ?></td>
        <td colspan="2" class="texto2">Taxa de Juros: <?php echo($linha["ave_taxa_juros"]); ?>%</td>
      </tr>
      <tr>
        <td height="21" class="texto2">Qauntidade de parcelas: <?php echo($linha["ave_numero_parcelas"]); ?></td>
        <td colspan="2" class="texto2">Valor da parcela: R$ <?php echo($linha["par_valor"]); ?></td>
      </tr>
      <tr>
        <td height="21" class="texto2">Periodo inicial: <?php echo($linha["par_periodo"]); ?></td>
        <td colspan="2" class="texto2">Periodo final: <?php echo($periodoFinal); ?></td>
      </tr>
      <tr>
        <td height="53" colspan="3" class="texto2"><div align="center">Montante: R$ <?php echo($linha["ave_montante"]); ?></div></td>
      </tr>
    </table>
	<div class="texto1" id="imprimir">Imprimir
<img src="../imagens/impressora.png" width="35" height="37" style="cursor:pointer" onclick="javascript: window.print();"/></div>
	</body>
</html>
