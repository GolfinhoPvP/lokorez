<?php
	class Solicitacao{
		private $codigo;
		private $staCodigo;
		private $cliCodigo;
		private $empCodigo;
		private $descricao;
		private $vencimento;
		private $valor;
		private $codigoBarras;
		private $valorPago;
		
		function __construct($staCod = NULL, $desc = NULL, $venc = NULL, $val = NULL, $cdb = NULL, $valPag = NULL){
			$this->codigo 			= NULL;
			$this->staCodigo 		= $staCod;
			
			if($_SESSION["nivel"] == 2)
				$cliCod = $_SESSION["codigo"];
			else
				$cliCod = $_SESSION["codigoPai"];
				
			$this->cliCodigo 		= $cliCod;
			$this->empCodigo 		= $_SESSION["empresa"];
			$this->descricao 		= $desc;
			$this->vencimento 		= $venc;
			$this->valor 			= $val;
			$this->codigoBarras 	= $cdb;
			$this->valorPago 		= $valPag;
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