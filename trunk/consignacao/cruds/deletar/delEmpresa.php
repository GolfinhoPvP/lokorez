<?php
	$empDel = isset($_POST["slEmpRef"]) ? $_POST["slEmpRef"] : NULL;
	if($empDel != NULL){
		include_once("../../dao/DAOEmpresa.class.php");
		$dao = new DAOEmpresa(NULL, "../../");
		$dao->deletar($empDel);
		header("Location: delEmpresa.php");
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
			 	loadContent('../../utils/getEmpresas.php', 'slEmpRef', '../../');
			}
		</script>
	</head>
	<body>
		<div id="carregando">
		</div>
		<form id="empresaDeletar" name="empresaDeletar" method="post" action="#" onsubmit="javascript: return validarDeletarEmpresa('empresaDeletar');">
		  <label>Selecione a empresa a ser alterada: 
		  <select name="slEmpRef" id="slEmpRef" onchange="javascript: return validarDeletarEmpresa('empresaDeletar');">
		    <option value="---">-----------------------------</option>
	      </select>
		  <br />
		  </label>
		  <label>
		  <input name="btEmpDel" type="submit" id="btEmpDel" value="Deletar" />
		  </label>
		</form>
	</body>
</html>
