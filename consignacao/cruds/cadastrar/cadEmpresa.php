<?php
	session_start();
	$nivelAcesso = "../../:2:3:4";
	include_once("../../utils/controladorAcesso.php");
	$desc = isset($_POST["tfEmpDesc"]) ? $_POST["tfEmpDesc"] : NULL;
	if($desc != NULL){
		include_once("../../utils/ConectarMySQL.class.php");
		$conexao = new ConectarMySQL();
		include_once("../../dao/DAOEmpresa.class.php");
		$dao = new DAOEmpresa($desc, "../../", $conexao);
		include_once("../../dao/DAOLog.class.php");
		$log = new DAOLog($_SESSION["pessoa"], 3, $_SESSION["nivel"], $_SESSION["codigo"], 2, "valor=\'".$desc."\'", "../../", $conexao);
		if($dao->cadastrar() && $log->cadastrar())
			$conexao->commit();
		else
			$conexao->rollback();
		header("Location: cadEmpresa.php?cad=ok");
		die();
	}
	$cad = isset($_GET["cad"]) ? $_GET["cad"] : NULL;
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
		<script type="text/javascript" language="javascript" src="../../scripts/javascript/empresa.js"></script>
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
		<br/>
		<form id="empresaCadastro" name="empresaCadastro" method="post" action="#" onsubmit="javascript: return validarDescricaoEmpresa('empresaCadastro');">
		  <label><span class="texto2">Insira o nome da empresa:</span> 
		  <input name="tfEmpDesc" type="text" class="tf1" id="tfEmpDesc" onkeyup="javascript: validarDescricaoEmpresa('empresaCadastro');" size="50" maxlength="100"/>
		  </label>
		  <label>
		  <input name="btEmpCad" type="submit" class="bt1" id="btEmpCad" value="Cadastrar" />
		  </label>
		</form>
	</body>
</html>
