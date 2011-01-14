<?php
	class DAOBanco{
		private $banco;
		private $conexao;
		
		function __construct($cod, $desc, $cont, $fone, $toRoot){
			include_once($toRoot."beans/Banco.class.php");
			include_once($toRoot."utils/ConectarMySQL.class.php");
			$this->banco = new Banco($cod, $desc, $cont, $fone);
			$this->conexao = new ConectarMySQL();
		}
		
		public function cadastrar(){
			$sql = "INSERT INTO bancos (ban_codigo, ban_descricao, ban_contato, ban_fone) VALUES ('".$this->banco->getCodigo()."', '".$this->banco->getDescricao()."', '".$this->banco->getContato()."', '".$this->banco->getFone()."')";
			if(!$this->conexao->salvar($sql)){
				die("Não foi possivel salvar: ".$this->banco->getDescricao());
			}
		}
		
		public function alterar($valRef){
			$sql = "UPDATE bancos SET ban_codigo='".$this->banco->getCodigo()."', ban_descricao='".$this->banco->getDescricao()."', ban_contato='".$this->banco->getContato()."', ban_fone='".$this->banco->getFone()."' WHERE ban_codigo=".$valRef;
			if(!$this->conexao->salvar($sql)){
				die("Não foi possivel alterar: ".$this->banco->getDescricao());
			}
		}
		
		public function deletar($valRef){
			$sql = "DELETE FROM bancos WHERE ban_codigo=".$valRef;
			if(!$this->conexao->salvar($sql)){
				die("Não foi possivel deletar: ".$this->banco->getDescricao());
			}
		}
		
		public function pesquisar($valRef){
			$sql = "SELECT * FROM bancos WHERE ban_codigo='".$valRef."'";
			$resultado = $this->conexao->selecionar($sql);
			if(!$resultado){
				die("Não foi possivel selecionar: ".$this->empresa->getDescricao());
			}
			return $resultado;
		}
	}
?>