<?php
	class DAOLog{
		private $aLog;
		private $conexao;
		
		function __construct($pCod, $oCod, $nCod, $admCod, $alvCod, $desc, $toRoot, $conex){
			include_once($toRoot."beans/Log.class.php");
			include_once($toRoot."utils/ConectarMySQL.class.php");
			$dT 	= date("Y-m-d H:i:s");

			$nM 	= @gethostbyaddr($REMOTE_ADDR);
			$ipR 	= @gethostbyname($REMOTE_ADDR);
			
			if(strlen($nM) < 1)
				$nM = @gethostbyaddr($_SERVER['REMOTE_ADDR']);;
			if(strlen($ipR) < 1)
				$ipR = @gethostbyname($_SERVER['REMOTE_ADDR']);
				
			$this->aLog = new Log(NULL, $pCod, $oCod, $nCod, $admCod, $alvCod, $dT, $nM, $ipR, $desc);
			$this->conexao = $conex;
		}
		
		public function cadastrar(){
			$sql = "INSERT INTO logs (pes_codigo, ope_codigo, niv_codigo, adm_codigo, alv_codigo, log_data_tempo, log_nome_maquina, log_ip_rede, log_descricao) VALUES (".$this->aLog->getPesCodigo().", ".$this->aLog->getOpeCodigo().", ".$this->aLog->getNivCodigo().", ".$this->aLog->getAdmCodigo().", ".$this->aLog->getAlvCodigo().", '".$this->aLog->getDataTempo()."', '".$this->aLog->getNomeMaquina()."', '".$this->aLog->getIpRede()."', '".$this->aLog->getDescricao()."')";
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel salvar: ".$this->aLog->getDescricao());
				return false;
			}
			return true;
		}
		
		public function alterar($valRef){
			/*$sql = "UPDATE logs SET pes_codigo=".$this->aLog->getPesCodigo().", ope_codigo=".$this->aLog->getOpeCodigo().", niv_codido=".$this->aLog->getNivCodigo().", adm_codigo=".$this->aLog->getAdmCodigo().", alv_codigo=".$this->aLog->getAlvCodigo().", log_data_tempo='".$this->aLog->getDataTempo()."' , log_nome_maquina='".$this->aLog->getNomeMaquina()."' , log_ip_rede='".$this->aLog->getIpRede()."' , log_descricao='".$this->aLog->getDescricao()."' WHERE log_codigo=".$valRef;
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel alterar: ".$this->aLog->getDescricao());
				return false;
			}
			return true;*/
		}
		
		public function deletar($valRef){
			/*$sql = "DELETE FROM logs WHERE log_codigo=".$valRef;
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel deletar: ".$this->aLog->getDescricao());
				return false;
			}
			return true;*/
		}
		
		public function pesquisar($valRef){
			$sql = "SELECT * FROM logs WHERE log_codigo=".$valRef;
			$resultado = $this->conexao->selecionar($sql);
			if(!$resultado){
				echo("Não foi possivel selecionar: ".$this->aLog->getDescricao());
			}
			return $resultado;
		}
	}
?>