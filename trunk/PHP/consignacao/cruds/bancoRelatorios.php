<?php
	session_start();
	$nivelAcesso = "../:4";
	include_once("../utils/controladorAcesso.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">
	<!--
	@import url("../scripts/css/geral.css");
	-->
</style>
<script type="text/javascript" language="javascript" src="../scripts/javascript/ajax.js"></script>
<script type="text/javascript" language="javascript" src="../scripts/javascript/pessoa.js"></script>
<script type="text/javascript" language="javascript">
	window.onload = function(){
		loadContent('pesquisar/getParametrosSL.php?key=tudo', 'slPer', '../../');
	}
	function manipularPessoa(id){
		switch(id){
			case "btRelSintetico" : window.location = "pesquisar/getRelatorioSintetico.php"; break;
			case "btRelAnalitico" : window.location = "pesquisar/getRelatorioAnalitico.php"; break;
		}
	}
</script>
</head>

<body>
	<div id="carregando">
	</div>
	<div>
	  <p>
	    <input name="btRelSintetico" type="submit" class="bt1" id="btRelSintetico" onclick="javascript: manipularPessoa('btRelSintetico');" value="Ver relatório sintético" />
	    <br />
      </p>
	  <form id="buscarAnalitico" name="buscarAnalitico" method="post" action="pesquisar/getRelatorioAnalitico.php" onsubmit="javascript: return validarPessoaForm('tfCPF');">
		<select name="slPer" class="tf1" id="slPer">
		          <option value="---">--------</option>
        </select>
  		<input name="btRelAnalitico" type="submit" class="bt1" id="btRelAnalitico" onclick="javascript: manipularPessoa('btRelAnalitico');" value="Ver relatório analítico" />
	    <span class="texto2">Por per&iacute;odo.</span> 
	  </form>
	</div>
    <br />
    <form id="buscarCPF" name="buscarCPF" method="post" action="pesquisar/getRelatorioCPF.php" onsubmit="javascript: return validarPessoaForm('tfCPF');">

      <div align="left">
        <input name="tfCPF" type="text" class="tf1" id="tfCPF" size="16" maxlength="14" onchange="javascript: return validarPessoaForm('tfCPF');"/>
        <input name="btBusCPF" type="submit" class="bt1" id="btBusCPF" value="Buscar por CPF"/>
      </div>
    </form>
    <br />
    <br />
<br />
</body>
</html>
