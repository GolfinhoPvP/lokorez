<?php
	class Empresa{
		private $codigo;
		private $cliCodigo;
		private $nome;
		
		function __construct($cod = NULL, $empCod = NULL, $nome = NULL){
			$this->codigo 		= $cod;
			$this->cliCodigo 	= $empCod;
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