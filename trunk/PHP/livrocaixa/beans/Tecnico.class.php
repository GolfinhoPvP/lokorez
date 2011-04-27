<?php
	class Tecnico{
		private $codigo;
		private $banCodigo;
		private $pesCodigo;
		private $claCodigo;
		private $descricao;
		private $agencia;
		private $conta;
		
		function __construct($banCod = NULL,$pesCod = NULL, $claCod = NULL, $des = NULL, $agen = NULL, $cont = NULL){
			$this->codigo 		= NULL;
			$this->banCodigo 	= $banCod;
			$this->pesCodigo 	= $pesCod;
			$this->claCodigo 	= $claCod;
			$this->descricao 	= $des;
			$this->agencia 		= $agen;
			$this->conta 		= $cont;
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