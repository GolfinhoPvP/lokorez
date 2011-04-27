<?php
	class Funcionario{
		private $empCodigo;
		private $cliCodigo;
		
		function __construct($empCod = NULL, $cliCod = NULL){
			$this->empCodigo 	= $empCod;
			$this->cliCodigo 	= $cliCod;
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