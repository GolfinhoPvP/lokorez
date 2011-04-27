<?php
	session_start();
	$nivelAcesso = "../../:2:3:4";
	include_once("../../utils/controladorAcesso.php");
	include_once("../../utils/funcoes.php");
	$key = antiSQL(isset($_GET["key"]) ? $_GET["key"] : NULL);
	if($key != NULL){
		include_once("../../utils/ConectarMySQL.class.php");
		$conexao = new ConectarMySQL();
		include_once("../../dao/DAOVerba.class.php");
		include_once("../../beans/Verba.class.php");
		$dao = new DAOVerba(NULL, NULL, NULL, NULL, NULL, "../../", $conexao);
		$verba = new Verba(NULL, NULL, NULL, NULL, NULL);
		$verba = $dao->getVerba($key);
		$conexao->commit();
		echo('<div id="A">'.$verba->getVerba().'</div>');
		echo('<div id="B">'.$verba->getEmpCodigo().'</div>');
		echo('<div id="C">'.$verba->getBanCodigo().'</div>');
		echo('<div id="D">'.$verba->getProCodigo().'</div>');
		echo('<div id="E">'.utf8_encode($verba->getDescricao()).'</div>');
	}else{
		echo("ERRO!");
	}
?>