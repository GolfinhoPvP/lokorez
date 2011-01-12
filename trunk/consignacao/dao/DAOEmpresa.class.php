<?php
	class DAOEmpresa{
		private $empresa;
		private $conexao;
		
		function __construct($desc, $toRoot){
			include_once($toRoot."beans/Empresa.class.php");
			include_once($toRoot."utils/ConectarMySQL.class.php");
			$this->empresa = new Empresa($desc);
			$this->conexao = new ConectarMySQL();
		}
		
		public function cadastrar(){
			$sql = "INSERT INTO empresas (emp_descricao) VALUES ('".$this->empresa->getDescricao()."')";
			if(!$this->conexao->salvar($sql)){
				die("Não foi possivel salvar: ".$this->empresa->getDescricao());
			}
		}
	}
?>