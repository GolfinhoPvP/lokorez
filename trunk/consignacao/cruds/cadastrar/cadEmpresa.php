<?php
	$desc = isset($_POST["tfEmpDesc"]) ? $_POST["tfEmpDesc"] : NULL;
	if($desc != NULL){
		include_once("../../dao/DAOEmpresa.class.php");
		$dao = new DAOEmpresa($desc, "../../");
		$dao->cadastrar();
		header("Location: cadEmpresa.php");
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
		<script type="text/javascript" language="javascript" src="../../scripts/javascript/empresa.js"></script>
	</head>
	<body>
		<form id="empresaCadastro" name="empresaCadastro" method="post" action="#" onsubmit="javascript: return validarDescricaoEmpresa('empresaCadastro');">
		  <label>Insira o nome da empresa: 
		  <input name="tfEmpDesc" type="text" id="tfEmpDesc" size="50" maxlength="100" onkeyup="javascript: validarDescricaoEmpresa('empresaCadastro');"/>
		  </label>
		  <label>
		  <input name="btEmpCad" type="submit" id="btEmpCad" value="Cadastrar" />
		  </label>
		</form>
	</body>
</html>
