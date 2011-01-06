<?php
	session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<link rel="shortcut icon" href="imagens/ca_icone.ico" mce_href="imagens/ca_icone.ico" type="image/x-icon" />
		
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<meta http-equiv="keywords" content="universidade, estadual, piau, UESPI, uespi, CA, centro acadmico, bacharelado, cincia, computao, teresina, brasil" />
		
		<title>CA de Computa&ccedil;&atilde;o - UESPI</title>
		
		<style type="text/css">
		<!--
			#centro{
				position:absolute;
				left: 0px;
				top: 0px;
			}
			body {
				background-image: url(imagens/back_ground_9x9_2.gif);
				background-repeat: repeat;
			}
		-->
		</style>
		
		<script type="text/javascript" src="javascript/ferramentas.js">
		</script>	
		<noscript>
			<meta http-equiv="refresh" content="0;URL=semjavascript.html">
		</noscript>
	</head>
	
	<body onload="javascript: centralizador();">
		<div id="centro">
			<?php
				include("inicial.php");
			?>
			<script type="text/javascript">
				fechar("aviso_1");
			</script>
		</div>
	</body>
</html>
