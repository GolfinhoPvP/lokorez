<?php
	/*agora igualmente as variaveis de POST eu posso pegar do mesmo jeiito as variáves por GET
	e lembre-se do vidio do professor, variáves por GET não devem ser usada para nada que tenha segurança no meio. só para controle*/
	$cadastrado = isset($_GET['cadastrado']) ? $_GET['cadastrado'] : NULL;
	
	$mensagem = NULL;
	if($cadastrado == "sim"){
		$mensagem = "Usuário cadastrado com sucesso!";
	}else if($cadastrado == "nao"){
		$mensagem = "Usuário não foi cadastrado!";
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Inserir Cliente</title>
	</head>
	
	<body>
		<?php echo($mensagem); ?><!-- IMPRIMINDO A MENSAGEM PARA O USUÁRIO -->
		<form id="form1" name="form1" method="post" action="cliente_salvar.php">
		  <p>nome
			<input type="text" name="tf_nome" id="tf_nome" />
		  </p>
		  <p> telefone
			<input type="text" name="tf_telefone" id="tf_telefone" />
		  </p>
		  <p>ip  
			<input type="text" name="tf_ip" id="tf_ip" />
		  </p>
		  <p>
			<input type="submit" name="enviar" id="enviar" value="Submit" />
		  </p>
		</form>
	</body>
</html>
