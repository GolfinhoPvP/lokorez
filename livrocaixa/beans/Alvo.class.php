<?php
	class Alvo{
		private $codigo;
		private $descricao;
		
		function __construct($cod = NULL, $des = NULL){
			$this->codigo 		= $cod;
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