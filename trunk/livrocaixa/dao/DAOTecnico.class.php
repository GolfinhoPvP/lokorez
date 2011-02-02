<?php
	class DAOTecnico{
		private $tecnico;
		private $conexao;
		
		function __construct($tecnico, $conexao){
			$this->tecnico 	= $tecnico;
			$this->conexao 	= $conexao;
		}
 
		public function getTecnico($valRef){
			$resultado = $this->pesquisar($valRef);
			if($resultado == false)
				return $this->tecnico = NULL;
			$linha = mysqli_fetch_array($resultado);
			$this->tecnico->codigo 		= $linha["tec_codigo"];
			$this->tecnico->pesCodigo 	= $linha["pes_codigo"];
			$this->tecnico->claCodigo 	= $linha["cla_codigo"];
			$this->tecnico->descricao	= $linha["tec_descricao"];
			return $this->tecnico;
		}
		
		public function getAtual(){
			$sql = "SELECT * FROM tecnicos WHERE pes_codigo=".$this->tecnico->pesCodigo." AND cla_codigo=".$this->tecnico->claCodigo." AND tec_descricao='".$this->tecnico->descricao."'";
			$resultado = $this->conexao->selecionar($sql);
			if($resultado == false)
				return $this->tecnico = NULL;
			$linha = mysqli_fetch_array($resultado);
			$this->tecnico->codigo 		= $linha["tec_codigo"];
			$this->tecnico->pesCodigo 	= $linha["pes_codigo"];
			$this->tecnico->claCodigo 	= $linha["cla_codigo"];
			$this->tecnico->descricao	= $linha["tec_descricao"];
			return $this->tecnico;
		}
		
		public function getTecnicoLista(){
			if($_SESSION["codigo"] == 2)
				$cliCod = 2;
			else
				$cliCod = $_SESSION["codigoPai"];
				
			$sql = "SELECT * FROM tecnicos t INNER JOIN classe c ON t.cla_codigo=c.cla_codigo WHERE c.cli_codigo =".$cliCod." ORDER BY t.tec_descricao";
			$resultado = $this->conexao->selecionar($sql);
			if($resultado == false ||  $this->conexao->numeroLinhas($resultado) == 0)
				return NULL;
			$contador = 0;
			while($linha = mysqli_fetch_array($resultado)){
				$bean 				= new Tecnico($linha["pes_codigo"], $linha["cla_codigo"], $linha["tec_descricao"]);
				$bean->codigo 		= $linha["tec_codigo"];
				$array[$contador] 	= $bean;
				$contador++;
			}
			return $array;
		}
		
		public function setTecnico($tecnico){
			$this->tecnico = $tecnico;
		}
		
		public function cadastrar(){
			$sql = "INSERT INTO tecnicos (pes_codigo, cla_codigo, tec_descricao) VALUES (".$this->tecnico->pesCodigo.", ".$this->tecnico->claCodigo.", '".$this->tecnico->descricao."')";
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel salvar o usuário: ".$this->tecnico->descricao);
				return false;
			}
			return true;
		}
		
		public function alterar($valRef){
			$sql = "UPDATE tecnicos SET pes_codigo=".$this->tecnico->pesCodigo.", cla_codigo=".$this->tecnico->nivel.", tec_descricao='".$this->tecnico->pesCodigo."' WHERE tec_codigo=".$valRef;
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel alterar o usuário código: ".$valRef);
				return false;
			}
			return true;
		}
		
		public function deletar($valRef){
			$sql = "DELETE FROM tecnicos WHERE tec_codigo=".$valRef;
			echo($sql);
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel deletar o usuário código: ".$valRef);
				return false;
			}
			return true;
		}
		
		public function pesquisar($valRef){
			$sql = "SELECT * FROM tecnicos WHERE tec_codigo='".$valRef."'";
			$resultado = $this->conexao->selecionar($sql);
			if(!$resultado){
				echo("Não foi possivel selecionar o usuário código: ".$valRef);
			}
			return $resultado;
		}
	}
?>