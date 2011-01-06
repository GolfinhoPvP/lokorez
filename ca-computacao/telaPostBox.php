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
	<div id="telaPostBoxInt">
	  <form id="notaForm" name="notaForm" method="post" action="gravaNota.php">
				<table width="391" height="100" border="0">
				  <tr>
					<td colspan="2"><input name="categoriaHF" type="hidden" id="categoriaHF" value="mensagem" />
					  <span class="cabecalho_2">Digite sua mensagem aqui.</span>
					  <div align="center"></div></td>
					<td width="59"><div align="right"><img src="imagens/cancel.png" alt="Fechar" width="16" height="16" style="cursor:pointer" onClick="javascript: esconder('telaPostBox');" /></div></td>
				  </tr>
				  <tr>
					<td colspan="3">
					  
					  <div align="center">
						<textarea name="mensagemTF"  cols="55" rows="4" wrap="physical" class="campo_2" id="mensagemTF" onKeyUp="javascript: validaMensagem();"></textarea>
					  </div></td></tr>
				  <tr>
					<td width="220"><span id="char_alert" class="alerta_1">caracteres dispon&iacute;veis 200 </span></td>
					<td width="98"><div align="center"><img style="cursor:pointer" onClick="javascript: limpar('mensagemTF'); validaMensagem();" src="imagens/borracha.gif" alt="Limpar" width="27" height="27" /></div></td>
					<td><input name="postar" type="button" class="butoes_1" id="postar" value="Postar" onClick="javascript: mostrar('telaConfBox'); carregaPagina('telaConfBox.php','telaConfBox');"/></td>
				  </tr>
				</table>
		<!--</body>
</html>-->
	  </form>
		  </div>
