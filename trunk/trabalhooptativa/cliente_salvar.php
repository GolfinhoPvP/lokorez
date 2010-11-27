<?php
	include_once("classes/Conexao.class.php");
	
	$nome 		= isset($_POST['tf_nome']) ? $_POST['tf_nome'] : NULL;
	$telefone	= isset($_POST['tf_telefone']) ? $_POST['tf_telefone'] : NULL;
	$ip 		= isset($_POST['tf_ip']) ? $_POST['tf_ip'] : NULL;
	
	$dados[0] = $nome;
	$dados[1] = $telefone;
	$dados[2] = $ip;
	
	$conexao = new Conexao();
	
	$comandoSQL = "INSERT INTO cliente (nome, telefone, ip, endereco_id) VALUES ('$dados[0]','$dados[1]','$dados[2]',1)";

	$teste = $conexao->salvar($comandoSQL);
	
	if($teste == true){
		/* Essa funçaõ header redireciona para qualquer lugar
		aogra eu vou passar uma variável por GET via URL
		é feito assim, ex: cliente_cadastro.php eu botaria um ? para
		para simbolizar que tem variaveis passando depois boto a variavel e o valor dela
		ficaria assim cliente_cadastro.php?cadastrado=nao*/
		echo('teste = verdadeiro' );
		header("Location: cliente_cadastro.php?cadastrado=sim");
	}else{
		echo('teste = falso');
		header("Location: cliente_cadastro.php?cadastrado=nao");
	}
?>