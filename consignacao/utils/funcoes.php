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
?>