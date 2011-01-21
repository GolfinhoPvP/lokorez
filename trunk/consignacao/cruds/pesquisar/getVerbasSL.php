<?php
	include_once("../../utils/ConectarMySQL.class.php");
	session_start();
	
	$key = isset($_GET["key"]) ? $_GET["key"] : NULL;
	
	$conexao = new ConectarMySQL();
	
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
	
	if($resultado == false){
		die("Não foi possivel realizar a busca!");
	}
	
	echo('<option value="---">-------------------------------------------------------</option>');
	while($linha = mysqli_fetch_array($resultado)){
		echo('<option value="'.$linha["ver_verba"].'">'.utf8_encode($linha["pro_descricao"]).", Prazo: ".utf8_encode($linha["pro_prazo_maximo"]).'</option>');
	}
?>