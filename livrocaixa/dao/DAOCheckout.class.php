<?php
	class DAOCheckout{
		private $checkout;
		private $conexao;
		
		function __construct($checkout, $conexao){
			$this->checkout 	= $checkout;
			$this->conexao 		= $conexao;
		}
 
		public function getCheckout($valRef){
			$sql = "SELECT tecnicos.tec_descricao, classe.cla_descricao, sum(lancamentos.lan_valor) soma, pessoas.pes_nome, pessoas.pes_cpf, tecnicos.tec_codigo, classe.cla_porcentagem, sum(lancamentos.lan_valor)*(classe.cla_porcentagem/100) chout FROM livrocaixa.lancamentos INNER JOIN livrocaixa.tecnicos ON (lancamentos.tec_codigo = tecnicos.tec_codigo) INNER JOIN livrocaixa.classe ON (tecnicos.cla_codigo = classe.cla_codigo) INNER JOIN livrocaixa.pessoas ON (tecnicos.pes_codigo = pessoas.pes_codigo) WHERE tecnicos.tec_codigo=".$valRef." AND lancamentos.lan_checado=0 GROUP BY tecnicos.tec_descricao";
			
			$resultado = $this->conexao->selecionar($sql);
			if(!$resultado){
				echo("Não foi possivel selecionar o checkout referência: ".$valRef);
			}
			if($resultado == false)
				return $this->checkout = NULL;
			$linha = mysqli_fetch_array($resultado);
			$this->checkout->tecDescricao	= $linha["tec_descricao"];
			$this->checkout->claDescricao	= $linha["cla_descricao"];
			$this->checkout->sumLanc		= $linha["soma"];
			$this->checkout->pesNome		= $linha["pes_nome"];
			$this->checkout->pesCPF			= $linha["pes_cpf"];
			$this->checkout->tecCodigo		= $linha["tec_codigo"];
			$this->checkout->claPorcentagem	= $linha["cla_porcentagem"];
			$this->checkout->valor			= $linha["chout"];
			return $this->checkout;
		}
	}
?>