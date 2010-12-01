<?php
	class Conexao{
		private $host 		= 'localhost';
		private $db_nome 	= 'rac';
		private $usuario 	= 'root';
		private $senha 		= '';
		
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
		
		function pesquisar($comando){
			if(!($link = mysql_connect($this->host, $this->usuario, $this->senha))){
				return false;
			}
			
			if(!mysql_select_db($this->db_nome, $link)){
				#mysql_close();
				return false;
			}
			
			$resultado = mysql_query($comando, $link);	
			if($resultado == false){
				#mysql_close();
				return false;
			}
			
			#mysql_close();
			return $resultado;
		}
		
		function contadorDeResultado($comando){
			if(!($link = mysql_connect($this->host, $this->usuario, $this->senha))){
				return false;
			}
			
			if(!mysql_select_db($this->db_nome, $link)){
				#mysql_close();
				return false;
			}
						
			if(mysql_query($comando, $link)){
				#mysql_close();
				return false;
			}
			/* Aqui tambйm й simples, essa funзгo (mysql_affected_rows($link);) retorna quantas linhas foram afetadas pela ъltima aзгo no banco, seja insert, delete, select, qualquer coisa*/
			#mysql_close();
			return mysql_affected_rows($link);
		}
	}
?>