<?php
	class DAOParcela{
		private $parcela;
		private $conexao;
		
		function __construct($nP, $aNE, $sC, $perPar, $val, $toRoot, $conex){
			include_once($toRoot."beans/Parcela.class.php");
			include_once($toRoot."utils/ConectarMySQL.class.php");
			$this->parcela = new Parcela($nP, $aNE, $sC, $perPar, $val);
			$this->conexao = $conex;
		}
		
		public function cadastrar(){
			$sql = "INSERT INTO parcelas (par_numero_parcela, ave_numero_externo, sta_codigo, par_periodo_parcela, par_valor) VALUES (".$this->parcela->getNumeroParcela().", '".$this->parcela->getAveNumeroExterno()."', ".$this->parcela->getStaCodigo().", '".$this->parcela->getPeriodoParcela()."', ".$this->parcela->getValor().")";
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel salvar: ".$this->parcela->getAveNumeroExterno());
				return false;
			}
			return true;
		}
		
		public function alterar($valRef){
			$sql = "UPDATE parcelas SET par_numero_parcela = ".$this->parcela->getNumeroParcela().", ave_numero_externo='".$this->parcela->getAveNumeroExterno()."', sta_codigo = ".$this->parcela->getStaCodigo().", par_periodo_parcela='".$this->parcela->getPeriodoParcela()."', par_valor = ".$this->parcela->getValor()." WHERE par_numero_parcela=".$valRef;
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel alterar: ".$this->parcela->getAveNumeroExterno());
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
			$sql = "SELECT * FROM parcelas WHERE par_numero_parcela LIKE '".$valRefNP."' AND ave_numero_externo='".$valRef."'";
			$resultado = $this->conexao->selecionar($sql);
			if(!$resultado){
				echo("Não foi possivel selecionar: ".$valRef);
			}
			return $resultado;
		}
		
		public function getParcela($valRefNP, $valRefNE){
			$linha = mysqli_fetch_array($this->pesquisar($valRefNP, $valRefNE));
			$this->parcela->setNumeroParcela($linha["par_numero_parcela"]);
			$this->parcela->setAveNumeroExterno($linha["ave_numero_externo"]);
			$this->parcela->setStaCodigo($linha["sta_codigo"]);
			$this->parcela->setPeriodoParcela($linha["par_periodo_parcela"]);
			$this->parcela->setValor($linha["par_valor"]);
			return $this->parcela;
		}
		
		public function getParcelasLista($valRef){
			$resultado = $this->pesquisar("%", $valRef);
			$contador = 0;
			$lista = NULL;
			while(($linha = mysqli_fetch_array($resultado))){
				$lista[$contador] = $linha;
			}			
			return $lista;
		}
	}
?>