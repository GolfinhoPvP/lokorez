<?php
	/*agora igualmente as variaveis de POST eu posso pegar do mesmo jeito as variáves por GET
	e lembre-se do video do professor, variáves por GET não devem ser usada para nada que tenha segurança no meio. só para controle*/
	$logar = isset($_GET['logar']) ? $_GET['logar'] : NULL;
	
	$mensagem = NULL;
	if($logar == "sim"){
		$mensagem = "";
	}else if($logar == "nao"){
		$mensagem = "Usuário não registrado!";
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>Untitled Document</title>
	</head>
	
	<body>
		<?php echo($mensagem); ?><!-- IMPRIMINDO A MENSAGEM PARA O USUÁRIO -->
		<form id="form1" name="form1" method="post" action="admin_logar.php">
		  <div align="center"></div>
		  <label></label>
		  <table width="100%" border="0">
            <tr>
              <td width="4%">&nbsp;</td>
              <td colspan="3">&nbsp;</td>
              <td width="5%">&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td width="26%"><p align="center">&nbsp;</p>
              </td>
              <td width="27%"><p>&nbsp;</p>
                <table width="243" border="1" align="center" bordercolor="#000000">
                <tr>
                  <td width="233"><p align="center">nome
                    <input name="tf_nome" type="text" id="tf_nome" size="25" maxlength="50" />
                  </p>
                    <p align="center">senha:
                      <label>
                        <input name="tf_senha" type="password" id="tf_senha" size="25" maxlength="50" />
                        </label>
                    </p>
                    <p align="center">
                      <label>
                      <input name="conectar" type="submit" id="conectar" value="Conectar" />
                      </label>
                    </p></td>
                </tr>
              </table>
                <p align="center">&nbsp;</p>
              </td>
              <td width="38%">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td colspan="3">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </table>
    </form>
	</body>
</html>
