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
			$this->servico->cliCodigo	= $linha["cli_codigo"];
			$this->servico->descricao	= $linha["ser_descricao"];
			return $this->servico;
		}
		
		public function getAtual(){
			$sql = "SELECT * FROM servicos WHERE cli_codigo=".$this->servico->cliCodigo." AND ser_descricao = '".$this->servico->descricao."'";
			$resultado = $this->conexao->selecionar($sql);
			if($resultado == false)
				return $this->servico = NULL;
			$linha = mysqli_fetch_array($resultado);
			$this->servico->codigo		= $linha["ser_codigo"];
			$this->servico->cliCodigo	= $linha["cli_codigo"];
			$this->servico->descricao	= $linha["ser_descricao"];
			return $this->servico;
		}
		
		public function getServicoLista(){
			if($_SESSION["codigo"] == 2)
				$cliCod = 2;
			else
				$cliCod = $_SESSION["codigoPai"];
				
			$sql = "SELECT * FROM servico WHERE cli_codigo =".$cliCod;
			$resultado = $this->conexao->selecionar($sql);
			if($resultado == false ||  $this->conexao->numeroLinhas($resultado) == 0)
				return NULL;
			$contador = 0;
			while($linha = mysqli_fetch_array($resultado)){
				$bean 				= new Servico($linha["cli_codigo"], $linha["pc_descricao"]);
				$classe->codigo 	= $linha["pc_codigo"];
				$array[$contador] 	= $bean;
				$contador++;
			}
			return $array;
		}
		
		public function setEmpresa($servico){
			$this->servico = $servico;
		}
		
		public function cadastrar(){
			$sql = "INSERT INTO servicos (cli_codigo, ser_descricao) VALUES (".$this->servico->cliCodigo.", '".$this->servico->descricao."')";
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel salvar o servico: ".$this->servico->descricao);
				return false;
			}
			return true;
		}
		
		public function alterar($valRef){
			$sql = "UPDATE servicos SET cli_codigo=".$this->servico->cliCodigo.", ser_descricao='".$this->servico->descricao."' WHERE ser_codigo=".$valRef;
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel alterar o servico código: ".$valRef);
				return false;
			}
			return true;
		}
		
		public function deletar($valRef){
			$sql = "DELETE FROM servicos WHERE ser_codigo=".valRef;
			echo($sql);
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel deletar o servico código: ".$valRef);
				return false;
			}
			return true;
		}
		
		public function pesquisar($valRef){
			$sql = "SELECT * FROM servicos WHERE ser_codigo = ".valRefE;
			$resultado = $this->conexao->selecionar($sql);
			if(!$resultado){
				echo("Não foi possivel selecionar o servico referência: ".$valRef);
			}
			return $resultado;
		}
	}
?>