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
		
		function __construct($cod = NULL, $tecCod = NULL, $proCod = NULL, $pcCod = NULL, $serCod = NULL, $forCod = NULL, $qua = NULL, $dathor = NULL){
			$this->codigo 		= $cod;
			$this->tecCodigo 	= $tecCod;
			$this->proCodigo 	= $proCod;
			$this->pcCodigo 	= $pcCod;
			$this->serCodigo 	= $serCod;
			$this->forCodigo 	= $forCod;
			$this->quantidade 	= $qua;
			$this->datahora 	= $dathor;
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