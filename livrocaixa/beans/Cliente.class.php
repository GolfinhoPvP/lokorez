<?php
	class Cliente{
		private $codigo;
		private $pesCodigo;
		private $codigoPai;
		private $nomeUsuario;
		private $senha;
		
		function __construct($pesCod = NULL, $codPai = NULL, $nomeUsu = NULL, $senha = NULL){
			$this->codigo 		= NULL;
			$this->pesCodigo 	= $pesCod;
			$this->codigoPai 	= $codPai;
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