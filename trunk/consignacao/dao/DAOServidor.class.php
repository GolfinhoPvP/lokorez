<?php
	class DAOServidor{
		private $servidor;
		private $conexao;
		
		function __construct($eCod, $pCod, $mat, $adm, $car, $vin, $cons, $uti, $disp, $toRoot, $conex){
			include_once($toRoot."beans/Servidor.class.php");
			include_once($toRoot."utils/ConectarMySQL.class.php");
			$this->servidor = new Servidor($eCod, $pCod, $mat, $adm, $car, $vin, $cons, $uti, $disp);
			$this->conexao = $conex;
		}
		
		public function cadastrar(){
			$sql = "INSERT INTO servidores (emp_codigo, pes_codigo, ser_matricula, ser_admissao, ser_cargo, ser_vinculo, ser_consignavel, ser_utilizada, ser_disponivel) VALUES (".$this->servidor->getEmpCodigo().", ".$this->servidor->getPesCodigo().", '".$this->servidor->getMatricula()."', '".$this->servidor->getAdmissao()."', '".$this->servidor->getCargo()."', '".$this->servidor->getVinculo()."', ".$this->servidor->getConsignavel()." , ".$this->servidor->getUtilizada()." , ".$this->servidor->getDisponivel().")";
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel salvar: ".$this->servidor->getMatricula());
				return false;
			}
			return true;
		}
		
		public function alterar($valRef){
			$sql = "UPDATE servidores SET emp_codigo=".$this->servidor->getEmpCodigo().", pes_codigo=".$this->servidor->getPesCodigo().", ser_matricula='".$this->servidor->getMatricula()."', ser_admissao='".$this->servidor->getAdmissao()."', ser_cargo='".$this->servidor->getCargo()."', ser_vinculo='".$this->servidor->getVinculo()."', ser_consignavel=".$this->servidor->getConsignavel().", ser_utilizada=".$this->servidor->getUtilizada().", ser_disponivel=".$this->servidor->getDisponivel()." WHERE ser_matricula='".$valRef."' OR pes_codigo='".$valRef."'";
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel alterar: ".$this->servidor->getNome());
				return false;
			}
			return true;
		}
		
		public function deletar($valRef){
			$sql = "DELETE FROM servidores WHERE ser_matricula='".$valRef."'";
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel deletar: ".$valRef);
				return false;
			}
			return true;
		}
		
		public function pesquisar($valRef){
			$sql = "SELECT * FROM servidores WHERE ser_matricula='".$valRef."'";
			$resultado = $this->conexao->selecionar($sql);
			if(!$resultado){
				echo("Não foi possivel selecionar: ".$valRef);
			}
			return $resultado;
		}
		
		public function zerar(){
			$sql = "UPDATE servidores SET ser_consignavel=0, ser_utilizada=0, ser_disponivel=0";
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel zerar: ".$this->servidor->getNome());
				return false;
			}
			return true;
		}
		
		public function atualizarVerba($valRef, $valor){
			$this->servidor = $this->getServidor($valRef);
			$valor = $this->servidor->getUtilizada() + $valor; 
			$this->servidor->setUtilizada($valor);
			$disponivel = $this->servidor->getConsignavel() - $this->servidor->getUtilizada();
			$this->servidor->setDisponivel($disponivel);
			
			return $this->alterar($valRef);
		}
		
		public function getServidor($valRef){
			$linha = mysqli_fetch_array($this->pesquisar($valRef));
			$this->servidor->setEmpCodigo($linha["emp_codigo"]);
			$this->servidor->setPesCodigo($linha["pes_codigo"]);
			$this->servidor->setMatricula($linha["ser_matricula"]);
			$this->servidor->setAdmissao($linha["ser_admissao"]);
			$this->servidor->setCargo($linha["ser_cargo"]);
			$this->servidor->setvinculo($linha["ser_vinculo"]);
			$this->servidor->setConsignavel($linha["ser_consignavel"]);
			$this->servidor->setUtilizada($linha["ser_utilizada"]);
			$this->servidor->setDisponivel($linha["ser_disponivel"]);
			return $this->servidor;
		}
	}
?>