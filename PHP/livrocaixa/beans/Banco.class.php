<?php
	class Banco{
		private $codigo;
		private $nome;
		
		function __construct($nome = NULL){
			$this->codigo 		= NULL;
			$this->nome 		= $nome;
		}
 
		public function __set($nome, $valor) {
			$this->$nome = $valor;
		}
	 
		public function __get($nome) {
			return $this->$nome;
		}
		
		public function __toString(){
			return $this->nome;
		}
	}
?>