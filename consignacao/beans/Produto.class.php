<?php
	class Produto{
		private $descricao;
		private $prazoMaximo;
		
		function __construct($desc, $prazMax){
			$this->descricao = $desc;
			$this->prazoMaximo = $prazMax;
		}
		
		public function setDescricao($valor){
			$this->descricao = $valor;
		}
		public function getDescricao(){
			return $this->descricao;
		}
		
		public function setPrazoMaximo($valor){
			$this->prazoMaximo = $valor;
		}
		public function getPrazoMaximo(){
			return $this->prazoMaximo;
		}
	}
?>