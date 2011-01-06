<?php
	$mensagem = $_SESSION["mensagem"];
?>
<!--<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
	    <link href="css/formatacao.css" rel="stylesheet" type="text/css" />
        <link href="css/texto.css" rel="stylesheet" type="text/css" />
</head>
	
<body>-->
	<script type="text/javascript">
		mostrar("telaMensagem");
	</script>
	<table id="msg2" width="27" border="0">
      <tr>
        <td width="17" height="19" align="right" bgcolor="#FFFFFF"><img src="imagens/cancel.png" alt="Fechar" width="16" height="16" style="cursor:pointer" onClick="javascript: esconder('telaMensagem');" /></td>
      </tr>
      <tr>
        <td><?php
		//erro de conexão ao servidor
		if($mensagem == 1){
			include("mensagens/msg1.php");
		}
		//erro de conexão ao banco
		if($mensagem == 2){
			include("mensagens/msg2.php");
		}
		//acesso externo
		if($mensagem == 3){
			include("mensagens/msg3.php");
		}
		//cadastar vários
		if($mensagem == 4){
			include("mensagens/msg4.php");
		}
		//gravação de dados
		if($mensagem == 5){
			include("mensagens/msg5.php");
		}
		//login com sucesso
		if($mensagem == 6){
			include("mensagens/msg6.php");
		}
		//cadastro sucesso
		if($mensagem == 7){
			include("mensagens/msg7.php");
		}
		//sql inject
		if($mensagem == 8){
			include("mensagens/msg8.php");
		}
		//usuário inexistente
		if($mensagem == 9){
			include("mensagens/msg9.php");
		}
		//nota salva com sucesso
		if($mensagem == 10){
			include("mensagens/msg10.php");
		}
		//dados incompatíveis
		if($mensagem == 11){
			include("mensagens/msg11.php");
		}
		//dados incompatíveis
		if($mensagem == 12){
			include("mensagens/msg12.php");
		}
		//dados incompatíveis
		if($mensagem == 13){
			include("mensagens/msg13.php");
		}
		//dados incompatíveis
		if($mensagem == 14){
			include("mensagens/msg14.php");
		}
		$_SESSION["mensagem"] = 0;
	?>
	</td>
      </tr>
    </table>
<!--</body>
</html>-->
