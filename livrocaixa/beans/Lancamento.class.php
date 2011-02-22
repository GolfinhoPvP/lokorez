<?php
	class Lancamento{
		private $codigo;
		private $forCodigo;
		private $tipCodigo;
		private $pcCodigo;
		private $datahora;
		private $valor;
		
		
		function __construct($cod = NULL, $forCod = NULL, $tipCod = NULL, $pcCod = NULL, $val = NULL){
			$this->codigo 		= $cod;
			$this->forCodigo 	= $forCod;
			$this->tipCodigo 	= $tipCod;
			$this->pcCodigo 	= $pcCod;
			$this->datahora 	= date("Y-m-d H:i:s");
			$this->valor 		= $val;
		}
 
		public function __set($nome, $valor) {
			$this->$nome = $valor;
		}
	 
		public function __get($nome) {
			return $this->$nome;
		}
		
		public function __toString(){
			return $this->codigo;
		}
	}
?>