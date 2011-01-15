<?php
	session_start();
	$tfBanCod = isset($_POST["tfBanCod"]) ? $_POST["tfBanCod"] : NULL;
	$tfBanDesc = isset($_POST["tfBanDesc"]) ? $_POST["tfBanDesc"] : NULL;
	
	$cbNovoContat = isset($_POST["cbNovoContat"]) ? $_POST["cbNovoContat"] : NULL;
	$tfBanContat = NULL;
	
	if($cbNovoContat == "novo"){
		$tfBanContat = isset($_POST["tfBanContat"]) ? $_POST["tfBanContat"] : NULL;
		$tfFoneCont = isset($_POST["tfFoneCont"]) ? $_POST["tfFoneCont"] : NULL;
		
		if($tfBanContat != NULL){
			include_once("../../dao/DAOPessoa.class.php");
			$dao = new DAOPessoa($tfBanContat, NULL, "B", "../../");
			include_once("../../dao/DAOLog.class.php");
			$log = new DAOLog($_SESSION["pessoa"], 3, $_SESSION["nivel"], $_SESSION["codigo"], 5, "nome=\'".$tfBanContat."\'", "../../");
			$dao->cadastrar();
			$log->cadastrar();
			$resultado = $dao->pesquisar($tfBanContat.":%:B");
			$linha = mysql_fetch_array($resultado);
			$tfBanContat = $linha["pes_codigo"];
		}
		
		for($x=1; $x < $tfFoneCont+1; $x++){
			eval("\$tfPesFone[$x] = isset(\$_POST[\"tfPesFone$x\"]) ? \$_POST[\"tfPesFone$x\"] : NULL;");
			if($tfPesFone[$x] != NULL && preg_match("/^[0-9]{2,2}-[0-9]{4,4}-[0-9]{4,4}$/", $tfPesFone[$x])){
				include_once("../../dao/DAOTelefone.class.php");
				$dao = new DAOTelefone($tfBanContat, $tfPesFone[$x], "../../");
				include_once("../../dao/DAOLog.class.php");
				$log = new DAOLog($_SESSION["pessoa"], 3, $_SESSION["nivel"], $_SESSION["codigo"], 6, "numero=\'".$tfPesFone[$x]."\'", "../../");
				$dao->cadastrar();
				$log->cadastrar();
			}
		}
	}else{
		$tfBanContat = isset($_POST["slBanContat"]) ? $_POST["slBanContat"] : NULL;
	}
	
	if($tfBanCod != NULL || $tfBanDesc != NULL){
		include_once("../../dao/DAOBanco.class.php");
		$dao = new DAOBanco($tfBanCod, $tfBanDesc, "../../");
		include_once("../../dao/DAOLog.class.php");
		$log = new DAOLog($_SESSION["pessoa"], 3, $_SESSION["nivel"], $_SESSION["codigo"], 3, "id=\'".$tfBanCod."\'", "../../");
		$dao->cadastrar();
		$log->cadastrar();
	}
	
	if($tfBanCod != NULL || $tfBanDesc != NULL){
		include_once("../../dao/DAOBancoPessoa.class.php");
		$dao = new DAOBancoPessoa($tfBanCod, $tfBanContat, "../../");
		include_once("../../dao/DAOLog.class.php");
		$log = new DAOLog($_SESSION["pessoa"], 3, $_SESSION["nivel"], $_SESSION["codigo"], 7, "id=\'".$tfBanCod."+".$tfBanContat."\'", "../../");
		$dao->cadastrar();
		$log->cadastrar();
		header("Location: cadBanco.php");
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
			@import url("../../scripts/css/banco.css");
			-->
		</style>
		<script type="text/javascript" language="javascript" src="../../scripts/javascript/ajax.js"></script>
		<script type="text/javascript" language="javascript" src="../../scripts/javascript/banco.js"></script>
		<script type="text/javascript" language="javascript">
			 window.onload = function(){
			 	carregarAlteracoes();
			}
			function carregarAlteracoes(){
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
			function inverter(id){
				if(document.getElementById(id).value == "velho"){
					mostar('pessoa');
					esconder('seletor');
					document.getElementById(id).value = "novo";
				}else{
					mostar('seletor');
					esconder('pessoa');
					document.getElementById(id).value = "velho";
				}
			}
			function addTel(id){
				document.getElementById("tfFoneCont").value = parseInt(document.getElementById("tfFoneCont").value) + 1;
				cont = document.getElementById("tfFoneCont").value;
				document.getElementById(id).innerHTML += 'Telefone para contato: <input name="tfPesFone'+cont+'" type="text" id="tfPesFone'+cont+'" size="12" maxlength="12" onkeyup="javascript: validarBancoForm(\'tfPesFone'+cont+'\');"/><label> Ex: XX-XXXX-XXXX </label><br />';
			}
		</script>
	</head>
	<body>
		<div id="carregando">
		</div>
		<form id="bancoCadastro" name="bancoCadastro" method="post" action="#" onsubmit="javascript: return validarBancoCadSubmit();">
		  <label>
		  Insira o c&oacute;digo do banco:
		  <input name="tfBanCod" type="text" id="tfBanCod" size="5" maxlength="3" onkeyup="javascript: validarBancoForm('tfBanCod');"/>
		  <br />
		  Descri&ccedil;a&otilde;:
		  </label>
		  <input name="tfBanDesc" type="text" id="tfBanDesc" size="50" maxlength="100" onkeyup="javascript: validarBancoForm('tfBanDesc');"/>
		  <br />
		  <div id="seletor">Selecione um contato: 
		  <label>
		  <select name="slBanContat" id="slBanContat">
		    <option value="---" selected="selected">-----------------------------</option>
	      </select>
		  </label></div>
		   ou Novo contato: 
		   <label>
		   <input id="cbNovoContat" type="checkbox" name="cbNovoContat" value="velho" onchange="javascript: inverter('cbNovoContat');"/>
		   </label>
		   <br />
		<div id="pessoa" style="visibility:hidden; height:0px">Nome do contato:  
		<input name="tfBanContat" type="text" id="tfBanContat" size="50" maxlength="100" onkeyup="javascript: validarBancoForm('tfBanContat');"/>
		<label>
		<input name="tfFoneCont" type="text" id="tfFoneCont" value="1" size="5" maxlength="5" style="visibility:hidden"/>
		</label>
		<br /><input name="btMaisFones" type="button" id="btMaisFones" value="+ Telefones" onclick="javascript: addTel('telefone');" />
		<div id="telefone">Telefone para contato:
		<input name="tfPesFone1" type="text" id="tfPesFone1" size="12" maxlength="12" onkeyup="javascript: validarBancoForm('tfPesFone1');"/>
		  <label> Ex: XX-XXXX-XXXX </label>
		  <br /></div></div>
		  <input name="btBanCad" type="submit" id="btBanCad" value="Cadastrar" />
		  </label></form>
	</body>
</html>