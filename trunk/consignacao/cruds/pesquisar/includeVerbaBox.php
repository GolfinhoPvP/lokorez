<?php
	session_start();
	$nivelAcesso = "../../:2:3:4";
	include_once("../../utils/controladorAcesso.php");
?>
<table width="432" border="0" cellpadding="0" cellspacing="0" class="texto2">
  <tr>
	<td width="54" style="background-repeat:repeat-x"><span style="background-position:top; background-repeat:no-repeat"><img src="../../imagens/box2_c_1.png" width="53" height="22" /></span></td>
	<td width="657" height="19" background="../../imagens/box2_b_1.png" style="background-repeat:repeat-x">&nbsp;</td>
	<td width="25"><img src="../../imagens/box2_c_2.png" width="25" height="22" /></td>
  </tr>
  <tr>
	<td background="../../imagens/box2_b_4.png" style="background-repeat:repeat-y">&nbsp;</td>
	<td height="19" >Verba: <?php echo($verba->getVerba()); ?>, Descri&ccedil;&atilde;o: <?php echo($verba->getDescricao()); ?>
	<div>
		<?php
			$sql = "SELECT e.emp_descricao, b.ban_descricao, p.pro_descricao FROM verbas v INNER JOIN empresas e ON v.emp_codigo=e.emp_codigo INNER JOIN bancos b ON v.ban_codigo=b.ban_codigo INNER JOIN produtos p ON v.pro_codigo=p.pro_codigo WHERE v.ver_verba = ".$verba->getVerba();
			$resultado = $conexao->selecionar($sql);
			$linha = mysqli_fetch_array($resultado);
			echo("Empresa: ".$linha["emp_descricao"]."<br/>Banco: ".$linha["ban_descricao"]."<br/>Produto: ".$linha["pro_descricao"]);
		?>
	</div></td>
	<td background="../../imagens/box2_b_2.png" style="background-repeat:repeat-y">&nbsp;</td>
  </tr>
  <tr>
	<td rowspan="3" style="background-position:bottom; background-repeat:repeat-x;"><img src="../../imagens/box2_c_4.png" width="53" height="22" /></td>
	<td rowspan="3" background="../../imagens/box2_b_3.png" style="background-position:bottom; background-repeat:repeat-x;">&nbsp;</td>
	<td rowspan="3"><img src="../../imagens/box2_c_3.png" width="25" height="22" /></td>
  </tr>
  <tr>
  </tr>
</table>