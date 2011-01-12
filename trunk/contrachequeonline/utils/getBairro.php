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
		$text .= "%";
		
		$result = $connect->execute("SELECT distinct id, bairro FROM $db WHERE logradouro LIKE '$text'");
		
		echo("<div id='---'>Selecione um logradouro!</div>");
		while($row = mysql_fetch_assoc($result)) {
			echo("<div id='".$row["id"]."' onclick='javascript: setLogradouto(".$row["id"].", \"tfBairro\");' style='cursor:pointer'>".utf8_encode($row["bairro"])."</div>");
		}
	}else{
		echo("Digite seu bairro");
	}
?>