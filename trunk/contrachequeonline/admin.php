<?php

	// INSERT INTO administradores (usuario, senha) VALUES ('admin', 'ff744c5f4cdf0d3c6dd01178bc595418');
	
	session_start();
	$_SESSION["usuario"] 	= NULL;
	$_SESSION["senha"] 		= NULL;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>FMS - Contracheque On-line</title>
		<style type="text/css">
		<!--
			@import url("css/general.css");
		-->
		</style>
		<script language="javascript" src="javascript/functions.js" type="text/javascript"></script>
	</head>
		
	<body>
	<table width="100%" border="0">
      <tr>
            <td colspan="2" bgcolor="#0000FF"><div align="center" class="words1">&Aacute;rea administrativa</div></td>
            <td width="65%" bgcolor="#0000FF"><?php
			if(isset($_GET["login"]) == "false"){
				echo('<p class="alert">Login não efetivado!</p>');
			}
		?></td>
            <td colspan="2" bgcolor="#0000FF"><form id="desconectForm" name="desconectForm" method="post" action="actions/Logout.class.php">
      <label>
      <input name="desconect" type="submit" id="desconect" value="Desconectar" />
      </label>
    </form></td>
            <td width="3%"></td>
      </tr>
          <tr>
            <td width="15%" bgcolor="#0099FF" class="words2"><div align="right">Conectar ao sistema: </div></td>
            <td colspan="4" rowspan="2"><form id="form1" name="form1" method="post" action="actions/Login.class.php">
              <label></label>
              <table width="100%" border="0" bordercolor="#0099FF" bgcolor="#0099FF">
                <tr>
                  <td width="17%" bgcolor="#0099FF" class="words2"><div align="right">Nome de usu&aacute;rio: </div></td>
                  <td width="83%" bgcolor="#0099FF" class="words2"><input name="tfUserName" type="text" id="tfUserName" size="25" maxlength="50" /></td>
                </tr>
                <tr>
                  <td bgcolor="#0099FF" class="words2"><div align="right">Senha:</div></td>
                  <td bgcolor="#0099FF" class="words2"><input name="tfPassword" type="password" id="tfPassword" size="25" maxlength="50" /></td>
                </tr>
                <tr>
                  <td bgcolor="#0099FF">&nbsp;</td>
                  <td bgcolor="#0099FF">&nbsp;</td>
                </tr>
                <tr>
                  <td bgcolor="#0099FF">&nbsp;</td>
                  <td bgcolor="#0099FF"><input name="btLogin" type="submit" id="btLogin" value="Conectar"/></td>
                </tr>
              </table>
            </form></td>
            <td rowspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td bgcolor="#999999">&nbsp;</td>
          </tr>
          
          <tr>
            <td colspan="5" bordercolor="#0000FF" bgcolor="#0000FF">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
	</body>
</html>
