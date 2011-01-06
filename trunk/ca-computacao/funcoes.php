<?php
	function soNumero($string){
		$tam = strlen($string);
		for($x=0; $x < $tam; $x++){
			if( ($string[x] != 0) and ($string[x] != 1) and ($string[x] != 2) and ($string[x] != 3) and ($string[x] != 4) and ($string[x] != 5) and ($string[x] != 6) and ($string[x] != 7) and ($string[x] != 8) and ($string[x] != 9) ){
				return false;
			}
		}
		return true;
	}
	
	function analisaBloco($bloco){
		if($bloco == "0000.0"){
			echo("sob análise!");
		}else{
			echo($bloco);
		}
		
		return true;
	}
	
	function analisaSituacao($situacao){
		if($situacao == 0){
			echo("sob análise!");
		}
		if($situacao == 1){
			echo("aluno(a)!");
		}
		if($situacao == 2){
			echo("secretário(a)!");
		}
		if($situacao == 3){
			echo("presidente(a)!");
		}
		if($situacao == 4){
			echo("professor(a)!");
		}
		return true;
	}
?>