<?php
	class DAOPessoa{
		private $pessoa;
		private $conexao;
		
		function __construct($pessoa, $conexao){
			$this->pessoa 	= $pessoa;
			$this->conexao 	= $conexao;
		}
 
		public function getPessoa($valRef){
			$resultado = $this->pesquisar($valRef);
			if($resultado == false)
				return $this->pessoa = NULL;
			$linha = mysqli_fetch_array($resultado);
			$this->pessoa->codigo	= $linha["pes_codigo"];
			$this->pessoa->nome		= $linha["pes_nome"];
			$this->pessoa->cpf		= $linha["pes_cpf"];
			$this->pessoa->rg		= $linha["pes_rg"];
			return $this->pessoa;
		}
		
		public function getAtual(){
			$cpf 	= " AND pes_cpf='".$this->pessoa->cpf."' ";
			$rg 	= " AND pes_rg='".$this->pessoa->rg."' ";
			if(strlen($this->pessoa->cpf) == "(NULL)")
				$cpf = " AND pes_cpf IS NULL ";
			if(strlen($this->pessoa->rg) == "(NULL)")
				$rg = " AND pes_rg IS NULL ";
				
			$sql = "SELECT * FROM pessoas WHERE pes_nome='".$this->pessoa->nome."'".$cpf.$rg;
			$resultado = $this->conexao->selecionar($sql);
			if($resultado == false)
				return $this->pessoa = NULL;
			$linha = mysqli_fetch_array($resultado);
			$this->pessoa->codigo	= $linha["pes_codigo"];
			$this->pessoa->nome		= $linha["pes_nome"];
			$this->pessoa->cpf		= $linha["pes_cpf"];
			$this->pessoa->rg		= $linha["pes_rg"];
			return $this->pessoa;
		}
		
		public function setPessoa($pessoa){
			$this->pessoa = $pessoa;
		}
		
		public function cadastrar(){
			$sql = "INSERT INTO pessoas (pes_nome, pes_cpf, pes_rg) VALUES ('".$this->pessoa->nome."', '".$this->pessoa->cpf."', '".$this->pessoa->rg."')";
			if(!$this->conexao->executar($sql)){
				echo("N�o foi possivel salvar o pessoa: ".$this->pessoa->nome);
				return false;
			}
			return true;
		}
		
		public function alterar($valRef){
			$sql = "UPDATE pessoas SET pes_nome='".$this->pessoa->nome."', pes_cpf='".$this->pessoa->cpf."', pes_rg='".$this->pessoa->rg."' WHERE pes_codigo=".$valRef;
			if(!$this->conexao->executar($sql)){
				echo("N�o foi possivel alterar o pessoa c�digo: ".$valRef);
				return false;
			}
			return true;
		}
		
		public function deletar($valRef){
			$sql = "DELETE FROM pessoas WHERE pes_codigo=".$valRef;
			echo($sql);
			if(!$this->conexao->executar($sql)){
				echo("N�o foi possivel deletar o pessoa c�digo: ".$valRef);
				return false;
			}
			return true;
		}
		
		public function pesquisar($valRef){
			$sql = "SELECT * FROM pessoas WHERE pes_codigo LIKE '".$valRef."' OR pes_cpf='".$valRef."' OR pes_rg='".$valRef."'";
			$resultado = $this->conexao->selecionar($sql);
			if(!$resultado){
				echo("N�o foi possivel selecionar o pessoa refer�ncia: ".$valRef);
			}
			return $resultado;
		}
	}
?>