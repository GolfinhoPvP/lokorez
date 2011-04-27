<?php 
	include_once("classes/Conexao.class.php");

	$protocolo 	= isset($_POST['tf_protocolo']) ? $_POST['tf_protocolo']	: NULL;
	$cliente 	= isset($_POST['tf_cliente']) 	? $_POST['tf_cliente'] 		: NULL;
	$clienteID 	= isset($_POST['cbCliente']) 	? $_POST['cbCliente'] 		: NULL;
	
	/* não usa Ç ç nas variaveis pô!*/
	$reclamacao = isset($_POST['ta_reclamacao'])? $_POST['ta_reclamacao'] 	: NULL;

	$dados[0] = $protocolo;
	$dados[1] = $clienteID;
	$dados[2] = $reclamacao;
	
	$conexao = new Conexao();
		
	
	/* Tua linha tava assim
	$comandoSQL = "INSERT INTO ra (protocolo, cliente_id, data, raclamaçao) VALUES ($dados[0], $dados[1], NOW(), $dados[2])";
	todas as variaveis que forem CHAR VARCHAR OU TEXT têm que entrar entre aspas*/
	$comandoSQL = "INSERT INTO ra (protocolo, cliente_id, status_id, data, reclamacao) VALUES ('$dados[0]', $dados[1], 1, NOW(), '$dados[2]')";
	
	//$controle = $conexao->salvar($comandoSQL);
	
	$urlLocation = "";
	
	if($conexao->salvar($comandoSQL)){
		/* Essa funçaõ header redireciona para qualquer lugar
		aogra eu vou passar uma variável por GET via URL
		é feito assim, ex: cliente_cadastro.php eu botaria um ? para
		para simbolizar que tem variaveis passando depois boto a variavel e o valor dela
		ficaria assim cliente_cadastro.php?cadastrado=nao*/
		$urlLocation = "rac_cadastro.php?cadastrado=sim";
		
		
	}else{
		$urlLocation = "rac_cadastro.php?cadastrado=nao";
	}
	
	echo '<script>window.location.href="'.$urlLocation.'"</script>';
?>