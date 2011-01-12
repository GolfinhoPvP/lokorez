<?php 
	class ConectarMySQL{
		private $hostBanco 		= "localhost";
		private $usuarioBanco 	= "root";
		private $senhaBanco 	= "root";
		private $nomeBanco 		= "consignacao";
		private $conexao;
		
		function __construct(){
			if(!$this->conectarSGBD())
				die("A conexão com o servidor não foi estabelecida!");
			if(!$this->selecionarBanco())
				die("A conexão com o servidor não foi estabelecida!");
		}
		
		private function conectarSGBD(){
			if(!($this->conexao = mysql_connect($this->hostBanco,$this->usuarioBanco,$this->senhaBanco))){
				return false;
			}
			return true;
		}
		
		private function selecionarBanco(){
			if(!($bancoDados = mysql_select_db($this->nomeBanco,$this->conexao))){
				return false;
			}
			return true;
		}
		
		public function salvar($query){	
			if(empty($query) || ($this->conexao == NULL)){
				return false;
			}
			if(!mysql_query($query, $this->conexao)){
				return false;
			}			
			return true;
		}
		
		public function atualizar($query){	
		}
		
		public function deletar($query){	
		}
		
		public function fechar(){
			mysql_close($this->conexao);
			$this->conexao = NULL;
		}
	}
?>