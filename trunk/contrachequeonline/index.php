<?php
	session_start();
	
	require_once("utils/Connect.class.php");
	include_once("beans/Variables.class.php");
	
	$variables = new Variables();
	$connect = new Connect($variables->dbHost, $variables->dbUser, $variables->dbPassword, $variables->dbName);
	if(!$connect->start()){
		die("ERRO na conexão com o banco!");
	}

	$login	= "visible";
	$search = "hidden";
	$messageVs = "hidden";
	if(isset($_SESSION["user"])){
		$login	= "hidden";
		$search = "visible";
		if(isset($_GET["found"])){
			$message = "Nenhum contracheque a seu respeito foi encontrado.";
			$messageVs = "visible";
		}
		if($_GET["pass"] == "true"){
			$message = "Senha alterada com sucesso!";
			$messageVs = "visible";
		}else if($_GET["pass"] == "false"){
			$message = "A senha não foi alterada!";
			$messageVs = "visible";
		}
	}else{
		if(isset($_GET["ok"])){
			$message = "Acesso negado, insira corretamente suas informações.";
			$messageVs = "visible";
		}
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
<div id="divBox" style="visibility:<?php echo($login); ?>">
			<table width="798" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="74"><img src="images/box_l.png" /></td>
    <td width="531" background="images/box_c.png">
	<div>
				<form id="login" name="login" method="post" onsubmit="javascript: return userLoginValider('login');" action="actions/UserLogin.class.php">
				  
				  <div align="center" class="wordsLabel2">FMS Contracheque On-line				  </div>
				  <br />
				  <table width="100%" border="0">
					<tr>
					  <td width="44%" class="words2"><div align="right">A qual folha voc&ecirc; pertence:</div></td>
					  <td width="56%"><select name="slSelect">
						<option value="0">Escolha</option>
						<?php
						/*
						FDSC - Funcionários disposição comissionado serviço prestado
						FMSA - 
						PACS - 
						FPUM - 
						*/
					$result = $connect->execute("SELECT codigo_fol, descricao FROM Folhas ORDER BY codigo_fol");
					
					while($row = mysql_fetch_assoc($result)) {
						echo("<option value='".$row["codigo_fol"]."'>".$row["descricao"]."</option>");
					}
					
					//$connect->close();
				?>
					  </select></td>
				    </tr>
					<tr>
					  <td class="words2"><div align="right">Informe a sua matr&iacute;cula:</div></td>
					  <td><input name="tfMatricula" autocomplete="off" type="text" id="tfMatricula" size="20" maxlength="50" /></td>
				    </tr>
					<tr>
					  <td class="words2"><div align="right">Informe a sua senha:</div></td>
					  <td><input name="tfPassword" type="password" id="tfPassword" size="20" maxlength="25" /></td>
				    </tr>
					<tr>
					  <td class="words2"></td>
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


<div id="divBoxLogged" style="visibility:<?php echo($search); ?>">
	<div id="divBoxSenha">
  <table width="611" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="74"><img src="images/box_l.png" /></td>
      <td width="344" background="images/box_c.png">
	  <form id="passChange" name="passChange" method="post" action="actions/changePassword.php" onsubmit="javascript: return changePassValider('passChange')">
        <table width="100%" border="0">
          <tr>
            <td colspan="2">
              <table width="337" border="0">
                <tr>
                  <td width="298"><div align="center" class="wordsLabel2">Alterar Senha </div></td>
                  <td width="29"><img src="images/fechar.png" style="cursor:pointer" onclick="javascript: hide('divBoxSenha');"/></td>
                </tr>
              </table></td>
          </tr>
          <tr>
            <td width="181" class="words1"><div align="right">Antiga senha: </div></td>
            <td width="153"><input name="tfOldPass" type="password" id="tfOldPass" size="25" maxlength="15" /></td>
          </tr>
          <tr>
            <td class="words1"><div align="right">Nova senha:</div></td>
            <td><input name="tfNewPass1" type="password" id="tfNewPass1" size="25" maxlength="15" /></td>
          </tr>
          <tr>
            <td class="words1"><div align="right">Confirme a nova senha: </div></td>
            <td><label>
              <input name="tfNewPass2" type="password" id="tfNewPass2" size="25" maxlength="15" />
            </label></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><input name="btChange" type="submit" id="btChange" value="Alterar" /></td>
          </tr>
        </table>
		</form>
      <br /></td>
      <td width="193"><img src="images/box_r.png" /></td>
    </tr>
  </table>
</div>
	<div id="divButDesc" style="cursor:pointer" onclick="location.href='actions/Logout.class.php'">
		<span class="wordsLabel">Desconectar </span><img src="images/desconectar.png" width="36" height="36" />	</div>
	<div class="wordsLabel" id="divSenMud" style="cursor:pointer" onclick="javascript: show('divBoxSenha');">
		Mudar Senha <img src="images/cadeado.png" width="32" height="47" />	</div>
  <table width="905" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="74"><img src="images/box_l.png" /></td>
      <td width="638" background="images/box_c.png">
          <div align="center" class="wordsLabel2">FMS Contracheque On-line </div>
          <br />
		  <table width="100%" border="0">
			  <tr>
				<td width="149"><div align="right" class="words2">Seja bem vindo(a) </div></td>
				<td width="306"><?php echo(isset($_SESSION["nome"])? $_SESSION["nome"] : ""); ?></td>
				<td width="132"></td>
			  </tr>
			  <tr>
				<td><div align="right" class="words2">Matr&iacute;cula:</div></td>
				<td><?php echo(isset($_SESSION["user"])? $_SESSION["user"] : ""); ?></td>
				<td>&nbsp;</td>
			  </tr>
			  <tr>
				<td colspan="3"><br /><br /><form action="utils/ContrachequeMaker.class.php" method="post" name="search" class="words2" id="search" onsubmit="javascript: return userSearchValider('search');">Contracheques a partir de:
                    <label>
                    <select name="slDate1" id="slDate1">
                      <option value="0" selected="selected">---</option>
                      <option value="1">janeiro</option>
                      <option value="2">fevereiro</option>
                      <option value="3">mar&ccedil;o</option>
                      <option value="4">abril</option>
                      <option value="5">maio</option>
                      <option value="6">junho</option>
                      <option value="7">julho</option>
                      <option value="8">agosto</option>
                      <option value="9">setembro</option>
                      <option value="10">outubro</option>
                      <option value="11">novembro</option>
                      <option value="12">dezembro</option>
                    </select>
                    de
                    </label>
                    <input name="tfDate1" type="text" id="tfDate1" size="6" maxlength="4" onkeydown="javascript: return onlyNums('tfDate1', event);"/>

        at&eacute;

        <label>
        <select name="slDate2" id="slDate2">
			<option value="0" selected="selected">---</option>
                      <option value="1">janeiro</option>
                      <option value="2">fevereiro</option>
                      <option value="3">mar&ccedil;o</option>
                      <option value="4">abril</option>
                      <option value="5">maio</option>
                      <option value="6">junho</option>
                      <option value="7">julho</option>
                      <option value="8">agosto</option>
                      <option value="9">setembro</option>
                      <option value="10">outubro</option>
                      <option value="11">novembro</option>
                      <option value="12">dezembro</option>
        </select>
        de
        </label>
        <input name="tfDate2" type="text" id="tfDate2" size="6" maxlength="5" onkeydown="javascript: return onlyNums('tfDate2', event);"/>
        .
  <input name="search" type="submit" id="search" value="Pesquisar" />

      </form></td>
			  </tr>
		</table>	  </td>
      <td width="193"><img src="images/box_r.png" /></td>
    </tr>
  </table>
</div>
</div>
</body>
</html>
