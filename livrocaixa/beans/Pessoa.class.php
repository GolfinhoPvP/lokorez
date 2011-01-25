<?php
	class Pessoa{
		private $codigo;
		private $nome;
		private $cpf;
		private $rg;
		
		function __construct($cod = NULL, $nome = NULL, $cpf = NULL, $rg = NULL){
			$this->codigo	= $cod;
			$this->nome 	= $nome;
			$this->cpf 		= $cpf;
			$this->rg 		= $rg;
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