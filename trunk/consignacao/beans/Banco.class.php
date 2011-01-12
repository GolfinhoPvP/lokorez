<?php
	class Banco{
		private $codigo;
		private $descricao;
		private $contato;
		private $fone;
		
		function __construct($cod, $desc, $cont, $fone){
			$this->codigo = $cod;
			$this->descricao = $desc;
			$this->contato = $cont;
			$this->fone = $fone;	
		}
		
		public function setCodigo($valor){
			$this->codigo = $valor;
		}
		public function getCodigo(){
			return $this->codigo;
		}
		
		public function setDescricao($valor){
			$this->descricao = $valor;
		}
		public function getDescricao(){
			return $this->descricao;
		}
		
		public function setContato($valor){
			$this->contato = $valor;
		}
		public function getContato(){
			return $this->contato;
		}
		
		public function setFone($valor){
			$this->fone = $valor;
		}
		public function getFone(){
			return $this->fone;
		}
	}
?>