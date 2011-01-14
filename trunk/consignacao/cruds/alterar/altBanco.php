<?php
	$slBancRef = isset($_POST["slBancRef"]) ? $_POST["slBancRef"] : NULL;
	$tfBanCod = isset($_POST["tfBanCod"]) ? $_POST["tfBanCod"] : NULL;
	$tfBanDesc = isset($_POST["tfBanDesc"]) ? $_POST["tfBanDesc"] : NULL;
	$tfBanContat = isset($_POST["tfBanContat"]) ? $_POST["tfBanContat"] : NULL;
	$tfBanFone = isset($_POST["tfBanFone"]) ? $_POST["tfBanFone"] : NULL;
	
	if($slBancRef != NULL || $tfBanCod != NULL || $tfBanDesc != NULL || $tfBanContat != NULL || $tfBanFone != NULL){
		include_once("../../dao/DAOBanco.class.php");
		$dao = new DAOBanco($tfBanCod, $tfBanDesc, $tfBanContat, $tfBanFone, "../../");
		$dao->alterar($slBancRef);
		header("Location: altBanco.php");
		die();
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>Untitled Document</title>
		<style type="text/css">
			<!--
			@import url("../../scripts/css/banco.css");
			-->
		</style>
		<script type="text/javascript" language="javascript" src="../../scripts/javascript/ajax.js"></script>
		<script type="text/javascript" language="javascript" src="../../scripts/javascript/banco.js"></script>
		<script type="text/javascript" language="javascript">
			 window.onload = function(){
			 	loadContent('../../utils/getBancos.php', 'slBancRef', '../../');
			}
			function carregarAlteracoes(){
				xmlRequest = getXMLHttp();

				xmlRequest.open("GET",'../../utils/getBancoAlt.php?key='+document.getElementById('slBancRef').value,true);
				
				if (xmlRequest.readyState == 1) {
					document.getElementById("carregando").innerHTML = "<img src='../../imagens/rotating_arrow.gif' width='20px' height='20px' />";
				}
				form = document.getElementById('bancoAlterar');
				xmlRequest.onreadystatechange = function () {
						if (xmlRequest.readyState == 4){
							document.getElementById("carregando").innerHTML = "";
							document.getElementById('alt').innerHTML = xmlRequest.responseText;
							form.tfBanCod.value 	= document.getElementById('A').innerHTML;
							form.tfBanDesc.value 	= document.getElementById('B').innerHTML;
							form.tfBanContat.value 	= document.getElementById('C').innerHTML;
							form.tfBanFone.value	= document.getElementById('D').innerHTML;
						}
				}
				xmlRequest.send(null);						
			}
		</script>
	</head>
	<body>
		<div id="alt" style="visibility:hidden; position:absolute">
		</div>
		<div id="carregando">
		</div>
		<form id="bancoAlterar" name="bancoAlterar" method="post" action="#"  onsubmit="javascript: return validarBancoAltSubmit();">
		  <table width="650" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="25%" height="22"><label>
                <div align="right">Banco a ser alterado:</div>
              </label></td>
              <td colspan="2"><select name="slBancRef" id="slBancRef" onchange="javascript: carregarAlteracoes();">
                <option value="---" selected="selected">---------------------------</option>
              </select></td>
              <td width="48%">&nbsp;</td>
              <td width="1%">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="2">&nbsp;</td>
              <td colspan="2">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td colspan="2"><div align="right">Insira o c&oacute;digo do banco:</div></td>
              <td colspan="2"><input name="tfBanCod" type="text" id="tfBanCod" size="5" maxlength="3" onkeyup="javascript: validarBancoForm('tfBanCod');"/></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td colspan="2"><div align="right">Descri&ccedil;&atilde;o:</div></td>
              <td colspan="2"><input name="tfBanDesc" type="text" id="tfBanDesc" size="50" maxlength="100" onkeyup="javascript: validarBancoForm('tfBanDesc');"/></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td colspan="2"><div align="right">Nome do contato:</div></td>
              <td colspan="2"><input name="tfBanContat" type="text" id="tfBanContat" size="50" maxlength="100" onkeyup="javascript: validarBancoForm('tfBanContat');"/></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td colspan="2"><div align="right">Telefone para contato:</div></td>
              <td width="13%"><input name="tfBanFone" type="text" id="tfBanFone" size="12" maxlength="12" onkeyup="javascript: validarBancoForm('tfBanFone');"/></td>
              <td>Ex: XX-XXXX-XXXX</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td colspan="2">&nbsp;</td>
              <td><br />
              <input name="btBanCad" type="submit" id="btBanCad" value="Cadastrar" /></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </table>
		</form>
	</body>
</html>
