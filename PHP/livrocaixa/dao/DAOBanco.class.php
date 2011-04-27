<?php
	class DAOBanco{
		private $banco;
		private $conexao;
		
		function __construct($banco, $conexao){
			$this->banco 		= $banco;
			$this->conexao 		= $conexao;
		}
 
		public function getBanco($valRef){
			$resultado = $this->pesquisar($valRef);
			if($resultado == false)
				return $this->banco = NULL;
			$linha = mysqli_fetch_array($resultado);
			$this->banco->codigo	= $linha["ban_codigo"];
			$this->banco->nome		= $linha["ban_nome"];
			return $this->banco;
		}
		
		public function getAtual(){
			$sql = "SELECT * FROM bancos WHERE ban_nome = '".$this->banco->nome."'";
			$resultado = $this->conexao->selecionar($sql);
			if($resultado == false)
				return $this->banco = NULL;
			$linha = mysqli_fetch_array($resultado);
			$this->banco->codigo	= $linha["ban_codigo"];
			$this->banco->nome		= $linha["ban_nome"];
			return $this->banco;
		}
		
		public function getBancoLista(){
			$sql = "SELECT * FROM bancos";
			$resultado = $this->conexao->selecionar($sql);
			if($resultado == false ||  $this->conexao->numeroLinhas($resultado) == 0)
				return NULL;
			$contador = 0;
			while($linha = mysqli_fetch_array($resultado)){
				$bean 				= new Banco($linha["ban_nome"]);
				$bean->codigo		= $linha["ban_codigo"];
				$array[$contador] 	= $bean;
				$contador++;
			}
			return $array;
		}
		
		public function setBanco($banco){
			$this->banco = $banco;
		}
		
		public function cadastrar(){
			$sql = "INSERT INTO bancos (ban_nome) VALUES ('".$this->banco->nome."')";
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel salvar o banco: ".$this->banco->nome);
				return false;
			}
			return true;
		}
		
		public function alterar($valRef){
			$sql = "UPDATE bancos SET ban_nome='".$this->banco->nome."' WHERE ban_codigo=".$valRef;
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel alterar o banco código: ".$valRef);
				return false;
			}
			return true;
		}
		
		public function deletar($valRef){
			$sql = "DELETE FROM bancos WHERE ban_codigo=".valRef;
			echo($sql);
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel deletar o banco código: ".$valRef);
				return false;
			}
			return true;
		}
		
		public function pesquisar($valRef){
			$sql = "SELECT * FROM bancos WHERE ban_codigo=".$valRef;
			$resultado = $this->conexao->selecionar($sql);
			if(!$resultado){
				echo("Não foi possivel selecionar o banco referência: ".$valRef);
			}
			return $resultado;
		}
	}
?>