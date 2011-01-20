<?php
	include_once("../../utils/ConectarMySQL.class.php");
	session_start();
	
	$key = isset($_GET["key"]) ? $_GET["key"] : NULL;
	
	$conexao = new ConectarMySQL();
	
	include_once("../../dao/DAOServidor.class.php");
	include_once("../../beans/Servidor.class.php");
	$dao = new DAOServidor(NULL, "../../", $conexao);
	$servidor = new Servidor(NULL, NULL);
	$servidor = $dao->getServidor($key);
	
	$resultado = $conexao->selecionar("SELECT * FROM verbas WHERE emp_codigo = ".$servidor->getEmpCodigo()." AND ban_codigo = '".$_SESSION["banco"]."'");
	
	if($resultado == false){
		die("Não foi possivel realizar a busca!");
	}
	
	echo('<option value="---">-------------------------------------------------------</option>');
	while($linha = mysqli_fetch_array($resultado)){
		echo('<option value="'.$linha["ver_verba"].'">'.$linha["ver_verba"].'</option>');
	}
?>