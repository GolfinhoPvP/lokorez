<?php
	include_once('conexao.class.php');
	
	$nome = isset($_POST['tf_nome']) ? $_POST['tf_nome'] : NULL;
	$telefone = isset($_POST['tf_telefone']) ? $_POST['tf_telefone'] : NULL;
	$ip = isset($_POST['tf_ip']) ? $_POST['tf_ip'] : NULL;
	
	$dados[0] = $nome;
	$dados[1] = $telefone;
	$dados[2] = $ip;
	echo($dados[0]);
	$conexao = new conexao();
	echo($dados[0]);
	
	$teste = $conexao->salvar("Insert into cliente (cliente_id, telefone, ip, endereco_id) values('$dados[0]','$dados[1]','$dados[2]',1)" ,$dados);
	
	echo($teste);
	
	if($teste == true){
		echo('teste');
		header("Location: cliente-cadastro.php");
	}else{
		echo('ERR0');
	}
?>dfsfsd