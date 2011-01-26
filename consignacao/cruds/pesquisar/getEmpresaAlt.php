<?php
	session_start();
	$nivelAcesso = "../../:2:3:4";
	include_once("../../utils/controladorAcesso.php");
	include_once("../../utils/funcoes.php");
	$key = antiSQLisset(isset($_GET["key"]) ? $_GET["key"] : NULL);
	if($key != NULL){
		include_once("../../utils/ConectarMySQL.class.php");
		$conexao = new ConectarMySQL();
		include_once("../../dao/DAOEmpresa.class.php");
		include_once("../../beans/Empresa.class.php");
		$dao = new DAOEmpresa(NULL, "../../", $conexao);
		$empresa = new Empresa(NULL, NULL);
		$empresa = $dao->getEmpresa($key);
		$conexao->commit();
		echo('<div id="A">'.utf8_encode($empresa->getDescricao()).'</div>');
	}else{
		echo("ERRO!");
	}
?>