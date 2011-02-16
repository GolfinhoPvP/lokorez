<?php
	class Sangria{
		private $codigo;
		private $empCodigo;
		private $tipCodigo;
		private $data;
		private $valor;
		
		function __construct($tipCod = NULL, $dat = NULL, $val = NULL){
			$this->codigo 		= NULL;
			$this->empCodigo	= $_SESSION["empresa"];
			$this->tipCodigo 	= $tipCod;
			$this->data 		= $dat;
			$this->valor	 	= $val;
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