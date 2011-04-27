<?php
	session_start();
	$nivelAcesso = "../../:2:3:4";
	include_once("../../utils/controladorAcesso.php");
	include_once("../../utils/funcoes.php");
	
	$tfDia = antiSQL(isset($_POST["tfDia"]) ? $_POST["tfDia"] : NULL);
	$slMes = antiSQL(isset($_POST["slMes"]) ? $_POST["slMes"] : NULL);
	$tfAno = antiSQL(isset($_POST["tfAno"]) ? $_POST["tfAno"] : NULL);
	
	if($slMes != NULL && $tfAno != NULL && $tfDia != NULL){
		switch($slMes){
			case 1 : $periodo = "Jan-".$tfAno; break;
			case 2 : $periodo = "Fev-".$tfAno; break;
			case 3 : $periodo = "Mar-".$tfAno; break;
			case 4 : $periodo = "Abr-".$tfAno; break;
			case 5 : $periodo = "Mai-".$tfAno; break;
			case 6 : $periodo = "Jun-".$tfAno; break;
			case 7 : $periodo = "Jul-".$tfAno; break;
			case 8 : $periodo = "Ago-".$tfAno; break;
			case 9 : $periodo = "Set-".$tfAno; break;
			case 10 : $periodo = "Out-".$tfAno; break;
			case 11 : $periodo = "Nov-".$tfAno; break;
			case 12 : $periodo = "Dez-".$tfAno; break;
		}
		$data = $tfAno."/".$slMes."/".$tfDia;
		
		include_once("../../utils/ConectarMySQL.class.php");
		$conexao = new ConectarMySQL();
		include_once("../../dao/DAOParametro.class.php");
		$dao = new DAOParametro($periodo, 1, $data, NULL, "../../", $conexao);
		include_once("../../dao/DAOLog.class.php");
		$log = new DAOLog($_SESSION["pessoa"], 3, $_SESSION["nivel"], $_SESSION["codigo"], 11, "Abriu=\'".$periodo."\'", "../../", $conexao);
		if($dao->cadastrar() && $log->cadastrar())
			$conexao->commit();
		else
			$conexao->rollback();
		header("Location: cadParametro.php?cad=ok");
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
		<script type="text/javascript" language="javascript" src="../../scripts/javascript/parametro.js"></script>
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
		<form id="parametroAbrir" name="periodoAbrir" method="post" action="#" onsubmit="javascript: return validarParametroCadSubmit();">
		  <div><span class="texto2">Abrir per&iacute;odo : 
		  M&ecirc;s</span>
		  <select name="slMes" class="tf1" id="slMes" onchange="javascript: validarParametroForm('slMes');">
		    <option value="---" selected="selected">------------</option>
		    <option value="1">janeiro</option>
		    <option value="2">fevereiro</option>
		    <option value="3">mar&ccedil;o</option>
		    <option value="4">abril</option>
		    <option value="5">maio</option>
		    <option value="6">junho</option>
		    <option value="7">julho</option>
		    <option value="8">agosto</option>
		    <option value="9">setembro</option>
		    <option value="10">outubro</option>
		    <option value="11">novembro</option>
		    <option value="12">dezembro</option>
	      </select>
		  <span class="texto2">, Ano</span>: 
		  <input name="tfAno" type="text" class="tf1" id="tfAno" onkeyup="javascript: validarParametroForm('tfAno');" size="10" maxlength="4"/>
		  </div>
		  <div>
		  <span class="texto2">Dia do corte:</span>
		  <input name="tfDia" type="text" class="tf1" id="tfDia" onkeyup="javascript: validarParametroForm('tfDia');" size="10" maxlength="2" />
		  </div>
		  <div align="center"><br />
	        <input name="btAbrir" type="submit" class="bt1" id="btAbrir" value="Abrir" />
	        </label>
	        </div>
		</form>
	</body>
</html>
