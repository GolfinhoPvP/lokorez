<?php
	class SangriaCofre{
		private $sanCodigo;
		private $numeroEnvelope;
		
		function __construct($sanCod = NULL, $numEnv = NULL){
			$this->sanCodigo 		= $sanCod;
			$this->numeroEnvelope 	= $numEnv;
		}
 
		public function __set($nome, $valor) {
			$this->$nome = $valor;
		}
	 
		public function __get($nome) {
			return $this->$nome;
		}
		
		public function __toString(){
			return $this->sanCodigo;
		}
	}
?>