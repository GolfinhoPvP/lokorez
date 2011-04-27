<?php
	session_start();
	$_SESSION["administrador"] = NULL;
	
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
		<title>RAC</title>
		<style type="text/css">
		<!--
			@import url("scripts/css/geral.css");
		-->
		</style>
		<script language="javascript" type="text/javascript">
			window.onload = function(){
				diff = ((screen.width - 750)/2);
				document.getElementById("divTela").style.left = diff+"px";
			}
		</script>
	</head>
	
	<body>
	<div id="divTela">
	<div id="divBox"><img src="imagens/box.png" width="246" height="237" />
	  <div id="divRac">
		<img src="imagens/rac_logo.png" width="169" height="64" />	</div>
	</div>
	
	<div id="divLog">
		<div id="divMSG">
		<?php echo('<p class="texto3">'.$mensagem.'</p>'); ?>	</div>
		<table width="317" height="150" border="0">
  <tr>
    <td align="center" valign="middle" background="<?php if($mensagem != NULL){echo('imagens/box_vermelho.png');}else{echo('imagens/box_normal.png');} ?>"><form id="form1" name="form1" method="post" action="admin_logar.php">
		<p><span class="texto2">Nome:
		    <input name="tf_nome" type="text" id="tf_nome" size="25" maxlength="50" />
		    <br />
		Senha:
		</span>
		  <input name="tf_senha" type="password" id="tf_senha" size="25" maxlength="50" />
		<br />
		<br />
		<input name="conectar" type="submit" id="conectar" value="Conectar" />
		</p>
		</form></td>
  </tr>
</table>

		
	</div>
	<div id="divLabel">
		<p align="center" class="texto1">Universidade Estadual do Piau&iacute; - UESPI<br />
              Centro de Tecnologia e Urbanismo - CTU<br />
              Bacharelado em Ci&ecirc;ncia da Computa&ccedil;&atilde;o - Optativa I, prof. M&aacute;rcio Igo Carvalho</p>
              <p align="center" class="texto1">Antonio Jos&eacute; Alves<br />
              Hector Efrain</p>
	</div>
	<div id="divLogo">
		<img src="imagens/hector_e_aj_logo.png" width="225" height="49" />	</div>
	</div>
	</body>
</html>
