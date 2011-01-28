<?php
	class Email{
		private $codigo;
		private $pesCodigo;
		private $email;
		private $nota;
		
		function __construct($pesCod = NULL, $email = NULL, $nota = NULL){
			$this->codigo		= NULL;
			$this->pesCodigo 	= $pesCod;
			$this->email 		= $email;
			$this->nota 		= $nota;
		}
 
		public function __set($nome, $valor) {
			$this->$nome = $valor;
		}
	 
		public function __get($nome) {
			return $this->$nome;
		}
		
		public function __toString(){
			return $this->email;
		}
	}
?>