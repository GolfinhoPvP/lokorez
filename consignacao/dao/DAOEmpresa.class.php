<?php
	class DAOEmpresa{
		private $empresa;
		private $conexao;
		
		function __construct($desc, $toRoot){
			include_once($toRoot."beans/Empresa.class.php");
			include_once($toRoot."utils/ConectarMySQL.class.php");
			$this->empresa = new Empresa(NULL, $desc);
			$this->conexao = new ConectarMySQL();
		}
		
		public function cadastrar(){
			$sql = "INSERT INTO empresas (emp_descricao) VALUES ('".$this->empresa->getDescricao()."')";
			if(!$this->conexao->executar($sql)){
				die("N�o foi possivel salvar: ".$this->empresa->getDescricao());
			}
		}
		
		public function alterar($valRef){
			$sql = "UPDATE empresas SET emp_descricao = '".$this->empresa->getDescricao()."' WHERE emp_codigo=".$valRef;
			if(!$this->conexao->executar($sql)){
				die("N�o foi possivel alterar: ".$this->empresa->getDescricao());
			}
		}
		
		public function deletar($valRef){
			$sql = "DELETE FROM empresas WHERE emp_codigo=".$valRef;
			if(!$this->conexao->executar($sql)){
				die("N�o foi possivel deletar: ".$this->empresa->getDescricao());
			}
		}
		
		public function pesquisar($valRef){
			$sql = "SELECT * FROM empresas WHERE emp_codigo=".$valRef;
			$resultado = $this->conexao->selecionar($sql);
			if(!$resultado){
				die("N�o foi possivel selecionar: ".$this->empresa->getDescricao());
			}
			return $resultado;
		}
	}
?>