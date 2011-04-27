<?php
	class DAOFuncionario{
		private $funcionario;
		private $conexao;
		
		function __construct($funcionario, $conexao){
			$this->funcionario 	= $funcionario;
			$this->conexao 		= $conexao;
		}
 
		public function getFuncionario($valRef){
			$resultado = $this->pesquisar($valRef);
			if($resultado == false)
				return $this->funcionario = NULL;
			$linha = mysqli_fetch_array($resultado);
			$this->funcionario->empCodigo	= $linha["emp_codigo"];
			$this->funcionario->cliCodigo	= $linha["cli_codigo"];
			return $this->funcionario;
		}
		
		public function setFuncionario($funcionario){
			$this->funcionario = $funcionario;
		}
		
		public function cadastrar(){
			$sql = "INSERT INTO funcionarios (emp_codigo, cli_codigo) VALUES (".$this->funcionario->empCodigo.", ".$this->funcionario->cliCodigo.")";
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel salvar o funcionario: ".$this->funcionario->cliCodigo);
				return false;
			}
			return true;
		}
		
		public function alterar($valRef){
			$sql = "UPDATE funcionarios SET emp_codigo=".$this->funcionario->empCodigo.", cli_codigo=".$this->funcionario->cliCodigo." WHERE emp_codigo=".$valRef;
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel alterar o funcionario código: ".$valRef);
				return false;
			}
			return true;
		}
		
		public function deletar($valRefE, $valRefC){
			$sql = "DELETE FROM funcionarios WHERE emp_codigo=".valRefE." AND cli_codigo=".$valRefC;
			echo($sql);
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel deletar o funcionario código: ".$valRefC);
				return false;
			}
			return true;
		}
		
		public function pesquisar($valRefE, $valRefC){
			$sql = "SELECT * FROM funcionarios WHERE emp_codigo LIKE '".valRefE."' AND cli_codigo LIKE '".$valRefC."'";
			$resultado = $this->conexao->selecionar($sql);
			if(!$resultado){
				echo("Não foi possivel selecionar o funcionario referência: ".$valRefC);
			}
			return $resultado;
		}
	}
?>