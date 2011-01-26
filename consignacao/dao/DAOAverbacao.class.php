<?php
	class DAOAverbacao{
		private $averbacao;
		private $conexao;
		
		function __construct($numExt, $end, $eC, $pesC, $serMat, $bC, $proC, $per, $sC, $dataC, $dataE, $numPar, $mont, $taxJur, $toRoot, $conex){
			include_once($toRoot."beans/Averbacao.class.php");
			include_once($toRoot."utils/ConectarMySQL.class.php");
			$this->averbacao = new Averbacao($numExt, $end, $eC, $pesC, $serMat, $bC, $proC, $per, $sC, $dataC, $dataE, $numPar, $mont, $taxJur);
			$this->conexao = $conex;
		}
		
		public function cadastrar(){
			$sql = "INSERT INTO averbacoes (ave_numero_externo, adm_codigo_encerrador, emp_codigo, pes_codigo, ser_matricula,	ban_codigo,	pro_codigo,	par_periodo, sta_codigo, ave_data_criacao, ave_data_encerramento, ave_numero_parcelas, ave_montante, ave_taxa_juros) VALUES ('".$this->averbacao->getNumeroExterno()."', ".$this->averbacao->getEncerrador().", ".$this->averbacao->getEmpCodigo().", ".$this->averbacao->getPesCodigo().", '".$this->averbacao->getSerMatricula()."', '".$this->averbacao->getBanCodigo()."', ".$this->averbacao->getProCodigo().", '".$this->averbacao->getParPeriodo()."', ".$this->averbacao->getStaCodigo().", '".$this->averbacao->getDataCriacao()."', '".$this->averbacao->getDataEncerramento()."', ".$this->averbacao->getNumeroParcelas().", ".$this->averbacao->getMontante().", ".$this->averbacao->getTaxaJuros().")";
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel salvar: ".$this->averbacao->getNumeroExterno());
				return false;
			}
			return true;
		}
		
		public function alterar($valRef){
			$sql = "UPDATE averbacoes SET ave_numero_externo='".$this->averbacao->getNumeroExterno()."', adm_codigo_encerrador=".$this->averbacao->getEncerrador().", emp_codigo=".$this->averbacao->getEmpCodigo().", pes_codigo=".$this->averbacao->getPesCodigo().", ser_matricula='".$this->averbacao->getSerMatricula()."',	ban_codigo='".$this->averbacao->getBanCodigo()."',	pro_codigo=".$this->averbacao->getProCodigo().", par_periodo='".$this->averbacao->getParPeriodo()."', sta_codigo=".$this->averbacao->getStaCodigo().", ave_data_criacao='".$this->averbacao->getDataCriacao()."', ave_data_encerramento='".$this->averbacao->getDataEncerramento()."', ave_numero_parcelas=".$this->averbacao->getNumeroParcelas().", ave_montante=".$this->averbacao->getMontante().", ave_taxa_juros=".$this->averbacao->getTaxaJuros()." WHERE ave_numero_externo=".$valRef;
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel alterar: ".$this->averbacao->getNumeroExterno());
				return false;
			}
			return true;
		}
		
		public function deletar($valRef){
			$sql = "DELETE FROM averbacoes WHERE ave_numero_externo='".$valRef."'";
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel deletar: ".$valRef);
				return false;
			}
			return true;
		}
		
		public function pesquisar($valRef){
			$sql = "SELECT * FROM averbacoes WHERE ave_numero_externo='".$valRef."'";
			$resultado = $this->conexao->selecionar($sql);
			if(!$resultado){
				echo("Não foi possivel selecionar: ".$valRef);
			}
			return $resultado;
		}
		
		public function getAverbacao($valRef){
			$linha = mysqli_fetch_array($this->pesquisar($valRef));
			$this->averbacao->setNumeroExterno($linha["ave_numero_externo"]);
			$this->averbacao->setEncerrador($linha["adm_codigo_encerrador"]);
			$this->averbacao->setEmpCodigo($linha["emp_codigo"]);
			$this->averbacao->setPesCodigo($linha["pes_codigo"]);
			$this->averbacao->setSerMatricula($linha["ser_matricula"]);
			$this->averbacao->setBanCodigo($linha["ban_codigo"]);
			$this->averbacao->setProCodigo($linha["pro_codigo"]);
			$this->averbacao->setParPeriodo($linha["par_periodo"]);
			$this->averbacao->setStaCodigo($linha["sta_codigo"]);
			$this->averbacao->setDataCriacao($linha["ave_data_criacao"]);
			$this->averbacao->setDataEncerramento($linha["ave_data_encerramento"]);
			$this->averbacao->setNumeroParcelas($linha["ave_numero_parcelas"]);
			$this->averbacao->setMontante($linha["ave_montante"]);
			$this->averbacao->setTaxaJuros($linha["ave_taxa_juros"]);
			return $this->averbacao;
		}
	}
?>