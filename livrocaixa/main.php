<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link href="scripts/css/geral.css" rel="stylesheet" type="text/css" />
		<link href="scripts/css/main.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" language="javascript">
			function carregarNoIframe(nomeFrame, url){
				top.frames['telaSistema'].frames[nomeFrame].location.href = url;
			}
		</script>
	</head>
	
<body>
	<div id="divMenu">
	  <ul id="menu">
		  <li>
			<div alt="Administrar" width="100px" height="100px" title="Empresas">Administrar</div>
			 <div id="nav">Clientes
			 	<div id="nav2">
					<div onclick="javascript: carregarNoIframe('conteudo','cruds/cadastrar/cadCliente.php');">Cadastrar</div>
					<div onclick="javascript: carregarNoIframe('conteudo','cruds/alterar/altCliente.php');">Alterar</div>
					<div onclick="javascript: carregarNoIframe('conteudo','cruds/deletar/delCliente.php');">Deletar</div>
					<div onclick="javascript: carregarNoIframe('conteudo','cruds/pesquisar/pesCliente.php');">Pesquisar</div>
				</div>
			</div>
		</li>
			 <li>
			<div alt="Averba&ccedil;&otilde;es" width="100px" height="100px" title="ZZZZZZ">OUTROS</div>
			 <div id="nav" onclick="javascript: carregarNoIframe('conteudo','');">ITEM</div>
			 <div id="nav" onclick="javascript: carregarNoIframe('conteudo','');">ITEM</div>
			 <div id="nav" onclick="javascript: carregarNoIframe('conteudo','');">ITEM</div>
		</li>
	  </ul>
	</div>
	<iframe id="frameConteudo" name="conteudo" width="940" height="550" frameBorder="0"></iframe>
</body>
</html>
