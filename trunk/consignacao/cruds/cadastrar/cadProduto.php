<?php
	session_start();
	$nivelAcesso = "../../:2:3:4";
	include_once("../../utils/controladorAcesso.php");
	include_once("../../funcoes.php");
	$tfProDesc = antiSQL(isset($_POST["tfProDesc"]) ? $_POST["tfProDesc"] : NULL);
	$tfProPrazMax = antiSQL(isset($_POST["tfProPrazMax"]) ? $_POST["tfProPrazMax"] : NULL);
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
		header("Location: cadProduto.php?cad=ok");
		die();
	}
	$cad = antiSQL(isset($_GET["cad"]) ? $_GET["cad"] : NULL);
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
		<script type="text/javascript" language="javascript" src="../../scripts/javascript/produto.js"></script>
	</head>
	<body>
		<?php
			if($cad != NULL){
				$tipo = "cad";
				$toRoot = "../../";
				include("../../includes/confirmar.php");
			}else{
				echo('<div id="confirmar"></div>');
			}
		?>
		<form id="produtoCadastro" name="produtoCadastro" method="post" action="#"  onsubmit="javascript: return validarProdutoCadSubmit();"><div><span class="texto2">Descri&ccedil;a&otilde;: </span>
		  <input name="tfProDesc" type="text" class="tf1" id="tfProDesc" onkeyup="javascript: validarProdutoForm('tfProDesc');" size="50" maxlength="100"/></div>
		  <div>
		<span class="texto2">Prazo m&aacute;ximo:</span>  
		<input name="tfProPrazMax" type="text" class="tf1" id="tfProPrazMax" onkeyup="javascript: validarProdutoForm('tfProPrazMax');" size="5" maxlength="2"/>
		</div>
		  <div align="center"><br />
		    <input name="btProCad" type="submit" class="bt1" id="btProCad" value="Cadastrar" />
	      </div>
		</form>
	</body>
</html>
