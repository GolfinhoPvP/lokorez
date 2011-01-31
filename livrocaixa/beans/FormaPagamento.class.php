<?php
	class FormaPagamento{
		private $codigo;
		private $cliCodigo;
		private $periodo;
		private $descricao;
		
		function __construct($per = NULL, $des = NULL){
			$this->codigo 		= NULL;
			if($_SESSION["codigo"] == 2)
				$cliCod = 2;
			else
				$cliCod = $_SESSION["codigoPai"];
			$this->cliCodigo 	= $cliCod;
			$this->periodo 		= $per;
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