<?php
	class Tecnico{
		private $codigo;
		private $pesCodigo;
		private $claCodigo;
		private $descricao;
		
		function __construct($pesCod = NULL, $claCod = NULL, $des = NULL){
			$this->codigo 		= NULL;
			$this->pesCodigo 	= $pesCod;
			$this->claCodigo 	= $claCod;
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