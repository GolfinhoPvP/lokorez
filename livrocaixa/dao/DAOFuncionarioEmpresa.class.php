<?php
	class DAOFuncionarioEmpresa{
		private $funcionarioEmpresa;
		private $conexao;
		
		function __construct($funcionarioEmpresa, $conexao){
			$this->funcionarioEmpresa 	= $funcionarioEmpresa;
			$this->conexao 				= $conexao;
		}
 
		public function getFuncionarioEmpresa($valRefP,$valRefE){
			$sql = "SELECT * FROM funcionarios f INNER JOIN empresas e ON f.emp_codigo=e.emp_codigo WHERE f.cli_codigo=".$valRefP." AND f.emp_codigo=".$valRefE;
			$resultado = $this->conexao->selecionar($sql);
			if($resultado == false)
				return $this->funcionarioEmpresa = NULL;
			$linha = mysqli_fetch_array($resultado);
			$this->funcionarioEmpresa->cliCodigo	= $linha["cli_codigo"];
			$this->funcionarioEmpresa->empCodigo	= $linha["emp_codigo"];
			$this->funcionarioEmpresa->nome			= $linha["emp_nome"];
			return $this->funcionarioEmpresa;
		}
		
		public function getFuncionarioEmpresaLista($valRef){
			$sql = "SELECT * FROM funcionarios f INNER JOIN empresas e ON f.emp_codigo=e.emp_codigo WHERE f.cli_codigo LIKE '".$valRef."' OR f.emp_codigo LIKE '".$valRef."'";
			$resultado = $this->conexao->selecionar($sql);
			if($resultado == false ||  $this->conexao->numeroLinhas($resultado) == 0)
				return NULL;
			$contador = 0;
			while($linha = mysqli_fetch_array($resultado)){
				$funcionarioArray[$contador] = new FuncionarioEmpresa($linha["cli_codigo"], $linha["emp_codigo"], $linha["emp_nome"]);
				$contador++;
			}
			return $funcionarioArray;
		}
	}
?>