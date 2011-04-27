<?php
	class LivroCaixa{
		private $lanCodigo;
		private $tecDescricao;
		private $proDescricao;
		private $pcDescricao;
		private $serDescricao;
		private $forDescricao;
		private $lanQuantidade;
		private $lanDatahora;
		private $lanValor;
		
		function __construct($lanCod = NULL, $tecDes = NULL, $proDes = NULL, $pcDes = NULL, $serDes = NULL, $forDes = NULL, $lanQua = NULL, $lanDat = NULL, $lanVal = NULL){
			$this->lanCodigo 		= $lanCod;
			$this->tecDescricao 	= $tecDes;
			$this->proDescricao 	= $proDes;
			$this->pcDescricao 		= $pcDes;
			$this->serDescricao 	= $serDes;
			$this->forDescricao 	= $forDes;
			$this->lanQuantidade 	= $lanQua;
			$this->lanDatahora 		= $lanDat;
			$this->lanValor 		= $lanVal;
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