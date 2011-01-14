<?php
	class Administrador{
		private $codigo;
		private $nivCodigo;
		private $nome;
		private $nomeUsuario;
		private $senha;
		
		function __construct($cod, $nCod, $n, $nU, $s){
			$this->codigo = $cod;
			$this->nivCodigo = $nCod;
			$this->admCodigo = $n;
			$this->dataTempo = $nU;
			$this->nomeMaquina = $s;	
		}
		
		public function setCodigo($valor){
			$this->codigo = $valor;
		}
		public function getCodigo(){
			return $this->codigo;
		}
		
		public function setNivCodigo($valor){
			$this->nivCodigo = $valor;
		}
		public function getNivCodigo(){
			return $this->nivCodigo;
		}
		
		public function setNome($valor){
			$this->nome = $valor;
		}
		public function getNome(){
			return $this->nome;
		}
		
		public function setNomeUsuario($valor){
			$this->nomeUsuario = $valor;
		}
		public function getNomeUsuario(){
			return $this->nomeUsuario;
		}
		
		public function setSenha($valor){
			$this->senha = $valor;
		}
		public function getSenha(){
			return $this->senha;
		}
	}
?>
