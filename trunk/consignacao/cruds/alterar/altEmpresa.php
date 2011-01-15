<?php
	session_start();
	$slEmpRef = isset($_POST["slEmpRef"]) ? $_POST["slEmpRef"] : NULL;
	$desc = isset($_POST["tfEmpDesc"]) ? $_POST["tfEmpDesc"] : NULL;
	if($desc != NULL && $slEmpRef != NULL){
		include_once("../../dao/DAOEmpresa.class.php");
		include_once("../../dao/DAOLog.class.php");
		$dao = new DAOEmpresa($desc, "../../");
		$log = new DAOLog($_SESSION["pessoa"], 4, $_SESSION["nivel"], $_SESSION["codigo"], 2, "id=\'".$slEmpRef."\'", "../../");
		$dao->alterar($slEmpRef);
		$log->cadastrar();
		header("Location: altEmpresa.php");
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
			@import url("../../scripts/css/empresa.css");
			-->
		</style>
		<script type="text/javascript" language="javascript" src="../../scripts/javascript/ajax.js"></script>
		<script type="text/javascript" language="javascript" src="../../scripts/javascript/empresa.js"></script>
		<script type="text/javascript" language="javascript">
			 window.onload = function(){
			 	loadContent('../pesquisar/getEmpresasSL.php', 'slEmpRef', '../../');
			}
			function carregarAlteracoes(){
				xmlRequest = getXMLHttp();

				xmlRequest.open("GET",'../pesquisar/getEmpresaAlt.php?key='+document.getElementById('slEmpRef').value,true);
				
				if (xmlRequest.readyState == 1) {
					document.getElementById("carregando").innerHTML = "<img src='../../imagens/rotating_arrow.gif' width='20px' height='20px' />";
				}
				xmlRequest.onreadystatechange = function () {
						if (xmlRequest.readyState == 4){
							document.getElementById("carregando").innerHTML = "";
							document.getElementById('alt').innerHTML = xmlRequest.responseText;
							document.getElementById('empresaAlterar').tfEmpDesc.value 	= document.getElementById('A').innerHTML;
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
		<form id="empresaAlterar" name="empresaAlterar" method="post" action="#" onsubmit="javascript: return validarAlterarEmpresa('empresaAlterar');">
		  <label>Selecione a empresa a ser alterada: 
		  <select name="slEmpRef" id="slEmpRef" onchange="javascript: carregarAlteracoes();">
		    <option value="---">-----------------------------</option>
	      </select>
		  <br />
		  <br />
		  Modifique o nome da empresa: 
		  <div id="alt"><input name="tfEmpDesc" type="text" id="tfEmpDesc" size="50" maxlength="100" onkeyup="javascript: validarDescricaoEmpresa('empresaAlterar');"/></div>
		  </label>
		  <label>
		  <input name="btEmpAlt" type="submit" id="btEmpAlt" value="Alterar" />
		  </label>
		</form>
	</body>
</html>
