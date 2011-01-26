<table class="texto2" width="676" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3">C&oacute;digo contrato:<br />
    <?php echo($linha["ave_numero_externo"]); ?></td>
  </tr>
  <tr>
    <td colspan="3">Nome: <?php echo($linha["pes_nome"]); ?></td>
  </tr>
  <tr>
    <td width="32%">Matr&iacute;cula: <?php echo($linha["ser_matricula"]); ?></td>
    <td colspan="2">Empresa: <?php echo($linha["emp_descricao"]); ?></td>
  </tr>
  <tr>
    <td>Quant. parcelas: <?php echo($linha["ave_numero_parcelas"]); ?><br />
      Valor parcela: <?php echo($linha["par_valor"]); ?></td>
    <td width="30%">Taxa de juros: <?php echo($linha["ave_taxa_juros"]); ?>%</td>
    <td width="38%">Montante <?php echo($linha["ave_montante"]); ?></td>
  </tr>
</table>
<br/>
