<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>Livro Caixa On-line</title>
		<link REL="SHORTCUT ICON" HREF="imagens/icone.ico">
		<link href="scripts/css/geral.css" rel="stylesheet" type="text/css" />
		
		<script type="text/javascript" language="javascript" src="scripts/javascript/funcoes.js"></script>
		<script type="text/javascript" language="javascript" src="scripts/javascript/login.js"></script>
		<script type="text/javascript" language="javascript" >
			window.onload = function(){
				centralizador("frame", 950, 600);
				document.getElementById("frame").style.visibility = "visible";
			}
		</script>
</head>
	<body>
		<noscript>Seu navegador não está com a opção JavaScript ativada, por favor, ative e reinicie o navegador!</noscript>
		<div id="frame">
			<iframe name="telaSistema" width="950" height="600" class="centralizar" frameBorder="0" src="login.php"></iframe>
		</div>
	</body>
</html>
