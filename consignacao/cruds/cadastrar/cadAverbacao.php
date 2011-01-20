<?php
	session_start();
	$tfVerba = isset($_POST["tfVerba"]) ? $_POST["tfVerba"] : NULL;
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
		<script type="text/javascript" language="javascript" src="../../scripts/javascript/verba.js"></script>
		<script type="text/javascript" language="javascript">
			 window.onload = function(){
			 	loadContent('../pesquisar/getServidoresSL.php', 'slSerRef', '../../');
				loadContent('../pesquisar/getParametrosSL.php', 'slPer', '../../');
				loadContent('../pesquisar/getVerbasSL.php', 'slPer', '../../');
			}
			function carregarServidor(id){
				loadContent('../pesquisar/getServidorAlt.php?key='+document.getElementById(id).value, 'infos', '../../');
			}
			function carregarBancos(){
				xmlRequest = getXMLHttp();

				xmlRequest.open("GET",'../pesquisar/getBancosSL.php',true);
				
				if (xmlRequest.readyState == 1) {
					document.getElementById("carregando").innerHTML = "<img src='../../imagens/rotating_arrow.gif' width='20px' height='20px' />";
				}
				xmlRequest.onreadystatechange = function () {
						if (xmlRequest.readyState == 4){
							document.getElementById("carregando").innerHTML = "";
							document.getElementById('slBancRef').innerHTML = xmlRequest.responseText;
							carregarProdutos();
						}
				}
				xmlRequest.send(null);
			}
			function carregarProdutos(){
				xmlRequest = getXMLHttp();

				xmlRequest.open("GET",'../pesquisar/getProdutosSL.php',true);
				
				if (xmlRequest.readyState == 1) {
					document.getElementById("carregando").innerHTML = "<img src='../../imagens/rotating_arrow.gif' width='20px' height='20px' />";
				}
				xmlRequest.onreadystatechange = function () {
						if (xmlRequest.readyState == 4){
							document.getElementById("carregando").innerHTML = "";
							document.getElementById('slProRef').innerHTML = xmlRequest.responseText;
						}
				}
				xmlRequest.send(null);
			}
		</script>
	</head>
	<body>
		<div id="carregando">
		</div>
	    <form id="averbarCad" name="averbarCad" method="post" action="">
	      Selecione um servidor:
	      <label>
	      <select name="slSerRef" id="slSerRef" onchange="javascript: carregarServidor('slSerRef');">
	        <option value="---" selected="selected">------------------------------</option>
          </select>
	      </label>
	      <br />
		  <div id="infos"></div>
	      <br />
		  <div id="cadastro">
			  N&uacute;mero externo: 
			  <label>
				<input name="tfNumExt" type="text" id="tfNumExt" size="100" maxlength="200" />
			  </label>
		      <p>Selecione o periodo: 
		        <label>
		        <select name="slPer" id="slPer">
		          <option value="---">--------</option>
	            </select>
		        </label>
	            <br />
	            <br />
	        Selecione uma verba: 
	        <label>
	        <select name="slVer" id="slVer">
	          <option value="---" selected="selected">------------------</option>
            </select>
	        </label>
	        </p>
		  </div>
          <br />
	      <label>
	      <input name="btAverbar" type="submit" id="btAverbar" value="Averbar" />
	      </label>
    </form>
</body>
</html>
