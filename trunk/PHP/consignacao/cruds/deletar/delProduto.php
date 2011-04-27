<?php
	session_start();
	$nivelAcesso = "../../:2:3:4";
	include_once("../../utils/controladorAcesso.php");
	include_once("../../utils/funcoes.php");
	$slProRef = antiSQL(isset($_POST["slProRef"]) ? $_POST["slProRef"] : NULL);
	if($slProRef != NULL){
		include_once("../../utils/ConectarMySQL.class.php");
		$conexao = new ConectarMySQL();
		include_once("../../dao/DAOLog.class.php");
		$log = new DAOLog($_SESSION["pessoa"], 5, $_SESSION["nivel"], $_SESSION["codigo"], 3, "id=\'".$slProRef."\'", "../../", $conexao);
		include_once("../../dao/DAOProduto.class.php");
		$dao = new DAOProduto(NULL, NULL, "../../", $conexao);
		if($dao->deletar($slProRef) && $log->cadastrar())
			$conexao->commit();
		else
			$conexao->rollback();
		header("Location: delProduto.php?del=ok");
		die();
	}
	$cad = antiSQL(isset($_GET["del"]) ? $_GET["del"] : NULL);
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
		<?php
			if($cad != NULL){
				$tipo = "del";
				$toRoot = "../../";
				include("../../includes/confirmar.php");
			}else{
				echo('<div id="confirmar"></div>');
			}
		?>
		<div id="carregando">		</div>
		<form id="produtoDeletar" name="bancoDeletar" method="post" action="#"  onsubmit="javascript: return validarProdutoDelSubmit('bancoDeletar');">
		  <div><span class="texto2">Produto a ser deletado:</span>
		    <select name="slProRef" class="tf1" id="slProRef" onchange="javascript: validarProdutoForm('slProRef');">
          <option value="---" selected="selected">---------------------------</option>
        </select></div>
		  <div align="center"><br />
		    <input name="btBanDel" type="submit" class="bt1" id="btProDel" value="Deletar" />
	        </div>
		</form>
	</body>
</html>
