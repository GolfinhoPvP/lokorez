<?php
	class LancamentoProduto{
		private $lanCodigo;
		private $empCodigo;
		private $proCodigo;
		private $quantidade;
		private $valorProduto;
		private $checado;
		
		function __construct($cod = NULL, $proCod = NULL, $qua = NULL, $val = NULL){
			$this->lanCodigo 	= $cod;
			$this->empCodigo 	= $_SESSION["empresa"];
			$this->proCodigo 	= $proCod;
			$this->quantidade 	= $qua;
			$this->valorProduto = $val;
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