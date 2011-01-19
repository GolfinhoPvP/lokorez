<?php
	session_start();
	$tipo = isset($_GET["tipo"]) ? $_GET["tipo"] : NULL;
	
	$slTipo = isset($_POST["slTipo"]) ? $_POST["slTipo"] : NULL;
	$slPesRef = isset($_POST["slPesRef"]) ? $_POST["slPesRef"] : NULL;
	
	if($slTipo != NULL && $slPesRef != NULL){
		include_once("../../utils/ConectarMySQL.class.php");
		$conexao = new ConectarMySQL();
		switch($slTipo){
			case "admin" : 
				include_once("../../dao/DAOAdministrador.class.php");
				$dao = new DAOAdministrador(NULL, NULL, NULL, NULL, "../../", $conexao);
				include_once("../../dao/DAOLog.class.php");
				$log = new DAOLog($_SESSION["pessoa"], 5, $_SESSION["nivel"], $_SESSION["codigo"], 8, "id=\'".$slPesRef."\'", "../../", $conexao);
				if($dao->deletar($slPesRef) && $log->cadastrar())
					$conexao->commit();
				else
					$conexao->rollback();
				break;
			case "contato" :
				include_once("../../dao/DAOBancoPessoa.class.php");
				$dao = new DAOBancoPessoa(NULL, NULL, "../../", $conexao);
				include_once("../../dao/DAOLog.class.php");
				$log = new DAOLog($_SESSION["pessoa"], 5, $_SESSION["nivel"], $_SESSION["codigo"], 7, "id=\'".$slPesRef."\'", "../../", $conexao);
				if($dao->deletar("", $slPesRef) && $log->cadastrar())
					$conexao->commit();
				else
					$conexao->rollback();
				break;
		}
		header("Location: delPessoa.php");
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
			@import url("../../scripts/css/pessoa.css");
			-->
		</style>
	<script type="text/javascript" language="javascript" src="../../scripts/javascript/ajax.js"></script>
	<script type="text/javascript" language="javascript" src="../../scripts/javascript/pessoa.js"></script>
	<script type="text/javascript" language="javascript">
		window.onload = function(){
			switch(document.getElementById("tipo").innerHTML){
				case "B" :
					document.getElementById("slTipo").value = "contato";
					carregarLista();
					break;
				case "A" :
					document.getElementById("slTipo").value = "admin";
					carregarLista();
					break;
				default : document.getElementById("slTipo").value = "---"; break;
			}
		}
		function carregarLista(){
			xmlRequest = getXMLHttp();
		
			xmlRequest.open("GET",'../pesquisar/getPessoasSL.php?classe='+document.getElementById('slTipo').value,true);
			
			if (xmlRequest.readyState == 1) {
				document.getElementById("carregando").innerHTML = "<img src='../../imagens/rotating_arrow.gif' width='20px' height='20px' />";
			}
			xmlRequest.onreadystatechange = function () {
					if (xmlRequest.readyState == 4){
						document.getElementById("carregando").innerHTML = "";
						document.getElementById("slPesRef").innerHTML = xmlRequest.responseText;
					}
			}
			xmlRequest.send(null);						
		}
	</script>
</head>

<body>
<div id="carregando">
</div>
<div id="tipo" style="visibility:hidden"><?php echo($tipo); ?></div>
<form id="form1" name="form1" method="post" action="#" onsubmit="javascript: return validarPessoaDelSubmit();">
  <div id="sletorTipo" >
    <p>Selecione o tipo de cadastro:
      <select name="slTipo" id="slTipo" onchange="javascript: carregarLista(); validarPessoaForm('slTipo'); ">
          <option value="---" selected="selected">----------------------</option>
          <option value="contato">Contato</option>
          <option value="admin">Administrador</option>
      </select>
      <br />
    <div id="pesRef"> Seleione o cadastro: 
      <select name="slPesRef" id="slPesRef" onchange="javascript: validarPessoaForm('slPesRef');">
        <option value="---" selected="selected">-----------------------------</option>
      </select>
    </div>
  </div>
  <br />
<input name="btDelPes" type="submit" id="btDelPes" value="Deletar" />
</p>
</form>
</body>
</html>
