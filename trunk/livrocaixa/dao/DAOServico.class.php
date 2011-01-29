<?php
	class DAOServico{
		private $servico;
		private $conexao;
		
		function __construct($servico, $conexao){
			$this->servico 	= $servico;
			$this->conexao 	= $conexao;
		}
 
		public function getEmpresa($valRef){
			$resultado = $this->pesquisar($valRef);
			if($resultado == false)
				return $this->servico = NULL;
			$linha = mysqli_fetch_array($resultado);
			$this->servico->codigo		= $linha["ser_codigo"];
			$this->servico->descricao	= $linha["ser_descricao"];
			return $this->servico;
		}
		
		public function getAtual(){
			$sql = "SELECT * FROM servicos WHERE ser_descricao = '".$this->servico->descricao."'";
			$resultado = $this->conexao->selecionar($sql);
			if($resultado == false)
				return $this->servico = NULL;
			$linha = mysqli_fetch_array($resultado);
			$this->servico->codigo		= $linha["ser_codigo"];
			$this->servico->descricao	= $linha["ser_descricao"];
			return $this->servico;
		}
		
		public function setEmpresa($servico){
			$this->servico = $servico;
		}
		
		public function cadastrar(){
			$sql = "INSERT INTO servicos (ser_descricao) VALUES ('".$this->servico->descricao."')";
			if(!$this->conexao->executar($sql)){
				echo("N�o foi possivel salvar o servico: ".$this->servico->descricao);
				return false;
			}
			return true;
		}
		
		public function alterar($valRef){
			$sql = "UPDATE servicos SET ser_descricao='".$this->servico->descricao."' WHERE ser_codigo=".$valRef;
			if(!$this->conexao->executar($sql)){
				echo("N�o foi possivel alterar o servico c�digo: ".$valRef);
				return false;
			}
			return true;
		}
		
		public function deletar($valRef){
			$sql = "DELETE FROM servicos WHERE ser_codigo=".valRef;
			echo($sql);
			if(!$this->conexao->executar($sql)){
				echo("N�o foi possivel deletar o servico c�digo: ".$valRef);
				return false;
			}
			return true;
		}
		
		public function pesquisar($valRef){
			$sql = "SELECT * FROM servicos WHERE ser_codigo = ".valRefE;
			$resultado = $this->conexao->selecionar($sql);
			if(!$resultado){
				echo("N�o foi possivel selecionar o servico refer�ncia: ".$valRef);
			}
			return $resultado;
		}
	}
?>