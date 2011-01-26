<?php
	session_start();
	$nivelAcesso = "../../:2:3:4";
	include_once("../../utils/controladorAcesso.php");
	include_once("../../utils/funcoes.php");
	$slProRef = antiSQL(isset($_POST["slProRef"]) ? $_POST["slProRef"] : NULL);
	
	if($slProRef != NULL){
		include_once("../../utils/ConectarMySQL.class.php");
		$conexao = new ConectarMySQL();
		include_once("../../dao/DAOProduto.class.php");
		include_once("../../beans/Produto.class.php");
		$dao = new DAOProduto(NULL, NULL, "../../", $conexao);
		$produto = new Produto(NULL, NULL, NULL);
		$produto = $dao->getProduto($slProRef);
		$conexao->commit();
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
		<script type="text/javascript" language="javascript" src="../../scripts/javascript/produto.js"></script>
		<script type="text/javascript" language="javascript">
			 window.onload = function(){
			 	loadContent('../pesquisar/getProdutosSL.php', 'slProRef', '../../');
			}
		</script>
	</head>
	<body>
		<div id="carregando"></div>
		<div id="confirmar" style="position:absolute"></div>
		<form id="produtoPesquisar" name="produtoPesquisar" method="post" action="#" onsubmit="javascript: return validarProdutoForm('slProRef');">
		  <div>
		  <span class="texto2">Selecione o produto a ser pesquisado:</span> 
		  <select name="slProRef" class="tf1" id="slProRef" onchange="javascript: validarProdutoForm('slProRef');">
		    <option value="---">-----------------------------</option>
	      </select></div>
		  <div align="center"><br />
		    <input name="btProPes" type="submit" class="bt1" id="btProPes" value="Pesquisar" />
	        </div>
		</form>
		<?php 
			if($slProRef != NULL){
				include("includeProdutoBox.php");
			}
		?>
	</body>
</html>
