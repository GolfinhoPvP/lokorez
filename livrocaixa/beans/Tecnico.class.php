<?php
	class Tecnico{
		private $codigo;
		private $pesCodigo;
		private $descricao;
		
		function __construct($cod = NULL, $pesCod = NULL, $des = NULL){
			$this->codigo 		= $cod;
			$this->pesCodigo 	= $pesCod;
			$this->descricao 	= $des;
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