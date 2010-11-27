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
		
		function pesquisar($comando){
			if(!($link = mysql_connect($this->host, $this->usuario, $this->senha))){
				return false;
			}
					
			if(!mysql_select_db($this->db_nome, $link)){
				mysql_close();
				return false;
			}
			
			/* A diferênça aqui é que agora agente só vai retornar um resultado ao inves de verdadeiro ou falso*/
			$resultado = mysql_query($comando, $link);			
			if($resultado == false){
				mysql_close();
				return false;
			}
			
			mysql_close();
			return $resultado;
		}
	}
?>