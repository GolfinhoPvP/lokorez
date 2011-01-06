<?php
	session_start();
	//Script para controlar as sessões	
	if(!isset($_SESSION["passeVerde"])){//Caso não exista sessão criar uma
		$_SESSION["passeVerde"] = "primario";
		$_SESSION["mensagem"] = 0;
	}else{
		if(isset($_GET["log"])){
			if($_GET["log"] == "down"){
				$_SESSION["passeVerde"] = "primario";
				$_SESSION["mensagem"] = 0;
				unset($_SESSION["usuario"]);
				unset($_SESSION["idPessoa"]);
				unset($_SESSION["matricula"]);
				unset($_SESSION["bloco"]);
				unset($_SESSION["situacao"]);
				unset($_SESSION["nome"]);
				unset($_SESSION["email"]);
			}
		}else if($_GET["log"] == "end"){
			session_destroy();
		}
	}
?>