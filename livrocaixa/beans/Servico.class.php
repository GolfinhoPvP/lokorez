<?php
	class Servico{
		private $codigo;
		private $descricao;
		
		function __construct($des = NULL){
			$this->codigo 		= NULL;
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