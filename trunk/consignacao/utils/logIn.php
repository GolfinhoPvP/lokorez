<?php
	include_once("funcoes.php");
	$tfNomeUsuario 	= antiSQL(isset($_POST["tfNomeUsuario"]) ? $_POST["tfNomeUsuario"] : NULL);
	$tfSenha 		= antiSQL(isset($_POST["tfSenha"]) ? $_POST["tfSenha"] : NULL);
	
	if($tfNomeUsuario != NULL && $tfSenha != NULL){
		include_once("../dao/DAOAdministrador.class.php");
		$daoAdm = new DAOAdministrador(NULL, NULL, NULL, NULL, "../");
		$resultado = $daoAdm->pesquisar("nomUsu", $tfNomeUsuario);
		while($linha = mysql_fetch_array($resultado)){
			if($tfNomeUsuario == $linha["adm_nome_usuario"] && $tfSenha == decodificar($linha["adm_senha"])){
				session_start();
				$_SESSION["codigo"] = $linha["adm_codigo"];
				$_SESSION["nivel"] = $linha["niv_codigo"];
				$_SESSION["nome"] = $linha["adm_nome"];
				$_SESSION["usuario"] = $linha["adm_nome_usuario"];
				$_SESSION["senha"] = $linha["adm_senha"];
				include_once("../dao/DAOLog.class.php");
				$log = new DAOLog(1, $linha["niv_codigo"], $linha["adm_codigo"], "Realizou log-in no sistema!", "../");
				$log->cadastrar();
				header("Location: ../admin.php");
				die();
			}
		}
	}
	header("Location: ../main.php?login=erro");
?>