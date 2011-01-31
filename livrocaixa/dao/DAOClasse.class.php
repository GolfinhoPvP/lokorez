<?php
	class DAOClasse{
		private $classe;
		private $conexao;
		
		function __construct($servico, $conexao){
			$this->classe 	= $servico;
			$this->conexao 	= $conexao;
		}
 
		public function getEmpresa($valRef){
			$resultado = $this->pesquisar($valRef);
			if($resultado == false)
				return $this->classe = NULL;
			$linha = mysqli_fetch_array($resultado);
			$this->classe->codigo		= $linha["cla_codigo"];
			$this->classe->cliCodigo	= $linha["cli_codigo"];
			$this->classe->descricao	= $linha["cla_descricao"];
			return $this->classe;
		}
		
		public function getAtual(){
			$sql = "SELECT * FROM classe WHERE cli_codigo=".$this->classe->cliCodigo." AND cla_descricao='".$this->classe->descricao."'";
			$resultado = $this->conexao->selecionar($sql);
			if($resultado == false)
				return $this->classe = NULL;
			$linha = mysqli_fetch_array($resultado);
			$this->classe->codigo		= $linha["cla_codigo"];
			$this->classe->cliCodigo	= $linha["cli_codigo"];
			$this->classe->descricao	= $linha["cla_descricao"];
			return $this->classe;
		}
		
		public function getClasseLista(){
			if($_SESSION["codigo"] == 2)
				$cliCod = 2;
			else
				$cliCod = $_SESSION["codigoPai"];
				
			$sql = "SELECT * FROM classe WHERE cli_codigo =".$cliCod;
			$resultado = $this->conexao->selecionar($sql);
			if($resultado == false ||  $this->conexao->numeroLinhas($resultado) == 0)
				return NULL;
			$contador = 0;
			while($linha = mysqli_fetch_array($resultado)){
				$classe = new Classe($linha["cli_codigo"], $linha["cla_descricao"]);
				$classe->codigo = $linha["cla_codigo"];
				$classeArray[$contador] = $classe;
				$contador++;
			}
			return $classeArray;
		}
		
		public function setEmpresa($servico){
			$this->classe = $servico;
		}
		
		public function cadastrar(){
			$sql = "INSERT INTO classe (cli_codigo, cla_descricao) VALUES (".$this->classe->cliCodigo.", '".$this->classe->descricao."')";
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel salvar o servico: ".$this->classe->descricao);
				return false;
			}
			return true;
		}
		
		public function alterar($valRef){
			$sql = "UPDATE classe SET cli_codigo=".$this->classe->cliCodigo.", cla_descricao='".$this->classe->descricao."' WHERE cla_codigo=".$valRef;
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel alterar o servico código: ".$valRef);
				return false;
			}
			return true;
		}
		
		public function deletar($valRef){
			$sql = "DELETE FROM classe WHERE cla_codigo=".valRef;
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel deletar o servico código: ".$valRef);
				return false;
			}
			return true;
		}
		
		public function pesquisar($valRef){
			$sql = "SELECT * FROM classe WHERE cla_codigo = ".valRefE;
			$resultado = $this->conexao->selecionar($sql);
			if(!$resultado){
				echo("Não foi possivel selecionar o servico referência: ".$valRef);
			}
			return $resultado;
		}
	}
?>