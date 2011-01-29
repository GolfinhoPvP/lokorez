<?php
	class DAOProduto{
		private $produto;
		private $conexao;
		
		function __construct($produto, $conexao){
			$this->produto 	= $produto;
			$this->conexao 	= $conexao;
		}
 
		public function getProduto($valRef){
			$resultado = $this->pesquisar($valRef);
			if($resultado == false)
				return $this->produto = NULL;
			$linha = mysqli_fetch_array($resultado);
			$this->produto->codigo 		= $linha["pro_codigo"];
			$this->produto->empCodigo 	= $linha["emp_codigo"];
			$this->produto->descricao	= $linha["pro_descricao"];
			$this->produto->modelo		= $linha["pro_modelo"];
			$this->produto->valorVenda	= $linha["pro_val_vendo"];
			return $this->produto;
		}
		
		public function getAtual(){
			$sql = "SELECT * FROM produtos WHERE emp_codigo=".$this->produto->empCodigo." AND pro_descricao='".$this->produto->descricao."' AND pro_modelo='".$this->produto->modelo."' AND pro_val_vendo=".$this->produto->valorVenda;
			$resultado = $this->conexao->selecionar($sql);
			if($resultado == false)
				return $this->produto = NULL;
			$linha = mysqli_fetch_array($resultado);
			$this->produto->codigo 		= $linha["pro_codigo"];
			$this->produto->empCodigo 	= $linha["emp_codigo"];
			$this->produto->descricao	= $linha["pro_descricao"];
			$this->produto->modelo		= $linha["pro_modelo"];
			$this->produto->valorVenda	= $linha["pro_val_vendo"];
			return $this->produto;
		}
		
		public function setProduto($produto){
			$this->produto = $produto;
		}
		
		public function cadastrar(){
			$sql = "INSERT INTO produtos (emp_codigo, pro_descricao, pro_modelo, pro_val_vendo) VALUES (".$this->produto->empCodigo.", '".$this->produto->descricao."', '".$this->produto->modelo."', ".$this->produto->valorVenda.")";
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel salvar o produto: ".$this->produto->nomeUsuario);
				return false;
			}
			return true;
		}
		
		public function alterar($valRef){
			$sql = "UPDATE produtos SET emp_codigo=".$this->produto->empCodigo.", pro_descricao='".$this->produto->descricao."', pro_modelo='".$this->produto->modelo."', pro_val_vendo=".$this->produto->valorVenda." WHERE pro_codigo=".$valRef;
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel alterar o produto código: ".$valRef);
				return false;
			}
			return true;
		}
		
		public function deletar($valRef){
			$sql = "DELETE FROM produtos WHERE pro_codigo = ".$valRef;
			echo($sql);
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel deletar o produto código: ".$valRef);
				return false;
			}
			return true;
		}
		
		public function pesquisar($valRef){
			$sql = "SELECT * FROM produtos WHERE pro_codigo = ".$valRef;
			$resultado = $this->conexao->selecionar($sql);
			if(!$resultado){
				echo("Não foi possivel selecionar o produto código: ".$valRef);
			}
			return $resultado;
		}
	}
?>