<?php 
	class ConectarMySQL{
		private $hostBanco 		= "localhost";
		private $usuarioBanco 	= "root";
		private $senhaBanco 	= "root";
		private $nomeBanco 		= "livrocaixa";
		private $conexao;
		
		function __construct(){
			if(!$this->conectarSGBD())
				die("A conexão com o servidor não foi estabelecida!");
			if(!$this->selecionarBanco())
				die("A conexão com o servidor não foi estabelecida!");
			if(!mysqli_autocommit($this->conexao, false))
				die("Auto comite não ativado!");
		}
		
		private function conectarSGBD(){
			if(!($this->conexao = mysqli_connect($this->hostBanco,$this->usuarioBanco,$this->senhaBanco))){
				return false;
			}
			return true;
		}
		
		private function selecionarBanco(){
			if(!($bancoDados = mysqli_select_db($this->conexao, $this->nomeBanco))){
				return false;
			}
			return true;
		}
		
		public function executar($query){	
			if(empty($query) || ($this->conexao == NULL)){
				return false;
			}
			if(!mysqli_query($this->conexao, $query)){
				return false;
			}			
			return true;
		}
		
		public function selecionar($query){
			if(empty($query) || ($this->conexao == NULL)){
				return false;
			}
			$resultado = mysqli_query($this->conexao, $query);
			if($resultado == false){
				return false;
			}			
			return $resultado;
		}
		
		public function getErro(){
			return mysql_error($this->conexao);
		}
		
		public function commit(){
			mysqli_commit($this->conexao);
			$this->fechar();
		}
		
		public function rollback(){
			mysqli_rollback($this->conexao);
			$this->fechar();
			die();
		}
		
		public function fechar(){
			mysqli_close($this->conexao);
			$this->conexao = NULL;
		}
	}
?>