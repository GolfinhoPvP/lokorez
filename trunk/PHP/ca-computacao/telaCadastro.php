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
		<div id="telaCadastroInt">
			<form id="cadastroForm" name="cadastroForm" method="post" action="gravarCadastro.php">
							  <table width="287" height="616" border="0">
								<tr>
								  <td width="6" height="47">&nbsp;</td>
								  <td width="80">&nbsp;</td>
								  <td width="137">&nbsp;</td>
								  <td colspan="2" valign="top"><div align="left"><img src="imagens/cancel.png" alt="Fechar" width="16" height="16" style="cursor:pointer" onclick="javascript: esconder('telaCadastro');" /></div></td>
							    </tr>
								<tr>
								  <td>&nbsp;</td>
								  <td colspan="3"><div align="center" class="cabecalho_4">Cadastro</div></td>
								  <td width="14">&nbsp;</td>
								</tr>
								<tr>
								  <td height="22">&nbsp;</td>
								  <td colspan="3" class="alerta_1"><div align="center">*Professores devem informar uma matr&iacute;cula qualquer acima da 9000000.</div></td>
								  <td>&nbsp;</td>
								</tr>
								<tr>
								  <td height="21">&nbsp;</td>
								  <td class="simples_2">Matr&iacute;cula:</td>
								  <td>
									<label>
									  <input name="matriculaCad" type="text" class="campo_2" id="matriculaCad" size="22" maxlength="7" onkeyup="javascript: validaMatricula();" />
									</label>         
								  <td width="28" class="alerta_2"><div align="center">*</div></td>
								  <td>&nbsp;</td>
								</tr>
								<tr>
								  <td height="21">&nbsp;</td>
								  <td class="simples_2">Nome:</td>
								  <td><input name="nomeCad" type="text" class="campo_2" id="nomeCad" size="22" maxlength="100" /></td>
								  <td><div align="center"><span class="alerta_2">*</span></div></td>
								  <td>&nbsp;</td>
								</tr>
								<tr>
								  <td>&nbsp;</td>
								  <td class="simples_2">Email:</td>
								  <td><input name="emailCad" type="text" class="campo_2" id="emailCad" size="22" maxlength="50" /></td>
								  <td><div align="center"><span class="alerta_2">*</span></div></td>
								  <td>&nbsp;</td>
								</tr>
								<tr>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								</tr>
								<tr>
								  <td>&nbsp;</td>
								  <td colspan="3"><div align="center" class="cabecalho_3">Dados de usu&aacute;rio </div></td>
								  <td>&nbsp;</td>
								</tr>
								<tr>
								  <td>&nbsp;</td>
								  <td class="simples_2">Usu&aacute;rio </td>
								  <td><input name="usuarioCad" type="text" class="campo_2" id="usuarioCad" size="22" maxlength="25" /></td>
								  <td><div align="center"><span class="alerta_2">*</span></div></td>
								  <td>&nbsp;</td>
								</tr>
								<tr>
								  <td>&nbsp;</td>
								  <td class="simples_2">Senha:</td>
								  <td><input name="senha1Cad" type="password" class="campo_2" id="senha1Cad" size="22" maxlength="25" /></td>
								  <td><div align="center"><span class="alerta_2">*</span></div></td>
								  <td>&nbsp;</td>
								</tr>
								<tr>
								  <td>&nbsp;</td>
								  <td class="simples_2">Senha:<br />
									<span class="rodape_1">(Confirma&ccedil;&atilde;o)</span></td>
								  <td><input name="senha2Cad" type="password" class="campo_2" id="senha2Cad" size="22" maxlength="25" /></td>
								  <td><div align="center"><span class="alerta_2">*</span></div></td>
								  <td>&nbsp;</td>
								</tr>
								<tr>
								  <td>&nbsp;</td>
								  <td class="simples_2">Telefone 1: </td>
								  <td><input name="telefone1Cad" type="text" class="campo_2" id="telefone1Cad" size="22" maxlength="14" onkeyup="javascript: validaTelefone('telefone1Cad');" /></td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								</tr>
								<tr>
								  <td>&nbsp;</td>
								  <td class="simples_2">Telefone 2 </td>
								  <td><input name="telefone2Cad" type="text" class="campo_2" id="telefone2Cad" size="22" maxlength="14" onkeyup="javascript: validaTelefone('telefone2Cad');" /></td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								</tr>
								<tr>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>
									<label>
									  <input name="cadastrarCad" type="submit" class="simples_2" id="cadastrarCad" value="Cadastrar" onclick="javascript: return validadorcadastroForm();"/>
									</label>						  </td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								</tr>
								<tr>
								  <td>&nbsp;</td>
								  <td colspan="2" class="alerta_2">&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								</tr>
								<tr>
								  <td>&nbsp;</td>
								  <td colspan="2" class="alerta_2">*  Campos obrigat&oacute;rios.</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								</tr>
								<tr>
								  <td>&nbsp;</td>
								  <td colspan="2" class="alerta_2">&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								</tr>
			  </table>
		  </form>
		</div>
<!--	</body>
</html>-->
