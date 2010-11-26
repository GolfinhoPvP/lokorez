<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

</head>
<?php
	$texto = @$_POST["texto"];
	$cor = @$_POST["cor"];
	
	switch($cor){
		case "azul" : $cor = "blue";
				break;
		case "verde" : $cor = "green";
				break;
		case "amarelo" : $cor = "yellow";
				break;
		case "rosa" : $cor = "pink";
				break;
	}

function imprimir($texto, $cor){
	
	echo ("<font color=\"$cor\"> $texto </font>");
}
?>
<body>
<p><a href="index.html">voltar</a></p>
<form id="formulario" name="formulario" method="post" action="">
  <label> Texto:
  <input name="texto" type="text" id="texto" size="50" maxlength="50" />
  </label>
  <label>
  <select name="cor" id="cor">
    <option>azul</option>
    <option>amarelo</option>
    <option>verde</option>
    <option>rosa</option>
  </select>
  <br />
  </label>
  <p>
    <label>
      <input name="imprimir" type="submit" id="imprimir" value="Imprimir" />
    </label>
  </p>
</form>
<table width="250" border="1">
      <tr>
        <td><?php imprimir($texto, $cor)  ?></td>
      </tr>
    </table>
	</body>

</html>

</body>
</html>
