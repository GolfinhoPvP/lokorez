<!--<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>Untitled Document</title>
	    <link href="css/formatacao.css" rel="stylesheet" type="text/css">
		<link href="css/formatacao2.css" rel="stylesheet" type="text/css" />
	    <link href="css/texto.css" rel="stylesheet" type="text/css">
        <link href="css/campos.css" rel="stylesheet" type="text/css">
        <link href="css/butoes.css" rel="stylesheet" type="text/css" />
	</head>
	
	<body>-->
		<div id="telaCadLogInt">
			<form name="form1" method="post" action="logar.php">
	<table width="334" height="227" border="0">
						  <tr>
						    <td height="21">&nbsp;</td>
						    <td colspan="3"><div align="right"><img src="imagens/cancel.png" alt="Fechar" width="16" height="16" style="cursor:pointer" onclick="javascript: esconder('telaCadLog');" /></div></td>
      </tr>
						  <tr>
							<td width="4" height="78">&nbsp;</td>
							<td colspan="2"><p align="center" class="cabecalho_1">							  Cadastro/Log-in</p>
							  <p align="center" class="cabecalho_1"><span class="alerta_1">Obs:. O site do CA de computa&ccedil;&atilde;o est&aacute; em constru&ccedil;&atilde;o, mas pedimos a todos que se cadastrem o mais breve poss&iacute;vel.</span></p></td>
							<td width="6"></td>
			  </tr>
						  <tr>
							<td height="21">&nbsp;</td>
							<td colspan="2" class="simples_1" align="center">&nbsp;</td>
							<td>&nbsp;</td>
						  </tr>
						  <tr>
							<td height="21">&nbsp;</td>
							<td width="134" class="simples_1"><div align="right">Nome de usu&aacute;rio: </div></td>
							<td width="172"><input name="nomeUsuario" type="text" class="campo_1" id="nomeUsuario" size="25" maxlength="25"></td>
							<td>&nbsp;</td>
						  </tr>
						  <tr>
							<td height="21">&nbsp;</td>
							<td class="simples_1"><div align="right">Senha: </div></td>
							<td><input name="senhaUsuario" type="password" class="campo_1" id="senhaUsuario" size="25" maxlength="25"></td>
							<td>&nbsp;</td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>
								<input name="conectar" type="submit" class="butoes_1" id="conectar" value="Conectar">						</td>
							<td>&nbsp;</td>
						  </tr>
			  </table>
			</form>
				  <table width="335" border="0">
					  <tr>
						<td width="55">&nbsp;</td>
						<td width="208" class="cabecalho_2">Se n&atilde;o est&aacute; cadastrado: </td>
						<td width="58">&nbsp;</td>
					  </tr>
					  <tr>
						<td>&nbsp;</td>
						<td><div align="center">
						  <input name="cadastrar" type="button" class="butoes_1" id="cadastrar" value="Cadastrar" onclick="javascript: mostrar('telaCadastro'); carregaPagina('telaCadastro.php','telaCadastro');">
						</div></td>
						<td>&nbsp;</td>
					  </tr>
					  <tr>
						<td>&nbsp;</td>
						<td class="rodape"><div align="center">
						  <p class="rodape_1">Universidade Estadual do Piau&iacute; - UESPI </p>
						  </div></td>
						<td>&nbsp;</td>
					  </tr>
				</table>
		</div>
<!--	</body>
</html>-->
