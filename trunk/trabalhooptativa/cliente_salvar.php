<?php
	include_once("classes/Conexao.class.php");
	//Dados do cliente
	$nome 		= isset($_POST['tf_nome']) ? $_POST['tf_nome'] : NULL;
	$telefone	= isset($_POST['tf_telefone']) ? $_POST['tf_telefone'] : NULL;
	$ip 		= isset($_POST['tf_ip']) ? $_POST['tf_ip'] : NULL;
	
	//Dados do endereço do cliente
	$rua		= isset($_POST['tf_rua']) ? $_POST['tf_rua'] : NULL;
	$numero		= isset($_POST['tf_numero']) ? $_POST['tf_numero'] : NULL;
	$bairro		= isset($_POST['tf_bairro']) ? $_POST['tf_bairro'] : NULL;
	$cidade		= isset($_POST['tf_cidade']) ? $_POST['tf_cidade'] : NULL;
	$cep		= isset($_POST['tf_cep']) ? $_POST['tf_cep'] : NULL;
	$estado		= isset($_POST['tf_estado']) ? $_POST['tf_estado'] : NULL;
	$pais		= isset($_POST['tf_pais']) ? $_POST['tf_pais'] : NULL;
	$flag		= isset($_POST['rg_flag']) ? $_POST['rg_flag'] : NULL;
	
	//Dados do condominio
	$condominio	= isset($_POST['tf_condominio']) ? $_POST['tf_condominio'] : NULL;
	$bloco		= isset($_POST['tf_bloco']) ? $_POST['tf_bloco'] : NULL;
	$ap			= isset($_POST['tf_ap']) ? $_POST['tf_ap'] : NULL;
	
	$dados[0] = $nome;
	$dados[1] = $telefone;
	$dados[2] = $ip;
	$dados[3] = $rua;
	$dados[4] = $numero;
	$dados[5] = $bairro;
	$dados[6] = $cidade;
	$dados[7] = $cep;
	$dados[8] = $estado;
	$dados[9] = $pais;
	$dados[10] = $condominio;
	$dados[11] = $bloco;
	$dados[12] = $ap;
	$dados[13] = $flag;
	
	$conexao = new Conexao();
	
	mysqli->autocommit(TRUE);
	$comandoSQL = "START TRANSACTION";
	$teste = $conexao->salvar($comandoSQL);
	
	if ($teste == true)
	//comando inserir endereço do cliente
	$comandoSQL = "INSERT INTO endereco (rua, numero, bairro, cidade, cep, estado, pais, flag) VALUES ('$dados[3]', $dados[4], '$dados[5]', '$dados[6]', '$dados[7]', '$dados[8]', '$dados[9]', '$dados[13]')";
	$teste = $conexao->salvar($comandoSQL);
	$controle = 'inseriu endereço';
	
	if($teste == true && $flag == 's'){
	//comando inserir condominio do cliente
	$comandoSQL = "INSERT INTO condominio (nome, bloco, apartamento, endereco_id) VALUES ($dados[10]', '$dados[11]', $dados[12],  mysql_insert_id())";
	$teste = $conexao->salvar($comandoSQL);
	$controle = 'inseriu condominio';
	}
	
	if($teste == true){	
	//comando inserir cliente
	$comandoSQL = "INSERT INTO cliente (nome, telefone, ip, endereco_id) VALUES ('$dados[0]','$dados[1]','$dados[2]',  mysql_insert_id())";
	$teste = $conexao->salvar($comandoSQL);
	$comandoSQL = 'commit';
	$teste = $conexao->salvar($comandoSQL);
	
	$controle = 'inserui cliente';
	}
	
	if($teste == true){
		/* Essa funçaõ header redireciona para qualquer lugar
		aogra eu vou passar uma variável por GET via URL
		é feito assim, ex: cliente_cadastro.php eu botaria um ? para
		para simbolizar que tem variaveis passando depois boto a variavel e o valor dela
		ficaria assim cliente_cadastro.php?cadastrado=nao*/
		header("Location: cliente_cadastro.php?cadastrado=sim");
	}else{
		$comandoSQL = 'rollback';
		$teste = $conexao->salvar($comandoSQL);
		header("Location: cliente_cadastro.php?cadastrado=nao&erro=$controle&sql=$teste");
	}
?>