<?php
	class DAOTelefone{
		private $telefone;
		private $conexao;
		
		function __construct($pCod, $num, $toRoot, $conex){
			include_once($toRoot."beans/Telefone.class.php");
			include_once($toRoot."utils/ConectarMySQL.class.php");
			$this->telefone = new Telefone(NULL, $pCod, $num);
			//$this->conexao = new ConectarMySQL();
			$this->conexao = $conex;
		}
		
		public function cadastrar(){
			$sql = "INSERT INTO telefones (pes_codigo, tel_numero) VALUES (".$this->telefone->getPesCodigo().", '".$this->telefone->getNumero()."')";
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel salvar: ".$this->telefone->getNumero());
				return false;
			}
			return true;
		}
		
		public function alterar($valRef){
			$sql = "UPDATE telefones SET pes_codigo='".$this->telefone->getPesCodigo()."', tel_numero='".$this->telefone->getNumero()."' WHERE tel_codigo=".$valRef;
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel alterar: ".$this->telefone->getNumero());
				return false;
			}
			return true;
		}
		
		public function deletar($valRef){
			$sql = "DELETE FROM telefones WHERE tel_codigo='".$valRef."'";
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel deletar: ".$this->telefone->getNumero());
				return false;
			}
			return true;
		}
		
		public function pesquisar($valRef){
			$sql = "SELECT * FROM telefones WHERE tel_codigo='".$valRef."'";
			$resultado = $this->conexao->selecionar($sql);
			if(!$resultado){
				echo("Não foi possivel selecionar: ".$this->telefone->getNumero());
			}
			return $resultado;
		}
	}
?>