<?php
	session_start();
	$slProRef = isset($_POST["slProRef"]) ? $_POST["slProRef"] : NULL;
	$tfProDesc = isset($_POST["tfProDesc"]) ? $_POST["tfProDesc"] : NULL;
	$tfProPrazMax = isset($_POST["tfProPrazMax"]) ? $_POST["tfProPrazMax"] : NULL;
	
	if($slProRef != NULL && $tfProDesc != NULL && $tfProPrazMax != NULL){
		include_once("../../utils/ConectarMySQL.class.php");
		$conexao = new ConectarMySQL();
		include_once("../../dao/DAOProduto.class.php");
		include_once("../../dao/DAOLog.class.php");
		$dao = new DAOProduto($tfProDesc, $tfProPrazMax, "../../", $conexao);
		$log = new DAOLog($_SESSION["pessoa"], 4, $_SESSION["nivel"], $_SESSION["codigo"], 4, "id=\'".$slProRef."\'", "../../", $conexao);
		if($dao->alterar($slProRef) && $log->cadastrar())
			$conexao->commit();
		else
			$conexao->rollback();
		header("Location: altProduto.php");
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
			 	loadContent('../pesquisar/getProdutosSL.php', 'slProRef', '../../');
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
		  <label>
		  Selecione o produto a ser alterado: 
		  <select name="slProRef" id="slProRef" onchange="javascript: carregarAlteracoes();">
		    <option value="---">-----------------------------</option>
	      </select>
		  <br />
		  <br />
		  <label>Descri&ccedil;a&otilde;: </label>
          <input name="tfProDesc" type="text" id="tfProDesc" size="50" maxlength="100" />
          <br />
Prazo m&aacute;ximo:
<input name="tfProPrazMax" type="text" id="tfProPrazMax" size="5" maxlength="2" />
<label></label>
<br />
		  </label>
          <label>
		  <input name="btEmpAlt" type="submit" id="btEmpAlt" value="Alterar" />
		  </label>
		</form>
	</body>
</html>
