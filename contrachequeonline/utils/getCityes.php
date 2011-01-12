<?php
	$uf = isset($_GET["uf"]) ? $_GET["uf"] : NULL;

	if($uf != NULL){
		require_once("Connect.class.php");
		include_once("../beans/Variables.class.php");
		
		$variables = new Variables();
		$connect = new Connect($variables->dbHost, $variables->dbUser, $variables->dbPassword, $variables->dbName);
		$connect->start();
		
		$result = $connect->execute("SELECT distinct id, nome FROM tb_cidades WHERE uf='$uf'");
		echo("<option value='---' selected='selected'>Selecione uma cidade</option>");
		while($row = mysql_fetch_assoc($result)) {
			echo("<option value=".$row["nome"].">".$row["nome"]."</option>");
		}
	}else{
		echo("ERRO!");
	}
?>