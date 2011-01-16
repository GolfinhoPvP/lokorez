<?php
	class DAOBancoPessoa{
		private $bancoPessoa;
		private $conexao;
		
		function __construct($bCod, $pCod, $toRoot, $conex){
			include_once($toRoot."beans/BancoPessoa.class.php");
			include_once($toRoot."utils/ConectarMySQL.class.php");
			$this->bancoPessoa = new BancoPessoa($bCod, $pCod);
			//$this->conexao = new ConectarMySQL();
			$this->conexao = $conex;
		}
		
		public function cadastrar(){
			$sql = "INSERT INTO bancos_pessoas (ban_codigo, pes_codigo) VALUES ('".$this->bancoPessoa->getBanCodigo()."', ".$this->bancoPessoa->getPesCodigo().")";
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel salvar: ".$this->bancoPessoa->getBanCodigo()." e ".$this->bancoPessoa->getPesCodigo());
				return false;
			}
			return true;
		}
		
		public function alterar($varRefBanco, $valRefPessoa){
			$sql = "UPDATE bancos_pessoas SET ban_codigo='".$this->bancoPessoa->getBanCodigo()."', pes_codigo=".$this->bancoPessoa->getPesCodigo()." WHERE ban_codigo='".$varRefBanco."' AND pes_codigo=".$valRefPessoa;
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel salvar: ".$this->bancoPessoa->getBanCodigo()." e ".$this->bancoPessoa->getPesCodigo());
				return false;
			}
			return true;
		}
		
		public function deletar($varRefBanco, $valRefPessoa){
			$sql = "DELETE FROM bancos_pessoas WHERE ban_codigo='".$varRefBanco."' AND pes_codigo=".$valRefPessoa;
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel salvar: ".$this->bancoPessoa->getBanCodigo()." e ".$this->bancoPessoa->getPesCodigo());
				return false;
			}
			return true;
		}
		
		public function pesquisar($varRefBanco, $valRefPessoa){
			$sql = "SELECT * FROM bancos_pessoas WHERE ban_codigo='".$varRefBanco."' AND pes_codigo=".$valRefPessoa;
			$resultado = $this->conexao->selecionar($sql);
			if(!$resultado){
				echo("Não foi possivel salvar: ".$this->bancoPessoa->getBanCodigo()." e ".$this->bancoPessoa->getPesCodigo());
			}
			return $resultado;
		}
	}
?>