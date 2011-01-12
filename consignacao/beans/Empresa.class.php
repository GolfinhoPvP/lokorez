<?php
	class Empresa{
		private $descricao;
		
		function __construct($d){
			$this->descricao = $d;
		}
		
		public function setDescricao($valor){
			$this->descricao = $valor;
		}
		public function getDescricao(){
			return $this->descricao;
		}
	}
?>