<?php
	session_start();
	
	if(!isset($_SESSION["usuario"]) && !isset($_SESSION["senha"]))
		header("Location: admin.php");
		
	if(($_SESSION["usuario"] == NULL) && ($_SESSION["senha"] == NULL))
		header("Location: admin.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script language="javascript" src="javascript/functions.js"></script>
<script language="javascript">
	window.onload = function(){
		document.forms[1].date.value = getUserDate();
	}
</script>
</head>

<body>
<table width="200" border="1">
  <tr>
    <td><form id="form1" name="form1" method="post" action="actions/Logout.class.php">
      <label>
      <input name="logout" type="submit" id="logout" value="Desconectar" />
      </label>
    </form></td>
  </tr>
</table>
<table width="384" border="1">
  <tr>
    <td width="324">Confirme a data de valida&ccedil;&atilde;o das tabelas: 
      <form id="form3" name="form3" method="post" action="">
        <label>
          <input name="tfDate" type="text" id="tfDate" size="12" maxlength="10" />
        </label>
        <label>
        <input type="submit" name="Submit" value="Confirmar Data" />
        </label>
      </form>
    </td>
  </tr>
</table>
<table width="200" border="1">
  <tr>
    <td><form id="form2" name="form2" enctype="multipart/form-data" method="post" action="">
      <label> Enviar tabela DCR:
        <input name="file1" type="file" id="file1" size="50" />
      </label>
      <label>
      <input name="submit1" type="submit" id="submit1" value="Enviar DCR" />
      </label>
    </form></td>
  </tr>
</table>
</body>
</html>
