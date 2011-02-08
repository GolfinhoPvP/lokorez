<?php
	class Lancamento{
		private $codigo;
		private $tecCodigo;
		private $proCodigo;
		private $pcCodigo;
		private $serCodigo;
		private $forCodigo;
		private $quantidade;
		private $datahora;
		private $valor;
		private $checado;
		
		function __construct($cod = NULL, $tecCod = NULL, $proCod = NULL, $pcCod = NULL, $serCod = NULL, $forCod = NULL, $qua = NULL, $val = NULL){
			$this->codigo 		= $cod;
			$this->tecCodigo 	= $tecCod;
			$this->proCodigo 	= $proCod;
			$this->pcCodigo 	= $pcCod;
			$this->serCodigo 	= $serCod;
			$this->forCodigo 	= $forCod;
			$this->quantidade 	= $qua;
			$this->datahora 	= date("Y-m-d H:i:s");
			$this->valor 		= $val;
			$this->checado 		= 0;
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