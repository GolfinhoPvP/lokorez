<?php
	class DAOPessoa{
		private $pessoa;
		private $conexao;
		
		function __construct($nome, $cpf, $toRoot){
			include_once($toRoot."beans/Pessoa.class.php");
			include_once($toRoot."utils/ConectarMySQL.class.php");
			$this->pessoa = new Pessoa($cod, $cpf);
			$this->conexao = new ConectarMySQL();
		}
		
		public function cadastrar(){
			$sql = "INSERT INTO pessoa (pes_nome, pes_cpf) VALUES ('".$this->pessoa->getNome()."', '".$this->pessoa->getCPF()."')";
			if(!$this->conexao->executar($sql)){
				die("Não foi possivel salvar: ".$this->pessoa->getNome));
			}
		}
		
		public function alterar($valRef){
			$sql = "UPDATE pessoa SET pes_nome='".$this->pessoa->getNome()."', pes_cpf='".$this->pessoa->getCPF()."' WHERE pes_codigo=".$valRef;
			if(!$this->conexao->executar($sql)){
				die("Não foi possivel alterar: ".$this->pessoa->getNome());
			}
		}
		
		public function deletar($valRef){
			$sql = "DELETE FROM pessoa WHERE pes_codigo='".$valRef."'";
			if(!$this->conexao->executar($sql)){
				die("Não foi possivel deletar: ".$this->pessoa->getNome());
			}
		}
		
		public function pesquisar($valRef){
			$sql = "SELECT * FROM pessoa WHERE pes_codigo='".$valRef."'";
			$resultado = $this->conexao->selecionar($sql);
			if(!$resultado){
				die("Não foi possivel selecionar: ".$this->pessoa->getNome());
			}
			return $resultado;
		}
	}
?>