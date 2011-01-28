<?php
	class DAOEmpresa{
		private $empresa;
		private $conexao;
		
		function __construct($empresa, $conexao){
			$this->empresa 	= $empresa;
			$this->conexao 		= $conexao;
		}
 
		public function getEmpresa($valRef){
			$resultado = $this->pesquisar($valRef);
			if($resultado == false)
				return $this->empresa = NULL;
			$linha = mysqli_fetch_array($resultado);
			$this->empresa->codigo	= $linha["emp_codigo"];
			$this->empresa->nome	= $linha["emp_nome"];
			return $this->empresa;
		}
		
		public function getAtual(){
			$sql = "SELECT * FROM empresas WHERE emp_nome = '".$this->empresa->nome."'";
			$resultado = $this->conexao->selecionar($sql);
			if($resultado == false)
				return $this->empresa = NULL;
			$linha = mysqli_fetch_array($resultado);
			$this->empresa->codigo	= $linha["emp_codigo"];
			$this->empresa->nome	= $linha["emp_nome"];
			return $this->empresa;
		}
		
		public function setEmpresa($empresa){
			$this->empresa = $empresa;
		}
		
		public function cadastrar(){
			$sql = "INSERT INTO empresas (emp_nome) VALUES ('".$this->empresa->nome."')";
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel salvar o empresa: ".$this->empresa->cliCodigo);
				return false;
			}
			return true;
		}
		
		public function alterar($valRef){
			$sql = "UPDATE empresas SET emp_nome='".$this->empresa->nome."' WHERE emp_codigo=".$valRef;
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel alterar o empresa código: ".$valRef);
				return false;
			}
			return true;
		}
		
		public function deletar($valRef){
			$sql = "DELETE FROM empresas WHERE emp_codigo=".valRef;
			echo($sql);
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel deletar o empresa código: ".$valRef);
				return false;
			}
			return true;
		}
		
		public function pesquisar($valRef){
			$sql = "SELECT * FROM empresas WHERE emp_codigo = ".valRefE;
			$resultado = $this->conexao->selecionar($sql);
			if(!$resultado){
				echo("Não foi possivel selecionar o empresa referência: ".$valRef);
			}
			return $resultado;
		}
	}
?>