<?php
	session_start();
	$nivelAcesso = "../../:2:3:4";
	include_once("../../utils/controladorAcesso.php");
	$slEmpRef = isset($_POST["slEmpRef"]) ? $_POST["slEmpRef"] : NULL;
	if($slEmpRef != NULL){
		include_once("../../utils/ConectarMySQL.class.php");
		$conexao = new ConectarMySQL();
		include_once("../../dao/DAOEmpresa.class.php");
		include_once("../../beans/Empresa.class.php");
		$dao = new DAOEmpresa(NULL, "../../", $conexao);
		$empresa = new Empresa(NULL, NULL);
		$empresa = $dao->getEmpresa($slEmpRef);
		$conexao->commit();
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<style type="text/css">
			<!--
			@import url("../../scripts/css/geral.css");
			-->
		</style>
		<script type="text/javascript" language="javascript" src="../../scripts/javascript/ajax.js"></script>
		<script type="text/javascript" language="javascript">
			window.onload = function(){
				loadContent('../pesquisar/getEmpresasSL.php', 'slEmpRef', '../../');
			}
		</script>
	</head>
	
	<body>
		<br/>
		<div id="carregando"></div>
		<div id="confirmar" style="position:absolute"></div>
		<form id="pesEmpresa" name="pesEmpresa" method="post" action="#">
		  <label>
		  <span class="texto2">Selecione uma empresa:</span>
		  <select name="slEmpRef" class="tf1" id="slEmpRef">
		    <option value="---" selected="selected">---</option>
		  </select>
		  </label> 
		  <label>
		  <input name="btPes" type="submit" class="bt1" id="btPes" value="Pesquisar" />
		  </label>
		  <br />
		  <br />
		</form>
		<?php 
			if($slEmpRef != NULL){
				include("includeEmpresaBox.php");
			}
		?>
	</body>
</html>