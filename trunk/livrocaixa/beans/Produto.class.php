<?php
	class Produto{
		private $codigo;
		private $descricao;
		
		function __construct($cod = NULL, $desc = NULL){
			$this->codigo = $cod;
			$this->descricao = $desc;
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