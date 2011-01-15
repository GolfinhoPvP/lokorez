<?php
	class BancoPessoa{
		private $banCodigo;
		private $pesCodigo;
		
		function __construct($bCod, $pCod){
			$this->banCodigo = $bCod;
			$this->pesCodigo = $pCod;
		}
		
		public function setBanCodigo($valor){
			$this->banCodigo = $valor;
		}
		public function getBanCodigo(){
			return $this->banCodigo;
		}
		
		public function setPesCodigo($valor){
			$this->pesCodigo = $valor;
		}
		public function getPesCodigo(){
			return $this->pesCodigo;
		}
	}
?>