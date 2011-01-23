<?php
	session_start();
	$nivelAcesso = "../../:2:3:4";
	include_once("../../utils/controladorAcesso.php");
	
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
					header("Location: altPessoa.php?alt=ok");
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
					header("Location: altPessoa.php?alt=ok");
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
	<script type="text/javascript" language="javascript" src="../../scripts/javascript/pessoa.js"></script>
	<script type="text/javascript" language="javascript" src="../../scripts/javascript/pessoaAlt.js"></script>
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
<div id="alt" style="visibility:hidden; position:absolute"></div>
<div id="bancosAlt" style="visibility:hidden; position:absolute"></div>
<div id="carregando">
</div>
<div id="valor" style="visibility:hidden"><?php echo($banco); ?></div>
<div id="tipo" style="visibility:hidden"><?php echo($tipo); ?></div>
<form id="form1" name="form1" method="post" action="<?php echo($destino); ?>" onsubmit="javascript: return validarPessoaAltSubmit();">
  <div id="sletorTipo" >
    <p><span class="texto2">Selecione o tipo de cadastro a ser alterado:</span>
      <select name="slTipo" class="tf1" id="slTipo" onchange="javascript: carregarLista(); validarPessoaForm('slTipo'); testarTipo();">
          <option value="---" selected="selected">----------------------</option>
          <option value="contato">Contato</option>
          <option value="admin">Administrador</option>
      </select>
      <br />
    <div id="pesRef"> <span class="texto2">Seleione o cadastro:</span> 
      <select name="slPesRef" class="tf1" id="slPesRef" onchange="javascript: validarPessoaForm('slPesRef'); testarTipo(); carregarAlteracoes();">
        <option value="---" selected="selected">-----------------------------</option>
    </select></div>
    </p>
  </div><div id="geral">
  <span class="texto2">Nome:</span> 
<input name="tfNome" type="text" class="tf1" id="tfNome" onkeyup="javascript: validarPessoaForm('tfNome');" size="75" maxlength="150"/>
  <br />
  <span class="texto2">CPF:  </span>
  <input name="tfCPF" type="text" class="tf1" id="tfCPF" onkeyup="javascript: validarPessoaForm('tfCPF');" size="14" maxlength="14" />

<br/></div>
  <div id="fones">
<div id="foneCads"></div>
<input name="tfFoneCont" type="text" class="tf1" id="tfFoneCont" style="visibility:hidden" value="0" size="5" maxlength="5"/>
<input name="btMaisFones" type="button" class="bt1" id="btMaisFones" onclick="javascript: addTel('telefone');" value="+ Telefones" />
<div id="fonesAuto"></div>
<div id="telefone">
</div></div>
<div id="apenasContato">
<div id="bancoAdd"><input name="tfBanCont" type="text" class="tf1" id="tfBanCont" style="visibility:hidden" value="0" size="5" maxlength="5"/>
<input name="btMaisBancos" type="button" class="bt1" id="btMaisBancos" onclick="javascript: addBan('banco');" value="+ Bancos" />
<div id="bancoAuto"></div><div id="banco"></div>
</div>

<br />
<div id="apenasAdmin">
<span class="texto2">Nome de usu&aacute;rio:</span>
<input name="tfNomeUsuario" type="text" class="tf1" id="tfNomeUsuario" onkeyup="javascript: validarPessoaForm('tfNomeUsuario');" size="25" maxlength="25"/>
<br />
<span class="texto2">Digite uma senha:</span>
<input name="tfSenha1" type="password" class="tf1" id="tfSenha1" onkeyup="javascript: validarPessoaForm('tfSenha1');" size="20" maxlength="15"/>
<br />
<span class="texto2">Confirme a senha:</span>
<input name="tfSenha2" type="password" class="tf1" id="tfSenha2" onkeyup="javascript: validarPessoaForm('tfSenha2'); verificarIgualdade();" size="20" maxlength="15"/>
<br />
<span class="texto2">N&iacute;vel de acesso:
<label></label>
</span>
<label><select name="slNivel" class="tf1" id="slNivel" onchange="javascript: validarPessoaForm('slNivel');">
  <option value="---" selected="selected">----------------------------</option>
</select>
</label>
</div>
</div>
<div align="center"><br />
    <input name="btAltPes" type="submit" class="bt1" id="btAltPes" value="Alterar" />
    </p>
</div>
</form>
</body>
</html>
