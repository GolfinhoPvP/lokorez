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
			$this->classe->porcentagem	= $linha["cla_porcentagem"];
			return $this->classe;
		}
		
		public function getAtual(){
			$sql = "SELECT * FROM classe WHERE cli_codigo=".$this->classe->cliCodigo." AND cla_descricao='".$this->classe->descricao."' AND cla_porcentagem=".$this->classe->porcentagem."";
			$resultado = $this->conexao->selecionar($sql);
			if($resultado == false)
				return $this->classe = NULL;
			$linha = mysqli_fetch_array($resultado);
			$this->classe->codigo		= $linha["cla_codigo"];
			$this->classe->cliCodigo	= $linha["cli_codigo"];
			$this->classe->descricao	= $linha["cla_descricao"];
			$this->classe->porcentagem	= $linha["cla_porcentagem"];
			return $this->classe;
		}
		
		public function getClasseLista(){
			if($_SESSION["nivel"] == 2)
				$cliCod = $_SESSION["codigo"];
			else
				$cliCod = $_SESSION["codigoPai"];
				
			$sql = "SELECT * FROM classe WHERE cli_codigo =".$cliCod;
			$resultado = $this->conexao->selecionar($sql);
			if($resultado == false ||  $this->conexao->numeroLinhas($resultado) == 0)
				return NULL;
			$contador = 0;
			while($linha = mysqli_fetch_array($resultado)){
				$classe 				= new Classe($linha["cla_descricao"], $linha["cla_porcentagem"]);
				$classe->codigo 		= $linha["cla_codigo"];
				$classeArray[$contador] = $classe;
				$contador++;
			}
			return $classeArray;
		}
		
		public function setEmpresa($servico){
			$this->classe = $servico;
		}
		
		public function cadastrar(){
			$sql = "INSERT INTO classe (cli_codigo, cla_descricao, cla_porcentagem) VALUES (".$this->classe->cliCodigo.", '".$this->classe->descricao."', ".$this->classe->porcentagem.")";
			if(!$this->conexao->executar($sql)){
				echo("N�o foi possivel salvar o servico: ".$this->classe->descricao);
				return false;
			}
			return true;
		}
		
		public function alterar($valRef){
			$sql = "UPDATE classe SET cli_codigo=".$this->classe->cliCodigo.", cla_descricao='".$this->classe->descricao."', cla_porcentagem=".$this->classe->porcentagem." WHERE cla_codigo=".$valRef;
			if(!$this->conexao->executar($sql)){
				echo("N�o foi possivel alterar o servico c�digo: ".$valRef);
				return false;
			}
			return true;
		}
		
		public function deletar($valRef){
			$sql = "DELETE FROM classe WHERE cla_codigo=".valRef;
			if(!$this->conexao->executar($sql)){
				echo("N�o foi possivel deletar o servico c�digo: ".$valRef);
				return false;
			}
			return true;
		}
		
		public function pesquisar($valRef){
			$sql = "SELECT * FROM classe WHERE cla_codigo = ".valRefE;
			$resultado = $this->conexao->selecionar($sql);
			if(!$resultado){
				echo("N�o foi possivel selecionar o servico refer�ncia: ".$valRef);
			}
			return $resultado;
		}
	}
?>