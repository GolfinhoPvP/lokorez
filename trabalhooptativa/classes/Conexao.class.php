<?php
	class Conexao{
		private $host 		= 'localhost';
		private $db_nome 	= 'rac';
		private $usuario 	= 'root';
		private $senha 		= '';
		
		function salvar($comando){
			if(!($link = mysql_connect($this->host, $this->usuario, $this->senha)))
				return false;
			
			if(!mysql_select_db($this->db_nome, $link)){
				mysql_close();
				return false;
			}
					
			if(!mysql_query($comando, $link)){
				mysql_close();
				return false;
			}
			
			mysql_close();
			return true;
		}
	}
?>