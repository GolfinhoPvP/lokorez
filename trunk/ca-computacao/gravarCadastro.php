<?php
	ob_start();
	session_start();
	
	if( !isset($_SESSION["passeVerde"]) ){
		//Caso seja notado que houve acesso não registrado pela página inicial emitir sinal de fraude 1, mensagem 3
		$_SESSION["mensagem"] = 3;
		header("Location: fake.php");
		die();
	}
	if($_SESSION["passeVerde"] != "primario"){
		//Caso tentar cadastrar dois usuário na mesma sessão emitir sinal de fraude 2, mensagem 4
		$_SESSION["mensagem"] = 4;
		header("Location: fake.php");
		die();
	}
	
	$matricula 		= $_POST["matriculaCad"];
	$nome 			= strtoupper($_POST["nomeCad"]);
	$email			= addslashes(strtolower($_POST["emailCad"]));
	$nomeUsuario	= strtolower($_POST["usuarioCad"]);
	$senhaUsuario	= addslashes($_POST["senha1Cad"]);
	$telefone1		= $_POST["telefone1Cad"];
	$telefone2		= $_POST["telefone2Cad"];
	
	if( strstr(stripslashes($email)," or ") or strstr(stripslashes($senhaUsuario)," or ") or  strstr($nomeUsuario," or ") ){
		//sql injection
		$_SESSION["mensagem"] = 8;
		header("Location: fake.php");
		die();
	}
	
	include("funcoes.php");
	//TESTAR SE SÓ FORAM PASSADOS NUMEROS NA MATRÍCULA
	if( !soNumero($matricula) ){
		$_SESSION["mensagem"] = 3;
		header("Location: fake.php");
		die();
	}

	include("conexao.php");

	$expressao = "SELECT * FROM aluno WHERE matricula='$matricula'";
	
	$resultado = mysql_query($expressao);
	$linha = mysql_fetch_array($resultado);
	
	if(mysql_num_rows($resultado) > 0){
		//Matrícula existente
		$_SESSION["mensagem"] = 13;
		mysql_free_result($resultado);
		mysql_close($conexao);
		header("Location: fake.php");
		die();
	}
	
	$expressao = "SELECT * FROM aluno WHERE usuario='$nomeUsuario'";
	
	$resultado = mysql_query($expressao);
	$linha = mysql_fetch_array($resultado);
	if(mysql_num_rows($resultado) > 0){
		//Nome de usuário existente
		$_SESSION["mensagem"] = 12;
		mysql_free_result($resultado);
		mysql_close($conexao);
		header("Location: fake.php");
		die();
	}
	
	$expressao = "SELECT * FROM pessoa WHERE email='$email'";
	
	$resultado = mysql_query($expressao);
	$linha = mysql_fetch_array($resultado);
	if(mysql_num_rows($resultado) > 0){
		//Email já cadastrado
		$_SESSION["mensagem"] = 14;
		mysql_free_result($resultado);
		mysql_close($conexao);
		header("Location: fake.php");
		die();
	}
	
	$expressao = "INSERT INTO pessoa (nome, email, telefone_1, telefone_2) VALUES ('$nome', '$email', '$telefone1', '$telefone2')";
	if( !mysql_query($expressao) ){
		//Caso não seja possivel gravar no banco
		$_SESSION["mensagem"] = 5;
		header("Location: fake.php");
		die();
	}

	$expressao = "SELECT idPessoa FROM pessoa WHERE email='$email'";
	$resultado = mysql_query($expressao);
	$linha = mysql_fetch_array($resultado);
	if(	$linha["idPessoa"] != "" ){
		$idPessoa = $linha["idPessoa"];
		$bloco = "0000.0";
		$situacao = 0;
		$expressao = "INSERT INTO aluno (idPessoa, matricula, usuario, senha, bloco, situacao) VALUES ('$idPessoa', '$matricula', '$nomeUsuario', ENCODE('$senhaUsuario', 'c@182'), '$bloco', '$situacao')";
		if( !mysql_query($expressao) ){
			//Caso não seja possivel gravar no banco
			$_SESSION["mensagem"] = 5;
			header("Location: fake.php");
			die();
		}
	}
	
	$_SESSION["passeVerde"] = "novato";
	
	mysql_free_result($resultado);
	mysql_close($conexao);
	//Caso o cadastro seja efetuado com sucesso
	$_SESSION["mensagem"] = 7;
	header("Location: fake.php");
	die();
?>