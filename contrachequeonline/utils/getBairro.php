<?php
	$uf = isset($_GET["uf"]) ? $_GET["uf"] : "%";
	$cep = isset($_GET["cep"]) ? $_GET["cep"] : "%";
	$text = isset($_GET["text"]) ? $_GET["text"] : "%";

	if($text != NULL && $uf != NULL){
		require_once("Connect.class.php");
		include_once("../beans/Variables.class.php");
		
		$variables = new Variables();
		$connect = new Connect($variables->dbHost, $variables->dbUser, $variables->dbPassword, $variables->dbName);
		$connect->start();
		
		$db = "br_estado_".strtolower($uf);
		$text .= ".{0,}";
		
		$result = $connect->execute("SELECT distinct bairro FROM $db WHERE bairro REGEXP '$text'");
		
		echo("<div id='---'>Selecione um bairro!</div>");
		while($row = mysql_fetch_assoc($result)) {
			echo("<div id='".$row["bairro"]."' onclick='javascript: setLogradouto(\"".urlencode($row["bairro"])."\", \"tfBairro\");' style='cursor:pointer'>".utf8_encode($row["bairro"])."</div>");
		}
	}else{
		echo("Digite seu bairro");
	}
?>