<?php
	class DAOFormaPagamento{
		private $formaPagamento;
		private $conexao;
		
		function __construct($formaPagamento, $conexao){
			$this->formaPagamento 	= $formaPagamento;
			$this->conexao 			= $conexao;
		}
 
		public function getFormaPagamento($valRef){
			$resultado = $this->pesquisar($valRef);
			if($resultado == false)
				return $this->formaPagamento = NULL;
			$linha = mysqli_fetch_array($resultado);
			$this->formaPagamento->codigo		= $linha["for_codigo"];
			$this->formaPagamento->periodo		= $linha["for_periodo"];
			$this->formaPagamento->descricao	= $linha["for_descricao"];			
			return $this->formaPagamento;
		}
		
		public function getAtual(){
			$sql = "SELECT * FROM forma_pagamentos WHERE emp_nome = '".$this->formaPagamento->nome."'";
			$resultado = $this->conexao->selecionar($sql);
			if($resultado == false)
				return $this->formaPagamento = NULL;
			$linha = mysqli_fetch_array($resultado);
			$this->formaPagamento->codigo		= $linha["for_codigo"];
			$this->formaPagamento->periodo		= $linha["for_periodo"];
			$this->formaPagamento->descricao	= $linha["for_descricao"];
			return $this->formaPagamento;
		}
		
		public function setFormaPagamento($formaPagamento){
			$this->formaPagamento = $formaPagamento;
		}
		
		public function cadastrar(){
			$sql = "INSERT INTO forma_pagamento (for_periodo, for_descricao) VALUES (".$this->formaPagamento->periodo.", '".$this->formaPagamento->descricao."')";
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel salvar a Forma de pagamento: ".$this->formaPagamento->descricao);
				return false;
			}
			return true;
		}
		
		public function alterar($valRef){
			$sql = "UPDATE forma_pagamento SET for_periodo='".$this->formaPagamento->periodo."', for_descricao='".$this->formaPagamento->descricao."' WHERE for_codigo=".$valRef;
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel alterar a Forma de pagamento: ".$valRef);
				return false;
			}
			return true;
		}
		
		public function deletar($valRef){
			$sql = "DELETE FROM forma_pagamento WHERE for_codigo = ".valRef;
			echo($sql);
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel deletar a Forma de pagamento: ".$valRef);
				return false;
			}
			return true;
		}
		
		public function pesquisar($valRef){
			$sql = "SELECT * FROM forma_pagamento WHERE for_codigo = ".valRefE;
			$resultado = $this->conexao->selecionar($sql);
			if(!$resultado){
				echo("Não foi possivel selecionar a Forma de pagamento: ".$valRef);
			}
			return $resultado;
		}
	}
?>