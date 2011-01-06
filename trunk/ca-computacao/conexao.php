<?php  
	ob_start();
	$hostBanco = "localhost";
	$usuarioBanco = "root";
	$senhaBanco = "";
	$nomeBanco = "ca_computacao";
	
	/*$hostBanco = "localhost";
	$usuarioBanco = "cacomput_admin";
	$senhaBanco = "db147852";
	$nomeBanco = "cacomput_DATA";*/
	
	//Caso no estabelecer conexão com o servidor do banco de dados, enviar mensagem de erro 1
	if( !($conexao = mysql_connect($hostBanco,$usuarioBanco,$senhaBanco)) ){
		$_SESSION["mensagem"] = 1;
		header("Location: fake.php");
		die();
	}
	
	//Caso não consegir abrir o banco de dados, enviar mensagem de erro 2
	if( !($bancoDados = mysql_select_db($nomeBanco,$conexao)) ){
		$_SESSION["mensagem"] = 2;
		header("Location: fake.php");
		die();
	}
?>