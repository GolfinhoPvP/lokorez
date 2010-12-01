<?php
	/*agora igualmente as variaveis de POST eu posso pegar do mesmo jeito as variáves por GET
	e lembre-se do video do professor, variáves por GET não devem ser usada para nada que tenha segurança no meio. só para controle*/
	$cadastrado = isset($_GET['logar']) ? $_GET['logar'] : NULL;
	
	$mensagem = NULL;
	if($cadastrado == "sim"){
		$mensagem = "";
	}else if($cadastrado == "nao"){
		$mensagem = "Usuário não registrado!";
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>Untitled Document</title>
		<style type="text/css">
		<!--
			@import url("css/geral.css");
		-->
		</style>
		<script language="javascript" src="scripts/javascript/funcoes.js" type="text/javascript">
		</script>
	</head>
	
	<body>
		<?php echo($mensagem); ?><!-- IMPRIMINDO A MENSAGEM PARA O USUÁRIO -->
		<form id="form1" name="form1" method="post" action="admin_logar.php">
		  nome: 
		<label>
		  <input name="tf_nome" type="text" id="tf_nome" size="25" maxlength="50" />
		  </label>
		<p>senha: 
		  <label>
		  <input name="tf_senha" type="password" id="tf_senha" size="25" maxlength="50" />
		  </label>
		</p>
		<p>
		  <label>
		  <input name="conectar" type="submit" id="conectar" value="Conectar" />
		  </label>
		</p>
		</form>
	</body>
</html>
