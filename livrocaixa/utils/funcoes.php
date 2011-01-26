<?php
	function antiSQL($string){
		if($string == NULL)
			return $string;
		if(get_magic_quotes_gpc() == 0)
			$string = addslashes($string);
		preg_replace(sql_regcase("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/"), "", $string);
		$string = strip_tags($string);
		return $string;
	}
	
	function codificar($string){
		return base64_encode($string);
	}
	
	function decodificar($string){
		return base64_decode($string);
	}
	
	function avancarPeriodo($string){
		$array = explode("-",$string);
		switch($array[0]){
			case "Jan" : $string = "Fev-".$array[1]; break;
			case "Fev" : $string = "Mar-".$array[1]; break;
			case "Mar" : $string = "Abr-".$array[1]; break;
			case "Abr" : $string = "Mai-".$array[1]; break;
			case "Mai" : $string = "Jun-".$array[1]; break;
			case "Jun" : $string = "Jul-".$array[1]; break;
			case "Jul" : $string = "Ago-".$array[1]; break;
			case "Ago" : $string = "Set-".$array[1]; break;
			case "Set" : $string = "Out-".$array[1]; break;
			case "Out" : $string = "Nov-".$array[1]; break;
			case "Nov" : $string = "Dez-".$array[1]; break;
			case "Dez" : $string = "Jan-".($array[1] + 1); break;
		}
		return $string;
	}
	
	function getHash(){
		$hash = "xxxxx";
		$hash[0] = chr(rand(65,90)); //Upcase word
		$hash[1] = chr(rand(48,57)); //number
		$hash[2] = chr(rand(97,122)); //Lowcase word
		$hash[3] = chr(rand(48,57)); //number
		$hash[4] = chr(rand(97,122)); //Lowcase word
		
		return $hash;
	}
?>