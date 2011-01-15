<?php
	$slBancRef = isset($_POST["slBancRef"]) ? $_POST["slBancRef"] : NULL;
	if($slBancRef != NULL){
		include_once("../../dao/DAOBanco.class.php");
		$dao = new DAOBanco(NULL, NULL, "../../");
		$dao->deletar($slBancRef);
		header("Location: delBanco.php");
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
		<form id="bancoDeletar" name="bancoDeletar" method="post" action="#"  onsubmit="javascript: return validarDeletarBanco('bancoDeletar');">
		  Banco a ser deletado:
		<select name="slBancRef" id="slBancRef" onchange="javascript: carregarAlteracoes();">
          <option value="---" selected="selected">---------------------------</option>
        </select>
		<br />
		<input name="btBanDel" type="submit" id="btBanDel" value="Deletar" />
		</form>
	</body>
</html>
