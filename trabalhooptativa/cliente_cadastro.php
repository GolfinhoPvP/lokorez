<?php
	/*agora igualmente as variaveis de POST eu posso pegar do mesmo jeito as variáves por GET
	e lembre-se do video do professor, variáves por GET não devem ser usada para nada que tenha segurança no meio. só para controle*/
	$cadastrado = isset($_GET['cadastrado']) ? $_GET['cadastrado'] : NULL;
	$logar = isset($_GET['logar']) ? $_GET['logar'] : NULL;
	
	$mensagem = NULL;
	if($cadastrado == "sim"){
		$mensagem = "Usuário cadastrado com sucesso!";
	}else if($cadastrado == "nao"){
		$mensagem = "Usuário não foi cadastrado!";
	}else if($logar == "sim"){
		$mensagem = "Bem vindo ADMINISTRADOR";
	}
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Inserir Cliente</title>
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
		<form id="formulario_cliente" name="formulario_cliente" method="post" action="cliente_salvar.php" onSubmit="javascript: return validarCliente('formulario_cliente');">
		  <p>nome
			<input type="text" name="tf_nome" id="tf_nome" />
		  </p>
		  <p> telefone
			<input name="tf_telefone" type="text" id="tf_telefone" onkeydown="javascript: return validarTelefone('tf_telefone', event);" size="18" maxlength="14" />
		  </p>
		  <p>ip  
			<input name="tf_ip" type="text" id="tf_ip" onkeydown="javascript: return validarIP('tf_ip', event);" size="20" maxlength="15"/>
		  </p>
		  <p>
			<input type="submit" name="enviar" id="enviar" value="Enviar" />
		    <input type="reset" name="limpar" id="limpar" value="Limpar" />
		  </p>
	</form>
	</body>
</html>
