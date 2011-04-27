<?php
	class Lancamento{
		private $codigo;
		private $empCodigo;
		private $cliCodigo;
		private $forCodigo;
		private $tipCodigo;
		private $pcCodigo;
		private $ordemServico;
		private $datahora;
		private $desconto;
		private $valor;
		private $checado;
		
		
		function __construct($cod = NULL, $forCod = NULL, $tipCod = NULL, $pcCod = NULL, $ordSer = NULL, $desc = NULL, $val = NULL){
			$this->codigo 		= $cod;
			$this->empCodigo 	= $_SESSION["empresa"];
			if($_SESSION["nivel"] == 2)
				$cliCod = $_SESSION["codigo"];
			else
				$cliCod = $_SESSION["codigoPai"];
			$this->cliCodigo 	= $cliCod;
			$this->forCodigo 	= $forCod;
			$this->tipCodigo 	= $tipCod;
			$this->pcCodigo 	= $pcCod;
			$this->ordemServico	= $ordSer;
			$this->datahora 	= date("Y-m-d H:i:s");
			$this->desconto		= $desc;
			$this->valor 		= $val;
			$this->checado		= 0;
		}
 
		public function __set($nome, $valor) {
			$this->$nome = $valor;
		}
	 
		public function __get($nome) {
			return $this->$nome;
		}
		
		public function __toString(){
			return $this->codigo;
		}
	}
?>