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
			if(strlen($this->pessoa->cpf) == 0)
				$cpf = " AND pes_cpf IS NULL ";
			if(strlen($this->pessoa->rg) == 0)
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
		
		public function getPessoaLista($valRef){	
			$sql = "SELECT * FROM pessoas WHERE pes_codigo != 1 ORDER BY pes_nome";
			$resultado = $this->conexao->selecionar($sql);
			if($resultado == false ||  $this->conexao->numeroLinhas($resultado) == 0)
				return NULL;
			$contador = 0;
			while($linha = mysqli_fetch_array($resultado)){
				$bean 				= new Pessoa($linha["pes_nome"], $linha["pes_cpf"], $linha["pes_rg"]);
				$bean->codigo 		= $linha["pes_codigo"];
				$array[$contador] 	= $bean;
				$contador++;
			}
			return $array;
		}
		
		public function setPessoa($pessoa){
			$this->pessoa = $pessoa;
		}
		
		public function cadastrar(){
			$cpf 	= "'".$this->pessoa->cpf."'";
			$rg 	= "'".$this->pessoa->rg."'";
			
			if(strlen($this->pessoa->cpf) == 0)
				$cpf = "NULL";
			if(strlen($this->pessoa->rg) == 0)
				$rg = "NULL";
				
			$sql = "INSERT INTO pessoas (pes_nome, pes_cpf, pes_rg) VALUES ('".$this->pessoa->nome."', ".$cpf.", ".$rg.")";
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel salvar o pessoa: ".$this->pessoa->nome);
				return false;
			}
			return true;
		}
		
		public function alterar($valRef){
			$sql = "UPDATE pessoas SET pes_nome='".$this->pessoa->nome."', pes_cpf='".$this->pessoa->cpf."', pes_rg='".$this->pessoa->rg."' WHERE pes_codigo=".$valRef;
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel alterar o pessoa código: ".$valRef);
				return false;
			}
			return true;
		}
		
		public function deletar($valRef){
			$sql = "DELETE FROM pessoas WHERE pes_codigo=".$valRef;
			echo($sql);
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel deletar o pessoa código: ".$valRef);
				return false;
			}
			return true;
		}
		
		public function pesquisar($valRef){
			$sql = "SELECT * FROM pessoas WHERE pes_codigo LIKE '".$valRef."' OR pes_cpf='".$valRef."' OR pes_rg='".$valRef."'";
			$resultado = $this->conexao->selecionar($sql);
			if(!$resultado){
				echo("Não foi possivel selecionar o pessoa referência: ".$valRef);
			}
			return $resultado;
		}
	}
?>