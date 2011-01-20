<?php
	class Averbacao{
		private $numeroExterno;
		private $empCodigo;
		private $pesCodigo;
		private $serMatricula;
		private $banCodigo;
		private $proCodigo;
		private $parPeriodo;
		private $staCodigo;
		private $dataCriacao;
		private $dataEnceramento;
		private $numeroParcelas;
		private $montante;
		private $taxaJuros;
		
		function __construct($numExt, $eC, $pesC, $serMat, $bC, $proC, $per, $sC, $dataC, $dataE, $numPar, $mont, $taxJur){
			$this->numeroExterno = $numExt;
			$this->empCodigo = $eC;
			$this->pesCodigo = $pesC;
			$this->serMatricula = $serMat;
			$this->banCodigo = $bC;
			$this->proCodigo = $proC;
			$this->parPeriodo = $per;
			$this->staCodigo = $sC;
			$this->dataCriacao = $dataC;
			$this->dataEncerramento = $dataE;
			$this->numeroParcelas = $numPAr;
			$this->montante = $mont;
			$this->taxaJuros = $taxJur;
		}
		
		public function setNumeroExterno($valor){
			$this->numeroExterno = $valor;
		}
		public function getNumeroExterno(){
			return $this->numeroExterno;
		}
		
		public function setEmpCodigo($valor){
			$this->empCodigo = $valor;
		}
		public function getEmpCodigo(){
			return $this->empCodigo;
		}
		
		public function setPesCodigo($valor){
			$this->pesCodigo = $valor;
		}
		public function getPesCodigo(){
			return $this->pesCodigo;
		}
		
		public function setSerMatricula($valor){
			$this->serMatricula = $valor;
		}
		public function getSerMatricula(){
			return $this->serMatricula;
		}
		
		public function setBanCodigo($valor){
			$this->banCodigo = $valor;
		}
		public function getBanCodigo(){
			return $this->banCodigo;
		}
		
		public function setProCodigo($valor){
			$this->proCodigo = $valor;
		}
		public function getProCodigo(){
			return $this->proCodigo;
		}
		
		public function setParPeriodo($valor){
			$this->parPeriodo = $valor;
		}
		public function getParPeriodo(){
			return $this->parPeriodo;
		}
		
		public function setStaCodigo($valor){
			$this->staCodigo = $valor;
		}
		public function getStaCodigo(){
			return $this->staCodigo;
		}

		public function setDataCriacao($valor){
			$this->dataCriacao = $valor;
		}
		public function getDataCriacao(){
			return $this->dataCriacao;
		}
		
		public function setDataEncerramento($valor){
			$this->dataEncerramento = $valor;
		}
		public function getDataEncerramento(){
			return $this->dataEncerramento;
		}

		public function setNumeroParcelas($valor){
			$this->numeroParcelas = $valor;
		}
		public function getNumeroParcelas(){
			return $this->numeroParcelas;
		}

		public function setMontante($valor){
			$this->montante = $valor;
		}
		public function getMontante(){
			return $this->montante;
		}

		public function setTaxaJuros($valor){
			$this->staCodigo = $taxaJuros;
		}
		public function getTaxaJuros(){
			return $this->taxaJuros;
		}
	}
?>