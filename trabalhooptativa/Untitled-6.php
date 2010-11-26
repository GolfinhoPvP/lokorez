<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<p>
  <a href="index.html">voltar</a></p>
<p>
  <?php 


$coluna = @$_POST['coluna'];
$linha = @$_POST['linha'];

echo('<table border="1">');
	$aux1 =1;
    echo "<table border = \"1\">";
    while($aux1 <= $linha){
        echo "<tr>";
        $aux2 = 1;
        while($aux2 <= $coluna){
            echo "<td>linha:$aux1, Coluna$aux2</td>";
            $aux2++;
        }
        echo "</tr>";
        $aux1++;
    }
    echo "</table>";

?>
</p>
<form id="form1" name="form1" method="post" action="">
  <p>coluna:
    <input name="coluna" type="text" id="coluna" size="5" maxlength="2" />
      <br/>
    linha:
    <input name="linha" type="text" id="linha" size="5" maxlength="2" />
  </p>
  <p>
    <input type="submit" name="criar" id="criar" value="Criar" />
  </p>
</form>
</body>
</html>
