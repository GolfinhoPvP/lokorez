<?php
	session_start();
	$tfProDesc = isset($_POST["tfProDesc"]) ? $_POST["tfProDesc"] : NULL;
	$tfProPrazMax = isset($_POST["tfProPrazMax"]) ? $_POST["tfProPrazMax"] : NULL;
	if($tfProDesc != NULL && $tfProPrazMax != NULL){
		include_once("../../utils/ConectarMySQL.class.php");
		$conexao = new ConectarMySQL();
		include_once("../../dao/DAOProduto.class.php");
		$dao = new DAOProduto($tfProDesc, $tfProPrazMax, "../../", $conexao);
		include_once("../../dao/DAOLog.class.php");
		$log = new DAOLog($_SESSION["pessoa"], 3, $_SESSION["nivel"], $_SESSION["codigo"], 4, "valor=\'".$tfProDesc."\'", "../../", $conexao);
		if($dao->cadastrar() && $log->cadastrar())
			$conexao->commit();
		else
			$conexao->rollback();
		header("Location: cadProduto.php");
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
		<script type="text/javascript" language="javascript" src="../../scripts/javascript/produto.js"></script>
	</head>
	<body>
		<form id="produtoCadastro" name="produtoCadastro" method="post" action="#"  onsubmit="javascript: return validarProdutoCadSubmit('produtoCadastro');">
		  <label>		  Descri&ccedil;a&otilde;:		  </label>
		  <input name="tfProDesc" type="text" id="tfProDesc" size="50" maxlength="100" onkeyup="javascript: validarProdutoForm('tfProDesc');"/>
		  <br />
		Prazo m&aacute;ximo:  
		<input name="tfProPrazMax" type="text" id="tfProPrazMax" size="5" maxlength="2" onkeyup="javascript: validarProdutoForm('tfProPrazMax');"/>
		<label><br />
		  <input name="btProCad" type="submit" id="btProCad" value="Cadastrar" />
		  </label></form>
	</body>
</html>
