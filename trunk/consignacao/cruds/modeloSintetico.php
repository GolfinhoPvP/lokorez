<table class="texto2" width="100%" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td width="15%">Periodo</td>
    <td width="15%">Quant. de contratos </td>
    <td width="16%">Qaunt. contratos finalizados </td>
    <td width="16%">Qaunt. contratos pendentes </td>
    <td width="13%">Valor total averbado </td>
    <td width="12%">Valor j&aacute; pago </td>
    <td width="18%">Valor que falta pagar </td>
  </tr>
  <tr>
    <td><div align="center"><?php echo($linha["par_periodo"]); ?></td>
    <td><div align="center"><?php echo($quantContratos); ?></div></td>
    <td><div align="center"><?php echo($quantFinalizados); ?></div></td>
    <td><div align="center"><?php echo($quantNaoFinalizada); ?></div></td>
    <td><div align="center">R$ <?php echo($valorTotal); ?></div></td>
    <td><div align="center">R$ <?php echo($valorPago); ?></div></td>
    <td><div align="center">R$ <?php echo($valorFaltaPagar); ?></div></td>
  </tr>
</table>
<br/>
