<?php
	class DAOPlanoConta{
		private $planoConta;
		private $conexao;
		
		function __construct($planoConta, $conexao){
			$this->planoConta 	= $planoConta;
			$this->conexao 		= $conexao;
		}
 
		public function getPlanoConta($valRef){
			$resultado = $this->pesquisar($valRef);
			if($resultado == false)
				return $this->planoConta = NULL;
			$linha = mysqli_fetch_array($resultado);
			$this->planoConta->codigo		= $linha["pc_codigo"];
			$this->planoConta->cliCodigo	= $linha["cli_codigo"];
			$this->planoConta->descricao	= $linha["pc_descricao"];
			return $this->planoConta;
		}
		
		public function getAtual(){
			$sql = "SELECT * FROM plano_conta WHERE cli_codigo=".$this->planoConta->cliCodigo." AND pc_descricao = '".$this->planoConta->descricao."'";
			$resultado = $this->conexao->selecionar($sql);
			if($resultado == false)
				return $this->planoConta = NULL;
			$linha = mysqli_fetch_array($resultado);
			$this->planoConta->codigo		= $linha["pc_codigo"];
			$this->planoConta->cliCodigo	= $linha["cli_codigo"];
			$this->planoConta->descricao	= $linha["pc_descricao"];
			return $this->planoConta;
		}
		
		public function getPlanoContaLista(){
			if($_SESSION["nivel"] == 2)
				$cliCod = $_SESSION["codigo"];
			else
				$cliCod = $_SESSION["codigoPai"];
				
			$sql = "SELECT * FROM plano_conta WHERE cli_codigo =".$cliCod." ORDER BY pc_descricao";
			$resultado = $this->conexao->selecionar($sql);
			if($resultado == false ||  $this->conexao->numeroLinhas($resultado) == 0)
				return NULL;
			$contador = 0;
			while($linha = mysqli_fetch_array($resultado)){
				$bean 				= new PlanoConta($linha["pc_descricao"]);
				$bean->codigo 		= $linha["pc_codigo"];
				$array[$contador] 	= $bean;
				$contador++;
			}
			return $array;
		}
		
		public function setPlanoConta($planoConta){
			$this->planoConta = $planoConta;
		}
		
		public function cadastrar(){
			$sql = "INSERT INTO plano_conta (cli_codigo, pc_descricao) VALUES (".$this->planoConta->cliCodigo.", '".$this->planoConta->descricao."')";
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel salvar o planoConta: ".$this->planoConta->descricao);
				return false;
			}
			return true;
		}
		
		public function alterar($valRef){
			$sql = "UPDATE plano_conta SET cli_codigo=".$this->planoConta->cliCodigo.", pc_descricao='".$this->planoConta->descricao."' WHERE pc_codigo=".$valRef;
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel alterar o planoConta código: ".$valRef);
				return false;
			}
			return true;
		}
		
		public function deletar($valRef){
			$sql = "DELETE FROM plano_conta WHERE pc_codigo=".valRef;
			echo($sql);
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel deletar o planoConta código: ".$valRef);
				return false;
			}
			return true;
		}
		
		public function pesquisar($valRef){
			$sql = "SELECT * FROM plano_conta WHERE pc_codigo = ".valRefE;
			$resultado = $this->conexao->selecionar($sql);
			if(!$resultado){
				echo("Não foi possivel selecionar o planoConta referência: ".$valRef);
			}
			return $resultado;
		}
	}
?>