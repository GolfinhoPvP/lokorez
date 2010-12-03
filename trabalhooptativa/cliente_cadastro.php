<?php
	session_start();
	
	if(!(isset($_SESSION["administrador"]) == "logado"))
		header("Location: index.php?logar=nao");

	/*agora igualmente as variaveis de POST eu posso pegar do mesmo jeito as variáves por GET
	e lembre-se do video do professor, variáves por GET não devem ser usada para nada que tenha segurança no meio. só para controle*/
	$cadastrado = isset($_GET['cadastrado'])? $_GET['cadastrado'] 	: NULL;
	$logar 		= isset($_GET['logar']) 	? $_GET['logar'] 		: NULL;
	
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
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>Inserir Cliente</title>
		<style type="text/css">
		<!--
			@import url("scripts/css/geral.css");
		-->
		</style>
		<script language="javascript" src="scripts/javascript/funcoes.js" type="text/javascript">
		</script>
	</head>
	
	<body >
		<?php echo($mensagem);?><!-- IMPRIMINDO A MENSAGEM PARA O USUÁRIO -->
<form id="formulario_cliente" name="formulario_cliente" method="post" action="cliente_salvar.php" onSubmit="javascript: return validarCliente('formulario_cliente');">
 <p>Nome
<input name="tf_nome" type="text" id="tf_nome" size="40" />
 Telefone
<input name="tf_telefone" type="text" id="tf_telefone" size="18" maxlength="14" onKeyDown="javascript: return validarTelefone('tf_telefone', event)"/>
IP  
<input name="tf_ip" type="text" id="tf_ip" size="20" maxlength="15" onKeyDown="javascript: return validarIP('tf_ip', event)"/>
 </p>
  <p>
Endere&ccedil;o</p>
<p>Rua 
<input name="tf_rua" type="text" id="tf_rua" size="60">
Numero
<input name="tf_numero" type="text" id="tf_numero" size="7">
</p>
<p>Bairro
<input name="tf_bairro" type="text" id="tf_bairro">
Cidade
<input name="tf_cidade" type="text" id="tf_cidade">
</p>
<p>CEP
<input name="tf_cep" type="text" id="tf_cep">
Estado
<input name="tf_estado" type="text" id="tf_estado" size="4" maxlength="2">
</p>
<p>Pa&iacute;s
<input name="tf_pais" type="text" id="tf_pais">
</p>
<p>
<label>
<input name="rg_flag" type="radio" value="n" checked onClick=" javascript: esconder('teste2')">
Residencial</label>
<label>
<input type="radio" name="rg_flag" value="s" onClick=" javascript: mostrar('teste2'); ">
Condominio</label>
</p>
<div id="teste2">
	Complemento
	</p>
	<p>Condominio
	<input name="tf_condominio" type="text" id="tf_condominio" size="40">
	</p>
	<p>Bloco
	<input name="tf_bloco" type="text" id="tf_bloco" size="20">
	Ap
	<input name="tf_ap" type="text" id="tf_ap" size="10">
	</p>

</div>
<p>
  <input type="submit" name="enviar" id="enviar" value="enviar">
  <input type="reset" name="limpar" id="limpar" value="Limpar">
</p>
</form>
</body>
</html> 
