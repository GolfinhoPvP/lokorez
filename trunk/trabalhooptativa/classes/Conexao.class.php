<?php
	class Conexao{
		private $host 		= 'localhost';
		private $db_nome 	= 'rac';
		private $usuario 	= 'root';
		private $senha 		= 'root';
		
		function salvar($comando){
			if(!($link = mysql_connect($this->host, $this->usuario, $this->senha))){
				return false;
			}
			
			if(!mysql_select_db($this->db_nome, $link)){
				# com essa linha no meu da pau!
				#mysql_close();
				return false;
			}
					
			if(!mysql_query($comando, $link)){
				#mysql_close();
				return false;
			}
			
			#mysql_close();
			return true;
		}
		
		function pesquisar($comando)
		
		{
			if(!($link = mysql_connect($this->host, $this->usuario, $this->senha))){
				return false;
			}
			
			if(!mysql_select_db($this->db_nome, $link)){
				#mysql_close();
				return false;
			}
						
			if($resultado = mysql_query($comando, $link)){
				#mysql_close();
				return false;
			}
			
			#mysql_close();
			return $resultado;
		}

	}
?>