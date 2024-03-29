<?php
	class Parcela{
		private $numeroParcela;
		private $aveNumeroExterno;
		private $staCodigo;
		private $periodoParcela;
		private $valor;
		
		function __construct($nP, $aNE, $sC, $perPar, $val){
			$this->numeroParcela = $nP;
			$this->aveNumeroExterno = $aNE;
			$this->staCodigo = $sC;
			$this->periodoParcela = $perPar;
			$this->valor = $val;
		}
		
		public function setNumeroParcela($valor){
			$this->numeroParcela = $valor;
		}
		public function getNumeroParcela(){
			return $this->numeroParcela;
		}
		
		public function setAveNumeroExterno($valor){
			$this->aveNumeroExterno = $valor;
		}
		public function getAveNumeroExterno(){
			return $this->aveNumeroExterno;
		}
		
		public function setStaCodigo($valor){
			$this->staCodigo = $valor;
		}
		public function getStaCodigo(){
			return $this->staCodigo;
		}
		
		public function setPeriodoPArcela($valor){
			$this->periodoParcela = $valor;
		}
		public function getPeriodoPArcela(){
			return $this->periodoParcela;
		}
		
		public function setValor($valor){
			$this->valor = $valor;
		}
		public function getValor(){
			return $this->valor;
		}
	}
?>