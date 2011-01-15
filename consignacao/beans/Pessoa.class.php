<?php
	class Pessoa{
		private $codigo;
		private $nome;
		private $cpf;
		
		function __construct($cod, $nome, $cpf){
			$this->codigo = $cod;
			$this->nome = $nome;
			$this->cpf = $cpf;	
		}
		
		public function setCodigo($valor){
			$this->codigo = $valor;
		}
		public function getCodigo(){
			return $this->codigo;
		}
		
		public function setNome($valor){
			$this->nome = $valor;
		}
		public function getNome(){
			return $this->nome;
		}
		
		public function setCPF($valor){
			$this->cpf = $valor;
		}
		public function getCPF(){
			return $this->cpf;
		}
	}
?>
