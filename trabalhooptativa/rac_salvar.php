<?php 
	include_once("classes/Conexao.class.php");

	$protocolo 	= isset($_POST['tf_protocolo']) ? $_POST['tf_protocolo']	: NULL;
	$cliente 	= isset($_POST['tf_cliente']) 	? $_POST['tf_cliente'] 		: NULL;
	/* não usa Ç ç nas variaveis pô!*/
	$reclamacao = isset($_POST['ta_reclamacao'])? $_POST['ta_reclamacao'] 	: NULL;

	$dados[0] = $protocolo;
	$dados[1] = $cliente;
	$dados[2] = $reclamacao;
	
	$conexao = new Conexao();
	
	/* Nova função que eu criei em conexão, olha lá
	e nome não é um parametro bom pra fazer pesquisa, tem que ser CPF, depois agente muda*/
	$comandoSQL = "SELECT * FROM cliente WHERE nome='$dados[1]'";
	$resultado = $conexao->pesquisar($comandoSQL);
	
	/* esse comando retorna uma linha de resultado, se botar ele num while ou for, ele vai retornando tudo, se houver mais linhas
	o certo, é ecistir só um cliente, por isso tem que ser um CPF*/
	$linha = mysql_fetch_array($resultado);
	
	/* se tiver um resultado ele retornou uma linha de result, senão um false
	por isso, é importante que o cliente exista*/
	if($linha != false){
		$idCliente = $linha["cliente_id"];
	}else{
		//O cliente não exite, tem que haver tratamento
		$idCliente = "lixo";
	}
	
	/* Tua linha tava assim
	$comandoSQL = "INSERT INTO ra (protocolo, cliente_id, data, raclamaçao) VALUES ($dados[0], $dados[1], NOW(), $dados[2])";
	todas as variaveis que forem CHAR VARCHAR OU TEXT têm que entrar entre aspas*/
	$comandoSQL = "INSERT INTO ra (protocolo, cliente_id, status_id, data, reclamacao) VALUES ('$dados[0]', $idCliente, 1, NOW(), '$dados[2]')";
	
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