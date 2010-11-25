<?php
	session_start();
	
	require_once("utils/Connect.class.php");
	include_once("beans/Variables.class.php");
	
	$variables = new Variables();
	$connect = new Connect($variables->dbHost, $variables->dbUser, $variables->dbPassword, $variables->dbName);
	$connect->start();

	$login	= "visible";
	$search = "hidden";
	if(/*(isset($_GET["ok"]) == "true") && */isset($_SESSION["user"])){
		$login	= "hidden";
		$search = "visible";
	}else{
		if(isset($_GET["ok"])){
			$mesage = "Acesso não permitido!";
		}
	}
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
<table width="100%" border="0" class="movel">
  <tr>
    <td width="2%">&nbsp;</td> 
    <td width="88%"><div></div></td>
    <td width="9%">&nbsp;</td>
    <td width="1%">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td bgcolor="#0000FF"><p class="alert"><?php echo($mesage); ?></p>Vkn84</td>
    <td bgcolor="#0000FF"><form id="desconectForm" name="desconectForm" method="post" action="actions/Logout.class.php">
      <label>
      <input name="desconect" type="submit" id="desconect" value="Desconectar" />
      </label>
    </form></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
  
    <td>&nbsp;</td>
    <td colspan="2" bgcolor="#0099FF" style="visibility:<?php echo($login); ?>">
	</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2" bgcolor="#0099FF" style="visibility:<?php echo($search); ?>"><div align="center"><form action="utils/ContrachequeMaker.class.php" method="post" name="search" class="words2" id="search" onsubmit="javascript: return userSearchValider('search');">
      <label> <span class="style2">Contracheques a partir de:</span>
        <input name="tfDate1" type="text" id="tfDate1" size="15" maxlength="10" onkeydown="javascript: return dateValider('tfDate1', event);"/>
      </label>
      at&eacute;
  <label>
  <input name="tfDate2" type="text" id="tfDate2" size="15" maxlength="10" onkeydown="javascript: return dateValider('tfDate2', event);"/>
  </label>
      .
  <label>
  <input name="search" type="submit" id="search" value="Pesquisar" />
  </label>
        </form></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><br />
      &quot;Nenhum sistema &eacute; melhor do que as pessoas que v&atilde;o oper&aacute;-lo&quot; - Autor Desconhecido </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<div id="infos">
<table width="200" border="0" style="visibility:<?php echo($search); ?>">
  <tr>
    <td width="71" height="21"><div align="right">Nome:</div></td>
    <td width="829"><?php echo(isset($_SESSION["nome"])? $_SESSION["nome"] : ""); ?></td>
  </tr>
  <tr>
    <td><div align="right">Matr&iacute;cula: </div> </td>
    <td><?php echo(isset($_SESSION["user"])? $_SESSION["user"] : ""); ?></td>
  </tr>
</table></div>
		<div id="divBox" align="center">
			<div id="divFields" style="visibility:<?php echo($login); ?>">
				<form id="login" name="login" method="post" onsubmit="javascript: return userLoginValider('login');" action="actions/UserLogin.class.php">
				  <label></label>
				  <table width="100%" border="0">
					<tr>
					  <td width="50%" class="words2"><div align="right">A qual folha voc&ecirc; pertence:</div></td>
					  <td width="50%"><select name="slSelect">
						<option>Escolha</option>
						<?php
						/*
						FDSC - Funcionários disposição comissionado serviço prestado
						FMSA - 
						PACS - 
						FPUM - 
						*/
					$result = $connect->execute("SELECT descricao FROM Folhas");
					
					while($row = mysql_fetch_assoc($result)) {
						echo("<option>".$row["descricao"]."</option>");
					}
					
					//$connect->close();
				?>
					  </select></td>
				    </tr>
					<tr>
					  <td class="words2"><div align="right">Informe a sua matr&iacute;cula:</div></td>
					  <td><input name="tfMatricula" type="text" id="tfMatricula" size="20" maxlength="50" /></td>
				    </tr>
					<tr>
					  <td class="words2"><div align="right">Informe a sua senha:</div></td>
					  <td><input name="tfPassword" type="password" id="tfPassword" size="20" maxlength="25" /></td>
				    </tr>
					<tr>
					  <td class="words2">&nbsp;</td>
					  <td><div align="center"><br />
				        <input name="connect" type="submit" id="connect" value="Conectar" />
				      </div></td></tr>
				  </table>
			  </form>
		  </div>
				  <img src="images/box.png" width="600" height="238" />
</div>
<div id="divFMSLogo" align="center"><img src="images/fms_logo.png" alt="Funda&ccedil;&atilde;o Municipal de Saude - FMS" width="274" height="73" /></div>
<div id="divBrasao" align="center"><img src="images/brasao_2.png" width="77" height="106" /></div>
</body>
</html>
