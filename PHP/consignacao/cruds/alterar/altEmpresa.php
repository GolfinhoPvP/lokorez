<?php
	session_start();
	$nivelAcesso = "../../:2:3:4";
	include_once("../../utils/controladorAcesso.php");
	include_once("../../utils/funcoes.php");
	$slEmpRef = antiSQL(isset($_POST["slEmpRef"]) ? $_POST["slEmpRef"] : NULL);
	$desc = antiSQL(isset($_POST["tfEmpDesc"]) ? $_POST["tfEmpDesc"] : NULL);
	if($desc != NULL && $slEmpRef != NULL){
		include_once("../../utils/ConectarMySQL.class.php");
		$conexao = new ConectarMySQL();
		include_once("../../dao/DAOEmpresa.class.php");
		include_once("../../dao/DAOLog.class.php");
		$dao = new DAOEmpresa($desc, "../../", $conexao);
		$log = new DAOLog($_SESSION["pessoa"], 4, $_SESSION["nivel"], $_SESSION["codigo"], 2, "id=\'".$slEmpRef."\'", "../../", $conexao);
		if($dao->alterar($slEmpRef) && $log->cadastrar())
			$conexao->commit();
		else
			$conexao->rollback();
		header("Location: altEmpresa.php?alt=ok");
		die();
	}
	$alt = antiSQL(isset($_GET["alt"]) ? $_GET["alt"] : NULL);
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
		<?php
			if($alt != NULL){
				$tipo = "alt";
				$toRoot = "../../";
				include("../../includes/confirmar.php");
			}else{
				echo('<div id="confirmar"></div>');
			}
		?>
		<br/>
		<div id="alt" style="visibility:hidden; position:absolute">
		</div><div id="carregando">
		</div>
		<form id="empresaAlterar" name="empresaAlterar" method="post" action="#" onsubmit="javascript: return validarAlterarEmpresa('empresaAlterar');">
		  <div><span class="texto2">
		  Selecione a empresa a ser alterada:</span> 
		  <select name="slEmpRef" class="tf1" id="slEmpRef" onchange="javascript: carregarAlteracoes();">
		    <option value="---">-----------------------------</option>
	      </select></div>
		  <div>
		    <div id="alt"><span class="texto2">Modifique o nome da empresa:</span>
  <input name="tfEmpDesc" type="text" class="tf1" id="tfEmpDesc" onkeyup="javascript: validarDescricaoEmpresa('empresaAlterar');" size="50" maxlength="100"/></div>
		  </div>
		  <div align="center"><br />
		    <input name="btEmpAlt" type="submit" class="bt1" id="btEmpAlt" value="Alterar" />
		  </div>
		</form>
	</body>
</html>
