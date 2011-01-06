<!--<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
	<link href="css/formatacao2.css" rel="stylesheet" type="text/css" />
    <link href="css/butoes.css" rel="stylesheet" type="text/css" />
    <link href="css/texto.css" rel="stylesheet" type="text/css" />
    <link href="css/campos.css" rel="stylesheet" type="text/css" />
	
	<script type="text/javascript" src="javascript/ferramentas.js">
		</script>
</head>
	
<body>-->
<div id="q1">
	<div id="q2">
		<table width="761" border="0" class="cabecalho_1">
		<tr>
		<td width="103">&nbsp;</td>
		<td width="543"><div align="center">NOTA </div></td>
		<td width="101"><span style="cursor:pointer" onclick="javascript: mostrar('telaPostBox'); carregaPagina('telaPostBox.php','telaPostBox');">Postar</span></td>
		</tr>
		</table>
	</div>
	
	<div id="q3">
		<?php
			include("paginacaoNotas.php");
		?>
	</div>
	
	<div id="q4">
		<div align="center" class="simples_3">
			<?php
				include("seletorPaginacao.php");
			?>
		</div>
	</div>
	
	<div id="telaPostBox"></div>
	
	<div id="telaConfBox"></div>
</div>
<!--</body>
</html>-->
