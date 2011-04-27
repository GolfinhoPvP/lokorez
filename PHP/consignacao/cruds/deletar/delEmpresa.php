<?php
	session_start();
	$nivelAcesso = "../../:2:3:4";
	include_once("../../utils/controladorAcesso.php");
	include_once("../../utils/funcoes.php");
	$empDel = antiSQL(isset($_POST["slEmpRef"]) ? $_POST["slEmpRef"] : NULL);
	if($empDel != NULL){
		include_once("../../utils/ConectarMySQL.class.php");
		$conexao = new ConectarMySQL();
		include_once("../../dao/DAOLog.class.php");
		$log = new DAOLog($_SESSION["pessoa"], 5, $_SESSION["nivel"], $_SESSION["codigo"], 2, "id=\'".$slEmpRef."\'", "../../", $conexao);
		include_once("../../dao/DAOEmpresa.class.php");
		$dao = new DAOEmpresa(NULL, "../../", $conexao);
		if($dao->deletar($empDel) && $log->cadastrar())
			$conexao->commit();
		else
			$conexao->rollback();
		header("Location: delEmpresa.php?del=ok");
		die();
	}
	$del = antiSQL(isset($_GET["del"]) ? $_GET["del"] : NULL);
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
		<script type="text/javascript" language="javascript" src="../../scripts/javascript/empresa.js"></script>
		<script type="text/javascript" language="javascript">
			 window.onload = function(){
			 	loadContent('../pesquisar/getEmpresasSL.php', 'slEmpRef', '../../');
			}
		</script>
	</head>
	<body>
		<div id="carregando"></div>
		<?php
			if($del != NULL){
				$tipo = "del";
				$toRoot = "../../";
				include("../../includes/confirmar.php");
			}else{
				echo('<div id="confirmar"></div>');
			}
		?>
		<br/>
		<form id="empresaDeletar" name="empresaDeletar" method="post" action="#" onsubmit="javascript: return validarDeletarEmpresa('empresaDeletar');">
		  <label><span class="texto2">Selecione a empresa a ser alterada:</span> 
		  <select name="slEmpRef" class="tf1" id="slEmpRef" onchange="javascript: return validarDeletarEmpresa('empresaDeletar');">
		    <option value="---">-----------------------------</option>
	      </select>
		  <br />
		  <br />
		  </label>
		  <label></label>
		  <div align="center">
		    <input name="btEmpDel" type="submit" class="bt1" id="btEmpDel" value="Deletar" />
		  </div>
		</form>
	</body>
</html>
