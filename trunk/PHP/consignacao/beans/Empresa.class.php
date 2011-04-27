<?php
	class Empresa{
		private $codigo;
		private $descricao;
		
		function __construct($cod, $d){
			$this->codigo = $cod;
			$this->descricao = $d;
		}
		
		public function setCodigo($valor){
			$this->codigo = $valor;
		}
		public function getCodigo(){
			return $this->codigo;
		}
		
		public function setDescricao($valor){
			$this->descricao = $valor;
		}
		public function getDescricao(){
			return $this->descricao;
		}
	}
?>