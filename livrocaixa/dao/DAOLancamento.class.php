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
			$this->lancamento->tecCodigo	= $linha["tec_codigo"];
			$this->lancamento->proCodigo	= $linha["pro_codigo"];
			$this->lancamento->pcCodigo		= $linha["pc_codigo"];
			$this->lancamento->serCodigo	= $linha["ser_codigo"];
			$this->lancamento->forCodigo	= $linha["for_nome"];
			$this->lancamento->quantidade	= $linha["lan_quantidade_item"];
			$this->lancamento->datahora		= $linha["lan_datahora"];
			$this->lancamento->valor		= $linha["lan_valor"];
			return $this->lancamento;
		}
		
		public function getAtual(){
			$sql = "SELECT * FROM lancamentos WHERE lan_codigo = '".$this->lancamento->codigo."'";
			$resultado = $this->conexao->selecionar($sql);
			if($resultado == false)
				return $this->lancamento = NULL;
			$linha = mysqli_fetch_array($resultado);
			$this->lancamento->codigo		= $linha["lan_codigo"];
			$this->lancamento->tecCodigo	= $linha["tec_codigo"];
			$this->lancamento->proCodigo	= $linha["pro_codigo"];
			$this->lancamento->pcCodigo		= $linha["pc_codigo"];
			$this->lancamento->serCodigo	= $linha["ser_codigo"];
			$this->lancamento->forCodigo	= $linha["for_codigo"];
			$this->lancamento->quantidade	= $linha["lan_quantidade_item"];
			$this->lancamento->datahora		= $linha["lan_datahora"];
			$this->lancamento->valor		= $linha["lan_valor"];
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
			$sql = "INSERT INTO lancamentos (lan_codigo, tec_codigo, pro_codigo, pc_codigo, ser_codigo, for_codigo, lan_quantidade_item, lan_datahora, lan_valor) VALUES ('".$this->lancamento->codigo."', ".$this->lancamento->tecCodigo.", ".$this->lancamento->proCodigo.", ".$this->lancamento->pcCodigo.", ".$this->lancamento->serCodigo.", ".$this->lancamento->forCodigo.", ".$this->lancamento->quantidade.", '".$this->lancamento->datahora."', ".$this->lancamento->valor.")";
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel salvar o lancamento: ".$this->lancamento->codigo);
				return false;
			}
			return true;
		}
		
		public function alterar($valRef){
			$sql = "UPDATE lancamentos SET lan_codigo='".$this->lancamento->codigo."', tec_codigo=".$this->lancamento->tecCodigo.", pro_codigo=".$this->lancamento->proCodigo.", pc_codigo=".$this->lancamento->pcCodigo.", ser_codigo=".$this->lancamento->serCodigo.", for_codigo=".$this->lancamento->forCodigo.",  lan_quantidade_item=".$this->lancamento->quantidade.", lan_datahora='".$this->lancamento->datahora."', lan_valor=".$this->lancamento->valor." WHERE lan_codigo='".$valRef."'";
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel alterar o lancamento código: ".$valRef);
				return false;
			}
			return true;
		}
		
		public function deletar($valRef){
			$sql = "DELETE FROM lancamentos WHERE lan_codigo='".valRef."'";
			echo($sql);
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