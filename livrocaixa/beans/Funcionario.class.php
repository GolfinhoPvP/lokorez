<?php
	class Funcionario{
		private $empCodigo;
		private $cliCodigo;
		private $claCodigo;
		
		function __construct($empCod = NULL, $cliCod = NULL, $claCod = NULL){
			$this->empCodigo 	= $empCod;
			$this->cliCodigo 	= $cliCod;
			$this->claCodigo 	= $claCod;
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