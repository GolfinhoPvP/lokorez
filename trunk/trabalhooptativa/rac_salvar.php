<?php 
	include_once("classes/Conexao.class.php");

	$protocolo 	= isset($_POST['tf_protocolo']) ? $_POST['tf_protocolo']	: NULL;
	$cliente 	= isset($_POST['tf_cliente']) 	? $_POST['tf_cliente'] 		: NULL;
	$reclamaçao = isset($_POST['ta_reclamaçao'])? $_POST['ta_reclamaçao'] 	: NULL;

	$dados[0] = $protocolo;
	$dados[1] = $cliente;
	$dados[2] = $reclamaçao;
	
	echo('$dados');
	
	$conexao = new Conexao();
	
	$comandoSQL = "INSERT INTO ra (protocolo, cliente_id, data, raclamaçao) VALUES ($dados[0], $dados[1], NOW(), $dados[2])";
	
	//$controle = $conexao->salvar($comandoSQL);
	
	if($conexao->salvar($comandoSQL)){
		/* Essa funçaõ header redireciona para qualquer lugar
		aogra eu vou passar uma variável por GET via URL
		é feito assim, ex: cliente_cadastro.php eu botaria um ? para
		para simbolizar que tem variaveis passando depois boto a variavel e o valor dela
		ficaria assim cliente_cadastro.php?cadastrado=nao*/
		header("Location: rac_cadastro.php?cadastrado=sim");
	}else{
		header("Location: rac_cadastro.php?cadastrado=nao");
	}
?>