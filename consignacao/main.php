<?php
	session_start();
	if(!isset($_SESSION["usuario"])){
		header("Location: index.php");
	}
	
	if($_SESSION["banco"] != "000"){
		$banco = "Bem vindo: ".$_SESSION["banco_nome"];
	}else{
		$banco = "Bem vindo administrador!";
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>SysConsig - Servi&ccedil;o de Consigna&ccedil;&atilde;o On-line</title>
		<style type="text/css">
			<!--
			@import url("scripts/css/geral.css");
			@import url("scripts/css/main.css");
			-->
		</style>
		<script type="text/javascript" language="javascript" src="scripts/javascript/geral.js"></script>
		<script type="text/javascript" language="javascript">
			window.onload = function(){
				centralizador("central", 810, 580);
				document.body.style.visibility = "visible";
			}
			function carregarNoIframe(nomeFrame, url){
				top.frames[nomeFrame].location.href = url;
			}
		</script>
</head>
	
<body id="corpo" style="visibility:hidden">
	<div id="central">
	<div id="desconectar" onclick="javascript: location.href = 'utils/desconectar.php';" style="cursor:pointer">
		<img src="imagens/desconectar.png" /></div>
	<div id="legendaBanco"><?php echo($banco); ?></div>
	<div id="divMenu">
	  <ul id="menu">
		  <li>
			<div alt="Administrar" width="100px" height="100px" title="Empresas">Administrar</div>
			 <div id="nav">Empresas
			 	<div id="nav2">
					<div onclick="javascript: carregarNoIframe('conteudo','cruds/cadastrar/cadEmpresa.php');">Cadastrar</div>
					<div onclick="javascript: carregarNoIframe('conteudo','cruds/alterar/altEmpresa.php');">Alterar</div>
					<div onclick="javascript: carregarNoIframe('conteudo','cruds/deletar/delEmpresa.php');">Deletar</div>
					<div onclick="javascript: carregarNoIframe('conteudo','cruds/pesquisar/pesEmpresa.php');">Pesquisar</div>
				</div>
			</div>
			 <div id="nav">Bancos
			 	<div id="nav2">
					<div onclick="javascript: carregarNoIframe('conteudo','cruds/cadastrar/cadBanco.php');">Cadastrar</div>
					<div onclick="javascript: carregarNoIframe('conteudo','cruds/alterar/altBanco.php');">Alterar</div>
					<div onclick="javascript: carregarNoIframe('conteudo','cruds/deletar/delBanco.php');">Deletar</div>
					<div onclick="javascript: carregarNoIframe('conteudo','cruds/pesquisar/pesBanco.php');">Pesquisar</div>
				</div>
			</div>
			 <div id="nav">Produtos
			 	<div id="nav2">
					<div onclick="javascript: carregarNoIframe('conteudo','cruds/cadastrar/cadProduto.php');">Cadastrar</div>
					<div onclick="javascript: carregarNoIframe('conteudo','cruds/alterar/altProduto.php');">Alterar</div>
					<div onclick="javascript: carregarNoIframe('conteudo','cruds/deletar/delProduto.php');">Deletar</div>
					<div onclick="javascript: carregarNoIframe('conteudo','cruds/pesquisar/pesProduto.php');">Pesquisar</div>
				</div></div>
				<div id="nav">Verbas
			 	<div id="nav2">
					<div onclick="javascript: carregarNoIframe('conteudo','cruds/cadastrar/cadVerba.php');">Cadastrar</div>
					<div onclick="javascript: carregarNoIframe('conteudo','cruds/alterar/altVerba.php');">Alterar</div>
					<div onclick="javascript: carregarNoIframe('conteudo','cruds/deletar/delVerba.php');">Deletar</div>
					<div onclick="javascript: carregarNoIframe('conteudo','cruds/pesquisar/pesVerba.php');">Pesquisar</div>
				</div></div>
				<div id="nav">Usu&aacute;rios
			 	<div id="nav2">
					<div onclick="javascript: carregarNoIframe('conteudo','utils/importarServidores.php');">Importar Servidores</div>
					<div onclick="javascript: carregarNoIframe('conteudo','cruds/cadastrar/cadPessoa.php');">Cadastrar</div>
					<div onclick="javascript: carregarNoIframe('conteudo','cruds/alterar/altPessoa.php');">Alterar</div>
					<div onclick="javascript: carregarNoIframe('conteudo','cruds/deletar/delPessoa.php');">Deletar</div>
					<div onclick="javascript: carregarNoIframe('conteudo','cruds/pesquisar/pesPessoa.php');">Pesquisar</div>
				</div></div>
				<div id="nav">Gerenciar Periodos
			 	<div id="nav2">
					<div onclick="javascript: carregarNoIframe('conteudo','cruds/cadastrar/cadParametro.php');">Abrir</div>
					<div onclick="javascript: carregarNoIframe('conteudo','cruds/alterar/altParametro.php');">Encerrar</div>
				</div></div>
		</li>
			 <li>
			<div alt="Averba&ccedil;&otilde;es" width="100px" height="100px" title="ZZZZZZ">Averba&ccedil;&otilde;es</div>
			 <div id="nav" onclick="javascript: carregarNoIframe('conteudo','cruds/cadastrar/cadAverbacao.php');">Averbar</div>
			 <div id="nav" onclick="javascript: carregarNoIframe('conteudo','cruds/bancoRelatorios.php');">Relat&oacute;rios</div>
			</li>
	  </ul>
</div>
	<iframe id="conteudo" name="conteudo" frameBorder="0"></iframe>
	</div>
</body>
</html>
