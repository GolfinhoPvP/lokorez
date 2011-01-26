<?php
	session_start();
	$nivelAcesso = "../../:2:3:4";
	include_once("../../utils/controladorAcesso.php");
	include_once("../../utils/funcoes.php");
	$tfVerba = antiSQL(isset($_POST["tfVerba"]) ? $_POST["tfVerba"] : NULL);
	$slEmpRef = antiSQL(isset($_POST["slEmpRef"]) ? $_POST["slEmpRef"] : NULL);
	$slBancRef = antiSQL(isset($_POST["slBancRef"]) ? $_POST["slBancRef"] : NULL);
	$slProRef = antiSQL(isset($_POST["slProRef"]) ? $_POST["slProRef"] : NULL);
	$tfVerDesc = antiSQL(isset($_POST["tfVerDesc"]) ? $_POST["tfVerDesc"] : NULL);
	
	if($tfVerba != NULL && $slEmpRef != NULL && $slBancRef != NULL && $slProRef != NULL && $tfVerDesc != NULL){
		include_once("../../utils/ConectarMySQL.class.php");
		$conexao = new ConectarMySQL();
		include_once("../../dao/DAOVerba.class.php");
		include_once("../../dao/DAOLog.class.php");
		$dao = new DAOVerba($tfVerba, $slEmpRef, $slBancRef, $slProRef, $tfVerDesc, "../../", $conexao);
		$log = new DAOLog($_SESSION["pessoa"], 3, $_SESSION["nivel"], $_SESSION["codigo"], 9, "id=\'".$tfVerba."\'", "../../", $conexao);
		if($dao->cadastrar() && $log->cadastrar())
			$conexao->commit();
		else
			$conexao->rollback();
		header("Location: cadVerba.php?cad=ok");
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
		<script type="text/javascript" language="javascript" src="../../scripts/javascript/ajax.js"></script>
		<script type="text/javascript" language="javascript" src="../../scripts/javascript/verba.js"></script>
		<script type="text/javascript" language="javascript">
			 window.onload = function(){
			 	carregarEmpresas();
			}
		</script>
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
		<div id="carregando"></div>
		<form id="verbaCadstrar" name="verbaCadstrar" method="post" action="#" onsubmit="javascript: return validarVerCadSubmit();">
		  <div><span class="texto2">Verba:</span> 
	      <input name="tfVerba" type="text" class="tf1" id="tfVerba" onkeyup="javascript: validarVerForm('tfVerba');" size="10" maxlength="10"/></div>
		  <div><span class="texto2">Selecione uma empresa :</span> 
		    <select name="slEmpRef" class="tf1" id="slEmpRef" onchange="javascript: validarVerForm('slEmpRef');">
		    <option value="---">-----------------------------</option>
	      </select></div>
		  <div><span class="texto2">Selecione um banco :</span>
          <select name="slBancRef" class="tf1" id="slBancRef" onchange="javascript: validarVerForm('slBancRef');">
            <option value="---" selected="selected">---------------------------</option>
          </select></div>
		<div><span class="texto2">Selecione um produto:
		</span>
		  <select name="slProRef" id="slProRef" class="tf1" onchange="javascript: validarVerForm('slProRef');">
		  <option value="---">-----------------------------</option>
		</select></div>
		<br />
		  <div><span class="texto2">Descri&ccedil;&atilde;o da verba: </span>
	      <input name="tfVerDesc" type="text" class="tf1" id="tfVerDesc" onkeyup="javascript: validarVerForm('tfVerDesc');" size="50" maxlength="100"/></div>
		  <div align="center"><br />
		    <input name="btVerCad" type="submit" class="bt1" id="btVerCad" value="Cadastrar" />
          </div>
		</form>
	</body>
</html>
