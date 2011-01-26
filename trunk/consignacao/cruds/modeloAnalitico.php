<table class="texto2" width="729" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="68%">Nome: <?php echo($linha["pes_nome"]); ?></td>
        <td width="32%">CPF: <?php echo($linha["pes_cpf"]); ?></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>Empresa: <?php echo($linha["emp_descricao"]); ?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3">N&uacute;mero contrato: <?php echo($linha["ave_numero_externo"]); ?></td>
  </tr>
  <tr>
    <td width="32%">Qauntidades de parcelas </td>
    <td width="34%">Qauntidade de parcelas pagas </td>
    <td width="34%">Qauntidade de parcelas que faltam </td>
  </tr>
  <tr>
    <td><div align="center"><?php echo($quantParcelas); ?></div></td>
    <td><div align="center"><?php echo($quantParcelasPagas); ?></div></td>
    <td><div align="center"><?php echo($quantParcelasFaltando); ?></div></td>
  </tr>
  <tr>
    <td>Valor total</td>
    <td>Valor pago</td>
    <td>Valor que falta  </td>
  </tr>
  <tr>
    <td><div align="center">R$ <?php echo(number_format($valorTotal, 2)); ?></div></td>
    <td><div align="center">R$ <?php echo(number_format($valorPago, 2)); ?></div></td>
    <td><div align="center">R$ <?php echo(number_format($valorFaltaPagar, 2)); ?></div></td>
  </tr>
</table>
<br/>
