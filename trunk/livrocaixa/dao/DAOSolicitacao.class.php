<?php
	class DAOSolicitacao{
		private $solicitacao;
		private $conexao;
		
		function __construct($solicitacao, $conexao){
			$this->solicitacao 	= $solicitacao;
			$this->conexao 		= $conexao;
		}
 
		public function getSolicitacao($valRef){
			$resultado = $this->pesquisar($valRef);
			if($resultado == false)
				return $this->solicitacao = NULL;
			$linha = mysqli_fetch_array($resultado);
			$this->solicitacao->codigo			= $linha["sol_codigo"];
			$this->solicitacao->staCodigo		= $linha["sta_codigo"];
			$this->solicitacao->cliCodigo		= $linha["cli_codigo"];
			$this->solicitacao->empCodigo		= $linha["emp_codigo"];
			$this->solicitacao->descricao		= $linha["sol_descricao"];
			$this->solicitacao->vencimento		= $linha["sol_vencimento"];
			$this->solicitacao->valor			= $linha["sol_valor"];
			$this->solicitacao->codigoBarras	= $linha["sol_codigo_barras"];
			$this->solicitacao->valorPago		= $linha["sol_valor_pago"];
			return $this->solicitacao;
		}
		
		public function getAtual(){
			$sql = "SELECT * FROM solicitacoes WHERE sol_codigo = '".$this->solicitacao->codigo."'";
			$resultado = $this->conexao->selecionar($sql);
			if($resultado == false)
				return $this->solicitacao = NULL;
			$linha = mysqli_fetch_array($resultado);
			$this->solicitacao->codigo			= $linha["sol_codigo"];
			$this->solicitacao->staCodigo		= $linha["sta_codigo"];
			$this->solicitacao->cliCodigo		= $linha["cli_codigo"];
			$this->solicitacao->empCodigo		= $linha["emp_codigo"];
			$this->solicitacao->descricao		= $linha["sol_descricao"];
			$this->solicitacao->vencimento		= $linha["sol_vencimento"];
			$this->solicitacao->valor			= $linha["sol_valor"];
			$this->solicitacao->codigoBarras	= $linha["sol_codigo_barras"];
			$this->solicitacao->valorPago		= $linha["sol_valor_pago"];
			return $this->solicitacao;
		}
		
		public function getSolicitacaoLista(){
			$sql = "SELECT * FROM solicitacoes WHERE cli_codigo=".$_SESSION["codigo"]." AND sta_codigo!=2";
			$resultado = $this->conexao->selecionar($sql);
			if($resultado == false ||  $this->conexao->numeroLinhas($resultado) == 0)
				return NULL;
			$contador = 0;
			while($linha = mysqli_fetch_array($resultado)){
				$bean 				= new Solicitacao($linha["sta_codigo"], $linha["sol_descricao"], $linha["sol_vencimento"], $linha["sol_valor"], $linha["sol_codigo_barras"], $linha["sol_valor_pago"]);
				$bean->codigo 		= $linha["sol_codigo"];
				$array[$contador] 	= $bean;
				$contador++;
			}
			return $array;
		}
		
		public function setSolicitacao($solicitacao){
			$this->solicitacao = $solicitacao;
		}
		
		public function cadastrar(){
			$sql = "INSERT INTO solicitacoes (sta_codigo, cli_codigo, emp_codigo, sol_descricao, sol_vencimento, sol_valor, sol_codigo_barras, sol_valor_pago) VALUES (".$this->solicitacao->staCodigo.", ".$this->solicitacao->cliCodigo.", ".$this->solicitacao->empCodigo.", '".$this->solicitacao->descricao."', '".$this->solicitacao->vencimento."', ".$this->solicitacao->valor.", '".$this->solicitacao->codigoBarras."', ".$this->solicitacao->valorPago.")";
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel salvar a solicitacao: ".$this->solicitacao->descricao);
				return false;
			}
			return true;
		}
		
		public function alterar($valRef){
			$sql = "UPDATE solicitacoes SET sta_codigo=".$this->solicitacao->staCodigo.", cli_codigo=".$this->solicitacao->cliCodigo.", emp_codigo=".$this->solicitacao->empCodigo.", sol_descricao='".$this->solicitacao->descricao."', sol_vencimento='".$this->solicitacao->vencimento."',  sol_valor=".$this->solicitacao->valor.", sol_codigo_barras='".$this->solicitacao->codigoBarras."', sol_valor_pago=".$this->solicitacao->valorPago." WHERE sol_codigo=".$valRef;
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel alterar a solicitacao código: ".$valRef);
				return false;
			}
			return true;
		}
		
		public function deletar($valRef){
			$sql = "DELETE FROM solicitacoes WHERE sol_codigo=".valRef;
			echo($sql);
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel deletar a solicitacao código: ".$valRef);
				return false;
			}
			return true;
		}
		
		public function pesquisar($valRef){
			$sql = "SELECT * FROM solicitacoes WHERE sol_codigo=".$valRef;
			$resultado = $this->conexao->selecionar($sql);
			if(!$resultado){
				echo("Não foi possivel selecionar a solicitacao referência: ".$valRef);
			}
			return $resultado;
		}
	}
?>