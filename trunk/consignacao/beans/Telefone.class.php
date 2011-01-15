<?php
	class Telefone{
		private $codigo;
		private $pesCodigo;
		private $numero;
		
		function __construct($cod, $pCod, $num){
			$this->codigo = $cod;
			$this->pesCodigo = $pCod;
			$this->numero = $num;
		}
		
		public function setCodigo($valor){
			$this->codigo = $valor;
		}
		public function getCodigo(){
			return $this->codigo;
		}
		
		public function setPesCodigo($valor){
			$this->pesCodigo = $valor;
		}
		public function getPesCodigo(){
			return $this->pesCodigo;
		}
		
		public function setNumero($valor){
			$this->numero = $valor;
		}
		public function getNumero(){
			return $this->numero;
		}
	}
?>