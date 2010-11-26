<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<?php 

$texto  = @$_POST[texto];
$chave = @$_POST[chave];

function busca_chave($texto, $chave){

if (strlen($chave) > 1){
	return( "Erro: -1");
	}
	
	else {
		$contador = 0;
		for ($aux = 0; $aux < strlen($texto); $aux ++){
				if($texto[$aux] == $chave)
					$contador += 1;
			}
	return ($contador);
	}
}

?>
<body>
<p><a href="index.html">voltar</a></p>
<form id="form1" name="form1" method="post" action="">
  <p>digite o texto aqui :<br/>
      <input name="texto" type="text" id="texto" size="50" maxlength="50" />
  </p>
  <p>buscar por:
    <input name="chave" type="text" id="chave" size="5" maxlength="5" />
      <input name="buscar" type="submit" id="buscar" value="buscar" />
  </p>
</form>
<table width="250" border="1">
  <tr>
    <td> <?php echo('numero de ocorrencias: ' .busca_chave($texto, $chave)) ?> </td>
  </tr>
</table>

</body>
</html>
