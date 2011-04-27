<?php
	class DAOSangriaCofre{
		private $sangriaCofre;
		private $conexao;
		
		function __construct($sangriaCofre, $conexao){
			$this->sangriaCofre = $sangriaCofre;
			$this->conexao 		= $conexao;
		}
 
		public function getSangriaCofre($valRef){
			$resultado = $this->pesquisar($valRef);
			if($resultado == false)
				return $this->sangriaCofre = NULL;
			$linha = mysqli_fetch_array($resultado);
			$this->sangriaCofre->sanCodigo		= $linha["san_codigo"];
			$this->sangriaCofre->numeroEnvelope	= $linha["san_numero_envelope"];
			return $this->sangriaCofre;
		}
		
		public function getAtual(){
			$sql = "SELECT * FROM sangria_cofre WHERE san_codigo=".$this->sangriaCofre->sanCodigo." AND san_numero_envelope='".$this->sangriaCofre->numeroEnvelope."'";
			$resultado = $this->conexao->selecionar($sql);
			if($resultado == false)
				return $this->sangriaCofre = NULL;
			$linha = mysqli_fetch_array($resultado);
			$this->sangriaCofre->sanCodigo		= $linha["san_codigo"];
			$this->sangriaCofre->numeroEnvelope	= $linha["san_numero_envelope"];
			return $this->sangriaCofre;
		}
		
		public function setSangriaCofre($sangriaCofre){
			$this->sangriaCofre = $sangriaCofre;
		}
		
		public function cadastrar(){
			$sql = "INSERT INTO sangria_cofre (san_codigo, san_numero_envelope) VALUES (".$this->sangriaCofre->sanCodigo.", '".$this->sangriaCofre->numeroEnvelope."')";
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel salvar a Sangria/Cofre: ".$this->sangriaCofre->sanCodigo);
				return false;
			}
			return true;
		}
		
		public function alterar($valRef){
			$sql = "UPDATE sangria_cofre SET san_codigo=".$this->sangriaCofre->sanCodigo.", san_numero_envelope='".$this->sangriaCofre->numeroEnvelope."' WHERE san_codigo=".$valRef;
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel alterar a Sangria/Cofre código: ".$valRef);
				return false;
			}
			return true;
		}
		
		public function deletar($valRef){
			$sql = "DELETE FROM sangria_cofre WHERE san_codigo=".valRef;
			echo($sql);
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel deletar a Sangria/Cofre código: ".$valRef);
				return false;
			}
			return true;
		}
		
		public function pesquisar($valRef){
			$sql = "SELECT * FROM sangria_cofre WHERE san_codigo=".$valRef;
			$resultado = $this->conexao->selecionar($sql);
			if(!$resultado){
				echo("Não foi possivel selecionar a Sangria/Cofre referência: ".$valRef);
			}
			return $resultado;
		}
	}
?>