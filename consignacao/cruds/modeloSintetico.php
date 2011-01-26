<table class="texto2" width="100%" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td width="12%"><div align="center">Periodo</div></td>
    <td width="15%"><div align="center">Quant. de contratos </div></td>
    <td width="16%"><div align="center">Contratos descontados </div></td>
    <td width="15%"><div align="center">Contratos n&atilde;o descontados </div></td>
    <td width="12%"><div align="center">Valor total </div></td>
    <td width="11%"><div align="center">Valor descontado </div></td>
    <td width="19%"><div align="center">Valor n&atilde;o descontado </div></td>
  </tr>
  <tr>
    <td><div align="center">
    <div align="center"><?php echo($linha["par_periodo"]); ?></div></td>
    <td><div align="center"><?php echo($quantContratos); ?></div></td>
    <td><div align="center"><?php echo($quantFinalizados); ?></div></td>
    <td><div align="center"><?php echo($quantNaoFinalizada); ?></div></td>
    <td><div align="center">R$ <?php echo(number_format($valorTotal, 2)); ?></div></td>
    <td><div align="center">R$ <?php echo(number_format($valorPago, 2)); ?></div></td>
    <td><div align="center">R$ <?php echo(number_format($valorFaltaPagar, 2)); ?></div></td>
  </tr>
</table>
<br/>
