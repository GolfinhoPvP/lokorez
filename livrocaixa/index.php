<?php
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>Livro Caixa On-line</title>
		
		<link href="scripts/css/geral.css" rel="stylesheet" type="text/css" />
		<link href="scripts/css/index.css" rel="stylesheet" type="text/css" />
		
		<script type="text/javascript" language="javascript" src="scripts/javascript/funcoes.js"></script>
		<script type="text/javascript" language="javascript" src="scripts/javascript/login.js"></script>
		<script type="text/javascript" language="javascript" >
			window.onload = function(){
				centralizador("telaLogin", 544, 245);
				document.body.style.visibility = "visible";
			}
		</script>
</head>
<body class="centralizar">
		<div id="confirmar"></div>
		<div id="telaLogin">
			<div id="esquerdaBox"></div>
			<div id="centroBox">
				<div id="sysLabel" align="center" class="texto2">Livro Caixa On-line </div>
				<form id="loginForm" name="loginForm" method="post" action="#" onsubmit="javascript: return validarLogin();">
		  	  	  <div class="texto1" id="nomeLabel">Nome de usu&aacute;rio: 
				  		<input name="tfNomUsu" type="text" class="textField1" id="tfNomUsu" size="25" maxlength="15" onkeyup="javascript: validarForm('tfNomUsu');" />
				  </div>
					<div class="texto1" id="senhaLabel">Senha: 
						<input name="tfSen" type="password" class="textField1" id="tfSen" size="25" maxlength="15" onkeyup="javascript: validarForm('tfSen');" />
				  </div>
					<div id="botaoLabel">
				  		<input class="botao1" name="btConect" type="submit" id="btConect" value="conectar" />
			  	  </div>
		      	</form>
				<div class="textField1" id="rodape" align="center">
				  zerokolSoft - www.zerokol.com<br />
				    aj.alves@live.com<br />
				    Teresina -PI
			  </div>
		    </div>
			<div id="direitaBox"></div>
		</div>
	</body>
</html>
