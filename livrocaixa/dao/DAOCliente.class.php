<?php
	class DAOCliente{
		private $cliente;
		private $conexao;
		
		function __construct($cliente, $conexao){
			$this->cliente 	= $cliente;
			$this->conexao 	= $conexao;
		}
 
		public function getCliente($valRef){
			$resultado = $this->pesquisar($valRef);
			if($resultado == false)
				return $this->cliente = NULL;
			$linha = mysqli_fetch_array($resultado);
			$this->cliente->codigo 		= $linha["cli_codigo"];
			$this->cliente->pesCodigo	= $linha["pes_codigo"];
			$this->cliente->codigoPai	= $linha["cli_pai"];
			$this->cliente->nomeUsuario	= $linha["cli_nome_usuario"];
			$this->cliente->senha		= $linha["cli_senha"];
			return $this->cliente;
		}
		
		public function setCliente($cliente){
			$this->cliente = $cliente;
		}
		
		public function cadastrar(){
			$sql = "INSERT INTO clientes (cli_codigo, pes_codigo, cli_pai, cli_nome_usuario, cli_senha) VALUES (".$this->cliente->codigo.", ".$this->cliente->pesCodigo.", ".$this->cliente->codigoPai.", '".$this->cliente->nomeUsuario."', '".$this->cliente->senha."')";
			if(!$this->conexao->executar($sql)){
				echo("N�o foi possivel salvar o usu�rio: ".$this->cliente->nomeUsuario);
				return false;
			}
			return true;
		}
		
		public function alterar($valRef){
			$sql = "UPDATE clientes SET cli_codigo=".$this->cliente->codigo.", pes_codigo=".$this->cliente->pesCodigo.", cli_pai=".$this->cliente->codigoPai.", cli_nome_usuario='".$this->cliente->nomeUsuario."', cli_senha='".$this->cliente->senha."' WHERE cli_codigo=".$valRef;
			if(!$this->conexao->executar($sql)){
				echo("N�o foi possivel alterar o usu�rio c�digo: ".$valRef);
				return false;
			}
			return true;
		}
		
		public function deletar($valRef){
			$sql = "DELETE FROM clientes WHERE cli_codigo=".$valRef;
			echo($sql);
			if(!$this->conexao->executar($sql)){
				echo("N�o foi possivel deletar o usu�rio c�digo: ".$valRef);
				return false;
			}
			return true;
		}
		
		public function pesquisar($valRef){
			$sql = "SELECT * FROM clientes WHERE cli_codigo LIKE '".$valRef."' OR cli_nome_usuario='".$valRef."'";
			$resultado = $this->conexao->selecionar($sql);
			if(!$resultado){
				echo("N�o foi possivel selecionar o usu�rio c�digo: ".$valRef);
			}
			return $resultado;
		}
	}
?>