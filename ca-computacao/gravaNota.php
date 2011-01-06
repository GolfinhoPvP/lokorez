<?php
	session_start();
	
	$nota = $_POST["mensagemTF"];	
	if((strlen($nota) > 200) or ($nota == NULL)){
		$_SESSION["mensagem"] = 11;
		header("Location: fake.php");
		die();
	}
	
	switch($_POST["categoriaHF"]){
		case "mensagem" : 	$categoria = 1;
							break;
	}
	
	$data = date("Y-m-d H:i:s");
	
	if((isset($_SESSION["passeVerde"]) == true) and ($_SESSION["passeVerde"] == "logado")){
		$idPessoa = $_SESSION["idPessoa"];
	}else{
		$idPessoa = 0;
	}
	
	include("conexao.php");
	
	$expressao = "INSERT INTO tome_nota (idPessoa, categoria, data, nota) VALUES ('$idPessoa', '$categoria', '$data', '$nota')";
	if( !mysql_query($expressao) ){
		//Caso não seja possivel gravar no banco
		$_SESSION["mensagem"] = 5;
		header("Location: fake.php");
		die();
	}
	
	mysql_close($conexao);
	header("Location: fake.php");
	$_SESSION["mensagem"] = 10;
	die();
?>
