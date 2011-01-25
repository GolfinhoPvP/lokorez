<?php
	class Produto{
		private $codigo;
		private $empCodigo;
		private $descricao;
		private $modelo;
		private $valorVenda;
		
		function __construct($cod = NULL, $empCod = NULL, $des = NULL, $mod = NULL, $valVen = NULL){
			$this->codigo 		= $cod;
			$this->empCodigo 	= $empCod;
			$this->descricao 	= $des;
			$this->modelo 		= $mod;
			$this->valorVenda 	= $valVen;
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