<?php
	class LancamentoServico{
		private $lanCodigo;
		private $serCodigo;
		private $tecCodigo;
		private $valorServico;
		private $checado;
		
		function __construct($cod = NULL, $proCod = NULL, $tecCod = NULL, $val = NULL){
			$this->lanCodigo 	= $cod;
			$this->serCodigo 	= $proCod;
			$this->tecCodigo 	= $tecCod;
			$this->valorServico = $val;
			$this->checado		= 0;
		}
 
		public function __set($nome, $valor) {
			$this->$nome = $valor;
		}
		
		public function __get($nome) {
			return $this->$nome;
		}
	}
?>