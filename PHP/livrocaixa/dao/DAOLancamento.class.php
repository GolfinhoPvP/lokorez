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
			$this->lancamento->empCodigo	= $linha["emp_codigo"];
			$this->lancamento->cliCodigo	= $linha["cli_codigo"];
			$this->lancamento->forCodigo	= $linha["for_codigo"];
			$this->lancamento->tipCodigo	= $linha["tip_codigo"];
			$this->lancamento->pcCodigo		= $linha["pc_codigo"];
			$this->lancamento->ordemServico	= $linha["lan_ordem_servico"];
			$this->lancamento->datahora		= $linha["lan_datahora"];
			$this->lancamento->desconto		= $linha["lan_desconto"];
			$this->lancamento->valor		= $linha["lan_valor_total"];
			$this->lancamento->checado		= $linha["lan_checado"];
			return $this->lancamento;
		}
		
		public function getAtual(){
			$sql = "SELECT * FROM lancamentos WHERE lan_codigo = '".$this->lancamento->codigo."'";
			$resultado = $this->conexao->selecionar($sql);
			if($resultado == false)
				return $this->lancamento = NULL;
			$linha = mysqli_fetch_array($resultado);
			$this->lancamento->codigo		= $linha["lan_codigo"];
			$this->lancamento->empCodigo	= $linha["emp_codigo"];
			$this->lancamento->cliCodigo	= $linha["cli_codigo"];
			$this->lancamento->forCodigo	= $linha["for_codigo"];
			$this->lancamento->tipCodigo	= $linha["tip_codigo"];
			$this->lancamento->pcCodigo		= $linha["pc_codigo"];
			$this->lancamento->ordemServico	= $linha["lan_ordem_servico"];
			$this->lancamento->datahora		= $linha["lan_datahora"];
			$this->lancamento->desconto		= $linha["lan_desconto"];
			$this->lancamento->valor		= $linha["lan_valor_total"];
			$this->lancamento->checado		= $linha["lan_checado"];
			return $this->lancamento;
		}
		
		public function getChave(){
			$chave 		= date("Ymd");
			$contador 	= 1;
			$contador 	= str_pad($contador, 4, "0", STR_PAD_LEFT);
			$sql = "SELECT * FROM lancamentos WHERE lan_codigo='".$chave.$contador."' AND emp_codigo=".$_SESSION["empresa"];
			$resultado = $this->conexao->selecionar($sql);
			while($this->conexao->numeroLinhas($resultado) != 0 && intval($contador) < 9999){
				$contador 	= intval($contador) + 1;
				$contador 	= str_pad($contador, 4, "0", STR_PAD_LEFT);
				$sql = "SELECT * FROM lancamentos WHERE lan_codigo='".$chave.$contador."' AND emp_codigo=".$_SESSION["empresa"];
				$resultado = $this->conexao->selecionar($sql);
			}
			$chave .= $contador;
			return $chave;
		}
		
		public function setLancamento($lancamento){
			$this->lancamento = $lancamento;
		}
		
		public function cadastrar(){
			$sql = "INSERT INTO lancamentos (lan_codigo, emp_codigo, cli_codigo, for_codigo, tip_codigo, pc_codigo, lan_ordem_servico, lan_datahora, lan_desconto, lan_valor_total, lan_checado) VALUES ('".$this->lancamento->codigo."', ".$this->lancamento->empCodigo.", ".$this->lancamento->cliCodigo.", ".$this->lancamento->forCodigo.", ".$this->lancamento->tipCodigo.", ".$this->lancamento->pcCodigo.", '".$this->lancamento->ordemServico."', '".$this->lancamento->datahora."', ".$this->lancamento->desconto.", ".$this->lancamento->valor.", ".$this->lancamento->checado.")";
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel salvar o lancamento: ".$this->lancamento->codigo);
				return false;
			}
			return true;
		}
		
		public function alterar($valRef){
			$sql = "UPDATE lancamentos SET lan_codigo='".$this->lancamento->codigo."', emp_codigo='".$this->lancamento->empCodigo."', cli_codigo='".$this->lancamento->cliCodigo."', for_codigo=".$this->lancamento->forCodigo.", tip_codigo=".$this->lancamento->tipCodigo.", pc_codigo=".$this->lancamento->pcCodigo.", lan_ordem_servico='".$this->lancamento->ordemServico."', lan_datahora='".$this->lancamento->datahora."', lan_desconto='".$this->lancamento->desconto."', lan_valor_total=".$this->lancamento->valor.", lan_checado=".$this->lancamento->checado." WHERE lan_codigo='".$valRef."'";
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
		
		public function zerar($valRef){
			$sql = "UPDATE lancamentos SET lan_checado = 1 WHERE lan_codigo = ".$valRef;
			
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel zerar o lancamento código: ".$valRef);
				return false;
			}
			return true;
		}
	}
?>