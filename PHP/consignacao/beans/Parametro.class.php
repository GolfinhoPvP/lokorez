<?php
	class Parametro{
		private $periodo;
		private $staCodigo;
		private $dataCorte;
		private $ulink;
		
		function __construct($per, $sC, $datCor, $lin){
			$this->periodo = $per;
			$this->staCodigo = $sC;
			$this->dataCorte = $datCor;
			$this->ulink = $lin;
		}
		
		public function setPeriodo($valor){
			$this->periodo = $valor;
		}
		public function getPeriodo(){
			return $this->periodo;
		}
		
		public function setStaCodigo($valor){
			$this->staCodigo = $valor;
		}
		public function getStaCodigo(){
			return $this->staCodigo;
		}
		
		public function setDataCorte($valor){
			$this->dataCorte = $valor;
		}
		public function getDataCorte(){
			return $this->dataCorte;
		}
		
		public function setLink($valor){
			$this->ulink = $valor;
		}
		public function getLink(){
			return $this->ulink;
		}
	}
?>