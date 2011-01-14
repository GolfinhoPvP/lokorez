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
		<img src="imagens/desconectar.png" />	</div>
	<div id="divMenu">
	  <ul id="menu">
		  <li>
			<a href="#"><div alt="Empresas" width="100px" height="100px" title="Empresas">. Empresas .</div>
			 <span onclick="javascript: carregarNoIframe('conteudo','cruds/cadastrar/cadEmpresa.php');">Cadastrar</span>
			 <span onclick="javascript: carregarNoIframe('conteudo','cruds/alterar/altEmpresa.php');">Alterar</span>
			 <span onclick="javascript: carregarNoIframe('conteudo','cruds/deletar/delEmpresa.php');">Deletar</span>
		    </a>
	    </li>
		   <li>
			<a href="#"><div alt="Bancos" width="100px" height="100px" title="Bancos">. Bancos .</div>
			 <span onclick="javascript: carregarNoIframe('conteudo','cruds/cadastrar/cadBanco.php');">Cadastrar</span>
			 <span onclick="javascript: carregarNoIframe('conteudo','cruds/alterar/altBanco.php');">Alterar</span>
			 <span onclick="javascript: carregarNoIframe('conteudo','cruds/deletar/delBanco.php');">Deletar</span>
			 </a>
		   </li>
		   <li>
			<a href="#"><div alt="Produtos" width="100px" height="100px" title="Produtos">. Produtos .</div>
			 <span onclick="javascript: carregarNoIframe('conteudo','cruds/cadastrar/cadProduto.php');">Cadastrar</span>
			 <span onclick="javascript: carregarNoIframe('conteudo','cruds/alterar/altProduto.php');">Alterar</span>
			 <span onclick="javascript: carregarNoIframe('conteudo','cruds/deletar/delProduto.php');">Deletar</span>
			 </a>
		   </li>
		   <li>
			<a href="#"><div alt="ZZZZZZ" width="100px" height="100px" title="ZZZZZZ">. ZZZZZZ .</div>
			 <span onclick="javascript: carregarNoIframe('conteudo','cruds/cadastrar/cadEmpresa.php');">Cadastrar</span>
			 <span onclick="javascript: carregarNoIframe('conteudo','cruds/alterar/altEmpresa.php');">Alterar</span>
			 <span onclick="javascript: carregarNoIframe('conteudo','cruds/deletar/delEmpresa.php');">Deletar</span>
			 </a>
		   </li>
	  </ul>
	</div>
	<iframe id="conteudo" name="conteudo" frameBorder="0"></iframe>
</body>
</html>
