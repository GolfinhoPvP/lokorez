<?php
	class Log{
		private $codigo;
		private $opeCodigo;
		private $nivCodigo;
		private $admCodigo;
		private $dataTempo;
		private $nomeMaquina;
		private $ipRede;
		private $descricao;
		
		function __construct($cod, $oCod, $nCod, $aCod, $dT, $nM, $ipR, $desc){
			$this->codigo = $cod;
			$this->opeCodigo = $oCod;
			$this->nivCodigo = $nCod;
			$this->admCodigo = $aCod;
			$this->dataTempo = $dT;
			$this->nomeMaquina = $nM;
			$this->ipRede = $ipR;
			$this->descricao = $desc;	
		}
		
		public function setCodigo($valor){
			$this->codigo = $valor;
		}
		public function getCodigo(){
			return $this->codigo;
		}
		
		public function setOpeCodigo($valor){
			$this->opeCodigo = $valor;
		}
		public function getOpeCodigo(){
			return $this->opeCodigo;
		}
		
		public function setNivCodigo($valor){
			$this->nivCodigo = $valor;
		}
		public function getNivCodigo(){
			return $this->nivCodigo;
		}
		
		public function setAdmCodigo($valor){
			$this->admCodigo = $valor;
		}
		public function getAdmCodigo(){
			return $this->admCodigo;
		}
		
		public function setDataTempo($valor){
			$this->dataTempo = $valor;
		}
		public function getDataTempo(){
			return $this->dataTempo;
		}
		
		public function setNomeMaquina($valor){
			$this->nomeMaquina = $valor;
		}
		public function getNomeMaquina(){
			return $this->nomeMaquina;
		}
		
		public function setIpRede($valor){
			$this->ipRede = $valor;
		}
		public function getIpRede(){
			return $this->ipRede;
		}
		
		public function setDescricao($valor){
			$this->descricao = $valor;
		}
		public function getDescricao(){
			return $this->descricao;
		}
	}
?>
