<?php
	class DAOBanco{
		private $banco;
		private $conexao;
		
		function __construct($cod, $desc, $toRoot){
			include_once($toRoot."beans/Banco.class.php");
			include_once($toRoot."utils/ConectarMySQL.class.php");
			$this->banco = new Banco($cod, $desc);
			$this->conexao = new ConectarMySQL();
		}
		
		public function cadastrar(){
			$sql = "INSERT INTO bancos (ban_codigo, ban_descricao) VALUES ('".$this->banco->getCodigo()."', '".$this->banco->getDescricao()."')";
			if(!$this->conexao->executar($sql)){
				die("Não foi possivel salvar: ".$this->banco->getDescricao());
			}
		}
		
		public function alterar($valRef){
			$sql = "UPDATE bancos SET ban_codigo='".$this->banco->getCodigo()."', ban_descricao='".$this->banco->getDescricao()."' WHERE ban_codigo='".$valRef."'";
			if(!$this->conexao->executar($sql)){
				die("Não foi possivel alterar: ".$this->banco->getDescricao());
			}
		}
		
		public function deletar($valRef){
			$sql = "DELETE FROM bancos WHERE ban_codigo='".$valRef."'";
			if(!$this->conexao->executar($sql)){
				die("Não foi possivel deletar: ".$this->banco->getDescricao());
			}
		}
		
		public function pesquisar($valRef){
			$sql = "SELECT * FROM bancos WHERE ban_codigo='".$valRef."'";
			$resultado = $this->conexao->selecionar($sql);
			if(!$resultado){
				die("Não foi possivel selecionar: ".$this->banco->getDescricao());
			}
			return $resultado;
		}
	}
?>