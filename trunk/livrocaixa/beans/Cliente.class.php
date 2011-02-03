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
			
			if($_SESSION["nivel"] == 1 || $_SESSION["nivel"] == 2)
				$codPai = $_SESSION["codigo"];
			else if($_SESSION["nivel"] == 3)
				$codPai = $_SESSION["codigoPai"];
				
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