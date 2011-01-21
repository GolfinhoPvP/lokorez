<?php
	session_start();
	$slPer = isset($_POST["slPer"]) ? $_POST["slPer"] : NULL;
	
	if($slPer != NULL){
		header("Location: cadParametro.php");
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
		<script type="text/javascript" language="javascript" src="../../scripts/javascript/parametro.js"></script>
		<script type="text/javascript" language="javascript">
			window.onload = function(){
				loadContent('../pesquisar/getParametrosSL.php', 'slPer', '../../');
			}
		</script>
	</head>
	<body>
		<div id="carregando">
		</div>
		<form id="periodoEncerrar" name="periodoEncerrar" method="post" action="#" onsubmit="javascript: return validarParametroAltSubmit();">
		  <label>Encerrar per&iacute;odo : 
		  <select name="slPer" id="slPer">
		          <option value="---">--------</option>
          </select><br />
		  <input name="btEncerrar" type="submit" id="btEncerrar" value="Encerrar" />
		  </label>
    </form>
	</body>
</html>
