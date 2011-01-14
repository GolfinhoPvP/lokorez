<?php
	$login = isset($_GET["login"]) ? $_GET["login"] : NULL;
	$mensagem = "";
	
	if($login == "erro"){
		$mensagem = "Nome de usu&aacute;rio ou senha incorreto!";
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">
	<!--
	@import url("scripts/css/index.css");
	-->
</style>
<script type="text/javascript" language="javascript" src="scripts/javascript/geral.js"></script>
<script type="text/javascript" language="javascript">
	window.onload = function(){
		centralizador("central", 375, 210);
		document.body.style.visibility = "visible";
	}
</script>
</head>

<body style="visibility:hidden">
<div id="central" align="center">  <span class="texto3">OnSysConsig - Sistema de Consigna&ccedil;&atilde;o On-line<br />
</span>
  <table width="361" height="140" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="15" height="19" background="imagens/box_c_1.png" style="background-repeat:no-repeat;  background-position:bottom">&nbsp;</td>
    <td colspan="8" background="imagens/box_b_2.png" style="background-repeat:repeat-x;  background-position:bottom">&nbsp;</td>
      <td width="14" height="19" background="imagens/box_c_2.png" style="background-repeat:no-repeat;  background-position:bottom">&nbsp;</td>
    </tr>
  <tr>
    <td height="101" background="imagens/box_b_1.png" style="background-repeat:repeat-y">&nbsp;</td>
      <td colspan="8" background="imagens/box_a.png"><form id="login" name="login" method="post" action="utils/logIn.php">
        <table width="100%" border="0" cellpadding="0" cellspacing="5">
          <tr>
            <td colspan="3" align="center"><span class="alerta1"><?php echo($mensagem); ?></span></td>
            </tr>
          <tr>
            <td width="44%"><div align="right" class="texto2">Nome de usu&aacute;rio: </div></td>
            <td colspan="2"><input name="tfNomeUsuario" type="text" class="tf1" id="tfNomeUsuario" size="25" maxlength="25" /></td>
            </tr>
          <tr>
            <td><div align="right" class="texto2">Senha:</div></td>
            <td colspan="2"><input name="tfSenha" type="password" class="tf1" id="tfSenha" size="25" maxlength="15" /></td>
            </tr>

          <tr>
            <td colspan="2" > </td>
            <td width="37%"><input name="btConectar" type="submit" class="bt1" id="btConectar" value="Conectar" /></td>
          </tr>
        </table>
      </form>      </td>
      <td background="imagens/box_b_3.png" style="background-repeat:repeat-y">&nbsp;</td>
    </tr>
  <tr>
    <td width="15" height="19"  background="imagens/box_c_4.png" style="background-repeat:no-repeat">&nbsp;</td>
      <td colspan="8" background="imagens/box_b_4.png" style="background-repeat:repeat-x">&nbsp;</td>
      <td width="14" height="19" background="imagens/box_c_3.png" style="background-repeat:no-repeat">&nbsp;</td>
    </tr>
  </table>
  <span class="texto1">zerokolSoft - www.zerokol.com<br />
aj.alves@live.com</span> </div>
</body>
</html>
