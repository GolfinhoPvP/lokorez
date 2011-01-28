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
			$this->funcionario->claCodigo	= $linha["cla_codigo"];
			return $this->funcionario;
		}
		
		public function setFuncionario($funcionario){
			$this->funcionario = $funcionario;
		}
		
		public function cadastrar(){
			$sql = "INSERT INTO emails (emp_codigo, cli_codigo, cla_codigo) VALUES (".$this->funcionario->empCodigo.", ".$this->funcionario->cliCodigo.", ".$this->funcionario->claCodigo.")";
			if(!$this->conexao->executar($sql)){
				echo("N�o foi possivel salvar o funcionario: ".$this->funcionario->cliCodigo);
				return false;
			}
			return true;
		}
		
		public function alterar($valRef){
			$sql = "UPDATE emails SET emp_codigo=".$this->funcionario->empCodigo.", cli_codigo=".$this->funcionario->cliCodigo.", cla_codigo=".$this->funcionario->claCodigo." WHERE emp_codigo=".$valRef;
			if(!$this->conexao->executar($sql)){
				echo("N�o foi possivel alterar o funcionario c�digo: ".$valRef);
				return false;
			}
			return true;
		}
		
		public function deletar($valRefE, $valRefC){
			$sql = "DELETE FROM emails WHERE emp_codigo=".valRefE." AND cli_codigo=".$valRefC;
			echo($sql);
			if(!$this->conexao->executar($sql)){
				echo("N�o foi possivel deletar o funcionario c�digo: ".$valRefC);
				return false;
			}
			return true;
		}
		
		public function pesquisar($valRefE, $valRefC){
			$sql = "SELECT * FROM emails WHERE emp_codigo LIKE '".valRefE."' AND cli_codigo LIKE '".$valRefC."'";
			$resultado = $this->conexao->selecionar($sql);
			if(!$resultado){
				echo("N�o foi possivel selecionar o funcionario refer�ncia: ".$valRefC);
			}
			return $resultado;
		}
	}
?>