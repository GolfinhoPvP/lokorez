<?php
	class PlanoConta{
		private $codigo;
		private $cliCodigo;
		private $descricao;
		
		function __construct($des = NULL){
			$this->codigo 		= NULL;
			if($_SESSION["nivel"] == 2)
				$cliCod = $_SESSION["codigo"];
			else
				$cliCod = $_SESSION["codigoPai"];
			$this->cliCodigo 	= $cliCod;
			$this->descricao 	= $des;
		}
 
		public function __set($nome, $valor) {
			$this->$nome = $valor;
		}
	 
		public function __get($nome) {
			return $this->$nome;
		}
		
		public function __toString(){
			return $this->descricao;
		}
	}
?>