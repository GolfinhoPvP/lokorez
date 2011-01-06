<?php
	$mensagem = $_SESSION["mensagem"];
	include("funcoes.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <title>CA de Computa&ccedil;&atilde;o - UESPI</title>
		<link href="css/formatacao.css" rel="stylesheet" type="text/css">
		<link href="css/formatacao2.css" rel="stylesheet" type="text/css" />
	    <link href="css/texto.css" rel="stylesheet" type="text/css">
        <link href="css/campos.css" rel="stylesheet" type="text/css">
        <link href="css/butoes.css" rel="stylesheet" type="text/css" />
	</head>
	
	<body>
<!----------------------------------------------------------------------------------------->
		<div id="tela">
	<!----------------------------------------------------------------------------------------->
			<!-- Div que posiciona a imagem de fundo do logo do CA -->
			<div id="logotipo">
				<table width="800" height="400" border="0">
                  <tr>
                    <td width="10">&nbsp;</td>
                    <td width="51">&nbsp;</td>
                    <td width="65">&nbsp;</td>
                    <td width="58">&nbsp;</td>
                    <td width="44">&nbsp;</td>
                    <td width="43">&nbsp;</td>
                    <td width="43">&nbsp;</td>
                    <td width="43">&nbsp;</td>
                    <td width="43">&nbsp;</td>
                    <td width="43">&nbsp;</td>
                    <td width="76">&nbsp;</td>
                    <td width="60">&nbsp;</td>
                    <td width="67">&nbsp;</td>
                    <td width="68">&nbsp;</td>
                    <td width="24">&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td colspan="3"><span class="cabecalho_2" style="cursor:pointer" onclick="javascript: mostrar('telaCadLog'); carregaPagina('telaCadLog.php','telaCadLog');">Cadastrar<br />
                    <br />
                    Log-in</span><br /><br />
                    <span class="cabecalho_2" style="cursor:pointer" onclick="javascript: mostrar('telaQuemSomos'); carregaPagina('telaQuemSomos.php','telaQuemSomos');">Quem Somos</span> </td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td colspan="2"><div align="center"><img style="cursor:pointer" onmouseover="javascript: mostrar('promo_csbc');" onmouseout="javascript: esconder('promo_csbc');" src="csbc_2010/imagens/logo.gif" alt="csbc_2010" width="100" height="80" border="0" /></div></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td height="34">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                </table>
		  </div>
	<!----------------------------------------------------------------------------------------->	
			<!-- Div que posiciona a imagem de fundo do log-in -->
		  <div id="telaCadLog">
		  </div>
	<!----------------------------------------------------------------------------------------->
		  	<div id="aviso_1">
		  	  <table width="732" height="208" border="0">
                  <tr>
                    <td width="31" height="21">&nbsp;</td>
                    <td width="398">&nbsp;</td>
                    <td width="10">&nbsp;</td>
                    <td width="83">&nbsp;</td>
                    <td width="188">&nbsp;</td>
                  </tr>
                  <tr>
                    <td height="158">&nbsp;</td>
                    <td class="cabecalho_3"><div class="alerta_1">Veja o site sem essas propagandas chatas!<br> http://www.ca-computacao-uespi.openwebster.com <-Link real.</div>OBS:. Este portal &eacute; totalmente independente da Universidade Estadual do Piau&iacute; - UESPI, bem como a todos os org&atilde;os que a comp&otilde;em. </td>
                    <td class="cabecalho_3">&nbsp;</td>
                    <td> <br />
                      <br />
                    <a href="http://www.uespi.br" target="_blank"><img src="imagens/logo_uespi_1.gif" alt="Universidade Estadual do Piauí - UESPI" width="82" height="110" border="0" longdesc="http://www.uespi.br" /></a></td>
                    <td align="left" valign="top"><p><br />
                      <img onclick="javascript: abrir('aviso_1');" src="imagens/seta_direita.gif" style="cursor:pointer" width="26" height="31" /><br />
                      <br />
                      <br />
                    <img onclick="javascript: fechar('aviso_1');" src="imagens/seta_esquerda.gif" style="cursor:pointer" width="28" height="27" /><br />
                    </p>
                    </td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
              </table>
		  	</div>
	<!----------------------------------------------------------------------------------------->
			<div id="telaCadastro"></div>
	<!----------------------------------------------------------------------------------------->
			<div id="telaMensagem">
				<?php
					if($mensagem > 0){
						include("telaMensagem.php");
					}
				?>
			</div>
	<!----------------------------------------------------------------------------------------->
		  	<div id="telaLogado">
				<?php
					if( $_SESSION["passeVerde"] == "logado" ){
						echo("
							<script type='text/javascript'>
								esconder('telaCadLog');
								mostrar('telaLogado');
							</script>
						");
						include("telaLogado.php");
					}
				?>
			</div>
	<!----------------------------------------------------------------------------------------->
			<div id="promo_csbc">
			  <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="392" height="284">
                <param name="movie" value="csbc_2010/imagens/csbc_2010.swf" />
                <param name="quality" value="high" />
				<param name="wmode" value="Transparent" />
                <embed src="csbc_2010/imagens/csbc_2010.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="392" height="284" wmode="Transparent"></embed>
		      </object>
		  </div>
	<!----------------------------------------------------------------------------------------->
			<div id="promo">
			  <table width="799" border="0">
		  <tr>
			<td width="462"><div align="right"><a href="http://www.sbc.org.br/" target="_blank"><img src="imagens/sbc.gif" alt="Sociedade Brasileira de Computa&ccedil;&atilde;o" width="400" height="52" border="0" /></a></div></td>
			<td width="62">&nbsp;</td>
			<td width="261"><a href="http://www.sbc.org.br/index.php?language=1&amp;subject=107" target="_blank"><img src="imagens/sbc_reg_prof.gif" width="111" height="52" border="0" /></a></td>
		  </tr>
		</table>
		</div>
	<!----------------------------------------------------------------------------------------->
	<div id="telaNota">
		<?php
			include("telaNota.php");
		?>
	</div>
	<!----------------------------------------------------------------------------------------->
	<div id="telaQuemSomos"></div>
	<!----------------------------------------------------------------------------------------->
		</div>
<!----------------------------------------------------------------------------------------->
	</body>
</html>
