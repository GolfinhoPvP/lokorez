<?php
	class DAOSangria{
		private $sangria;
		private $conexao;
		
		function __construct($sangria, $conexao){
			$this->sangria 	= $sangria;
			$this->conexao 	= $conexao;
		}
 
		public function getSangria($valRef){
			$resultado = $this->pesquisar($valRef);
			if($resultado == false)
				return $this->sangria = NULL;
			$linha = mysqli_fetch_array($resultado);
			$this->sangria->codigo		= $linha["san_codigo"];
			$this->sangria->empCodigo	= $linha["emp_codigo"];
			$this->sangria->tipCodigo	= $linha["tip_codigo"];
			$this->sangria->data		= $linha["san_data"];
			$this->sangria->valor		= $linha["san_valor"];			
			return $this->sangria;
		}
		
		public function getAtual(){
			$sql = "SELECT * FROM sangrias WHERE emp_codigo=".$this->sangria->empCodigo." AND tip_codigo=".$this->sangria->tipCodigo." AND san_data='".$this->sangria->data."' AND san_valor=".$this->sangria->valor;
			$resultado = $this->conexao->selecionar($sql);
			if($resultado == false)
				return $this->sangria = NULL;
			$linha = mysqli_fetch_array($resultado);
			$this->sangria->codigo		= $linha["san_codigo"];
			$this->sangria->empCodigo	= $linha["emp_codigo"];
			$this->sangria->tipCodigo	= $linha["tip_codigo"];
			$this->sangria->data		= $linha["san_data"];
			$this->sangria->valor		= $linha["san_valor"];
			return $this->sangria;
		}
		
		public function getSangriaLista(){
			$empCodigo = $_SESSION["empresa"];
				
			$sql = "SELECT * FROM sangrias WHERE emp_codigo =".$empCodigo;
			$resultado = $this->conexao->selecionar($sql);
			if($resultado == false ||  $this->conexao->numeroLinhas($resultado) == 0)
				return NULL;
			$contador = 0;
			while($linha = mysqli_fetch_array($resultado)){
				$bean 				= new Sangria($linha["tip_codigo"], $linha["san_data"], $linha["san_valor"]);
				$bean->codigo 		= $linha["san_codigo"];
				$array[$contador] 	= $bean;
				$contador++;
			}
			return $array;
		}
		
		public function setSangria($sangria){
			$this->sangria = $sangria;
		}
		
		public function cadastrar(){
			$sql = "INSERT INTO sangrias (emp_codigo, tip_codigo, san_data, san_valor) VALUES (".$this->sangria->empCodigo.", ".$this->sangria->tipCodigo.", '".$this->sangria->data."', ".$this->sangria->valor.")";
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel salvar a Sangria: ".$this->sangria->valor);
				return false;
			}
			return true;
		}
		
		public function alterar($valRef){
			$sql = "UPDATE sangrias SET emp_codigo=".$this->sangria->empCodigo.", tip_codigo=".$this->sangria->tipCodigo.", san_data='".$this->sangria->data."', san_valor=".$this->sangria->valor." WHERE san_codigo=".$valRef;
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel alterar a Sangria: ".$valRef);
				return false;
			}
			return true;
		}
		
		public function deletar($valRef){
			$sql = "DELETE FROM sangrias WHERE san_codigo = ".valRef;
			echo($sql);
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel deletar a Sangria: ".$valRef);
				return false;
			}
			return true;
		}
		
		public function pesquisar($valRef){
			$sql = "SELECT * FROM sangrias WHERE san_codigo = ".valRefE;
			$resultado = $this->conexao->selecionar($sql);
			if(!$resultado){
				echo("Não foi possivel selecionar a Sangria: ".$valRef);
			}
			return $resultado;
		}
	}
?>