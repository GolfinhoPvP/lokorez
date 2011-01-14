<?php
	class DAOLog{
		private $aLog;
		private $conexao;
		
		function __construct($oCod, $nCod, $aCod, $desc, $toRoot){
			include_once($toRoot."beans/Log.class.php");
			include_once($toRoot."utils/ConectarMySQL.class.php");
			$dT 	= date("Y-m-d H:i:s");
			$nM 	= gethostbyaddr($REMOTE_ADDR) != NULL ? gethostbyaddr($REMOTE_ADDR) : "Não Informado";
			$ipR 	= gethostbyname($REMOTE_ADDR) != NULL ? gethostbyname($REMOTE_ADDR) : "Não Informado";
			$this->aLog = new Log(NULL, $oCod, $nCod, $aCod, $dT, $nM, $ipR, $desc);
			$this->conexao = new ConectarMySQL();
		}
		
		public function cadastrar(){
			$sql = "INSERT INTO log (ope_codigo, niv_codigo, adm_codigo, log_data_tempo, log_nome_maquina, log_ip_rede, log_descricao) VALUES (".$this->aLog->getOpeCodigo().", ".$this->aLog->getNivCodigo().", ".$this->aLog->getAdmCodigo().", '".$this->aLog->getDataTempo()."', '".$this->aLog->getNomeMaquina()."', '".$this->aLog->getIpRede()."', '".$this->aLog->getDescricao()."')";
			echo($sql);
			if(!$this->conexao->executar($sql)){
				die("Não foi possivel salvar: ".$this->aLog->getDescricao());
			}
		}
		
		public function alterar($valRef){
			/*$sql = "UPDATE log SET ope_codigo=".$this->aLog->getOpeCodigo().", niv_codido=".$this->aLog->getNivCodigo().", adm_codigo=".$this->aLog->getAdmCodigo().", log_data_tempo='".$this->aLog->getDataTempo()."' , log_nome_maquina='".$this->aLog->getNomeMaquina()."' , log_ip_rede='".$this->aLog->getIpRede()."' , log_descricao='".$this->aLog->getDescricao()."' WHERE log_codigo=".$valRef;
			if(!$this->conexao->executar($sql)){
				die("Não foi possivel alterar: ".$this->aLog->getDescricao());
			}*/
		}
		
		public function deletar($valRef){
			/*$sql = "DELETE FROM log WHERE log_codigo=".$valRef;
			if(!$this->conexao->executar($sql)){
				die("Não foi possivel deletar: ".$this->aLog->getDescricao());
			}*/
		}
		
		public function pesquisar($valRef){
			$sql = "SELECT * FROM log WHERE log_codigo=".$valRef;
			$resultado = $this->conexao->selecionar($sql);
			if(!$resultado){
				die("Não foi possivel selecionar: ".$this->aLog->getDescricao());
			}
			return $resultado;
		}
	}
?>