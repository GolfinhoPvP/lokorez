<?php
	session_start();
	$tipo = isset($_GET["tipo"]) ? $_GET["tipo"] : NULL;
	$banco = isset($_GET["banco"]) ? $_GET["banco"] : NULL;
	$cadastrar = isset($_GET["cadastrar"]) ? $_GET["cadastrar"] : NULL;
	
	$tfNome = isset($_POST["tfNome"]) ? $_POST["tfNome"] : NULL;
	$tfCPF = isset($_POST["tfCPF"]) ? $_POST["tfCPF"] : NULL;
	
	$tfFoneCont = isset($_POST["tfFoneCont"]) ? $_POST["tfFoneCont"] : NULL;
	
	if(strlen($tipo) == 0)
		$tipo = isset($_POST["slTipo"]) ? $_POST["slTipo"] : NULL;
	
	if(($tipo == "contato" || $tipo == "admin") && $cadastrar == "ok"){
		include_once("../../utils/ConectarMySQL.class.php");
		$conexao = new ConectarMySQL();
		$comitar = true;
		switch($tipo){
			case "admin" :
				$classe = "A";
				$tfNomeUsuario = isset($_POST["tfNomeUsuario"]) ? $_POST["tfNomeUsuario"] : NULL;
				$tfSenha1 = isset($_POST["tfSenha1"]) ? $_POST["tfSenha1"] : NULL;
				$tfSenha2 = isset($_POST["tfSenha2"]) ? $_POST["tfSenha2"] : NULL;
				$slNivel = isset($_POST["slNivel"]) ? $_POST["slNivel"] : NULL;
				break;
				
			case "contato" :
				$classe = "B"; 
				$slBancRef = isset($_POST["slBancRef"]) ? $_POST["slBancRef"] : NULL;
				break;
		}
		
		$pesCod = NULL;
		if($tfNome != NULL || $tfCPF != NULL){
			if(strlen($tfCPF) == 0)
				$tfCPF = NULL;
			include_once("../../dao/DAOPessoa.class.php");
			$dao = new DAOPessoa($tfNome, $tfCPF, $classe, "../../", $conexao);
			include_once("../../dao/DAOLog.class.php");
			$log = new DAOLog($_SESSION["pessoa"], 3, $_SESSION["nivel"], $_SESSION["codigo"], 5, "nome=\'".$tfNome."\'", "../../", $conexao);
			if(!$dao->cadastrar() || !$log->cadastrar())
				$comitar = false;
			if($tfCPF == NULL)
				$tfCPF = "%";
			$linha = mysqli_fetch_array($dao->pesquisar($tfNome.":".$tfCPF.":".$classe));
			$pesCod = $linha["pes_codigo"];
		}else{
			$comitar = false;
		}
			
		for($x=1; $x < $tfFoneCont+1; $x++){
			eval("\$tfPesFone[$x] = isset(\$_POST[\"tfPesFone$x\"]) ? \$_POST[\"tfPesFone$x\"] : NULL;");
			if($tfPesFone[$x] != NULL && preg_match("/^[0-9]{2,2}-[0-9]{4,4}-[0-9]{4,4}$/", $tfPesFone[$x])){
				include_once("../../dao/DAOTelefone.class.php");
				$dao = new DAOTelefone($pesCod, $tfPesFone[$x], "../../", $conexao);
				include_once("../../dao/DAOLog.class.php");
				$log = new DAOLog($_SESSION["pessoa"], 3, $_SESSION["nivel"], $_SESSION["codigo"], 6, "numero=\'".$tfPesFone[$x]."\'", "../../", $conexao);
				if(!$dao->cadastrar() || !$log->cadastrar())
					$comitar = false;
			}else{
				$comitar = false;
			}
		}
		
		switch($tipo){
			case "admin" :
				if($tfNomeUsuario != NULL || (strcmp($tfSenha1, $tfSenha2) !=0) || $slNivel != NULL){
					if(strlen($tfCPF) == 0)
						$tfCPF = NULL;
					include_once("../../dao/DAOAdministrador.class.php");
					$dao = new DAOAdministrador($pesCod, $slNivel, $tfNomeUsuario, $tfSenha1, "../../", $conexao);
					include_once("../../dao/DAOLog.class.php");
					$log = new DAOLog($_SESSION["pessoa"], 3, $_SESSION["nivel"], $_SESSION["codigo"], 8, "nome usuário=\'".$tfNomeUsuario."\'", "../../", $conexao);
					if(!$dao->cadastrar() || !$log->cadastrar())
						$comitar = false;
					if($comitar)
						$conexao->commit();
					else
						$conexao->rollback();
					header("Location: cadPessoa.php");
					die();
				}else{
					$comitar = false;
				}
				break;
				
			case "contato" :
				if($slBancRef != NULL || $pesCod != NULL){
					include_once("../../dao/DAOBancoPessoa.class.php");
					$dao = new DAOBancoPessoa($slBancRef, $pesCod, "../../", $conexao);
					include_once("../../dao/DAOLog.class.php");
					$log = new DAOLog($_SESSION["pessoa"], 3, $_SESSION["nivel"], $_SESSION["codigo"], 7, "id=\'".$slBancRef."+".$pesCod."\'", "../../", $conexao);
					if(!$dao->cadastrar() || !$log->cadastrar())
						$comitar = false;
					if($comitar)
						$conexao->commit();
					else
						$conexao->rollback();
					header("Location: cadPessoa.php");
					die();
				}else{
					$comitar = false;
				}
				break;
		}
		if($comitar)
			$conexao->commit();
		else
			$conexao->rollback();
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
			//carregarLista();
			//loadContent('../pesquisar/getNiveisSL.php', 'slNivel', '../../');
			switch(document.getElementById("tipo").innerHTML){
				case "contato" : document.getElementById("slTipo").value = "contato"; break;
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
					mostrar("geral");
					break;
				case "admin" :
					esconder("apenasContato");
					mostrar("apenasAdmin");
					mostrar("geral");
					break;
				default :
					esconder("apenasAdmin");
					esconder("apenasContato");
					esconder("geral");
					break;
			}
			validarPessoaForm("slTipo");
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
						//document.getElementById('slBancRef').value = document.getElementById("valor").innerHTML;
					}
			}
			xmlRequest.send(null);						
		}
		function carregarAlteracoes(){
			xmlRequest = getXMLHttp();

			xmlRequest.open("GET",'../pesquisar/getBancosPessoasLista.php?classe='+document.getElementById('slTipo').value,true);
			
			if (xmlRequest.readyState == 1) {
				document.getElementById("carregando").innerHTML = "<img src='../../imagens/rotating_arrow.gif' width='20px' height='20px' />";
			}
			xmlRequest.onreadystatechange = function () {
					if (xmlRequest.readyState == 4){
						document.getElementById("carregando").innerHTML = "";
						document.getElementById("alt").innerHTML = xmlRequest.responseText;
						carregarBancos();
						//document.getElementById('slBancRef').value = document.getElementById("valor").innerHTML;
					}
			}
			xmlRequest.send(null);						
		}
		function carregarBancos(){
			xmlRequest2 = getXMLHttp();

			xmlRequest2.open("GET",'../pesquisar/getBancosSL.php',true);
			
			if (xmlRequest2.readyState == 1) {
				document.getElementById("carregando").innerHTML = "<img src='../../imagens/rotating_arrow.gif' width='20px' height='20px' />";
			}
			xmlRequest2.onreadystatechange = function () {
					if (xmlRequest2.readyState == 4){
						document.getElementById("carregando").innerHTML = "";
						//document.getElementById("alt").innerHTML += xmlRequest2.responseText;
						contador = parseInt(document.getElementById("BPQuantidade").innerHTML);
						for(x=1; x<=contador; x++){
							document.getElementById("apenasContato").innerHTML += '&Eacute; contato do banco: <select name="slBancRef'+contador+'" id="slBancRef'+contador+'" onchange="javascript: validarPessoaForm(\'slBancRef\');">'+xmlRequest2.responseText+'</select>';
							document.getElementById(("slBancRef"+contador)).value = document.getElementById(("cB"+contador)).innerHTML;
						}
					}
			}
			xmlRequest2.send(null);
		}
	</script>
