<?php
	class LancamentoProduto{
		private $lanCodigo;
		private $proCodigo;
		private $quantidade;
		private $valorProduto;
		
		function __construct($cod = NULL, $proCod = NULL, $qua = NULL, $val = NULL){
			$this->lanCodigo 	= $cod;
			$this->proCodigo 	= $proCod;
			$this->quantidade 	= $qua;
			$this->valorProduto = $val;
		}
 
		public function __set($nome, $valor) {
			$this->$nome = $valor;
		}
	 
		public function __get($nome) {
			return $this->$nome;
		}
	}
?>