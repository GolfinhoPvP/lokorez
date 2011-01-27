<?php
	class Log{
		private $codigo;
		private $cliCodigo;
		private $opeCodigo;
		private $alvCodigo;
		private $datahora;
		private $nomeMaquina;
		private $ipRede;
		private $descricao;
		
		function __construct($opeCod = NULL, $alvCod = NULL, $desc = NULL){
			$this->codigo 		= NULL;
			$this->cliCodigo 	= $_SESSION["codigo"];
			$this->opeCodigo 	= $opeCod;
			$this->alvCodigo 	= $alvCod;
			$this->datahora 	= date("Y-m-d H:i:s");
			$this->nomeMaquina 	= @gethostbyaddr($REMOTE_ADDR);
				if(strlen($this->nomeMaquina) < 1)
					$this->nomeMaquina = @gethostbyaddr($_SERVER['REMOTE_ADDR']);
			$this->ipRede 		= @gethostbyname($REMOTE_ADDR);
				if(strlen($this->ipRede) < 1)
					$this->ipRede = @gethostbyname($_SERVER['REMOTE_ADDR']);
			$this->descricao 	= $desc;	
		}
		
		public function __set($nome, $valor) {
			$this->$nome = $valor;
		}
	 
		public function __get($nome) {
			return $this->$nome;
		}
		
		public function __toString(){
			return $this->descricao;
		}
	}
?>
