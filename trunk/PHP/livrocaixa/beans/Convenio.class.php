<?php
	class Convenio{
		private $codigo;
		private $cliCodigo;
		private $pesCodigo;
		private $descricao;
		
		function __construct($pesCod = NULL, $desc = NULL){
			$this->codigo 		= NULL;
			
			if($_SESSION["nivel"] == 2)
				$cliCod = $_SESSION["codigo"];
			else
				$cliCod = $_SESSION["codigoPai"];
			$this->cliCodigo 	= $cliCod;
				
			$this->pesCodigo 	= $pesCod;
			$this->descicao 	= $desc;
		}
 
		public function __set($nome, $valor) {
			$this->$nome = $valor;
		}
	 
		public function __get($nome) {
			return $this->$nome;
		}
	}
?>