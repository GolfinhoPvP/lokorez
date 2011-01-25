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
		
		function __construct($cod = NULL, $cliCod = NULL, $alvCod = NULL, $dathor = NULL, $nomeMaq = NULL, $ipRed = NULL, $desc = NULL){
			$this->codigo 		= $cod;
			$this->cliCodigo 	= $cliCod;
			$this->alvCodigo 	= $alvCod;
			$this->datahora 	= $dathor;
			$this->nomeMaquina 	= $nomeMaq;
			$this->ipRede 		= $ipRed;
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
