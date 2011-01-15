<?php
	class DAOTelefone{
		private $telefone;
		private $conexao;
		
		function __construct($pCod, $num, $toRoot){
			include_once($toRoot."beans/Telefone.class.php");
			include_once($toRoot."utils/ConectarMySQL.class.php");
			$this->telefone = new Telefone(NULL, $pCod, $num);
			$this->conexao = new ConectarMySQL();
		}
		
		public function cadastrar(){
			$sql = "INSERT INTO telefones (pes_codigo, tel_numero) VALUES (".$this->telefone->getPesCodigo().", '".$this->telefone->getNumero()."')";
			if(!$this->conexao->executar($sql)){
				die("N�o foi possivel salvar: ".$this->telefone->getNumero());
			}
		}
		
		public function alterar($valRef){
			$sql = "UPDATE telefones SET pes_codigo='".$this->telefone->getPesCodigo()."', tel_numero='".$this->telefone->getNumero()."' WHERE tel_codigo=".$valRef;
			if(!$this->conexao->executar($sql)){
				die("N�o foi possivel alterar: ".$this->telefone->getNumero());
			}
		}
		
		public function deletar($valRef){
			$sql = "DELETE FROM telefones WHERE tel_codigo='".$valRef."'";
			if(!$this->conexao->executar($sql)){
				die("N�o foi possivel deletar: ".$this->telefone->getNumero());
			}
		}
		
		public function pesquisar($valRef){
			$sql = "SELECT * FROM telefones WHERE tel_codigo='".$valRef."'";
			$resultado = $this->conexao->selecionar($sql);
			if(!$resultado){
				die("N�o foi possivel selecionar: ".$this->telefone->getNumero());
			}
			return $resultado;
		}
	}
?>