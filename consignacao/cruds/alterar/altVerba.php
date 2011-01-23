<?php
	session_start();
	$nivelAcesso = "../../:2:3:4";
	include_once("../../utils/controladorAcesso.php");
	$slVerRef = isset($_POST["slVerRef"]) ? $_POST["slVerRef"] : NULL;
	$tfVerba = isset($_POST["tfVerba"]) ? $_POST["tfVerba"] : NULL;
	$slEmpRef = isset($_POST["slEmpRef"]) ? $_POST["slEmpRef"] : NULL;
	$slBancRef = isset($_POST["slBancRef"]) ? $_POST["slBancRef"] : NULL;
	$slProRef = isset($_POST["slProRef"]) ? $_POST["slProRef"] : NULL;
	$tfVerDesc = isset($_POST["tfVerDesc"]) ? $_POST["tfVerDesc"] : NULL;
	
	if($slVerRef != NULL && $tfVerba != NULL && $slEmpRef != NULL && $slBancRef != NULL && $slProRef != NULL && $tfVerDesc != NULL){
		include_once("../../utils/ConectarMySQL.class.php");
		$conexao = new ConectarMySQL();
		include_once("../../dao/DAOVerba.class.php");
		include_once("../../dao/DAOLog.class.php");
		$dao = new DAOVerba($tfVerba, $slEmpRef, $slBancRef, $slProRef, $tfVerDesc, "../../", $conexao);
		$log = new DAOLog($_SESSION["pessoa"], 4, $_SESSION["nivel"], $_SESSION["codigo"], 9, "Log id=\'".$slVerRef."\'", "../../", $conexao);
		if($dao->alterar($slVerRef) && $log->cadastrar())
			$conexao->commit();
		else
			$conexao->rollback();
		header("Location: altVerba.php?alt=ok");
		die();
	}
	$alt = isset($_GET["alt"]) ? $_GET["alt"] : NULL;
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
			 	carregar();
			}
			function carregar(){
				xmlRequest = getXMLHttp();

				xmlRequest.open("GET",'../pesquisar/getVerbasSL.php',true);
				
				if (xmlRequest.readyState == 1) {
					document.getElementById("carregando").innerHTML = "<img src='../../imagens/rotating_arrow.gif' width='20px' height='20px' />";
				}
				xmlRequest.onreadystatechange = function () {
						if (xmlRequest.readyState == 4){
							document.getElementById("carregando").innerHTML = "";
							document.getElementById('slVerRef').innerHTML = xmlRequest.responseText;
							carregarEmpresas();
						}
				}
				xmlRequest.send(null);
			}
			function carregarAlteracoes(){
				xmlRequest = getXMLHttp();

				xmlRequest.open("GET",'../pesquisar/getVerbaAlt.php?key='+document.getElementById('slVerRef').value,true);
				
				if (xmlRequest.readyState == 1) {
					document.getElementById("carregando").innerHTML = "<img src='../../imagens/rotating_arrow.gif' width='20px' height='20px' />";
				}
				xmlRequest.onreadystatechange = function () {
						if (xmlRequest.readyState == 4){
							document.getElementById("carregando").innerHTML = "";
							document.getElementById('alt').innerHTML = xmlRequest.responseText;
							document.getElementById('verbaAlterar').tfVerba.value 	= document.getElementById('A').innerHTML;
							document.getElementById('verbaAlterar').slEmpRef.value 	= document.getElementById('B').innerHTML;
							document.getElementById('verbaAlterar').slBancRef.value = document.getElementById('C').innerHTML;
							document.getElementById('verbaAlterar').slProRef.value 	= document.getElementById('D').innerHTML;
							document.getElementById('verbaAlterar').tfVerDesc.value = document.getElementById('E').innerHTML;
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
		</div><div id="carregando"></div>
		<form id="verbaAlterar" name="verbaAlterar" method="post" action="#" onsubmit="javascript: return validarVerAltSubmit();">
		  <div><span class="texto2">
		  Selecione a verba a ser alterada:</span> 
		  <select name="slVerRef" class="tf1" id="slVerRef" onchange="javascript: carregarAlteracoes();">
		    <option value="---">-----------------------------</option>
	      </select>
		  <br />
		  <br />
		  <br />
		  </div>
		  <div><span class="texto2">Novo c&oacute;digo da verba :</span> 
	        <input name="tfVerba" type="text" class="tf1" id="tfVerba" onkeyup="javascript: validarVerForm('tfVerba');" size="10" maxlength="10"/></div>
		  <div><span class="texto2">Selecione uma empresa :</span> 
		    <select name="slEmpRef" class="tf1" id="slEmpRef" onchange="javascript: validarVerForm('slEmpRef');">
		    <option value="---">-----------------------------</option>
	      </select></div>
		  <div><span class="texto2">Selecione um banco :</span>
          <select name="slBancRef" class="tf1" id="slBancRef" onchange="javascript: validarVerForm('slBancRef');">
            <option value="---" selected="selected">---------------------------</option>
          </select></div>
		<div><span class="texto2">Selecione um produto:
		</span>
		  <select name="slProRef" id="slProRef" class="tf1" onchange="javascript: validarVerForm('slProRef');">
		  <option value="---">-----------------------------</option>
		</select></div>
		<div><span class="texto2">Descri&ccedil;&atilde;o do produto:
		</span>
		  <label>
		  <input name="tfVerDesc" type="text" class="tf1" id="tfVerDesc" size="50" maxlength="100" onkeyup="javascript: validarVerForm('tfVerDesc');"/>
		  </label>
		</div>
		  <div align="center"><br />
		    <input name="btEmpAlt" type="submit" class="bt1" id="btEmpAlt" value="Alterar" />
		  </div>
		</form>
	</body>
</html>
