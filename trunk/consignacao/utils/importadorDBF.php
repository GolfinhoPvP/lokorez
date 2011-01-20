<?php
	$uri = "../uploads/";
	
	if(empty($arquivo)){
		die("Arquivo vazio!");
	}
	
	$lowName = strtolower($arquivo["name"]);
	$chars = array("ç","~","^","]","[","{","}",";",":","´",",",">","<","-","/","|","@","$","%","ã","â","á","à","é","è","ó","ò","+","=","*","&","(",")","!","#","?","`","ã"," ","©");
	$newName = str_replace($chars,"",$lowName);
	$arquivoNome = $newName;
	
	if(!preg_match("/([a-z]|[A-Z]|[0-9]|\.|-|_| ){2,}\.[dbfDBF]{3,3}$/", $arquivoNome)){
		die("Formato inválido!");
	}
	
	if ($arquivo["size"] > 15242880) {//Limit: 15MB
		die("Arquivo muito grande!");
	}
	$uri .= $arquivoNome;
	if(move_uploaded_file($arquivo['tmp_name'],$uri)){
		chmod($uri, 0777);
	}else{
		die("Erro na importação");
	}
	
	if( !ini_get('safe_mode') ){ 
		set_time_limit(900);
	}

	if(!($DFBconector = dbase_open($uri,0)))
		die("Erro ao abrir o arquivo");
		
	$nLinhas = dbase_numrecords($DFBconector);
	$nCampos = dbase_numfields($DFBconector);
	
	for($x=1; $x<=$nLinhas; $x++){
		$linha = dbase_get_record($DFBconector, $x);
		$matriz[$x-1] = $linha;
	}
	
	dbase_close($DFBconector);		
	unlink($uri);
?>
