<?php
	class DAOLog{
		private $aLog;
		private $conexao;
		
		function __construct($log, $conexao){
			$this->aLog 	= $log;
			$this->conexao 	= $conexao;
		}
		
		public function setLog($log){
			$this->aLog = $log;
		}
		
		public function cadastrar(){
			$sql = "INSERT INTO logs (cli_codigo, ope_codigo, alv_codigo, log_data_hora, log_nome_maquina, log_ip_rede, log_descricao) VALUES (".$this->aLog->cliCodigo.", ".$this->aLog->opeCodigo.", ".$this->aLog->alvCodigo.", '".$this->aLog->datahora."', '".$this->aLog->nomeMaquina."', '".$this->aLog->ipRede."', '".$this->aLog->descricao."')";
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel salvar o log referente: ".$this->aLog->descricao);
				return false;
			}
			return true;
		}
	}
?>