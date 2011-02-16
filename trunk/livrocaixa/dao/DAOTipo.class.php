<?php
	class DAOTipo{
		private $tipo;
		private $conexao;
		
		function __construct($servico, $conexao){
			$this->tipo 	= $servico;
			$this->conexao 	= $conexao;
		}
		
		public function getTipoLista(){
			$sql = "SELECT * FROM tipos";
			$resultado = $this->conexao->selecionar($sql);
			if($resultado == false ||  $this->conexao->numeroLinhas($resultado) == 0)
				return NULL;
			$contador = 0;
			while($linha = mysqli_fetch_array($resultado)){
				$tipo 					= new Tipo($linha["tip_codigo"], $linha["tip_descricao"]);
				$tipoArray[$contador] 	= $tipo;
				$contador++;
			}
			return $tipoArray;
		}
	}
?>