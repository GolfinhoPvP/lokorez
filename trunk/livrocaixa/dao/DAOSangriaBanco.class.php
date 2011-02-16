<?php
	class DAOSangriaBanco{
		private $sangriaBanco;
		private $conexao;
		
		function __construct($sangriaBanco, $conexao){
			$this->sangriaBanco = $sangriaBanco;
			$this->conexao 		= $conexao;
		}
 
		public function getSangriaBanco($valRef){
			$resultado = $this->pesquisar($valRef);
			if($resultado == false)
				return $this->sangriaBanco = NULL;
			$linha = mysqli_fetch_array($resultado);
			$this->sangriaBanco->sanCodigo	= $linha["san_codigo"];
			$this->sangriaBanco->banCodigo	= $linha["ban_codigo"];
			return $this->sangriaBanco;
		}
		
		public function getAtual(){
			$sql = "SELECT * FROM sangria_banco WHERE san_codigo=".$this->sangriaBanco->sanCodigo." AND ban_codigo=".$this->sangriaBanco->banCodigo;
			$resultado = $this->conexao->selecionar($sql);
			if($resultado == false)
				return $this->sangriaBanco = NULL;
			$linha = mysqli_fetch_array($resultado);
			$this->sangriaBanco->sanCodigo	= $linha["san_codigo"];
			$this->sangriaBanco->banCodigo	= $linha["ban_codigo"];
			return $this->sangriaBanco;
		}
		
		public function setSangriaBanco($sangriaBanco){
			$this->sangriaBanco = $sangriaBanco;
		}
		
		public function cadastrar(){
			$sql = "INSERT INTO sangria_banco (san_codigo, ban_codigo) VALUES (".$this->sangriaBanco->sanCodigo.", ".$this->sangriaBanco->banCodigo.")";
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel salvar a Sangria/Banco: ".$this->sangriaBanco->sanCodigo);
				return false;
			}
			return true;
		}
		
		public function alterar($valRef){
			$sql = "UPDATE sangria_banco SET san_codigo=".$this->sangriaBanco->sanCodigo.", ban_codigo=".$this->sangriaBanco->banCodigo." WHERE san_codigo=".$valRef;
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel alterar a Sangria/Banco código: ".$valRef);
				return false;
			}
			return true;
		}
		
		public function deletar($valRef){
			$sql = "DELETE FROM sangria_banco WHERE san_codigo=".valRef;
			echo($sql);
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel deletar a Sangria/Banco código: ".$valRef);
				return false;
			}
			return true;
		}
		
		public function pesquisar($valRef){
			$sql = "SELECT * FROM sangria_banco WHERE san_codigo=".$valRef;
			$resultado = $this->conexao->selecionar($sql);
			if(!$resultado){
				echo("Não foi possivel selecionar a Sangria/Banco referência: ".$valRef);
			}
			return $resultado;
		}
	}
?>