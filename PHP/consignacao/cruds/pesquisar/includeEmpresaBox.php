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
	<td height="19" >C&oacute;digo: <?php echo($empresa->getCodigo()); ?>, Nome: <?php echo($empresa->getDescricao()); ?></td>
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