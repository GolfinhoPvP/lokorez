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
		<div id="telaConfBoxInt">
		  	<form id="form2" name="form2" method="post" action="">
		    <table width="245" border="0" class="simples_1">
              <tr>
                <td width="64">C&oacute;digo:</td>
                <td id="cod" width="94">COD</td>
                <td width="73" class="alerta_1"><div align="right"><img src="imagens/cancel.png" alt="Fechar" width="16" height="16" style="cursor:pointer" onClick="javascript: esconder('telaConfBox');" /></div></td>
              </tr>
              <tr>
                <td colspan="2">Digite o c&oacute;digo acima para confirmar :
                  <input name="codigoTF" type="text" class="campo_2" id="codigoTF" size="4" maxlength="4" />
               </td>
                <td><input name="confirmarMS" type="button" class="butoes_1" id="confirmarMS" value="Confirmar" onclick="javascript: validaQuantMensa(); validaCodigo();"/></td>
              </tr>
            </table>
			</form>
		</div>
<!--</body>
</html>-->
