<?php
	session_start();
	$nivelAcesso = "../../:2:3:4";
	include_once("../../utils/controladorAcesso.php");
	$slBancRef = isset($_POST["slBancRef"]) ? $_POST["slBancRef"] : NULL;
	$tfBanCod = isset($_POST["tfBanCod"]) ? $_POST["tfBanCod"] : NULL;
	$tfBanDesc = isset($_POST["tfBanDesc"]) ? $_POST["tfBanDesc"] : NULL;
	
	if($slBancRef != NULL && $tfBanCod != NULL && $tfBanDesc != NULL){
		include_once("../../utils/ConectarMySQL.class.php");
		$conexao = new ConectarMySQL();
		include_once("../../dao/DAOBanco.class.php");
		$dao = new DAOBanco($tfBanCod, $tfBanDesc, "../../", $conexao);
		include_once("../../dao/DAOLog.class.php");
		$log = new DAOLog($_SESSION["pessoa"], 4, $_SESSION["nivel"], $_SESSION["codigo"], 3, "id=\'".$slBancRef."\'", "../../", $conexao);
		if($dao->alterar($slBancRef) && $log->cadastrar())
			$conexao->commit();
		else
			$conexao->rollback();
		header("Location: altBanco.php?alt=ok");
		die();
	}
	$alt = isset($_GET["alt"]) ? $_GET["alt"] : NULL;
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
			function carregarAlteracoes(){
				xmlRequest = getXMLHttp();

				xmlRequest.open("GET",'../pesquisar/getBancoAlt.php?key='+document.getElementById('slBancRef').value,true);
				
				if (xmlRequest.readyState == 1) {
					document.getElementById("carregando").innerHTML = "<img src='../../imagens/rotating_arrow.gif' width='20px' height='20px' />";
				}
				form = document.getElementById('bancoAlterar');
				xmlRequest.onreadystatechange = function () {
						if (xmlRequest.readyState == 4){
							document.getElementById("carregando").innerHTML = "";
							document.getElementById('alt').innerHTML = xmlRequest.responseText;
							form.tfBanCod.value 	= document.getElementById('A').innerHTML;
							form.tfBanDesc.value 	= document.getElementById('B').innerHTML;
						}
				}
				xmlRequest.send(null);						
			}
			function manipularContato(){
				window.location = "../xxxContato.php?banco="+document.getElementById("tfBanCod").value;
			}
		</script>
	</head>
	<body>
		<?php
			if($alt != NULL){
				$tipo = "alt";
				$toRoot = "../../";
				include("../../includes/confirmar.php");
			}else{
				echo('<div id="confirmar"></div>');
			}
		?>
		<br/>
		<div id="alt" style="visibility:hidden; position:absolute">
		</div>
		<div id="carregando">
		</div>
		<form id="bancoAlterar" name="bancoAlterar" method="post" action="#"  onsubmit="javascript: return validarBancoAltSubmit();">
		<div><span class="texto2">Banco a ser alterado:</span>
		<select name="slBancRef" class="tf1" id="slBancRef" onchange="javascript: carregarAlteracoes();">
          <option value="---" selected="selected">---------------------------</option>
        </select></div>
		<div><span class="texto2">Insira o c&oacute;digo do banco:</span>
		<input name="tfBanCod" type="text" class="tf1" id="tfBanCod" onkeyup="javascript: validarBancoForm('tfBanCod');" size="5" maxlength="3"/></div>
		<div><span class="texto2">Descri&ccedil;&atilde;o:</span>
		<input name="tfBanDesc" type="text" class="tf1" id="tfBanDesc" onkeyup="javascript: validarBancoForm('tfBanDesc');" size="50" maxlength="100"/></div>
		<div align="center"><br />
	      <input name="btBanAlt" type="submit" class="bt1" id="btBanAlt" value="Alterar" />
		  </div>
		</form>
	    <br />
	    <input name="btContat" type="button" class="bt1" id="btContat" onclick="javascript: manipularContato();" value="Clique aqui para Adicionar ou Modificar um contato deste banco!"/>
</body>
</html>
