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
						
			$resultado = mysql_query($comando, $link);	
			if($resultado == false){
				#mysql_close();
				return false;
			}
			/* Aqui tamb�m � simples, essa fun��o (mysql_num_rows($resultado);) retorna quantas linhas foram afetadas pela �ltima a��o no banco de select*/
			#mysql_close();
			return mysql_num_rows($resultado);
		}
		
		function transacao($comando){
			if(!($link = mysqli_connect($this->host, $this->usuario, $this->senha, $this->db_nome))){
				return false;
			}
						
			mysqli_autocommit($link, FALSE);
			#mysql_query("begin", $link);
			
			mysqli_autocommit($link, false);
			
			foreach($comando as $temp){
							
				if(mysqli_query($link, $temp) == FALSE){
					#mysql_close();
					mysqli_rollback($link);
#					echo 
					die("deu erro: ".mysqli_error($link). "$temp");

					return false;
				}
			}
			die ("asd");
			mysqli_commit($link);
			#mysql_close();
			return true;
		}
	}
?>