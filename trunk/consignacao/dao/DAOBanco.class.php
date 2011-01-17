<?php
	class DAOBanco{
		private $banco;
		private $conexao;
		
		function __construct($cod, $desc, $toRoot, $conex){
			include_once($toRoot."beans/Banco.class.php");
			include_once($toRoot."utils/ConectarMySQL.class.php");
			$this->banco = new Banco($cod, $desc);
			//$this->conexao = new ConectarMySQL();
			$this->conexao = $conex;
		}
		
		public function cadastrar(){
			$sql = "INSERT INTO bancos (ban_codigo, ban_descricao) VALUES ('".$this->banco->getCodigo()."', '".$this->banco->getDescricao()."')";
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel salvar: ".$this->banco->getDescricao());
				return false;
			}
			return true;
		}
		
		public function alterar($valRef){
			$sql = "UPDATE bancos SET ban_codigo='".$this->banco->getCodigo()."', ban_descricao='".$this->banco->getDescricao()."' WHERE ban_codigo='".$valRef."'";
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel alterar: ".$this->banco->getDescricao());
				return false;
			}
			return true;
		}
		
		public function deletar($valRef){
			$sql = "DELETE FROM bancos WHERE ban_codigo='".$valRef."'";
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel deletar: ".$this->banco->getDescricao());
				return false;
			}
			return true;
		}
		
		public function pesquisar($valRef){
			$sql = "SELECT * FROM bancos WHERE ban_codigo='".$valRef."'";
			$resultado = $this->conexao->selecionar($sql);
			if(!$resultado){
				echo("Não foi possivel selecionar: ".$this->banco->getDescricao());
			}
			return $resultado;
		}
		
		public function getBanco($valRef){
			$linha = mysqli_fetch_array($this->pesquisar($valRef));
			$this->banco->setCodigo($linha["ban_codigo"]);
			$this->banco->setDescricao($linha["ban_descricao"]);
			return $this->banco;
		}
	}
?>