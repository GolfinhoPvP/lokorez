<?php
	if( isset($_SESSION["passeVerde"]) ){
		if( $_SESSION["passeVerde"] != "logado"){
			$_SESSION["mensagem"] = 4;
			header("Location: fake.php");
			die();
		}
	}else{
		$_SESSION["mensagem"] = 3;
		header("Location: fake.php");
		die();
	}
?>
<!--<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
	    <link href="css/texto.css" rel="stylesheet" type="text/css" />
        <link href="css/formatacao.css" rel="stylesheet" type="text/css" />
</head>
	
	<body>
	
		  	  --><table id="log" width="780" height="50" border="0">
                    <tr>
                      <td width="20">&nbsp;</td>
                      <td colspan="5" class="simples_3">Bem vindo(a) <span class="simples_4"><?php echo($_SESSION['nome']);?></span>, conectado(a) como <span class="simples_4"><?php echo($_SESSION['usuario']); ?></span>.<br />
                        email:	<span class="simples_4"><?php echo($_SESSION['email']);?></span>,	Matr&iacute;cula:	<span class="simples_4"><?php echo($_SESSION['matricula']);?></span>,	Bloco:<span class="simples_4"> <?php analisaBloco($_SESSION['bloco']);?></span>, Situa&ccedil;&atilde;o: <span class="simples_4"><?php analisaSituacao($_SESSION['situacao']);?></span>. </td>
                      <td width="99" ><a class="alerta_1" href="#" onclick="javascript: location.href='desconectar.php';">desconectar X</a> </td>
                    </tr>
                  </table>
<!--	</body>
</html>-->
