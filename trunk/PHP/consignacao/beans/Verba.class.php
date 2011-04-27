<?php
	class Verba{
		private $verba;
		private $empCodigo;
		private $banCodigo;
		private $proCodigo;
		private $descricao;
		
		function __construct($ver, $eC, $bC, $pC, $desc){
			$this->verba = $ver;
			$this->empCodigo = $eC;
			$this->banCodigo = $bC;
			$this->proCodigo = $pC;
			$this->descricao = $desc;
		}
		
		public function setVerba($valor){
			$this->verba = $valor;
		}
		public function getVerba(){
			return $this->verba;
		}
		
		public function setEmpCodigo($valor){
			$this->empCodigo = $valor;
		}
		public function getEmpCodigo(){
			return $this->empCodigo;
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
		
		public function setDescricao($valor){
			$this->descricao = $valor;
		}
		public function getDescricao(){
			return $this->descricao;
		}
	}
?>