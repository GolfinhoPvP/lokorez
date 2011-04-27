<?php
	class FuncionarioEmpresa{
		private $cliCodigo;
		private $empCodigo;
		private $nome;
		
		function __construct($cliCod = NULL, $empCod = NULL, $nome = NULL){
			$this->cliCodigo 	= $cliCod;
			$this->empCodigo 	= $empCod;
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