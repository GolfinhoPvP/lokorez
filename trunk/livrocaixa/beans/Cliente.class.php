<?php
	class Cliente{
		private $codigo;
		private $nivel;
		private $pesCodigo;
		private $codigoPai;
		private $nomeUsuario;
		private $senha;
		
		function __construct($pesCod = NULL, $niv = NULL, $nomeUsu = NULL, $senha = NULL){
			$this->codigo 		= NULL;
			$this->pesCodigo 	= $pesCod;
			$this->nivel		= $niv;
			$this->codigoPai 	= $_SESSION["codigo"];
			$this->nomeUsuario 	= $nomeUsu;
			$this->senha 		= $senha;
		}
 
		public function __set($nome, $valor) {
			$this->$nome = $valor;
		}
	 
		public function __get($nome) {
			return $this->$nome;
		}
		
		public function __toString(){
			return $this->nomeUsuario;
		}
	}
?>