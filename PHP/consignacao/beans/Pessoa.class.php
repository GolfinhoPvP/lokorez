<?php
	class Pessoa{
		private $codigo;
		private $nome;
		private $cpf;
		private $classe;
		
		function __construct($cod, $nome, $cpf, $cla){
			$this->codigo = $cod;
			$this->nome = $nome;
			$this->cpf = $cpf;
			$this->classe = $cla;
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
		
		public function setClasse($valor){
			$this->classe = $valor;
		}
		public function getClasse(){
			return $this->classe;
		}
	}
?>
