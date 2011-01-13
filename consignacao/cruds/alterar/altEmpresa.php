<?php
	$empAlt = isset($_POST["slEmpDesc"]) ? $_POST["slEmpDesc"] : NULL;
	$desc = isset($_POST["tfEmpDesc"]) ? $_POST["tfEmpDesc"] : NULL;
	if($desc != NULL && $empAlt != NULL){
		include_once("../../dao/DAOEmpresa.class.php");
		$dao = new DAOEmpresa($desc, "../../");
		$dao->alterar($empAlt);
		header("Location: altEmpresa.php");
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
			 	loadContent('../../utils/getEmpresas.php', 'slEmpDesc', '../../');
			}
		</script>
	</head>
	<body>
		<div id="carregando">
		</div>
		<form id="empresaAlterar" name="empresaAlterar" method="post" action="#" onsubmit="javascript: return validarAlterarEmpresa('empresaAlterar');">
		  <label>Selecione a empresa a ser alterada: 
		  <select name="slEmpDesc" id="slEmpDesc">
		    <option value="---">-----------------------------</option>
	      </select>
		  <br />
		  <br />
		  Insira o nome da empresa: 
		  <input name="tfEmpDesc" type="text" id="tfEmpDesc" size="50" maxlength="100" onkeyup="javascript: validarDescricaoEmpresa('empresaAlterar');"/>
		  </label>
		  <label>
		  <input name="btEmpAlt" type="submit" id="btEmpAlt" value="Alterar" />
		  </label>
		</form>
	</body>
</html>
