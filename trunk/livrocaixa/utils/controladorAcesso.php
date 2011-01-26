<?php
	$acessoLista = explode(":",$nivelAcesso);
	for($x=1; $x < sizeof($acessoLista); $x++){
		if($_SESSION["nivel"] == $acessoLista[$x]){
			header("Location: ".$acessoLista[0]."acesso_negado.php");
			die();
		}
	}
?>