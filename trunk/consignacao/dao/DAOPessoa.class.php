<?php
	class DAOPessoa{
		private $pessoa;
		private $conexao;
		
		function __construct($nome, $cpf, $cla, $toRoot, $conex){
			include_once($toRoot."beans/Pessoa.class.php");
			include_once($toRoot."utils/ConectarMySQL.class.php");
			$this->pessoa = new Pessoa(NULL, $nome, $cpf, $cla);
			//$this->conexao = new ConectarMySQL();
			$this->conexao = $conex;
		}
		
		public function cadastrar(){
			if($this->pessoa->getCPF() != NULL)
				$sql = "INSERT INTO pessoas (pes_nome, pes_cpf, pes_classe) VALUES ('".$this->pessoa->getNome()."', '".$this->pessoa->getCPF()."', '".$this->pessoa->getClasse()."')";
				else
					$sql = "INSERT INTO pessoas (pes_nome, pes_classe) VALUES ('".$this->pessoa->getNome()."', '".$this->pessoa->getClasse()."')";
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel salvar: ".$this->pessoa->getNome());
				return false;
			}
			return true;
		}
		
		public function alterar($valRef){
			$sql = "UPDATE pessoas SET pes_nome='".$this->pessoa->getNome()."', pes_cpf='".$this->pessoa->getCPF()."', pes_classe='".$this->pessoa->getClasse()."' WHERE pes_codigo=".$valRef;
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel alterar: ".$this->pessoa->getNome());
				return false;
			}
			return true;
		}
		
		public function deletar($valRef){
			$sql = "DELETE FROM pessoas WHERE pes_codigo=".$valRef;
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel deletar: ".$valRef);
				return false;
			}
			return true;
		}
		
		public function pesquisar($valRef){
			$lista = explode(":", $valRef);
			switch(sizeof($lista)){
				case 1 : $sql = "SELECT * FROM pessoas WHERE pes_codigo=".$valRef; break;
				case 2 : $sql = "SELECT * FROM pessoas WHERE pes_nome='".$lista[0]."' AND (pes_cpf LIKE '".$lista[1]."'  OR pes_cpf IS NULL)"; break;
				case 3 : $sql = "SELECT * FROM pessoas WHERE pes_nome='".$lista[0]."' AND (pes_cpf LIKE '".$lista[1]."'  OR pes_cpf IS NULL) AND pes_classe LIKE '".$lista[2]."'"; break;
				default : $sql = "SELECT * FROM pessoas WHERE pes_codigo=".$valRef; break;
			}
			$resultado = $this->conexao->selecionar($sql);
			if(!$resultado){
				echo("Não foi possivel selecionar: ".$valRef);
			}
			return $resultado;
		}
		
		public function getPessoa($valRef){
			$linha = mysqli_fetch_array($this->pesquisar($valRef));
			$this->pessoa->setCodigo($linha["pes_codigo"]);
			$this->pessoa->setNome($linha["pes_nome"]);
			$this->pessoa->setCPF($linha["pes_cpf"]);
			$this->pessoa->setClasse($linha["pes_classe"]);
			return $this->pessoa;
		}
	}
?>