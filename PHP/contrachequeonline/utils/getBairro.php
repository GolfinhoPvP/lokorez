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
		
		$text .= ".{0,}";
		
		$result = $connect->execute("SELECT * FROM bairros WHERE bai_nome REGEXP '$text'");
		
		echo("<div id='---'>Selecione um bairro!</div>");
		while($row = mysql_fetch_assoc($result)) {
			echo("<div id='".$row["bai_codigo"]."' onclick='javascript: setLogradouto(\"".$row["bai_codigo"]."\", \"tfBairro\");' style='cursor:pointer'>".utf8_encode($row["bai_nome"])."</div>");
		}
	}else{
		echo("Digite seu bairro");
	}
?>