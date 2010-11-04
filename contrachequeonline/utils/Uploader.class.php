<?php
	class Uploader{
	
		function upload($arquivo,$caminho){
		if(!(empty($arquivo))){
		$arquivo1 = $arquivo;
		$arquivo_minusculo = strtolower($arquivo1['name']);
		$caracteres = array("ç","~","^","]","[","{","}",";",":","´",",",">","<","-","/","|","@","$","%","ã","â","á","à","é","è","ó","ò","+","=","*","&","(",")","!","#","?","`","ã"," ","©");
		$arquivo_tratado = str_replace($caracteres,"",$arquivo_minusculo);
		$destino = $caminho."/".$arquivo_tratado;
		if(move_uploaded_file($arquivo1['tmp_name'],$destino)){
		echo "<script>window.alert('Arquivo enviado com sucesso.');</script>";
		}else{
		echo "<script>window.alert('Erro ao enviar o arquivo');</script>";
		}
		}
		}
	}
?>
