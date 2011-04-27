<?php
	class DAOEmail{
		private $email;
		private $conexao;
		
		function __construct($email, $conexao){
			$this->email 	= $email;
			$this->conexao 	= $conexao;
		}
 
		public function getEmail($valRef){
			$resultado = $this->pesquisar($valRef);
			if($resultado == false)
				return $this->email = NULL;
			$linha = mysqli_fetch_array($resultado);
			$this->email->codigo		= $linha["ema_codigo"];
			$this->email->pesCodigo		= $linha["pes_codigo"];
			$this->email->email			= $linha["ema_email"];
			$this->email->nota			= $linha["ema_nota"];
			return $this->email;
		}
		
		public function setEmail($email){
			$this->email = $email;
		}
		
		public function cadastrar(){
			$sql = "INSERT INTO emails (pes_codigo, ema_email, ema_nota) VALUES (".$this->email->pesCodigo.", '".$this->email->email."', '".$this->email->nota."')";
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel salvar o email: ".$this->email->email);
				return false;
			}
			return true;
		}
		
		public function alterar($valRef){
			$sql = "UPDATE emails SET pes_codigo=".$this->email->pesCodigo.", ema_email='".$this->email->email."', ema_nota='".$this->email->nota."' WHERE ema_codigo=".$valRef;
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel alterar o email código: ".$valRef);
				return false;
			}
			return true;
		}
		
		public function deletar($valRef){
			$sql = "DELETE FROM emails WHERE ema_codigo=".$valRef;
			echo($sql);
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel deletar o email código: ".$valRef);
				return false;
			}
			return true;
		}
		
		public function pesquisar($valRef){
			$sql = "SELECT * FROM emails WHERE ema_codigo LIKE '".$valRef."' OR ema_email='".$valRef."'";
			$resultado = $this->conexao->selecionar($sql);
			if(!$resultado){
				echo("Não foi possivel selecionar o email referência: ".$valRef);
			}
			return $resultado;
		}
	}
?>