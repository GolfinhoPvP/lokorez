<?php
	session_start();
	$nivelAcesso = "../../:2:3:4";
	include_once("../../utils/controladorAcesso.php");
	include_once("../../utils/funcoes.php");
	$tipo = antiSQLisset(isset($_GET["tipo"]) ? $_GET["tipo"] : NULL);
	
	$slTipo = antiSQLisset(isset($_POST["slTipo"]) ? $_POST["slTipo"] : NULL);
	$slPesRef = antiSQLisset(isset($_POST["slPesRef"]) ? $_POST["slPesRef"] : NULL);
	
	if($slTipo != NULL && $slPesRef != NULL){
		include_once("../../utils/ConectarMySQL.class.php");
		$conexao = new ConectarMySQL();
		
		include_once("../../dao/DAOPessoa.class.php");
		include_once("../../beans/Pessoa.class.php");
		$dao = new DAOPessoa(NULL, NULL, NULL, "../../", $conexao);
		$pessoa = new Pessoa(NULL, NULL, NULL, NULL);
		$pessoa = $dao->getPessoa($slPesRef);
		
		switch($slTipo){
			case "admin" : 
				include_once("../../dao/DAOAdministrador.class.php");
				$dao = new DAOAdministrador(NULL, NULL, NULL, NULL, NULL, "../../", $conexao);
				include_once("../../beans/Administrador.class.php");
				$administrador = new Administrador(NULL, NULL, NULL, NULL, NULL, NULL);
				$administrador = $dao->getAdministrador("codPes", $pessoa->getCodigo());
				break;
			case "contato" :
				include_once("../../dao/DAOBancoPessoa.class.php");
				$dao = new DAOBancoPessoa(NULL, NULL, "../../", $conexao);
				include_once("../../beans/BancoPessoa.class.php");
				$bancoPessoa = new BancoPessoa(NULL, NULL);
				$bancoPessoa = $dao->getBancoPessoa($pessoa->getCodigo());
				
				include_once("../../dao/DAOBanco.class.php");
				$dao = new DAOBanco(NULL, NULL, "../../", $conexao);
				include_once("../../beans/Banco.class.php");
				$banco = new Banco(NULL, NULL);
				$banco = $dao->getBanco($bancoPessoa->getBanCodigo());
				break;
		}
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
    <p><span class="texto2">Selecione o tipo de cadastro:</span>
      <select name="slTipo" class="tf1" id="slTipo" onchange="javascript: carregarLista(); validarPessoaForm('slTipo'); ">
          <option value="---" selected="selected">----------------------</option>
          <option value="contato">Contato</option>
          <option value="admin">Administrador</option>
      </select>
      <br />
    <div id="pesRef"> <span class="texto2">Seleione o cadastro:</span> 
      <select name="slPesRef" class="tf1" id="slPesRef" onchange="javascript: validarPessoaForm('slPesRef');">
        <option value="---" selected="selected">-----------------------------</option>
      </select>
    </div>
  </div>
  <div align="center"><br />
    <input name="btPesPes" type="submit" class="bt1" id="btPesPes" value="Pesquisar" />
    </p>
  </div>
</form>
<?php 
	if($slTipo != NULL && $slPesRef != NULL){
		include("includePessoaBox.php");
		$conexao->commit();
	}
?>
</body>
</html>
