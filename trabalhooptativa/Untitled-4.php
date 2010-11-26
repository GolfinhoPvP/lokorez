<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<?php

$text = @$_POST["texto"];	
    
function contar_vogais($texto){
		$n_vogais = 0;
		for($cont=0; $cont < strlen($texto); $cont++){
			if( ($texto[$cont] == "a" ) ||
				($texto[$cont] == "e" ) ||
				($texto[$cont] == "i" ) ||
				($texto[$cont] == "o" ) ||
				($texto[$cont] == "u" )
			)
			$n_vogais += 1;
		}
		return ($n_vogais);
	}
	

?>
<body>
<p><a href="index.html">voltar</a></p>
<form id="formulario" name="formulario" method="post" action="">
  <label> escreva seu texto aqui:<br/>
  <input name="texto" type="text" id="texto" size="50" maxlength="50" />
  </label>
  <label></label>
  <p>
    <label>
      <input name="contar" type="submit" id="contar" value="Contar vogais" />
    </label>
  </p>
</form>
<table width="200" border="1">
      <tr>
        <td> 
		 	<?php echo ( "numero de vogais = " .contar_vogais($text)); ?>
        </td>
      </tr>
    </table>
</body>
</html>
