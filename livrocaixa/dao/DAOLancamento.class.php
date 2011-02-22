<?php
	class DAOLancamento{
		private $lancamento;
		private $conexao;
		
		function __construct($lancamento, $conexao){
			$this->lancamento 	= $lancamento;
			$this->conexao 		= $conexao;
		}
 
		public function getLancamento($valRef){
			$resultado = $this->pesquisar($valRef);
			if($resultado == false)
				return $this->lancamento = NULL;
			$linha = mysqli_fetch_array($resultado);
			$this->lancamento->codigo		= $linha["lan_codigo"];
			$this->lancamento->forCodigo	= $linha["for_codigo"];
			$this->lancamento->tipCodigo	= $linha["tip_codigo"];
			$this->lancamento->pcCodigo		= $linha["pc_codigo"];
			$this->lancamento->datahora		= $linha["lan_datahora"];
			$this->lancamento->valor		= $linha["lan_valor_total"];
			return $this->lancamento;
		}
		
		public function getAtual(){
			$sql = "SELECT * FROM lancamentos WHERE lan_codigo = '".$this->lancamento->codigo."'";
			$resultado = $this->conexao->selecionar($sql);
			if($resultado == false)
				return $this->lancamento = NULL;
			$linha = mysqli_fetch_array($resultado);
			$this->lancamento->codigo		= $linha["lan_codigo"];
			$this->lancamento->forCodigo	= $linha["for_codigo"];
			$this->lancamento->tipCodigo	= $linha["tip_codigo"];
			$this->lancamento->pcCodigo		= $linha["pc_codigo"];
			$this->lancamento->datahora		= $linha["lan_datahora"];
			$this->lancamento->valor		= $linha["lan_valor_total"];
			return $this->lancamento;
		}
		
		public function getChave(){
			$chave 		= date("Ymd");
			$contador 	= 1;
			$contador 	= str_pad($contador, 4, "0", STR_PAD_LEFT);
			$resultado 	= $this->pesquisar($chave.$contador);
			while($this->conexao->numeroLinhas($resultado) != 0 && intval($contador) < 9999){
				$contador 	= intval($contador) + 1;
				$contador 	= str_pad($contador, 4, "0", STR_PAD_LEFT);
				$resultado 	= $this->pesquisar($chave.$contador);
			}
			$chave .= $contador;
			return $chave;
		}
		
		public function setLancamento($lancamento){
			$this->lancamento = $lancamento;
		}
		
		public function cadastrar(){
			$sql = "INSERT INTO lancamentos (lan_codigo, for_codigo, tip_codigo, pc_codigo, lan_datahora, lan_valor_total) VALUES ('".$this->lancamento->codigo."', ".$this->lancamento->forCodigo.", ".$this->lancamento->tipCodigo.", ".$this->lancamento->pcCodigo.", '".$this->lancamento->datahora."', ".$this->lancamento->valor.")";
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel salvar o lancamento: ".$this->lancamento->codigo);
				return false;
			}
			return true;
		}
		
		public function alterar($valRef){
			$sql = "UPDATE lancamentos SET lan_codigo='".$this->lancamento->codigo."', for_codigo=".$this->lancamento->forCodigo.", tip_codigo=".$this->lancamento->tipCodigo.", pc_codigo=".$this->lancamento->pcCodigo.", lan_datahora='".$this->lancamento->datahora."', lan_valor_total=".$this->lancamento->valor." WHERE lan_codigo='".$valRef."'";
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel alterar o lancamento código: ".$valRef);
				return false;
			}
			return true;
		}
		
		public function deletar($valRef){
			$sql = "DELETE FROM lancamentos WHERE lan_codigo='".$valRef."'";
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel deletar o lancamento código: ".$valRef);
				return false;
			}
			return true;
		}
		
		public function pesquisar($valRef){
			$sql = "SELECT * FROM lancamentos WHERE lan_codigo='".$valRef."'";
			$resultado = $this->conexao->selecionar($sql);
			if(!$resultado){
				echo("Não foi possivel selecionar o lancamento referência: ".$valRef);
			}
			return $resultado;
		}
	}
?>