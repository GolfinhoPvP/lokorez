<?php
	class Telefone{
		private $codigo;
		private $pesCodigo;
		private $numero;
		private $nota;
		
		function __construct($pesCod = NULL, $num = NULL, $nota = NULL){
			$this->codigo		= NULL;
			$this->pesCodigo 	= $pesCod;
			$this->numero 		= $num;
			$this->nota 		= $nota;
		}
 
		public function __set($nome, $valor) {
			$this->$nome = $valor;
		}
	 
		public function __get($nome) {
			return $this->$nome;
		}
		
		public function __toString(){
			return $this->numero;
		}
	}
?>