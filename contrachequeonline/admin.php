<?php
	//senha: fmssuperadmin
	// INSERT INTO administradores (usuario, senha) VALUES ('admin', 'ff744c5f4cdf0d3c6dd01178bc595418');
	
	session_start();
	isset($_SESSION["usuario"]) ? session_destroy() : NULL;
	isset($_SESSION["senha"]) ? NULL : session_start();
	
	$messageVs = "hidden";
	if(isset($_GET["login"])){
		$message = "Acesso negado, insira corretamente suas informações.";
		$messageVs = "visible";
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="shortcut icon" href="images/fms.ico">
<title>FMS - Contracheque On-line</title>
<style type="text/css">
<!--
	@import url("css/general.css");
-->
</style>
<script language="javascript" src="javascript/functions.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript">
	window.onload = function(){
		diff = ((screen.width - 800)/2);
		document.getElementById("userFrame").style.left = diff+"px";
	}
</script>
</head>

<body>
<div id="userFrame">
<div id="divBox">
			<table width="798" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="74"><img src="images/box_l.png" /></td>
    <td width="531" background="images/box_c.png">
	<div>
				<form id="login" name="login" method="post" action="actions/Login.class.php">
				  
				  <div align="center" class="wordsLabel2">ADMINISTRADOR - Contracheque On-line				  </div>
				  <br />
				  <table width="100%" border="0">
					<tr>
					  <td width="25%" class="words2"><div align="right">Nome de usu&aacute;rio :</div></td>
					  <td width="75%"><input name="tfUserName" autocomplete="off" type="text" id="tfUserName" size="25" maxlength="50" /></td>
				    </tr>
					<tr>
					  <td class="words2"><div align="right">Senha:</div></td>
					  <td><input name="tfPassword" type="password" id="tfPassword" size="25" maxlength="25" /></td>
				    </tr>
					<tr>
					  <td class="words2">&nbsp;</td>
					  <td><div align="left"><br />
				        <input name="connect" type="submit" id="connect" value="Conectar" />
					    </div></td></tr>
				  </table>
			  </form>
      </div></td>
    <td width="193"><img src="images/box_r.png" /></td>
  </tr>
</table>
</div>
<div id="divFMSLogo" align="center"><img src="images/fms_logo.png" alt="Funda&ccedil;&atilde;o Municipal de Saude - FMS" width="274" height="73" /></div>
<div id="divBrasao" align="center"><img src="images/brasao_2.png" width="77" height="106" /></div>
<div id="divBoxMessage" style="visibility:<?php echo($messageVs); ?>">
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="21"><img src="images/box2_l.png" width="21" height="50" /></td>
      <td width="399" align="left" valign="top" background="images/box2_c.png">
      <p class="alert"><b><?php echo($message); ?></b></p></td>
      <td width="53"><img src="images/box2_r.png" width="36" height="50" /></td>
    </tr>
  </table>
</div>
<div id="divLabel" class="wordsLabel">
  <p align="center">Funda&ccedil;&atilde;o Municipal de Saude - FMS</p>
  <p align="center">zerokolSoft - www.zerokol.com<br />
    aj.alves@live.com<br />
    Teresina -PI<br />
  &quot;Nenhum sistema &eacute; melhor do que as pessoas que v&atilde;o oper&aacute;-lo&quot; - Autor Desconhecido</p>
</div>
</div>

</body>
</html>
