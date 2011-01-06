<?php
	$idPessoa = $linha['idPessoa'];
	if($idPessoa != 0){
		$expressao = "SELECT * FROM aluno WHERE idPessoa = '$idPessoa'";
		$resultado = mysql_query($expressao);
		$linha2 = mysql_fetch_array($resultado);
		$usuario = $linha2["usuario"];
		$situacao = $linha2["situacao"];
	}else{
		$usuario = "Anônimo";
	}
	
	/*pronto, agora a DATA/HORA do PC , esta armazenada nesta variavel no formato timestamp (AAAA-MM-DD HH:ii:ss).
	agora vamos decompor esta variavel..
	
	$mes = substr($linha['data'],5,2);
	$dia = substr($linha['data'],8,2);
	$ano = substr($linha['data'],0,4);
	$hora = substr($linha['data'],11,2);
	$minutos = substr($linha['data'],14,2);
	$segundos = substr($linha['data'],17,4);
	
	$data = date("d-M-Y G:H:i", mktime($dia,$mes,$ano,$hora,$minutos,$segundos));*/
	
	$data = $linha["data"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link href="css/formatacao2.css" rel="stylesheet" type="text/css" />
<link href="css/formatacao.css" rel="stylesheet" type="text/css" />
<link href="css/texto.css" rel="stylesheet" type="text/css" />
</head>
	
<body>
<table width="965" border="1" bordercolor="" bordercolorlight="#000000" bordercolordark="#000000" class="largura" id="notinha">
          <tr>
            <td width="53" class="simples_3">Postado por: <?php echo($usuario); ?></td>
            <td width="586" class="simples_3">, no dia: <?php echo($data); ?></td>
            <td width="298"></td>
          </tr>
          <tr>
            <td colspan="3"><?php echo($linha["nota"]); ?></td>
          </tr>
</table>
<p><br />
  <?php
	if($situacao == 1){
		/*echo('<script type="text/javascript"> mudaFundo("notinha","#0066FF"); </script>');*/
	}
?>
</p>
<p>&nbsp;</p>
<table width="200" border="0" >
  <tr>
    <td class="notinha">&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
