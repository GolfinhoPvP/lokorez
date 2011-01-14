<?php
	class Produto{
		private $codigo;
		private $descricao;
		private $prazoMaximo;
		
		function __construct($cod, $desc, $prazMax){
			$this->codigo = $cod;
			$this->descricao = $desc;
			$this->prazoMaximo = $prazMax;
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
		
		public function setPrazoMaximo($valor){
			$this->prazoMaximo = $valor;
		}
		public function getPrazoMaximo(){
			return $this->prazoMaximo;
		}
	}
?>