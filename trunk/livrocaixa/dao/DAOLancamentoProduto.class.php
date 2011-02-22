<?php
	class DAOLancamentoProduto{
		private $lancamentoProduto;
		private $conexao;
		
		function __construct($lancamentoProduto, $conexao){
			$this->lancamentoProduto 	= $lancamentoProduto;
			$this->conexao 				= $conexao;
		}
 
		public function getLancamentoProduto($valRef){
			$resultado = $this->pesquisar($valRef);
			if($resultado == false)
				return $this->lancamentoProduto = NULL;
			$linha = mysqli_fetch_array($resultado);
			$this->lancamentoProduto->lanCodigo		= $linha["lan_codigo"];
			$this->lancamentoProduto->proCodigo		= $linha["pro_codigo"];
			$this->lancamentoProduto->quantidade	= $linha["lan_quantidade"];
			$this->lancamentoProduto->valorProduto	= $linha["lan_valor_produto"];
			return $this->lancamentoProduto;
		}
		
		public function getAtual(){
			$sql = "SELECT * FROM lancamentos_produto WHERE lan_codigo = '".$this->lancamentoProduto->lanCodigo."'";
			$resultado = $this->conexao->selecionar($sql);
			if($resultado == false)
				return $this->lancamentoProduto = NULL;
			$linha = mysqli_fetch_array($resultado);
			$this->lancamentoProduto->lanCodigo		= $linha["lan_codigo"];
			$this->lancamentoProduto->proCodigo		= $linha["pro_codigo"];
			$this->lancamentoProduto->quantidade	= $linha["lan_quantidade"];
			$this->lancamentoProduto->valorProduto	= $linha["lan_valor_produto"];
			return $this->lancamentoProduto;
		}
		
		public function setLancamentoProduto($lancamentoProduto){
			$this->lancamentoProduto = $lancamentoProduto;
		}
		
		public function cadastrar(){
			$sql = "INSERT INTO lancamentos_produto (lan_codigo, pro_codigo, lan_quantidade, lan_valor_produto) VALUES ('".$this->lancamentoProduto->lanCodigo."', ".$this->lancamentoProduto->proCodigo.", ".$this->lancamentoProduto->quantidade.", ".$this->lancamentoProduto->valorProduto.")";
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel salvar o Lancamento/Produto: ".$this->lancamentoProduto->lanCodigo);
				return false;
			}
			return true;
		}
		
		public function alterar($valRef){
			$sql = "UPDATE lancamentos_produto SET lan_codigo='".$this->lancamentoProduto->lanCodigo."', pro_codigo=".$this->lancamentoProduto->proCodigo.",  lan_quantidade=".$this->lancamentoProduto->quantidade.", lan_valor_produto=".$this->lancamentoProduto->valorProduto." WHERE lan_codigo='".$valRef."'";
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel alterar o Lancamento/Produto código: ".$valRef);
				return false;
			}
			return true;
		}
		
		public function deletar($valRef){
			$sql = "DELETE FROM lancamentos_produto WHERE lan_codigo='".$valRef."'";
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel deletar o Lancamento/Produto código: ".$valRef);
				return false;
			}
			return true;
		}
		
		public function pesquisar($valRef){
			$sql = "SELECT * FROM lancamentos_produto WHERE lan_codigo='".$valRef."'";
			$resultado = $this->conexao->selecionar($sql);
			if(!$resultado){
				echo("Não foi possivel selecionar o Lancamento/Produto referência: ".$valRef);
			}
			return $resultado;
		}
	}
?>