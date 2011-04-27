<?php
	session_start();
	if(!isset($_SESSION["passeVerde"])){
		$_SESSION["passeVerde"] = "primario";
	}
	if(isset($_SESSION["passeVerde"])){
		echo("<script type='text/javascript'> </script>");
	}
	$_SESSION["mensagem"] = 0;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<link rel="shortcut icon" href="imagens/ca_icone.ico" mce_href="imagens/ca_icone.ico" type="image/x-icon" />
		<link href="css/padrao.css" rel="stylesheet" type="text/css" />
		
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<meta http-equiv="keywords" content="universidade, estadual, piau, UESPI, uespi, CA, centro acadmico, bacharelado, cincia, computao, teresina, brasil" />
		
		<title>CA de Computa&ccedil;&atilde;o - UESPI</title>
		
		<style type="text/css">
		<!--
			body {
				background-image: url(imagens/back_ground_9x9.gif);
				background-repeat: repeat;
				margin-left: 0px;
				margin-top: 0px;
				margin-right: 0px;
				margin-bottom: 0px;
			}
		-->
        </style>
		
		<script type="text/javascript" src="javascript/ferramentas.js">
		</script>
		<noscript>
			<meta http-equiv="refresh" content="0;URL=semjavascript.html">
		</noscript>
	</head>
	
	<body onload="javascript: principal();">
		<div id="centro">
			<?php
				include("inicial.php");
			?>
		</div>
	</body>
</html>
