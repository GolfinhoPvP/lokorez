<?php
	session_start();
	$nivelAcesso = "../../:2:3:4";
	include_once("../../utils/controladorAcesso.php");
	$banco = isset($_GET["banco"]) ? $_GET["banco"] : "*";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
	<style type="text/css">
			<!--
			@import url("../scripts/css/geral.css");
			-->
		</style>
		<script type="text/javascript" language="javascript">
			function manipularPessoa(id){
				switch(id){
					case "btCadContat" :
						window.location = "cadastrar/cadPessoa.php?tipo=contato&banco="+document.getElementById("valor").innerHTML;
						break;
					case "brAltContat" : break;
					case "brDelContat" : break;
				}
			}
		</script>
</head>

<body>
	<div id="valor" style="visibility:hidden"><?php echo($banco); ?></div>
  	<input name="btCadContat" type="submit" class="bt1" id="btCadContat" onclick="javascript: manipularPessoa('btCadContat');" value="Cadastrar Contato!" />
  	<input name="brAltContat" type="submit" class="bt1" id="brAltContat" onclick="javascript: manipularPessoa('brAltContat');" value="Alterar Contato!" />
  	<input name="brDelContat" type="submit" class="bt1" id="brDelContat" onclick="javascript: manipularPessoa('brDelContat');" value="Deletar Contato!" />
</body>
</html>
