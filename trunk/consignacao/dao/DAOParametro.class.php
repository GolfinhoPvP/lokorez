<?php
	class DAOParametro{
		private $parametro;
		private $conexao;
		
		function __construct($per, $sC, $datCor, $lin, $toRoot, $conex){
			include_once($toRoot."beans/Parametro.class.php");
			include_once($toRoot."utils/ConectarMySQL.class.php");
			$this->parametro = new Parametro($per, $sC, $datCor, $lin);
			$this->conexao = $conex;
		}
		
		public function cadastrar(){
			$sql = "INSERT INTO parametros (par_periodo, sta_codigo, par_data_corte, par_link) VALUES ('".$this->parametro->getPeriodo()."', ".$this->parametro->getStaCodigo().", '".$this->parametro->getDataCorte()."', '".$this->parametro->getLink()."')";
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel salvar: ".$this->parametro->getPeriodo());
				return false;
			}
			return true;
		}
		
		public function alterar($valRef){
			$sql = "UPDATE parametros SET par_periodo = '".$this->parametro->getPeriodo()."', sta_codigo=".$this->parametro->getStaCodigo().", par_data_corte = '".$this->parametro->getDataCorte()."', par_link = '".$this->parametro->getLink()."' WHERE par_periodo=".$valRef;
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel alterar: ".$this->parametro->getPeriodo());
				return false;
			}
			return true;
		}
		
		public function deletar($valRef){
			$sql = "DELETE FROM parametros WHERE par_periodo=".$valRef;
			if(!$this->conexao->executar($sql)){
				echo("Não foi possivel deletar: ".$valRef);
				return false;
			}
			return true;
		}
		
		public function pesquisar($valRef){
			$sql = "SELECT * FROM parametros WHERE par_periodo=".$valRef;
			$resultado = $this->conexao->selecionar($sql);
			if(!$resultado){
				echo("Não foi possivel selecionar: ".$valRef);
			}
			return $resultado;
		}
		
		public function getProduto($valRef){
			$linha = mysqli_fetch_array($this->pesquisar($valRef));
			$this->parametro->setPeriodo($linha["par_periodo"]);
			$this->parametro->setStaCodigo($linha["sta_codigo"]);
			$this->parametro->setDataCorte($linha["par_data_corte"]);
			$this->parametro->setLink($linha["par_link"]);
			return $this->parametro;
		}
	}
?>