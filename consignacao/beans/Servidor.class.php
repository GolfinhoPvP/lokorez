<?php
	class Servidor{
		private $empCodigo;
		private $pesCodigo;
		private $matricula;
		private $admissao;
		private $cargo;
		private $vinculo;
		private $consignavel;
		private $utilizada;
		private $disponivel;
		
		function __construct($eCod, $pCod, $mat, $adm, $car, $vin, $cons, $uti, $disp){
			$this->empCodigo 	= $eCod;
			$this->pesCodigo	= $pCod;
			$this->matricula	= $mat;
			$this->admissao		= $adm;
			$this->cargo		= $car;
			$this->vinculo		= $vin;
			$this->consignavel	= $cons;
			$this->utilizada	= $uti;
			$this->disponivel	= $disp;
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
		
		public function setMatricula($valor){
			$this->matricula = $valor;
		}
		public function getMatricula(){
			return $this->matricula;
		}
		
		public function setAdmissao($valor){
			$this->admissao = $valor;
		}
		public function getAdmissao(){
			return $this->admissao;
		}
		
		public function setCargo($valor){
			$this->cargo = $valor;
		}
		public function getCargo(){
			return $this->cargo;
		}
		
		public function setVinculo($valor){
			$this->vinculo = $valor;
		}
		public function getVinculo(){
			return $this->vinculo;
		}
		
		public function setConsignavel($valor){
			$this->consignavel = $valor;
		}
		public function getConsignavel(){
			return $this->consignavel;
		}
		
		public function setUtilizada($valor){
			$this->utilizada = $valor;
		}
		public function getUtilizada(){
			return $this->utilizada;
		}
		
		public function setDisponivel($valor){
			$this->disponivel = $valor;
		}
		public function getDisponivel(){
			return $this->disponivel;
		}
	}
?>
