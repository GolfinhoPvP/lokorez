<?php
	class DAOParcelas{
		private $parcelas;
		private $conexao;
		
		function __construct($nP, $aNE, $sC, $perPar, $val, $toRoot, $conex){
			include_once($toRoot."beans/Parcelas.class.php");
			include_once($toRoot."utils/ConectarMySQL.class.php");
			$this->parcelas = new Parcelas($nP, $aNE, $sC, $perPar, $val);
			$this->conexao = $conex;
		}
		
		public function cadastrar(){
			$sql = "INSERT INTO parcelas (par_numero_parcela, ave_numero_externo, sta_codigo, par_periodo_parcela, par_valor) VALUES (".$this->parcelas->getNumeroParcela().", '".$this->parcelas->getAveNumeroExterno()."', ".$this->parcelas->getStaCodigo().", '".$this->parcelas->getPeriodoParcela()."', ".$this->parcelas->getValor().")";
			echo($sql);
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel salvar: ".$this->parcelas->getAveNumeroExterno());
				return false;
			}
			return true;
		}
		
		public function alterar($valRef){
			$sql = "UPDATE parcelas SET par_numero_parcela = ".$this->parcelas->getNumeroParcela().", ave_numero_externo='".$this->parcelas->getAveNumeroExterno()."', sta_codigo = ".$this->parcelas->getStaCodigo().", par_periodo_parcela='".$this->parcelas->getPeriodoParcela()."', par_valor = ".$this->parcelas->getValor()." WHERE par_numero_parcela=".$valRef;
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel alterar: ".$this->parcelas->getAveNumeroExterno());
				return false;
			}
			return true;
		}
		
		public function deletar($valRef){
			$sql = "DELETE FROM parcelas WHERE ave_numero_externo='".$valRef."'";
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel deletar: ".$valRef);
				return false;
			}
			return true;
		}
		
		public function pesquisar($valRefNP, $valRefNE){
			$sql = "SELECT * FROM parcelas WHERE par_numero_parcela=".$valRefNP." AND ave_numero_externo='".$valRef."'";
			$resultado = $this->conexao->selecionar($sql);
			if(!$resultado){
				echo("Não foi possivel selecionar: ".$valRef);
			}
			return $resultado;
		}
		
		public function getParcela($valRefNP, $valRefNE){
			$linha = mysqli_fetch_array($this->pesquisar($valRefNP, $valRefNE));
			$this->parcelas->setNumeroParcela($linha["par_numero_parcela"]);
			$this->parcelas->setAveNumeroExterno($linha["ave_numero_externo"]);
			$this->parcelas->setStaCodigo($linha["sta_codigo"]);
			$this->parcelas->setPeriodoParcela($linha["par_periodo_parcela"]);
			$this->parcelas->setValor($linha["par_valor"]);
			return $this->parcelas;
		}
	}
?>