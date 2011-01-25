<?php
	class FormaPagamento{
		private $codigo;
		private $periodo;
		private $descricao;
		
		function __construct($cod = NULL, $per = NULL, $des = NULL){
			$this->codigo 		= $cod;
			$this->periodo 		= $per;
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