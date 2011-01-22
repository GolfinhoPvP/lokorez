<?php
	session_start();
	include_once("../../utils/funcoes.php");
	$slSerRef 	= isset($_POST["slSerRef"]) ? $_POST["slSerRef"] : NULL;
	$tfNumExt 	= isset($_POST["tfNumExt"]) ? $_POST["tfNumExt"] : NULL;
	$slPer 		= isset($_POST["slPer"]) ? $_POST["slPer"] : NULL;
	$slPro 		= isset($_POST["slPro"]) ? $_POST["slPro"] : NULL;
	$slPar 		= isset($_POST["slPar"]) ? $_POST["slPar"] : NULL;
	$tfMon 		= isset($_POST["tfMon"]) ? $_POST["tfMon"] : NULL;
	$tfTxJ 		= isset($_POST["tfTxJ"]) ? $_POST["tfTxJ"] : NULL;
	$tfValor 	= isset($_POST["tfValor"]) ? $_POST["tfValor"] : NULL;
	
	if($slSerRef != NULL && $tfNumExt != NULL && $slPer != NULL && $slPro != NULL && $slPar != NULL){
		include_once("../../utils/ConectarMySQL.class.php");
		$conexao = new ConectarMySQL();
		$comitar = true;
		
		include_once("../../dao/DAOServidor.class.php");
		$dao = new DAOServidor(NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, "../../", $conexao);
		if(!$dao->atualizarVerba($slSerRef, $tfValor))
			$comitar = false;
			
		$servidor = $dao->getServidor($slSerRef);
		
		include_once("../../dao/DAOVerba.class.php");
		$dao = new DAOVerba(NULL,  NULL,  NULL,  NULL,  NULL, "../../", $conexao);
		$verba = $dao->getVerba($slPro);
		
		$data = date("Y-m-d H:i:s");
		
		include_once("../../dao/DAOAverbacao.class.php");
		if(strlen($tfMon) == 0)
			$tfMon = 0;
		if(strlen($tfTxJ) == 0)
			$tfTxJ = 0;
		$dao = new DAOAverbacao($tfNumExt, 'NULL', $servidor->getEmpCodigo(), $servidor->getPesCodigo(), $slSerRef, $_SESSION["banco"], $verba->getProCodigo(), $slPer, 1, $data, '0000-00-00', $slPar, $tfMon, $tfTxJ, "../../", $conexao);
		include_once("../../dao/DAOLog.class.php");
		$log = new DAOLog($_SESSION["pessoa"], 3, $_SESSION["nivel"], $_SESSION["codigo"], 12, "noum ext=\'".$tfNumExt."\'", "../../", $conexao);
		if(!$dao->cadastrar() || !$log->cadastrar())
			$comitar = false;
		
		$valor = $tfValor / $slPar;
		
		for($x=1; $x <= $slPar; $x++){
			include_once("../../dao/DAOParcela.class.php");
			$dao = new DAOParcela($x, $tfNumExt, 1, $slPer, $valor,  "../../", $conexao);
			$slPer = avancarPeriodo($slPer);
			include_once("../../dao/DAOLog.class.php");
			$log = new DAOLog($_SESSION["pessoa"], 3, $_SESSION["nivel"], $_SESSION["codigo"], 13, "num ext=\'".$tfNumExt."\'", "../../", $conexao);
			if(!$dao->cadastrar() || !$log->cadastrar())
				$comitar = false;
		}
		
		if($comitar)
			$conexao->commit();
		else
			$conexao->rollback();
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>Untitled Document</title>
		<style type="text/css">
			<!--
			@import url("../../scripts/css/verba.css");
			-->
		</style>
		<script type="text/javascript" language="javascript" src="../../scripts/javascript/ajax.js"></script>
		<script type="text/javascript" language="javascript" src="../../scripts/javascript/averbacao.js"></script>
		<script type="text/javascript" language="javascript">
			<!--
			window.onload = function(){
			 	loadContent('../pesquisar/getServidoresSL.php', 'slSerRef', '../../');
			}
			function carregarInfos(){
				xmlRequest1 = getXMLHttp();

				xmlRequest1.open("GET",'../pesquisar/getServidorAlt.php?key='+document.getElementById("slSerRef").value,true);
				
				if (xmlRequest1.readyState == 1) {
					document.getElementById("carregando").innerHTML = "<img src='../../imagens/rotating_arrow.gif' width='20px' height='20px' />";
				}
				xmlRequest1.onreadystatechange = function () {
						if (xmlRequest1.readyState == 4){
							document.getElementById("carregando").innerHTML = "";
							document.getElementById('infos').innerHTML = xmlRequest1.responseText;
						}
				}
				xmlRequest1.send(null);
			}
			function carregarParametros(){
				xmlRequest2 = getXMLHttp();

				xmlRequest2.open("GET",'../pesquisar/getParametrosSL.php',true);
				
				if (xmlRequest2.readyState == 1) {
					document.getElementById("carregando").innerHTML = "<img src='../../imagens/rotating_arrow.gif' width='20px' height='20px' />";
				}
				xmlRequest2.onreadystatechange = function () {
						if (xmlRequest2.readyState == 4){
							document.getElementById("carregando").innerHTML = "";
							document.getElementById('slPer').innerHTML = xmlRequest2.responseText;
							carregarVerbas();
						}
				}
				xmlRequest2.send(null);
			}
			function carregarVerbas(){
				xmlRequest = getXMLHttp();

				xmlRequest.open("GET",'../pesquisar/getVerbasSL.php?key='+document.getElementById("slSerRef").value,true);
				
				if (xmlRequest.readyState == 1) {
					document.getElementById("carregando").innerHTML = "<img src='../../imagens/rotating_arrow.gif' width='20px' height='20px' />";
				}
				xmlRequest.onreadystatechange = function () {
						if (xmlRequest.readyState == 4){
							document.getElementById("carregando").innerHTML = "";
							document.getElementById('slPro').innerHTML = xmlRequest.responseText;
						}
				}
				xmlRequest.send(null);
			}
			function selecionarParcelas(){
				loadContent('../pesquisar/getParcelasSL.php?key='+document.getElementById("slPro").value, 'slPar', '../../');
			}
//-->
</script>
	</head>
	<body>
		<div id="carregando">
		</div>
	    <form id="averbarCad" name="averbarCad" method="post" action="#" onsubmit="javascript: return validarAveCadSubmit();">
	      Selecione um servidor:
	      <label>
	      <select name="slSerRef" id="slSerRef" onchange="javascript: carregarParametros(); carregarInfos(); mostrar('cadastro');">
	        <option value="---" selected="selected">------------------------------</option>
          </select>
	      </label>
	      <br />
		  <div id="infos"></div>
	      <br />
		  <div id="cadastro" style="visibility:hidden">
			  N&uacute;mero externo: 
			  <label>
				<input name="tfNumExt" autocomplete="off" type="text" id="tfNumExt" size="100" maxlength="200" />
			  </label>
	        <p>Selecione o periodo: 
		        <label>
		        <select name="slPer" id="slPer">
		          <option value="---">--------</option>
	            </select>
		        </label>
	            <br />
	            <br />
	        Selecione um produto: 
	        <label>
	        <select name="slPro" id="slPro" onchange="javascript: selecionarParcelas(); mostrar('mais');">
	          <option value="---" selected="selected" >------------------</option>
            </select>
	        </label>
			<div id="mais" style="visibility:hidden">
	        </p>
	        <p>Qual o valor: 
	          <label>
	          R$
	          <input name="tfValor" type="text" id="tfValor" size="15" maxlength="25" autocomplete="off" onkeyup="javascript: validarForm('tfValor'); ajustarValores();"/>
	          </label>
	          <br />
	          <br />
	        Em quantas parcelas: 
	        <label>
	        <select name="slPar" id="slPar" onchange="javascript: dividirParelas();">
	          <option value="---" selected="selected">---</option>
            </select>
	        </label>
	        </p>
	        <div id="parcelas"></div>
	          <br />
	          <label>Taxa de juros:
            <input name="tfTxJ" type="text" id="tfTxJ" value="0" size="6" maxlength="3" />
            </label>
%<br />
<br />
	        <label>
	        Montante: 
	        R$
	        <input name="tfMon" type="text" id="tfMon" size="15" maxlength="25" />
            <br />
	        </label>
	        </p>
		  </div>
          <br />
		  </div>
	      <label>
	      <input name="btAverbar" type="submit" id="btAverbar" value="Averbar" />
	      </label>
    </form>
</body>
</html>
