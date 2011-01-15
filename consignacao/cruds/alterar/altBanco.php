<?php
	session_start();
	$slBancRef = isset($_POST["slBancRef"]) ? $_POST["slBancRef"] : NULL;
	$tfBanCod = isset($_POST["tfBanCod"]) ? $_POST["tfBanCod"] : NULL;
	$tfBanDesc = isset($_POST["tfBanDesc"]) ? $_POST["tfBanDesc"] : NULL;
	
	if($slBancRef != NULL || $tfBanCod != NULL || $tfBanDesc != NULL || $tfBanContat != NULL || $tfBanFone != NULL){
		include_once("../../dao/DAOBanco.class.php");
		$dao = new DAOBanco($tfBanCod, $tfBanDesc, "../../");
		include_once("../../dao/DAOLog.class.php");
		$log = new DAOLog($_SESSION["pessoa"], 4, $_SESSION["nivel"], $_SESSION["codigo"], 3, "id=\'".$slBancRef."\'", "../../");
		$dao->alterar($slBancRef);
		$log->cadastrar();
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
			 	loadContent('../pesquisar/getBancosSL.php', 'slBancRef', '../../');
			}
			function carregarAlteracoes(){
				xmlRequest = getXMLHttp();

				xmlRequest.open("GET",'../pesquisar/getBancoAlt.php?key='+document.getElementById('slBancRef').value,true);
				
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
						}
				}
				xmlRequest.send(null);						
			}
			function manipularContato(){
				window.location = "../xxxContato.php?banco="+document.getElementById("tfBanCod").value;
			}
		</script>
	</head>
	<body>
		<div id="alt" style="visibility:hidden; position:absolute">
		</div>
		<div id="carregando">
		</div>
		<form id="bancoAlterar" name="bancoAlterar" method="post" action="#"  onsubmit="javascript: return validarBancoAltSubmit();">
		Banco a ser alterado:
		<select name="slBancRef" id="slBancRef" onchange="javascript: carregarAlteracoes();">
          <option value="---" selected="selected">---------------------------</option>
        </select>
		<br />
		Insira o c&oacute;digo do banco:
		<input name="tfBanCod" type="text" id="tfBanCod" size="5" maxlength="3" onkeyup="javascript: validarBancoForm('tfBanCod');"/>
		<br />
		Descri&ccedil;&atilde;o:
		<input name="tfBanDesc" type="text" id="tfBanDesc" size="50" maxlength="100" onkeyup="javascript: validarBancoForm('tfBanDesc');"/>
		<br />
		<input name="btBanAlt" type="submit" id="btBanAlt" value="Alterar" />
		<br />
		</form>
	    <input name="btContat" type="button" id="btContat" value="Clique aqui para Adicionar ou Modificar um contato deste banco!" onclick="javascript: manipularContato();"/>
</body>
</html>
