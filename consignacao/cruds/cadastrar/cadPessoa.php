<?php
	session_start();
	$tipo = isset($_GET["tipo"]) ? $_GET["tipo"] : NULL;
	$banco = isset($_GET["banco"]) ? $_GET["banco"] : NULL;
	$cadastrar = isset($_GET["cadastrar"]) ? $_GET["cadastrar"] : NULL;
	
	if(strlen($tipo) == 0)
		$tipo = isset($_POST["slTipo"]) ? $_POST["slTipo"] : NULL;
	
	if($tipo == "contato" && $cadastrar == "ok"){
		$tfNome = isset($_POST["tfNome"]) ? $_POST["tfNome"] : NULL;
		$tfCPF = isset($_POST["tfCPF"]) ? $_POST["tfCPF"] : NULL;
		$slBancRef = isset($_POST["slBancRef"]) ? $_POST["slBancRef"] : NULL;
		$tfFoneCont = isset($_POST["tfFoneCont"]) ? $_POST["tfFoneCont"] : NULL;
		
		$pesCod = NULL;
		if($tfNome != NULL || $tfNome != NULL || $tfNome != NULL){
			if(strlen($tfCPF) == 0)
				$tfCPF = NULL;
			include_once("../../dao/DAOPessoa.class.php");
			$dao = new DAOPessoa($tfNome, $tfCPF, "B", "../../");
			include_once("../../dao/DAOLog.class.php");
			$log = new DAOLog($_SESSION["pessoa"], 3, $_SESSION["nivel"], $_SESSION["codigo"], 5, "nome=\'".$tfNome."\'", "../../");
			$dao->cadastrar();
			$log->cadastrar();
			if($tfCPF == NULL)
				$tfCPF = "%";
			$linha = mysql_fetch_array($dao->pesquisar($tfNome.":".$tfCPF.":B"));
			$pesCod = $linha["pes_codigo"];
		}
			
		for($x=1; $x < $tfFoneCont+1; $x++){
			eval("\$tfPesFone[$x] = isset(\$_POST[\"tfPesFone$x\"]) ? \$_POST[\"tfPesFone$x\"] : NULL;");
			if($tfPesFone[$x] != NULL && preg_match("/^[0-9]{2,2}-[0-9]{4,4}-[0-9]{4,4}$/", $tfPesFone[$x])){
				include_once("../../dao/DAOTelefone.class.php");
				$dao = new DAOTelefone($pesCod, $tfPesFone[$x], "../../");
				include_once("../../dao/DAOLog.class.php");
				$log = new DAOLog($_SESSION["pessoa"], 3, $_SESSION["nivel"], $_SESSION["codigo"], 6, "numero=\'".$tfPesFone[$x]."\'", "../../");
				$dao->cadastrar();
				$log->cadastrar();
			}
		}
		
		if($slBancRef != NULL || $pesCod != NULL){
			include_once("../../dao/DAOBancoPessoa.class.php");
			$dao = new DAOBancoPessoa($slBancRef, $pesCod, "../../");
			include_once("../../dao/DAOLog.class.php");
			$log = new DAOLog($_SESSION["pessoa"], 3, $_SESSION["nivel"], $_SESSION["codigo"], 7, "id=\'".$slBancRef."+".$pesCod."\'", "../../");
			$dao->cadastrar();
			$log->cadastrar();
			header("Location: cadPessoa.php");
			die();
		}
	}
	
	$destino = "cadPessoa.php?tipo=".$tipo."&cadastrar=ok";
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
			carregarAlteracoes();
			switch(document.getElementById("tipo").innerHTML){
				case "contato" :
					document.getElementById("slTipo").value = "contato";
					break;
				case "admin" : document.getElementById("slTipo").value = "admin"; break;
				default : document.getElementById("slTipo").value = "---"; break;
			}
			testarTipo();
		}
		function testarTipo(){
			switch(document.getElementById("slTipo").value){
				case "contato" :
					esconder("apenasAdmin");
					mostrar("apenasContato");
					break;
				case "admin" :
					esconder("apenasContato");
					mostrar("apenasAdmin");
					break;
				default :
					esconder("apenasAdmin");
					esconder("apenasContato");
					break;
			}
		}
		function carregarAlteracoes(){
			xmlRequest = getXMLHttp();

			xmlRequest.open("GET",'../pesquisar/getBancosSL.php',true);
			
			if (xmlRequest.readyState == 1) {
				document.getElementById("carregando").innerHTML = "<img src='../../imagens/rotating_arrow.gif' width='20px' height='20px' />";
			}
			form = document.getElementById('bancoAlterar');
			xmlRequest.onreadystatechange = function () {
					if (xmlRequest.readyState == 4){
						document.getElementById("carregando").innerHTML = "";
						document.getElementById('slBancRef').innerHTML = xmlRequest.responseText;
						document.getElementById('slBancRef').value = document.getElementById("valor").innerHTML;
					}
			}
			xmlRequest.send(null);						
		}
	</script>
</head>

<body>
<div id="carregando">
</div>
<div id="valor" style="visibility:hidden"><?php echo($banco); ?></div>
<div id="tipo" style="visibility:hidden"><?php echo($tipo); ?></div>
<form id="form1" name="form1" method="post" action="<?php echo($destino); ?>" onsubmit="javascript: return validarPessoaCadSubmit();">
  <div id="sletorTipo" >
  Selecione o tipo de cadastro:
  <select name="slTipo" id="slTipo" onchange="javascript: testarTipo();">
    <option value="---" selected="selected">----------------------</option>
    <option value="contato">Contato</option>
    <option value="admin">Administrador</option>
  </select>
  <br />
  </div>
  Nome: 
<input name="tfNome" type="text" id="tfNome" size="75" maxlength="150" onkeyup="javascript: validarPessoaForm('tfNome');"/>
  <br />
CPF: 

<input name="tfCPF" type="text" id="tfCPF" size="14" maxlength="14" onkeyup="javascript: validarPessoaForm('tfCPF');" />

<br/>
<input name="tfFoneCont" type="text" id="tfFoneCont" value="1" size="5" maxlength="5" style="visibility:hidden"/>
<input name="btMaisFones" type="button" id="btMaisFones" value="+ Telefones" onclick="javascript: addTel('telefone');" />
<div id="telefone">Telefone para contato:
<input name="tfPesFone1" type="text" id="tfPesFone1" size="12" maxlength="12" onkeyup="javascript: validarPessoaForm('tfPesFone1');"/>
 Ex: XX-XXXX-XXXX <br/>
</div>
<div id="apenasContato">
Este contato é do banco:
<select name="slBancRef" id="slBancRef" onchange="javascript: validarPessoaForm('slBancRef');">
  <option value="---" selected="selected">---------------------------</option>
</select>
</div>
<br />
<div id="apenasAdmin">
Nome de usu&aacute;rio:
<input name="tfNomeUsuario" type="text" id="tfNomeUsuario" size="25" maxlength="25" />
<br />
Digite uma senha: 
<input name="tfSenha1" type="text" id="tfSenha1" size="20" maxlength="15" />
<br />
Confirme a senha:
<input name="tfSenha2" type="text" id="tfSenha2" size="20" maxlength="15" /></div>
<br />
<input name="btCad" type="submit" id="btCad" value="Cadastrar" />
</p>
</form>
</body>
</html>
