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
			$this->tecnico->banCodigo 	= $linha["ban_codigo"];
			$this->tecnico->pesCodigo 	= $linha["pes_codigo"];
			$this->tecnico->claCodigo 	= $linha["cla_codigo"];
			$this->tecnico->descricao	= $linha["tec_descricao"];
			$this->tecnico->agencia		= $linha["tec_numero_agencia"];
			$this->tecnico->conta		= $linha["tec_numero_conta"];
			return $this->tecnico;
		}
		
		public function getAtual(){
			$sql = "SELECT * FROM tecnicos WHERE ban_codigo=".$this->tecnico->banCodigo." AND pes_codigo=".$this->tecnico->pesCodigo." AND cla_codigo=".$this->tecnico->claCodigo." AND tec_descricao='".$this->tecnico->descricao."' AND tec_numero_agencia='".$this->tecnico->agencia."' AND tec_numero_conta='".$this->tecnico->conta."'";
			$resultado = $this->conexao->selecionar($sql);
			if($resultado == false)
				return $this->tecnico = NULL;
			$linha = mysqli_fetch_array($resultado);
			$this->tecnico->codigo 		= $linha["tec_codigo"];
			$this->tecnico->banCodigo 	= $linha["ban_codigo"];
			$this->tecnico->pesCodigo 	= $linha["pes_codigo"];
			$this->tecnico->claCodigo 	= $linha["cla_codigo"];
			$this->tecnico->descricao	= $linha["tec_descricao"];
			$this->tecnico->agencia		= $linha["tec_numero_agencia"];
			$this->tecnico->conta		= $linha["tec_numero_conta"];
			return $this->tecnico;
		}
		
		public function getTecnicoLista(){
			if($_SESSION["nivel"] == 2)
				$cliCod = $_SESSION["codigo"];
			else
				$cliCod = $_SESSION["codigoPai"];
				
			$sql = "SELECT * FROM tecnicos t INNER JOIN classe c ON t.cla_codigo=c.cla_codigo WHERE c.cli_codigo =".$cliCod." ORDER BY t.tec_descricao";
			$resultado = $this->conexao->selecionar($sql);
			if($resultado == false ||  $this->conexao->numeroLinhas($resultado) == 0)
				return NULL;
			$contador = 0;
			while($linha = mysqli_fetch_array($resultado)){
				$bean 				= new Tecnico($linha["ban_codigo"], $linha["pes_codigo"], $linha["cla_codigo"], $linha["tec_descricao"], $linha["tec_numero_agencia"], $linha["tec_numero_conta"]);
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
			$sql = "INSERT INTO tecnicos (ban_codigo, pes_codigo, cla_codigo, tec_descricao, tec_numero_agencia, tec_numero_conta) VALUES (".$this->tecnico->banCodigo.", ".$this->tecnico->pesCodigo.", ".$this->tecnico->claCodigo.", '".$this->tecnico->descricao."', '".$this->tecnico->agencia."', '".$this->tecnico->conta."')";
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel salvar o usuário: ".$this->tecnico->descricao);
				return false;
			}
			return true;
		}
		
		public function alterar($valRef){
			$sql = "UPDATE tecnicos SET ban_codigo=".$this->tecnico->banCodigo.", pes_codigo=".$this->tecnico->pesCodigo.", cla_codigo=".$this->tecnico->nivel.", tec_descricao='".$this->tecnico->pesCodigo."', tec_numero_agencia='".$this->tecnico->agencia."', tec_numero_conta='".$this->tecnico->conta."' WHERE tec_codigo=".$valRef;
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