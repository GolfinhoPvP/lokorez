<?php
	$uf 	= isset($_GET["uf"]) ? $_GET["uf"] : "%";
	$cidade = urldecode(isset($_GET["cidade"]) ? $_GET["cidade"] : "%");
	$bairro = urldecode(isset($_GET["bairro"]) ? $_GET["bairro"] : "%");
	$cep 	= isset($_GET["cep"]) ? $_GET["cep"] : "%";
	$text 	= urldecode(isset($_GET["text"]) ? $_GET["text"] : "%");

	if($text != NULL && strlen($uf) > 1 && strlen($cidade) > 1 && strlen($bairro) > 1){
		require_once("Connect.class.php");
		include_once("../beans/Variables.class.php");
		
		$variables = new Variables();
		$connect = new Connect($variables->dbHost, $variables->dbUser, $variables->dbPassword, $variables->dbName);
		$connect->start();
		
		$db = "br_estado_".strtolower($uf);
		$text .= ".{0,}";
		
		$sql = "SELECT distinct tp_logradouro FROM $db WHERE tp_logradouro REGEXP '$text' AND cidade = '$cidade' AND bairro = '$bairro'";
		$result = $connect->execute($sql);
		
		echo("<div id='---'>Selecione um logradouro!</div>");
		while($row = mysql_fetch_assoc($result)) {
			echo("<div id='".$row["tp_logradouro"]."' onclick='javascript: setLogradouto(\"".urlencode($row["tp_logradouro"])."\", \"tfTipoLog\");' style='cursor:pointer'>".utf8_encode($row["tp_logradouro"])."</div>");
		}
	}else{
		echo("Digite seu logradouro");
	}
?>