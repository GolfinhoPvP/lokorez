<?php
	switch($tipo){
		case "cad" : $mensagem = "Cadastro efetuado com sucesso!"; break;
		case "alt" : $mensagem = "Altera��o efetuada com sucesso!"; break;
		case "del" : $mensagem = "Exclus�o efetuada com sucesso!"; break;
		case "inc" : $mensagem = "Importa��o efetuada com sucesso!"; break;
		case "ave" : $mensagem = "Averba��o efetuada com sucesso!"; break;
		case "can" : $mensagem = "Averba��o cancelada com sucesso!"; break;
		case "liq" : $mensagem = "Averba��o liquidada com sucesso!"; break;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
	<!--
	@import url("../../scripts/css/geral.css");
	-->
</style>
</head>

<body>
<div align="center">
<br />
<table id="confirmar" width="50%" border="0" cellpadding="0" cellspacing="0" class="confirma1">
  <tr>
    <td width="43"><img src="<?php echo($toRoot); ?>imagens/box_conf_1.png" width="43" height="31" /></td>
    <td background="<?php echo($toRoot); ?>imagens/box_conf_2.png" style="background-repeat:repeat-x"><?php echo($mensagem); ?></td>
    <td width="15"><img src="<?php echo($toRoot); ?>imagens/box_conf_3.png" width="15" height="31" /></td>
  </tr>
</table>
<br />
</div>
</body>
</html>
