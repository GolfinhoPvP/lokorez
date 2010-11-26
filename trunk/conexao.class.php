<?php
	class conexao{
		private $host 		= 'localhost';
		private $db_nome 	= 'rac';
		private $usuario 	= 'root';
		private $senha 		= 'root';
		
		function salvar($comando, $dados){
			$link = mysql_connect($this->host, $this->usuario, $this->senha);
			mysql_select_db($this->db_nome, $link);
			if(!mysql_query($comando, $link)){
				mysql_close();
				return false;
			}
			mysql_close();
			return true;
		}
	}
?>