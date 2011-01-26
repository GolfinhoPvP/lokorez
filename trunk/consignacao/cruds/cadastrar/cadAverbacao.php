<?php
	session_start();
	$nivelAcesso = "../../:1:2";
	include_once("../../utils/controladorAcesso.php");
	include_once("../../utils/funcoes.php");
	$slSerRef 	= isset($_POST["slSerRef"]) ? $_POST["slSerRef"] : NULL;
	$tfNumExt 	= isset($_POST["tfNumExt"]) ? $_POST["tfNumExt"] : NULL;
	$slPer 		= isset($_POST["slPer"]) ? $_POST["slPer"] : NULL;
	$slPro 		= isset($_POST["slPro"]) ? $_POST["slPro"] : NULL;
	$slPar 		= isset($_POST["slPar"]) ? $_POST["slPar"] : NULL;
	$tfMon 		= isset($_POST["tfMon"]) ? $_POST["tfMon"] : NULL;
	$tfTxJ 		= isset($_POST["tfTxJ"]) ? $_POST["tfTxJ"] : NULL;
	$tfValor 	= isset($_POST["tfValor"]) ? $_POST["tfValor"] : NULL;
	
	if($tfValor != NULL && $slSerRef != NULL && $tfNumExt != NULL && $slPer != NULL && $slPro != NULL && $slPar != NULL){
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
		
		for($x=1; $x <= $slPar; $x++){
			include_once("../../dao/DAOParcela.class.php");
			$dao = new DAOParcela($x, $tfNumExt, 1, $slPer, $tfValor,  "../../", $conexao);
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
			$_SESSION["numeroExt"] = $tfNumExt;
		header("Location: cadAverbacao.php?ave=ok");
		die();
	}
	$ave = isset($_GET["ave"]) ? $_GET["ave"] : NULL;
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
		<script type="text/javascript" language="javascript" src="../../scripts/javascript/averbacao.js"></script>
		<script type="text/javascript" language="javascript">
			<!--
			width = 620;
			height = 320;
			left = 150;
			top = 100;
			URL = "../averbacaoComprovante.php";
			window.onload = function(){
			 	loadContent('../pesquisar/getServidoresSL.php', 'slSerRef', '../../');
				<?php if($ave != NULL) echo('window.open(URL,"promo", "width="+width+", height="+height+", top="+top+", left="+left+", scrollbars=no, status=no, toolbar=no, location=no, directories=no, menubar=no, resizable=no, fullscreen=no");'); ?>
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
		<?php
			if($ave != NULL){
				$tipo = "ave";
				$toRoot = "../../";
				include("../../includes/confirmar.php");
			}else{
				echo('<div id="confirmar"></div>');
			}
		?>
		<div id="carregando">
		</div>
	    <form id="averbarCad" name="averbarCad" method="post" action="#" onsubmit="javascript: return validarAveCadSubmit();">
	      <span class="texto2">Selecione um servidor:</span>
	      <label>
	      <select name="slSerRef" class="tf1" id="slSerRef" onchange="javascript: carregarParametros(); carregarInfos(); mostrar('cadastro');">
	        <option value="---" selected="selected">------------------------------</option>
          </select>
	      </label>
		  <div id="infos"></div>
		  <div id="cadastro" style="visibility:hidden">
			  <div><span class="texto2">N&uacute;mero externo:</span> 
				<input name="tfNumExt" type="text" class="tf1" id="tfNumExt" size="100" maxlength="200" autocomplete="off" /></div>
	        <div><span class="texto2">Selecione o periodo:</span> 
		        <select name="slPer" class="tf1" id="slPer">
		          <option value="---">--------</option>
	            </select></div>
	            <div><span class="texto2">Selecione um produto:</span> 
	        <select name="slPro" class="tf1" id="slPro" onchange="javascript: selecionarParcelas(); mostrar('mais');">
	          <option value="---" selected="selected" >------------------</option>
            </select></div>
			<div id="mais" style="visibility:hidden">
	        <div><span class="texto2">Qual o valor da parcela: 
	          R$</span>
	          <input name="tfValor" type="text" class="tf1" id="tfValor" onkeyup="javascript: validarForm('tfValor'); ajustarValores();" size="15" maxlength="25" autocomplete="off"/></div>
	        <div><span class="texto2">Em quantas parcelas:</span> 
	        <select name="slPar" class="tf1" id="slPar" onchange="javascript: validarForm('slPar'); ajustarMontante();">
	          <option value="---" selected="selected">---</option>
            </select></div>
	        <div id="parcelas"></div>
	          <div class="texto2">Taxa de juros:
            <input name="tfTxJ" type="text" class="tf1" id="tfTxJ" value="0" size="6" maxlength="3" />
            %
            </div>
	        <div>
	        <span class="texto2">Montante: R$</span>
	        <input name="tfMon" type="text" class="tf1" id="tfMon" size="15" maxlength="25" onfocus="javascript:  ajustarMontante();" />
	        </div>
		  </div>
		  </div>
	      <label></label>
          <div align="center"><br />
            <input name="btAverbar" type="submit" class="bt1" id="btAverbar" value="Averbar" />
          </div>
    </form>
</body>
</html>
