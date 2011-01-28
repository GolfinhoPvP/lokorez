<?php
	class DAOTelefone{
		private $telefone;
		private $conexao;
		
		function __construct($telefone, $conexao){
			$this->telefone = $telefone;
			$this->conexao 	= $conexao;
		}
 
		public function getTelefone($valRef){
			$resultado = $this->pesquisar($valRef);
			if($resultado == false)
				return $this->telefone = NULL;
			$linha = mysqli_fetch_array($resultado);
			$this->telefone->codigo		= $linha["tel_codigo"];
			$this->telefone->pesCodigo	= $linha["pes_codigo"];
			$this->telefone->numero		= $linha["tel_numero"];
			$this->telefone->nota		= $linha["tel_nota"];
			return $this->telefone;
		}
		
		public function setTelefone($telefone){
			$this->telefone = $telefone;
		}
		
		public function cadastrar(){
			$sql = "INSERT INTO telefones (pes_codigo, tel_numero, tel_nota) VALUES (".$this->telefone->pesCodigo.", '".$this->telefone->numero."', '".$this->telefone->nota."')";
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel salvar o telefone: ".$this->telefone->telefone);
				return false;
			}
			return true;
		}
		
		public function alterar($valRef){
			$sql = "UPDATE telefones SET pes_codigo=".$this->telefone->pesCodigo.", tel_numero='".$this->telefone->numero."', tel_nota='".$this->telefone->nota."' WHERE tel_codigo=".$valRef;
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel alterar o telefone código: ".$valRef);
				return false;
			}
			return true;
		}
		
		public function deletar($valRef){
			$sql = "DELETE FROM telefones WHERE tel_codigo=".$valRef;
			echo($sql);
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel deletar o telefone código: ".$valRef);
				return false;
			}
			return true;
		}
		
		public function pesquisar($valRef){
			$sql = "SELECT * FROM telefones WHERE tel_codigo = ".$valRef;
			$resultado = $this->conexao->selecionar($sql);
			if(!$resultado){
				echo("Não foi possivel selecionar o telefone referência: ".$valRef);
			}
			return $resultado;
		}
	}
?>