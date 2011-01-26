<?php
	session_start();
	$nivelAcesso = "../../:2:3:4";
	include_once("../../utils/controladorAcesso.php");
	include_once("../../utils/funcoes.php");
	$slVerRef = antiSQLisset($_POST["slVerRef"]) ? $_POST["slVerRef"] : NULL);
	
	if($slVerRef != NULL){
		include_once("../../utils/ConectarMySQL.class.php");
		$conexao = new ConectarMySQL();
		include_once("../../dao/DAOVerba.class.php");
		include_once("../../beans/Verba.class.php");
		$dao = new DAOVerba(NULL, NULL, NULL, NULL, NULL, "../../", $conexao);
		$verba = new Verba(NULL, NULL, NULL, NULL, NULL);
		$verba = $dao->getVerba($slVerRef);
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>Untitled Document</title>
		<style type="text/css">
			<!--
			@import url("../../scripts/css/geral.css");
			-->
		</style>
		<script type="text/javascript" language="javascript" src="../../scripts/javascript/ajax.js"></script>
		<script type="text/javascript" language="javascript" src="../../scripts/javascript/verba.js"></script>
		<script type="text/javascript" language="javascript">
			 window.onload = function(){
			 	loadContent('../pesquisar/getVerbasSL.php', 'slVerRef', '../../');
			}
		</script>
	</head>
	<body>
		<div id="confirmar" style="position:absolute"></div>
		<div id="carregando"></div>
		<form id="verbaAlterar" name="verbaAlterar" method="post" action="#" onsubmit="javascript: return validarVerForm('slVerRef');">
		  <div><span class="texto2">
		  Selecione a verba a ser pesquisada:</span> 
		    <select name="slVerRef" class="tf1" id="slVerRef" onchange="javascript: validarVerForm('slVerRef');">
		    <option value="---">-----------------------------</option>
	      </select>
		  <br />
		  <br />
		  </div>
		  <div align="center"><br />
		    <input name="btVerPesq" type="submit" class="bt1" id="btVerPesq" value="Pesquisar" />
		  </div>
		</form>
		<br />
		<br />
		<br />
		<?php 
			if($slVerRef != NULL){
				include("includeVerbaBox.php");
				$conexao->commit();
			}
		?>
	</body>
</html>
