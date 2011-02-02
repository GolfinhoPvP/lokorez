<?php
	class DAOLivroCaixa{
		private $livroCaixa;
		private $conexao;
		
		function __construct($livroCaixa, $conexao){
			$this->livroCaixa 	= $livroCaixa;
			$this->conexao 		= $conexao;
		}
 
		public function getLivroCaixa(){
			$resultado = $this->pesquisar();
			if($resultado == false)
				return $this->livroCaixa = NULL;
			$linha = mysqli_fetch_array($resultado);
			$this->livroCaixa->lanCodigo		= $linha["lan_codigo"];
			$this->livroCaixa->tecDescricao		= $linha["tec_descricao"];
			$this->livroCaixa->proDescricao		= $linha["pro_descricao"];
			$this->livroCaixa->pcDescricao		= $linha["pc_descricao"];
			$this->livroCaixa->serDescricao		= $linha["ser_descricao"];
			$this->livroCaixa->forDescricao		= $linha["for_descricao"];
			$this->livroCaixa->lanQuantidade 	= $linha["lan_quantidade_item"];
			$this->livroCaixa->lanDatahora		= $linha["lan_datahora"];
			$this->livroCaixa->lanValor			= $linha["lan_valor"];
			return $this->livroCaixa;
		}
		
		public function getLivroCaixaLista(){
			$resultado = $this->pesquisar();
			if($resultado == false ||  $this->conexao->numeroLinhas($resultado) == 0)
				return NULL;
			$contador = 0;
			while($linha = mysqli_fetch_array($resultado)){
				$bean 				= new LivroCaixa($linha["lan_codigo"], $linha["tec_descricao"], $linha["pro_descricao"], $linha["pc_descricao"], $linha["ser_descricao"], $linha["for_descricao"], $linha["lan_quantidade_item"], $linha["lan_datahora"], $linha["lan_valor"]);
				$array[$contador] 	= $bean;
				$contador++;
			}
			return $array;
		}
		
		public function setLivroCaixa($livroCaixa){
			$this->livroCaixa = $livroCaixa;
		}
		
		public function pesquisar(){
			$sql = "SELECT lan.lan_codigo, tec.tec_descricao, pro.pro_descricao, pc.pc_descricao, ser.ser_descricao, fp.for_descricao, lan.lan_datahora, lan.lan_quantidade_item, lan.lan_valor FROM lancamentos lan INNER JOIN tecnicos tec ON lan.tec_codigo=tec.tec_codigo INNER JOIN produtos pro ON lan.pro_codigo=pro.pro_codigo INNER JOIN plano_conta pc	ON lan.pc_codigo=pc.pc_codigo INNER JOIN servicos ser ON lan.ser_codigo=ser.ser_codigo INNER JOIN forma_pagamento fp	ON lan.for_codigo= fp.for_codigo WHERE pro.emp_codigo=".$_SESSION["empresa"]." ORDER BY lan.lan_codigo DESC";
			$resultado = $this->conexao->selecionar($sql);
			if(!$resultado){
				echo("Não foi possivel selecionar entradas do livroCaixa referência empresa: ".$_SESSION["empresa"]);
			}
			return $resultado;
		}
	}
?>