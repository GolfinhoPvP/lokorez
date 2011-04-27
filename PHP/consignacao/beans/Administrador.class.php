<?php
	class Administrador{
		private $codigo;
		private $pesCodigo;
		private $nivCodigo;
		private $banCodigo;
		private $nomeUsuario;
		private $senha;
		
		function __construct($cod, $pCod, $nCod, $bCod, $nU, $s){
			$this->codigo = $cod;
			$this->pesCodigo = $pCod;
			$this->nivCodigo = $nCod;
			$this->banCodigo = $bCod;
			$this->nomeUsuario = $nU;
			$this->senha = $s;	
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
		
		public function setNivCodigo($valor){
			$this->nivCodigo = $valor;
		}
		public function getNivCodigo(){
			return $this->nivCodigo;
		}
		
		public function setBanCodigo($valor){
			$this->banCodigo = $valor;
		}
		public function getBanCodigo(){
			return $this->banCodigo;
		}
		
		public function setNomeUsuario($valor){
			$this->nomeUsuario = $valor;
		}
		public function getNomeUsuario(){
			return $this->nomeUsuario;
		}
		
		public function setSenha($valor){
			$this->senha = $valor;
		}
		public function getSenha(){
			return $this->senha;
		}
	}
?>
