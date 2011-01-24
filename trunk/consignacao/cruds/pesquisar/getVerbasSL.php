<?php
	session_start();
	$nivelAcesso = "../../";
	include_once("../../utils/controladorAcesso.php");
	include_once("../../utils/ConectarMySQL.class.php");
	
	$key = isset($_GET["key"]) ? $_GET["key"] : NULL;
	
	$conexao = new ConectarMySQL();
	
	if($key != NULL){
		include_once("../../dao/DAOServidor.class.php");
		include_once("../../beans/Servidor.class.php");
		$dao = new DAOServidor(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, "../../", $conexao);
		$servidor = new Servidor(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
		$servidor = $dao->getServidor($key);
	
	
		if($_SESSION["codigo"] != 1)
			$banco = $_SESSION["banco"];
		else
			$banco = "%";
		
		$resultado = $conexao->selecionar("SELECT * FROM verbas v INNER JOIN produtos p ON v.pro_codigo = p.pro_codigo WHERE v.emp_codigo = ".$servidor->getEmpCodigo()." AND v.ban_codigo LIKE '".$banco."'");
	}else{
		$resultado = $conexao->selecionar("SELECT * FROM verbas ORDER BY ver_verba");
	}
	
	if($resultado == false){
		die("Não foi possivel realizar a busca!");
	}
	
	echo('<option value="---">-------------------------------------------------------</option>');
	if($key != NULL){
		while($linha = mysqli_fetch_array($resultado)){
			echo('<option value="'.$linha["ver_verba"].'">'.utf8_encode($linha["pro_descricao"]).", Prazo: ".utf8_encode($linha["pro_prazo_maximo"]).'</option>');
		}
	}else{
		while($linha = mysqli_fetch_array($resultado)){
			echo('<option value="'.$linha["ver_verba"].'">'.$linha["ver_verba"]." - ".$linha["ver_descricao"].'</option>');
		}
	}
	$conexao->commit();
?>