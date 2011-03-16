<?php
	class DAOLancamentoServico{
		private $lancamentoProduto;
		private $conexao;
		
		function __construct($lancamentoProduto, $conexao){
			$this->lancamentoProduto 	= $lancamentoProduto;
			$this->conexao 				= $conexao;
		}
 
		public function getLancamentoServico($valRef){
			$resultado = $this->pesquisar($valRef);
			if($resultado == false)
				return $this->lancamentoProduto = NULL;
			$linha = mysqli_fetch_array($resultado);
			$this->lancamentoProduto->lanCodigo		= $linha["lan_codigo"];
			$this->lancamentoProduto->serCodigo		= $linha["ser_codigo"];
			$this->lancamentoProduto->tecCodigo		= $linha["tec_codigo"];
			$this->lancamentoProduto->valorServico	= $linha["lan_valor_servico"];
			$this->lancamentoProduto->checado		= $linha["lan_checado"];
			return $this->lancamentoProduto;
		}
		
		public function getAtual(){
			$sql = "SELECT * FROM lancamentos_servico WHERE lan_codigo = '".$this->lancamentoProduto->lanCodigo."'";
			$resultado = $this->conexao->selecionar($sql);
			if($resultado == false)
				return $this->lancamentoProduto = NULL;
			$linha = mysqli_fetch_array($resultado);
			$this->lancamentoProduto->lanCodigo		= $linha["lan_codigo"];
			$this->lancamentoProduto->serCodigo		= $linha["ser_codigo"];
			$this->lancamentoProduto->tecCodigo		= $linha["tec_codigo"];
			$this->lancamentoProduto->valorServico	= $linha["lan_valor_servico"];
			$this->lancamentoProduto->checado		= $linha["lan_checado"];
			return $this->lancamentoProduto;
		}
		
		public function setLancamentoServico($lancamentoProduto){
			$this->lancamentoProduto = $lancamentoProduto;
		}
		
		public function cadastrar(){
			$sql = "INSERT INTO lancamentos_servico (lan_codigo, ser_codigo, tec_codigo, lan_valor_servico, lan_checado) VALUES ('".$this->lancamentoProduto->lanCodigo."', ".$this->lancamentoProduto->serCodigo.", ".$this->lancamentoProduto->tecCodigo.", ".$this->lancamentoProduto->valorServico.", ".$this->lancamentoProduto->checado.")";
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel salvar o Lancamento/Servico: ".$this->lancamentoProduto->lanCodigo);
				return false;
			}
			return true;
		}
		
		public function alterar($valRef){
			$sql = "UPDATE lancamentos_servico SET lan_codigo='".$this->lancamentoProduto->lanCodigo."', ser_codigo=".$this->lancamentoProduto->serCodigo.",  tec_codigo=".$this->lancamentoProduto->tecCodigo.", lan_valor_servico=".$this->lancamentoProduto->valorServico.", lan_checado=".$this->lancamentoProduto->checado." WHERE lan_codigo='".$valRef."'";
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel alterar o Lancamento/Servico código: ".$valRef);
				return false;
			}
			return true;
		}
		
		public function deletar($valRef){
			$sql = "DELETE FROM lancamentos_servico WHERE lan_codigo='".$valRef."'";
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel deletar o Lancamento/Servico código: ".$valRef);
				return false;
			}
			return true;
		}
		
		public function pesquisar($valRef){
			$sql = "SELECT * FROM lancamentos_servico WHERE lan_codigo='".$valRef."'";
			$resultado = $this->conexao->selecionar($sql);
			if(!$resultado){
				echo("Não foi possivel selecionar o Lancamento/Servico referência: ".$valRef);
			}
			return $resultado;
		}
		
		public function zerar($valRef){
			$sql = "UPDATE lancamentos SET lan_checado = 1 WHERE tec_codigo = ".$valRef;
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel zerar o lancamento código: ".$valRef);
				return false;
			}
			return true;
		} 
	}
?>