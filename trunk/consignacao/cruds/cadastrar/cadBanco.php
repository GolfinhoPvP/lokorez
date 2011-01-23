<?php
	session_start();
	$nivelAcesso = "../../:2:3:4";
	include_once("../../utils/controladorAcesso.php");
	$tfBanCod = isset($_POST["tfBanCod"]) ? $_POST["tfBanCod"] : NULL;
	$tfBanDesc = isset($_POST["tfBanDesc"]) ? $_POST["tfBanDesc"] : NULL;
	
	$cbNovoContat = isset($_POST["cbNovoContat"]) ? $_POST["cbNovoContat"] : NULL;
	$tfBanContat = NULL;
	
	if($tfBanCod != NULL && $tfBanDesc != NULL){
		include_once("../../utils/ConectarMySQL.class.php");
		$conexao = new ConectarMySQL();
		$comitar = true;
		if($cbNovoContat == "novo"){
			$tfBanContat = isset($_POST["tfBanContat"]) ? $_POST["tfBanContat"] : NULL;
			$tfFoneCont = isset($_POST["tfFoneCont"]) ? $_POST["tfFoneCont"] : NULL;
			
			if($tfBanContat != NULL){
				include_once("../../dao/DAOPessoa.class.php");
				$dao = new DAOPessoa($tfBanContat, NULL, "B", "../../", $conexao);
				include_once("../../dao/DAOLog.class.php");
				$log = new DAOLog($_SESSION["pessoa"], 3, $_SESSION["nivel"], $_SESSION["codigo"], 5, "nome=\'".$tfBanContat."\'", "../../", $conexao);
				if(!$dao->cadastrar() || !$log->cadastrar())
					$comitar = false;
				$resultado = $dao->pesquisar($tfBanContat.":%:B");
				$linha = mysqli_fetch_array($resultado);
				$tfBanContat = $linha["pes_codigo"];
			}else{
				$comitar = false;
			}
			
			for($x=1; $x < $tfFoneCont+1; $x++){
				eval("\$tfPesFone[$x] = isset(\$_POST[\"tfPesFone$x\"]) ? \$_POST[\"tfPesFone$x\"] : NULL;");
				if($tfPesFone[$x] != NULL && preg_match("/^[0-9]{2,2}-[0-9]{4,4}-[0-9]{4,4}$/", $tfPesFone[$x])){
					include_once("../../dao/DAOTelefone.class.php");
					$dao = new DAOTelefone($tfBanContat, $tfPesFone[$x], "../../", $conexao);
					include_once("../../dao/DAOLog.class.php");
					$log = new DAOLog($_SESSION["pessoa"], 3, $_SESSION["nivel"], $_SESSION["codigo"], 6, "numero=\'".$tfPesFone[$x]."\'", "../../", $conexao);
					if(!$dao->cadastrar() || !$log->cadastrar())
						$comitar = false;
				}else if(strcmp($tfPesFone[$x], "") != 0){
					$comitar = false;
				}
			}
		}else{
			$tfBanContat = isset($_POST["slBanContat"]) ? $_POST["slBanContat"] : NULL;
		}
		
		if($tfBanCod != NULL || $tfBanDesc != NULL){
			include_once("../../dao/DAOBanco.class.php");
			$dao = new DAOBanco($tfBanCod, $tfBanDesc, "../../", $conexao);
			include_once("../../dao/DAOLog.class.php");
			$log = new DAOLog($_SESSION["pessoa"], 3, $_SESSION["nivel"], $_SESSION["codigo"], 3, "id=\'".$tfBanCod."\'", "../../", $conexao);
			if(!$dao->cadastrar() || !$log->cadastrar())
				$comitar = false;
		}else{
			$comitar = false;
		}
		
		if($tfBanCod != NULL || $tfBanDesc != NULL){
			include_once("../../dao/DAOBancoPessoa.class.php");
			$dao = new DAOBancoPessoa($tfBanCod, $tfBanContat, "../../", $conexao);
			include_once("../../dao/DAOLog.class.php");
			$log = new DAOLog($_SESSION["pessoa"], 3, $_SESSION["nivel"], $_SESSION["codigo"], 7, "id=\'".$tfBanCod."+".$tfBanContat."\'", "../../", $conexao);
			if(!$dao->cadastrar() || !$log->cadastrar())
				$comitar = false;
			if($comitar)
				$conexao->commit();
			else
				$conexao->rollback();
			header("Location: cadBanco.php?cad=ok");
			die();
		}else{
			$comitar = false;
		}
		if($comitar)
			$conexao->commit();
		else
			$conexao->rollback();
	}
	$cad = isset($_GET["cad"]) ? $_GET["cad"] : NULL;
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
			 	carregarListaContatos();
			}
			function carregarListaContatos(){
				xmlRequest = getXMLHttp();

				xmlRequest.open("GET",'../pesquisar/getPessoasSL.php?classe=B',true);
				
				if (xmlRequest.readyState == 1) {
					document.getElementById("carregando").innerHTML = "<img src='../../imagens/rotating_arrow.gif' width='20px' height='20px' />";
				}
				xmlRequest.onreadystatechange = function () {
						if (xmlRequest.readyState == 4){
							document.getElementById("carregando").innerHTML = "";
							document.getElementById('slBanContat').innerHTML = xmlRequest.responseText;
						}
				}
				xmlRequest.send(null);						
			}
		</script>
	</head>
	<body>
		<?php
			if($cad != NULL){
				$tipo = "cad";
				$toRoot = "../../";
				include("../../includes/confirmar.php");
			}else{
				echo('<div id="confirmar"></div>');
			}
		?>
		<div id="carregando"></div>
		<form id="bancoCadastro" name="bancoCadastro" method="post" action="#" onsubmit="javascript: return validarBancoCadSubmit();">
		  <div><span class="texto2">Insira o c&oacute;digo do banco:</span>
	  	  <input name="tfBanCod" type="text" class="tf1" id="tfBanCod" onkeyup="javascript: validarBancoForm('tfBanCod');" size="5" maxlength="3"/></div>
		  <span class="texto2">Descri&ccedil;a&otilde;:</span>
		  <input name="tfBanDesc" type="text" class="tf1" id="tfBanDesc" onkeyup="javascript: validarBancoForm('tfBanDesc');" size="50" maxlength="100"/></div>
		  <div id="seletor"><span class="texto2">Selecione um contato:</span> 
		  	<select name="slBanContat" class="tf1" id="slBanContat">
		    <option value="---" selected="selected">-----------------------------</option>
	      </select></div>
		  <div><span class="texto2">ou Novo contato: 
		   </span>
		    <input name="cbNovoContat" type="checkbox" class="tf1" id="cbNovoContat" onchange="javascript: inverter('cbNovoContat');" value="velho"/>
	      </div>
		<div id="pessoa" style="visibility:hidden; height:0px"><div><span class="texto2">Nome do contato:</span>  
		<input name="tfBanContat" type="text" class="tf1" id="tfBanContat" onkeyup="javascript: validarBancoForm('tfBanContat');" size="75" maxlength="150"/></div>
		<div><input name="tfFoneCont" type="text" class="tf1" id="tfFoneCont" style="visibility:hidden" value="1" size="5" maxlength="5"/></div>
		<div><input name="btMaisFones" type="button" class="bt1" id="btMaisFones" onclick="javascript: addTel('telefone');" value="+ Telefones" /></div>
		<div id="telefone"><span class="texto2">Telefone para contato:</span>
		<input name="tfPesFone1" type="text" class="tf1" id="tfPesFone1" onkeyup="javascript: validarBancoForm('tfPesFone1');" size="12" maxlength="12"/>
		  <label class="alerta1"> Ex: XX-XXXX-XXXX </label>
		  <br /></div></div>
		  <div align="center">
		    <input name="btBanCad" type="submit" class="bt1" id="btBanCad" value="Cadastrar" />
		    </label>
	      </div>
		</form>
	</body>
</html>