</head>

<body>
<div id="alt" style="visibility:hidden; position:absolute"></div>
<div id="carregando">
</div>
<div id="valor" style="visibility:hidden"><?php echo($banco); ?></div>
<div id="tipo" style="visibility:hidden"><?php echo($tipo); ?></div>
<form id="form1" name="form1" method="post" action="<?php echo($destino); ?>" onsubmit="javascript: return validarPessoaAltSubmit();">
  <div id="sletorTipo" >
    <p>Selecione o tipo de cadastro:
      <select name="slTipo" id="slTipo" onchange="javascript: carregarLista(); validarPessoaForm('slTipo'); testarTipo();">
          <option value="---" selected="selected">----------------------</option>
          <option value="contato">Contato</option>
          <option value="admin">Administrador</option>
      </select>
      <br />
    <div id="pesRef"> Seleione o cadastro: 
      <select name="slPesRef" id="slPesRef" onchange="javascript: validarPessoaForm('slPesRef'); testarTipo(); carregarAlteracoes();">
        <option value="---" selected="selected">-----------------------------</option>
      </select></div>
    </p>
  </div><div id="geral">
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
</div>
<br />
<div id="apenasAdmin">
Nome de usu&aacute;rio:
<input name="tfNomeUsuario" type="text" id="tfNomeUsuario" size="25" maxlength="25" onkeyup="javascript: validarPessoaForm('tfNomeUsuario');"/>
<br />
Digite uma senha: 
<input name="tfSenha1" type="password" id="tfSenha1" size="20" maxlength="15" onkeyup="javascript: validarPessoaForm('tfSenha1');"/>
<br />
Confirme a senha:
<input name="tfSenha2" type="password" id="tfSenha2" size="20" maxlength="15" onkeyup="javascript: validarPessoaForm('tfSenha2'); verificarIgualdade();"/>
<br />
N&iacute;vel de acesso:
<label>
<select name="slNivel" id="slNivel" onchange="javascript: validarPessoaForm('slNivel');">
  <option value="---" selected="selected">----------------------------</option>
</select>
</label>
</div></div>
<br />
<input name="btAltPes" type="submit" id="btAltPes" value="Alterar" />
</p>
</form>
</body>
</html>
