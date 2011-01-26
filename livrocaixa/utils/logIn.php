<?php
	include_once("funcoes.php");
	$tfNomeUsuario 	= antiSQL(isset($_POST["tfNomeUsuario"]) ? $_POST["tfNomeUsuario"] : NULL);
	$tfSenha 		= antiSQL(isset($_POST["tfSenha"]) ? $_POST["tfSenha"] : NULL);
	
	if($tfNomeUsuario != NULL && $tfSenha != NULL){
		include_once("ConectarMySQL.class.php");
		$conexao = new ConectarMySQL();
		include_once("../dao/DAOAdministrador.class.php");
		$daoAdm = new DAOAdministrador(NULL, NULL, NULL, NULL, NULL, "../", $conexao);
		$resultado = $daoAdm->pesquisar("nomUsu", $tfNomeUsuario);
		while($linha = mysqli_fetch_array($resultado)){
			if($tfNomeUsuario == $linha["adm_nome_usuario"] && $tfSenha == decodificar($linha["adm_senha"])){
				session_start();
				$_SESSION["codigo"] = $linha["adm_codigo"];
				$_SESSION["pessoa"] = $linha["pes_codigo"];
				$_SESSION["nivel"] = $linha["niv_codigo"];
				$_SESSION["banco"] = $linha["ban_codigo"];
				$_SESSION["usuario"] = $linha["adm_nome_usuario"];
				$_SESSION["senha"] = $linha["adm_senha"];
				$linha = mysqli_fetch_array($conexao->selecionar("SELECT ban_descricao FROM bancos WHERE ban_codigo='".$linha["ban_codigo"]."'"));
				$_SESSION["banco_nome"] = $linha["ban_descricao"];
				include_once("../dao/DAOLog.class.php");
				$log = new DAOLog($linha["pes_codigo"], 1, $linha["niv_codigo"], $linha["adm_codigo"], 1, "Realizou log-in no sistema!", "../", $conexao);
				$log->cadastrar();
				$conexao->commit();
				header("Location: ../main.php");
				die();
			}
		}
		$conexao->commit();
	}
	header("Location: ../index.php?login=erro");
?>