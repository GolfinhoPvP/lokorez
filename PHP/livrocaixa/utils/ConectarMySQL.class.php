<?php 
	class ConectarMySQL{
		/*protected $hostBanco 		= "localhost";
		protected $usuarioBanco 	= "zeroko1_livcaixa";
		protected $senhaBanco 		= "livroCaixaDB";
		protected $nomeBanco 		= "zeroko1_livrocaixa";*/
		
		protected $hostBanco;
		protected $usuarioBanco;
		protected $senhaBanco;
		protected $nomeBanco;
		protected $conexao;
		private $comitar 			= true;
		
		function __construct($toRoot = NULL){
			if(!$xml = simplexml_load_file($toRoot."configuracao.xml")){
				trigger_error('Erro ao ler o arquivo XML',E_USER_ERROR);
			}
			
			$this->hostBanco		= $xml->bancoDeDados->host;
			$this->usuarioBanco 	= $xml->bancoDeDados->nomeUsuario;
			$this->senhaBanco		= $xml->bancoDeDados->senha;
			$this->nomeBanco		= $xml->bancoDeDados->nomeBanco;
			
			if(!$this->conectarSGBD())
				die("A conex�o com o servidor n�o foi estabelecida!");
			if(!$this->selecionarBanco())
				die("N�o foi possivel selecionar o banco no servidor!");
			if(!mysqli_autocommit($this->conexao, false))
				die("Auto comite n�o ativado!");
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
				$this->comitar = false;
				return false;
			}
			if(!mysqli_query($this->conexao, $query)){
				$this->comitar = false;
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
		
		public function numeroLinhas($resultado){ 
			return mysqli_num_rows($resultado);
		}
		
		public function getErro(){
			return mysql_error($this->conexao);
		}
		
		public function commit(){
			mysqli_commit($this->conexao);
			$this->close();
		}
		
		public function rollback(){
			mysqli_rollback($this->conexao);
			$this->close();
			die();
		}
		
		private function close(){
			mysqli_close($this->conexao);
			$this->conexao = NULL;
		}
		
		public function fechar(){
			if($this->comitar){
				$this->commit();
			}else{
				$this->rollback();
			}
		}
	}
?>