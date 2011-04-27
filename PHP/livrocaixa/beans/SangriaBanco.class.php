<?php
	class SangriaBanco{
		private $sanCodigo;
		private $banCodigo;
		
		function __construct($sanCod = NULL, $banCod = NULL){
			$this->sanCodigo 	= $sanCod;
			$this->banCodigo 	= $banCod;
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