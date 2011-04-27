<?php
	class Banco{
		private $codigo;
		private $descricao;
		
		function __construct($cod, $desc){
			$this->codigo = $cod;
			$this->descricao = $desc;	
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