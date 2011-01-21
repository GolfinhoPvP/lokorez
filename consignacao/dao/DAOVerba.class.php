<?php
	class DAOVerba{
		private $verba;
		private $conexao;
		
		function __construct($ver, $eC, $bC, $pC, $desc, $toRoot, $conex){
			include_once($toRoot."beans/Verba.class.php");
			include_once($toRoot."utils/ConectarMySQL.class.php");
			$this->verba = new Verba($ver, $eC, $bC, $pC, $desc);
			$this->conexao = $conex;
		}
		
		public function cadastrar(){
			$sql = "INSERT INTO verbas (ver_verba, emp_codigo, ban_codigo, pro_codigo, ver_descricao) VALUES ('".$this->verba->getVerba()."', ".$this->verba->getEmpCodigo().", '".$this->verba->getBanCodigo()."', ".$this->verba->getProCodigo().", '".$this->verba->getDescricao()."')";
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel salvar: ".$this->verba->getDescricao());
				return false;
			}
			return true;
		}
		
		public function alterar($valRef){
			$sql = "UPDATE verbas SET ver_verba = '".$this->verba->getDescricao()."', emp_codigo = ".$this->verba->getDescricao().", ban_codigo = '".$this->verba->getDescricao()."', pro_codigo = ".$this->verba->getDescricao().", ver_descricao = '".$this->verba->getDescricao()."' WHERE ver_verba=".$valRef;
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel alterar: ".$this->verba->getDescricao());
				return false;
			}
			return true;
		}
		
		public function deletar($valRef){
			$sql = "DELETE FROM verbas WHERE ver_verba=".$valRef;
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel deletar: ".$valRef);
				return false;
			}
			return true;
		}
		
		public function pesquisar($valRef){
			$sql = "SELECT * FROM verbas WHERE ver_verba=".$valRef;
			$resultado = $this->conexao->selecionar($sql);
			if(!$resultado){
				echo("Não foi possivel selecionar: ".$valRef);
			}
			return $resultado;
		}
		
		public function getVerba($valRef){
			$linha = mysqli_fetch_array($this->pesquisar($valRef));
			$this->verba->setVerba($linha["ver_verba"]);
			$this->verba->setEmpCodigo($linha["emp_codigo"]);
			$this->verba->setBanCodigo($linha["ban_codigo"]);
			$this->verba->setProCodigo($linha["pro_codigo"]);
			$this->verba->setDescricao($linha["ver_descricao"]);
			return $this->verba;
		}
	}
?>