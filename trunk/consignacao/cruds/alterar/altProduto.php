<?php
	session_start();
	$nivelAcesso = "../../:2:3:4";
	include_once("../../utils/controladorAcesso.php");
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
		header("Location: altProduto.php?alt=ok");
		die();
	}
	$cad = isset($_GET["alt"]) ? $_GET["alt"] : NULL;
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
		<script type="text/javascript" language="javascript" src="../../scripts/javascript/produto.js"></script>
		<script type="text/javascript" language="javascript">
			 window.onload = function(){
			 	loadContent('../pesquisar/getProdutosSL.php', 'slProRef', '../../');
			}
			function carregarAlteracoes(){
				xmlRequest = getXMLHttp();

				xmlRequest.open("GET",'../pesquisar/getProdutoAlt.php?key='+document.getElementById('slProRef').value,true);
				
				if (xmlRequest.readyState == 1) {
					document.getElementById("carregando").innerHTML = "<img src='../../imagens/rotating_arrow.gif' width='20px' height='20px' />";
				}
				xmlRequest.onreadystatechange = function () {
						if (xmlRequest.readyState == 4){
							document.getElementById("carregando").innerHTML = "";
							document.getElementById('alt').innerHTML = xmlRequest.responseText;
							//document.getElementById('tfProDesc').tfEmpDesc.value 	= document.getElementById('A').innerHTML;
							document.getElementById('tfProDesc').value 	= document.getElementById('B').innerHTML;
							document.getElementById('tfProPrazMax').value 	= document.getElementById('C').innerHTML;
						}
				}
				xmlRequest.send(null);
			}
		</script>
	</head>
	<body>
		<?php
			if($cad != NULL){
				$tipo = "alt";
				$toRoot = "../../";
				include("../../includes/confirmar.php");
			}else{
				echo('<div id="confirmar"></div>');
			}
		?>
		<div id="alt" style="visibility:hidden; position:absolute">
		</div>
		<div id="carregando">
		</div>
		<form id="produtoAlterar" name="produtoAlterar" method="post" action="#" onsubmit="javascript: return validarProdutoAltSubmit();">
		  <div>
		  <span class="texto2">Selecione o produto a ser alterado:</span> 
		  <select name="slProRef" class="tf1" id="slProRef" onchange="javascript: validarProdutoForm('slProRef'); carregarAlteracoes();">
		    <option value="---">-----------------------------</option>
	      </select></div>
		  <div><span class="texto2">Descri&ccedil;&atilde;o:</span> 
            <input name="tfProDesc" type="text" class="tf1" id="tfProDesc" onkeyup="javascript: validarProdutoForm('tfProDesc');" size="50" maxlength="100"/>
          </div>
		  <div>
<span class="texto2">Prazo m&aacute;ximo:</span>
<input name="tfProPrazMax" type="text" class="tf1" id="tfProPrazMax" onkeyup="javascript: validarProdutoForm('tfProPrazMax');" size="5" maxlength="2"/></div>
		  <div align="center"><br />
		    <input name="btEmpAlt" type="submit" class="bt1" id="btEmpAlt" value="Alterar" />
	        </div>
		</form>
	</body>
</html>
