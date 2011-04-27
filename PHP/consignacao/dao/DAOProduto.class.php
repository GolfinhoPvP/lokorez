<?php
	class DAOProduto{
		private $produto;
		private $conexao;
		
		function __construct($desc, $prazMax, $toRoot, $conex){
			include_once($toRoot."beans/Produto.class.php");
			include_once($toRoot."utils/ConectarMySQL.class.php");
			$this->produto = new Produto(NULL, $desc, $prazMax);
			//$this->conexao = new ConectarMySQL();
			$this->conexao = $conex;
		}
		
		public function cadastrar(){
			$sql = "INSERT INTO produtos (pro_descricao, pro_prazo_maximo) VALUES ('".$this->produto->getDescricao()."', ".$this->produto->getPrazoMaximo().")";
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel salvar: ".$this->produto->getDescricao());
				return false;
			}
			return true;
		}
		
		public function alterar($valRef){
			$sql = "UPDATE produtos SET pro_descricao = '".$this->produto->getDescricao()."', pro_prazo_maximo=".$this->produto->getPrazoMaximo()." WHERE pro_codigo=".$valRef;
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel alterar: ".$this->produto->getDescricao());
				return false;
			}
			return true;
		}
		
		public function deletar($valRef){
			$sql = "DELETE FROM produtos WHERE pro_codigo=".$valRef;
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel deletar: ".$this->produto->getDescricao());
				return false;
			}
			return true;
		}
		
		public function pesquisar($valRef){
			$sql = "SELECT * FROM produtos WHERE pro_codigo=".$valRef;
			$resultado = $this->conexao->selecionar($sql);
			if(!$resultado){
				echo("Não foi possivel selecionar: ".$this->produto->getDescricao());
			}
			return $resultado;
		}
		
		public function getProduto($valRef){
			$linha = mysqli_fetch_array($this->pesquisar($valRef));
			$this->produto->setCodigo($linha["pro_codigo"]);
			$this->produto->setDescricao($linha["pro_descricao"]);
			$this->produto->setPrazoMaximo($linha["pro_prazo_maximo"]);
			return $this->produto;
		}
	}
?>