<?php
	session_start();
	if(!isset($_SESSION["usuario"])){
		header("Location: index.php");
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Servi&ccedil;o de Consigna&ccedil;&atilde;o</title>
		<style type="text/css">
			<!--
			@import url("scripts/css/index.css");
			@import url("scripts/css/admin.css");
			-->
		</style>
		<script type="text/javascript" language="javascript">
			function carregarNoIframe(nomeFrame, url){
				top.frames["main"].frames[nomeFrame].location.href = url;
			}
		</script>
</head>
	
<body>
	<div id="desconectar" onclick="javascript: location.href = 'utils/desconectar.php';" style="cursor:pointer">
		<img src="imagens/desconectar.png" /></div>
	<div id="divMenu">
	  <ul id="menu">
		  <li>
			<div alt="Administrar" width="100px" height="100px" title="Empresas">Administrar</div>
			 <div id="nav">Empresas
			 	<div id="nav2">
					<div onclick="javascript: carregarNoIframe('conteudo','cruds/cadastrar/cadEmpresa.php');">Cadastrar</div>
					<div onclick="javascript: carregarNoIframe('conteudo','cruds/alterar/altEmpresa.php');">Alterar</div>
					<div onclick="javascript: carregarNoIframe('conteudo','cruds/deletar/delEmpresa.php');">Deletar</div>
				</div>
			</div>
			 <div id="nav">Bancos
			 	<div id="nav2">
					<div onclick="javascript: carregarNoIframe('conteudo','cruds/cadastrar/cadBanco.php');">Cadastrar</div>
					<div onclick="javascript: carregarNoIframe('conteudo','cruds/alterar/altBanco.php');">Alterar</div>
					<div onclick="javascript: carregarNoIframe('conteudo','cruds/deletar/delBanco.php');">Deletar</div>
				</div></div>
			 <div id="nav">Produtos
			 	<div id="nav2">
					<div onclick="javascript: carregarNoIframe('conteudo','cruds/cadastrar/cadProduto.php');">Cadastrar</div>
					<div onclick="javascript: carregarNoIframe('conteudo','cruds/alterar/altProduto.php');">Alterar</div>
					<div onclick="javascript: carregarNoIframe('conteudo','cruds/deletar/delProduto.php');">Deletar</div>
				</div></div>
				<div id="nav">Usu&aacute;rios
			 	<div id="nav2">
					<div onclick="javascript: carregarNoIframe('conteudo','utils/importarServidores.php');">Importar Servidores</div>
					<div onclick="javascript: carregarNoIframe('conteudo','cruds/cadastrar/cadPessoa.php');">Cadastrar</div>
					<div onclick="javascript: carregarNoIframe('conteudo','cruds/alterar/altPessoa.php');">Alterar</div>
					<div onclick="javascript: carregarNoIframe('conteudo','cruds/deletar/delPessoa.php');">Deletar</div>
				</div></div>
				<div id="nav">Produtos
			 	<div id="nav2">
					<div onclick="javascript: carregarNoIframe('conteudo','cruds/cadastrar/cadVerba.php');">Cadastrar</div>
					<div onclick="javascript: carregarNoIframe('conteudo','cruds/alterar/altVerba.php');">Alterar</div>
					<div onclick="javascript: carregarNoIframe('conteudo','cruds/deletar/delVerba.php');">Deletar</div>
				</div></div>
			</li>
			 <li>
			<div alt="Averba&ccedil;&otilde;es" width="100px" height="100px" title="ZZZZZZ">Averba&ccedil;&otilde;es</div>
			 <div id="nav" onclick="javascript: carregarNoIframe('conteudo','cruds/cadastrar/cadAverbacao.php');">Cadastrar</div>
			 <div id="nav" onclick="javascript: carregarNoIframe('conteudo','cruds/alterar/altAverbacao.php');">Alterar</div>
			 <div id="nav" onclick="javascript: carregarNoIframe('conteudo','cruds/deletar/delAverbacao.php');">Deletar</div>
			</li>
	  </ul>
	</div>
	<iframe id="conteudo" name="conteudo" frameBorder="0"></iframe>
</body>
</html>
