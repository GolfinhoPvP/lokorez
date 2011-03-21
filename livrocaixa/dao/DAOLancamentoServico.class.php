<?php
	class DAOLancamentoServico{
		private $lancamentoServico;
		private $conexao;
		
		function __construct($lancamentoServico, $conexao){
			$this->lancamentoServico 	= $lancamentoServico;
			$this->conexao 				= $conexao;
		}
 
		public function getLancamentoServico($valRef){
			$resultado = $this->pesquisar($valRef);
			if($resultado == false)
				return $this->lancamentoServico = NULL;
			$linha = mysqli_fetch_array($resultado);
			$this->lancamentoServico->lanCodigo		= $linha["lan_codigo"];
			$this->lancamentoServico->serCodigo		= $linha["ser_codigo"];
			$this->lancamentoServico->tecCodigo		= $linha["tec_codigo"];
			$this->lancamentoServico->valorServico	= $linha["lan_valor_servico"];
			$this->lancamentoServico->checado		= $linha["lan_ser_checado"];
			return $this->lancamentoServico;
		}
		
		public function getAtual(){
			$sql = "SELECT * FROM lancamentos_servico WHERE lan_codigo = '".$this->lancamentoServico->lanCodigo."'";
			$resultado = $this->conexao->selecionar($sql);
			if($resultado == false)
				return $this->lancamentoServico = NULL;
			$linha = mysqli_fetch_array($resultado);
			$this->lancamentoServico->lanCodigo		= $linha["lan_codigo"];
			$this->lancamentoServico->serCodigo		= $linha["ser_codigo"];
			$this->lancamentoServico->tecCodigo		= $linha["tec_codigo"];
			$this->lancamentoServico->valorServico	= $linha["lan_valor_servico"];
			$this->lancamentoServico->checado		= $linha["lan_ser_checado"];
			return $this->lancamentoServico;
		}
		
		public function setLancamentoServico($lancamentoServico){
			$this->lancamentoServico = $lancamentoServico;
		}
		
		public function cadastrar(){
			$sql = "INSERT INTO lancamentos_servico (lan_codigo, emp_codigo, ser_codigo, tec_codigo, lan_valor_servico, lan_ser_checado) VALUES ('".$this->lancamentoServico->lanCodigo."', ".$this->lancamentoServico->empCodigo.", ".$this->lancamentoServico->serCodigo.", ".$this->lancamentoServico->tecCodigo.", ".$this->lancamentoServico->valorServico.", ".$this->lancamentoServico->checado.")";
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel salvar o Lancamento/Servico: ".$this->lancamentoServico->lanCodigo);
				return false;
			}
			return true;
		}
		
		public function alterar($valRef){
			$sql = "UPDATE lancamentos_servico SET lan_codigo='".$this->lancamentoServico->lanCodigo."', emp_codigo=".$this->lancamentoServico->empCodigo.", ser_codigo=".$this->lancamentoServico->serCodigo.",  tec_codigo=".$this->lancamentoServico->tecCodigo.", lan_valor_servico=".$this->lancamentoServico->valorServico.", lan_ser_checado=".$this->lancamentoServico->checado." WHERE lan_codigo='".$valRef."'";
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel alterar o Lancamento/Servico código: ".$valRef);
				return false;
			}
			return true;
		}
		
		public function deletar($valRef){
			$sql = "DELETE FROM lancamentos_servico WHERE lan_codigo='".$valRef."'";
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel deletar o Lancamento/Servico código: ".$valRef);
				return false;
			}
			return true;
		}
		
		public function pesquisar($valRef){
			$sql = "SELECT * FROM lancamentos_servico WHERE lan_codigo='".$valRef."'";
			$resultado = $this->conexao->selecionar($sql);
			if(!$resultado){
				echo("Não foi possivel selecionar o Lancamento/Servico referência: ".$valRef);
			}
			return $resultado;
		}
		
		public function zerar($valRef){
			if($valRef == 0){
				$sql = "UPDATE lancamentos_servico SET lan_ser_checado = 1";
			}else{
				$sql = "UPDATE lancamentos_servico SET lan_ser_checado = 1 WHERE tec_codigo = ".$valRef;
			}
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel zerar o lancamento código: ".$valRef);
				return false;
			}
			return true;
		} 
	}
?>