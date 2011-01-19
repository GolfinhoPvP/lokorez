<?php
	session_start();
	$tfVerba = isset($_POST["tfVerba"]) ? $_POST["tfVerba"] : NULL;
	$slEmpRef = isset($_POST["slEmpRef"]) ? $_POST["slEmpRef"] : NULL;
	$slBancRef = isset($_POST["slBancRef"]) ? $_POST["slBancRef"] : NULL;
	$slProRef = isset($_POST["slProRef"]) ? $_POST["slProRef"] : NULL;
	$tfVerDesc = isset($_POST["tfVerDesc"]) ? $_POST["tfVerDesc"] : NULL;
	
	if($tfVerba != NULL && $slEmpRef != NULL && $slBancRef != NULL && $slProRef != NULL && $tfVerDesc != NULL){
		include_once("../../utils/ConectarMySQL.class.php");
		$conexao = new ConectarMySQL();
		include_once("../../dao/DAOVerba.class.php");
		include_once("../../dao/DAOLog.class.php");
		$dao = new DAOVerba($tfVerba, $slEmpRef, $slBancRef, $slProRef, $tfVerDesc, "../../", $conexao);
		$log = new DAOLog($_SESSION["pessoa"], 3, $_SESSION["nivel"], $_SESSION["codigo"], 9, "id=\'".$tfVerba."\'", "../../", $conexao);
		if($dao->cadastrar() && $log->cadastrar())
			$conexao->commit();
		else
			$conexao->rollback();
		header("Location: cadVerba.php");
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
			@import url("../../scripts/css/verba.css");
			-->
		</style>
		<script type="text/javascript" language="javascript" src="../../scripts/javascript/ajax.js"></script>
		<script type="text/javascript" language="javascript" src="../../scripts/javascript/verba.js"></script>
		<script type="text/javascript" language="javascript">
			 window.onload = function(){
			 	carregarEmpresas();
			}
			function carregarEmpresas(){
				xmlRequest = getXMLHttp();

				xmlRequest.open("GET",'../pesquisar/getEmpresasSL.php',true);
				
				if (xmlRequest.readyState == 1) {
					document.getElementById("carregando").innerHTML = "<img src='../../imagens/rotating_arrow.gif' width='20px' height='20px' />";
				}
				xmlRequest.onreadystatechange = function () {
						if (xmlRequest.readyState == 4){
							document.getElementById("carregando").innerHTML = "";
							document.getElementById('slEmpRef').innerHTML = xmlRequest.responseText;
							carregarBancos();
						}
				}
				xmlRequest.send(null);
			}
			function carregarBancos(){
				xmlRequest = getXMLHttp();

				xmlRequest.open("GET",'../pesquisar/getBancosSL.php',true);
				
				if (xmlRequest.readyState == 1) {
					document.getElementById("carregando").innerHTML = "<img src='../../imagens/rotating_arrow.gif' width='20px' height='20px' />";
				}
				xmlRequest.onreadystatechange = function () {
						if (xmlRequest.readyState == 4){
							document.getElementById("carregando").innerHTML = "";
							document.getElementById('slBancRef').innerHTML = xmlRequest.responseText;
							carregarProdutos();
						}
				}
				xmlRequest.send(null);
			}
			function carregarProdutos(){
				xmlRequest = getXMLHttp();

				xmlRequest.open("GET",'../pesquisar/getProdutosSL.php',true);
				
				if (xmlRequest.readyState == 1) {
					document.getElementById("carregando").innerHTML = "<img src='../../imagens/rotating_arrow.gif' width='20px' height='20px' />";
				}
				xmlRequest.onreadystatechange = function () {
						if (xmlRequest.readyState == 4){
							document.getElementById("carregando").innerHTML = "";
							document.getElementById('slProRef').innerHTML = xmlRequest.responseText;
						}
				}
				xmlRequest.send(null);
			}
		</script>
	</head>
	<body>
		<div id="carregando">
		</div>
		<form id="verbaCadstrar" name="verbaCadstrar" method="post" action="#" onsubmit="javascript: return validarVerCadSubmit();">
		  Verba: 
		    <label>
		    <input name="tfVerba" type="text" id="tfVerba" size="10" maxlength="10" onkeyup="javascript: validarVerForm('tfVerba');"/>
		    </label>
	      <br />
		  Selecione uma empresa 
		  : 
		    <select name="slEmpRef" id="slEmpRef" onchange="javascript: validarVerForm('slEmpRef');">
		    <option value="---">-----------------------------</option>
	      </select>
		  <br />
		  Selecione um banco :
          <select name="slBancRef" id="slBancRef" onchange="javascript: validarVerForm('slBancRef');">
            <option value="---" selected="selected">---------------------------</option>
          </select>
          <br />
          <label>
Selecione um produto:
<select name="slProRef" id="slProRef" onchange="javascript: validarVerForm('slProRef');">
  <option value="---">-----------------------------</option>
</select>
<br />
		  <br />
		  Descri&ccedil;&atilde;o da verba: <input name="tfVerDesc" type="text" id="tfVerDesc" size="50" maxlength="100" onkeyup="javascript: validarVerForm('tfVerDesc');"/>
		  </label>
		  <label>
		  <input name="btVerCad" type="submit" id="btVerCad" value="Cadastrar" />
		  </label>
		</form>
	</body>
</html>
