<?php
	session_start();
	$nivelAcesso = "../../:2:3:4";
	include_once("../../utils/controladorAcesso.php");
	$slVerRef = isset($_POST["slVerRef"]) ? $_POST["slVerRef"] : NULL;
	
	if($slVerRef != NULL){
		include_once("../../utils/ConectarMySQL.class.php");
		$conexao = new ConectarMySQL();
		include_once("../../dao/DAOVerba.class.php");
		include_once("../../dao/DAOLog.class.php");
		$dao = new DAOVerba(NULL, NULL, NULL, NULL, NULL, "../../", $conexao);
		$log = new DAOLog($_SESSION["pessoa"], 5, $_SESSION["nivel"], $_SESSION["codigo"], 9, "Log id=\'".$slVerRef."\'", "../../", $conexao);
		if($dao->deletar($slVerRef) && $log->cadastrar())
			$conexao->commit();
		else
			$conexao->rollback();
		header("Location: delVerba.php?del=ok");
		die();
	}
	$alt = isset($_GET["del"]) ? $_GET["del"] : NULL;
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
			 	loadContent('../pesquisar/getVerbasSL.php', 'slVerRef', '../../');
			}
		</script>
	</head>
	<body>
		<?php
			if($alt != NULL){
				$tipo = "del";
				$toRoot = "../../";
				include("../../includes/confirmar.php");
			}else{
				echo('<div id="confirmar"></div>');
			}
		?>
		<br/>
		</div><div id="carregando"></div>
		<form id="verbaDeletar" name="verbaDeletar" method="post" action="#" onsubmit="javascript: return validarVerForm('slVerRef');">
		  <div><span class="texto2">
		  Selecione a verba a ser alterada:</span> 
		  <select name="slVerRef" class="tf1" id="slVerRef" onchange="javascript: validarVerForm('slVerRef');">
		    <option value="---">-----------------------------</option>
	      </select>
		  <br />
		  <br />
		  <br />
		  </div>
		  <div align="center"><br />
		    <input name="btVerDel" type="submit" class="bt1" id="btVerDel" value="Deletar" />
		  </div>
		</form>
	</body>
</html>
