<?php
	$slProRef = isset($_POST["slProRef"]) ? $_POST["slProRef"] : NULL;
	if($slProRef != NULL){
		session_start();
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
		header("Location: delProduto.php");
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
			@import url("../../scripts/css/produto.css");
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
		<div id="alt" style="visibility:hidden; position:absolute">
		</div>
		<div id="carregando">
		</div>
		<form id="produtoDeletar" name="bancoDeletar" method="post" action="#"  onsubmit="javascript: return validarProdutoDelSubmit('bancoDeletar');">
		  Produto a ser deletado:
		    <select name="slProRef" id="slProRef" onchange="javascript: validarProdutoForm('slProRef');">
          <option value="---" selected="selected">---------------------------</option>
        </select>
		<br />
		<input name="btBanDel" type="submit" id="btProDel" value="Deletar" />
		</form>
	</body>
</html>
