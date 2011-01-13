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
		</script>
	</head>
	<body>
		<div id="carregando">
		</div>
		<form id="form1" name="form1" method="post" action="#"  onsubmit="javascript: return validarBancoAltSubmit();">
		  <label>Banco a ser alterado: 
		  <select name="slBancRef" id="slBancRef" onchange="javascript: validarBancoForm('slBancRef');">
		    <option value="---" selected="selected">---------------------------</option>
	      </select>
		  <br />
		  <br />
		  <label>
		  Insira o c&oacute;digo do banco:
		  <input name="tfBanCod" type="text" id="tfBanCod" size="5" maxlength="3" onkeyup="javascript: validarBancoForm('tfBanCod');"/>
		  <br />
		  Descri&ccedil;a&otilde;:
		  </label>
		  <input name="tfBanDesc" type="text" id="tfBanDesc" size="50" maxlength="100" onkeyup="javascript: validarBancoForm('tfBanDesc');"/>
		  <br />
		Nome do contato:  
		<input name="tfBanContat" type="text" id="tfBanContat" size="50" maxlength="100" onkeyup="javascript: validarBancoForm('tfBanContat');"/>
		<br />
		Telefone para contato:
		<input name="tfBanFone" type="text" id="tfBanFone" size="12" maxlength="12" onkeyup="javascript: validarBancoForm('tfBanFone');"/>
		  <label> Ex: XX-XXXX-XXXX <br />
		  <input name="btBanCad" type="submit" id="btBanCad" value="Cadastrar" />
		  </label></form>
	</body>
</html>
