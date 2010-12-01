<?php
	include_once("classes/Conexao.class.php");
	
	$nome 	= isset($_POST['tf_nome']) ? $_POST['tf_nome'] : NULL;
	$senha	= isset($_POST['tf_senha']) ? $_POST['tf_senha'] : NULL;
	
	$dados[0] = $nome;
	$dados[1] = $senha;
	
	$conexao = new Conexao();
	
	$comandoSQL = "SELECT * FROM admin WHERE admin_nome='$dados[0]' AND admin_senha='$dados[1]'";
	
	if($conexao->contadorDeResultado($comandoSQL) > 0){
		/* Essa funçaõ header redireciona para qualquer lugar
		aogra eu vou passar uma variável por GET via URL
		é feito assim, ex: cliente_cadastro.php eu botaria um ? para
		para simbolizar que tem variaveis passando depois boto a variavel e o valor dela
		ficaria assim cliente_cadastro.php?cadastrado=nao*/
		header("Location: cliente_cadastro.php?logar=sim");
	}else{
		header("Location: index.php?logar=nao");
	}
?>