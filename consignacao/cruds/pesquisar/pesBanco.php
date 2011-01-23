<?php
	session_start();
	$nivelAcesso = "../../:2:3:4";
	include_once("../../utils/controladorAcesso.php");
	$slBancRef = isset($_POST["slBancRef"]) ? $_POST["slBancRef"] : NULL;
	
	if($slBancRef != NULL){
		include_once("../../utils/ConectarMySQL.class.php");
		$conexao = new ConectarMySQL();
		include_once("../../dao/DAOBanco.class.php");
		include_once("../../beans/Banco.class.php");
		$dao = new DAOBanco(NULL, NULL, "../../", $conexao);
		$banco = new Banco(NULL, NULL);
		$banco = $dao->getBanco($slBancRef);
	}
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
		<br/>
		<div id="carregando"></div>
		<div id="confirmar" style="position:absolute"></div>
		<form id="bancoPesquisar" name="bancoPesquisar" method="post" action="#"  onsubmit="javascript: return validarDeletarBanco('bancoPesquisar');">
		<div><span class="texto2">Banco a ser alterado:</span>
		<select name="slBancRef" class="tf1" id="slBancRef">
          <option value="---" selected="selected">---------------------------</option>
        </select></div>
		<div align="center"><br />
	      <input name="btBanPes" type="submit" class="bt1" id="btBanPes" value="Pesquisar" />
		</div>
		</form>
		<?php 
			if($slBancRef != NULL){
				include("includeBancoBox.php");
				$conexao->commit();
			}
		?>
	</body>
</html>
