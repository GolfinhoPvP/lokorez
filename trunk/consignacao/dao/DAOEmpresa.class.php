<?php
	class DAOEmpresa{
		private $empresa;
		private $conexao;
		
		function __construct($desc, $toRoot, $conex){
			include_once($toRoot."beans/Empresa.class.php");
			include_once($toRoot."utils/ConectarMySQL.class.php");
			$this->empresa = new Empresa(NULL, $desc);
			//$this->conexao = new ConectarMySQL();
			$this->conexao = $conex;
		}
		
		public function cadastrar(){
			$sql = "INSERT INTO empresas (emp_descricao) VALUES ('".$this->empresa->getDescricao()."')";
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel salvar: ".$this->empresa->getDescricao());
				return false;
			}
			return true;
		}
		
		public function alterar($valRef){
			$sql = "UPDATE empresas SET emp_descricao = '".$this->empresa->getDescricao()."' WHERE emp_codigo=".$valRef;
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel alterar: ".$this->empresa->getDescricao());
				return false;
			}
			return true;
		}
		
		public function deletar($valRef){
			$sql = "DELETE FROM empresas WHERE emp_codigo=".$valRef;
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel deletar: ".$this->empresa->getDescricao());
				return false;
			}
			return true;
		}
		
		public function pesquisar($valRef){
			$sql = "SELECT * FROM empresas WHERE emp_codigo=".$valRef;
			$resultado = $this->conexao->selecionar($sql);
			if(!$resultado){
				echo("Não foi possivel selecionar: ".$this->empresa->getDescricao());
			}
			return $resultado;
		}
		
		public function getEmpresa($valRef){
			$linha = mysqli_fetch_array($this->pesquisar($valRef));
			$this->empresa->setCodigo($linha["emp_codigo"]);
			$this->empresa->setDescricao($linha["emp_descricao"]);
			return $this->empresa;
		}
	}
?>