<?php
	session_start();
	
	if( (!isset($_SESSION["usuario"])) and ($_SESSION["passeVerde"] != "logado") ){
		$usuario = strtolower($_POST["nomeUsuario"]);
		$senha = $_POST["senhaUsuario"];
		
		if($usuario == "" or $senha == ""){
			$_SESSION["mensagem"] = 9;
			header("Location: fake.php");
			die();
		}
		
		if( strstr($usuario," or ") or strstr($senha," or ") ){
			//sql injection
			$_SESSION["mensagem"] = 8;
			header("Location: fake.php");
			die();
		}
		
		include("conexao.php");
		
		$expressao = "SELECT idAluno, idPessoa, matricula, usuario, DECODE(senha, 'c@182') , bloco, situacao FROM aluno WHERE usuario='$usuario' AND senha=ENCODE('$senha','c@182')";
		$resultado = mysql_query($expressao);
		$linha = mysql_fetch_array($resultado);
		
		if( ($linha['usuario'] == $usuario) and (stripslashes($linha["DECODE(senha, 'c@182')"]) == $senha) ){
			//Exito no login
			$_SESSION["mensagem"] = 6;
			$_SESSION["usuario"] = $linha['usuario'];
			$_SESSION["idPessoa"] = $linha['idPessoa'];
			$_SESSION["matricula"] = $linha['matricula'];
			$_SESSION["bloco"] = $linha['bloco'];
			$_SESSION["situacao"] = $linha['situacao'];
			
			$idPessoa = $linha["idPessoa"];
			$expressao = "SELECT * FROM pessoa WHERE idPessoa='$idPessoa'";
			$resultado = mysql_query($expressao);
			$linha = mysql_fetch_array($resultado);
			
			$_SESSION["nome"] = $linha['nome'];
			$_SESSION["email"] = stripslashes($linha['email']);
			
			$_SESSION["passeVerde"] = "logado";
			
			mysql_free_result($resultado);
			mysql_close($conexao);
			header("Location: fake.php");
			die();
		}else{
			$_SESSION["mensagem"] = 9;
			header("Location: fake.php");
			die();
		}
	}else if( isset($_SESSION["usuario"]) and isset($_SESSION["senha"]) and ($_SESSION["passeVerde"] != "logado") ){
		unset($_SESSION["usuario"]);
		unset($_SESSION["senha"]);
		header("Location: logar.php");
		die();
	}else{
		$_SESSION["mensagem"] = 3;
		header("Location: fake.php");
		die();
	}
?>