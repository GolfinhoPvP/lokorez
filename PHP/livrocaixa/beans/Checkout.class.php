<?php
	class Checkout{
		private $tecDescricao;
		private $claDescricao;
		private $sumLanc;
		private $pesNome;
		private $pesCPF;
		private $tecCodigo;
		private $claPorcentagem;
		private $valor;
		
		function __construct($tecDes = NULL, $claDes = NULL, $sumLan = NULL, $nome = NULL, $cpf = NULL, $tecCod = NULL, $pct = NULL, $val = NULL){
			$this->tecDescricao 	= $tecDes;
			$this->claDescricao 	= $claDes;
			$this->sumLanc 			= $sumLan;
			$this->pesNome 			= $nome;
			$this->pesCPF 			= $cpf;
			$this->tecCodigo 		= $tecCod;
			$this->claPorcentagem 	= $pct;
			$this->valor 			= $val;
		}
 
		public function __set($nome, $valor) {
			$this->$nome = $valor;
		}
	 
		public function __get($nome) {
			return $this->$nome;
		}
		
		public function __toString(){
			return $this->datahora;
		}
	}
?>