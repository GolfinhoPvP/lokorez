<?php
	$uf = isset($_GET["uf"]) ? $_GET["uf"] : "%";
	$cep = isset($_GET["cep"]) ? $_GET["cep"] : "%";
	$text = isset($_GET["text"]) ? $_GET["text"] : "%";
	$cidade = rawurldecode(isset($_GET["cidade"]) ? $_GET["cidade"] : "%");
	$bairro = rawurldecode(isset($_GET["bairro"]) ? $_GET["bairro"] : "%");

	if($text != NULL && $uf != NULL){
		require_once("Connect.class.php");
		include_once("../beans/Variables.class.php");
		
		$variables = new Variables();
		$connect = new Connect($variables->dbHost, $variables->dbUser, $variables->dbPassword, $variables->dbName);
		$connect->start();
		
		$db = "br_estado_".strtolower($uf);
		$text .= "%";
		
		$result = $connect->execute("SELECT distinct id, logradouro FROM $db WHERE bairro LIKE '$bairro' AND cidade LIKE '$cidade' AND logradouro LIKE '$text'");
		echo("<div id='---'>Selecione um logradouro!</div>");
		while($row = mysql_fetch_assoc($result)) {
			echo("<div id='".$row["id"]."' onclick='javascript: setLogradouto(".$row["id"].", \"tfEnd\");' style='cursor:pointer'>".utf8_encode($row["logradouro"])."</div>");
		}
	}else{
		echo("Digite seu logradouro");
	}
?>