<?php
	session_start();
	$nivelAcesso = "../../:2:3:4";
	include_once("../../utils/controladorAcesso.php");
	include_once("../../utils/funcoes.php");
	$slBancRef = antiSQL(isset($_POST["slBancRef"]) ? $_POST["slBancRef"] : NULL);
	if($slBancRef != NULL){
		include_once("../../utils/ConectarMySQL.class.php");
		$conexao = new ConectarMySQL();
		include_once("../../dao/DAOLog.class.php");
		$log = new DAOLog($_SESSION["pessoa"], 5, $_SESSION["nivel"], $_SESSION["codigo"], 3, "id=\'".$slBancRef."\'", "../../", $conexao);
		include_once("../../dao/DAOBanco.class.php");
		$dao = new DAOBanco(NULL, NULL, "../../", $conexao);
		if($dao->deletar($slBancRef) && $log->cadastrar())
			$conexao->commit();
		else
			$conexao->rollback();
		header("Location: delBanco.php?del=ok");
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
		<script type="text/javascript" language="javascript" src="../../scripts/javascript/banco.js"></script>
		<script type="text/javascript" language="javascript">
			 window.onload = function(){
			 	loadContent('../pesquisar/getBancosSL.php', 'slBancRef', '../../');
			}
		</script>
	</head>
	<body>
		<?php
			if($del != NULL){
				$tipo = "del";
				$toRoot = "../../";
				include("../../includes/confirmar.php");
			}else{
				echo('<div id="confirmar"></div>');
			}
		?>
		<div id="alt" style="visibility:hidden; position:absolute">
		</div>
		<div id="carregando">		</div>
		<form id="bancoDeletar" name="bancoDeletar" method="post" action="#"  onsubmit="javascript: return validarDeletarBanco('bancoDeletar');">
		  <div><span class="texto2">Banco a ser deletado:</span>
		<select name="slBancRef" class="tf1" id="slBancRef" onchange="javascript: validarBancoForm('slBancRef');">
          <option value="---" selected="selected">---------------------------</option>
        </select></div>
		  <br />
		  <br/>
		  <br/>
		  <div align="center">
	      <input name="btBanDel" type="submit" class="bt1" id="btBanDel" value="Deletar" />
	        </div>
		</form>
	</body>
</html>
