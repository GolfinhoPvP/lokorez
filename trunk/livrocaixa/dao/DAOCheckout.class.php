<?php
	class DAOCheckout{
		private $checkout;
		private $conexao;
		
		function __construct($checkout, $conexao){
			$this->checkout 	= $checkout;
			$this->conexao 		= $conexao;
		}
 
		public function getCheckout($valRef){
			$sql = "SELECT t.tec_descricao, c.cla_descricao, sum(ls.lan_valor_servico) soma, p.pes_nome, p.pes_cpf, t.tec_codigo, c.cla_porcentagem, format(sum(ls.lan_valor_servico)*(c.cla_porcentagem/100), 2) chout FROM lancamentos_servico ls
		INNER JOIN tecnicos t
			ON ls.tec_codigo = t.tec_codigo
		INNER JOIN classe c
			ON t.cla_codigo = c.cla_codigo
		INNER JOIN pessoas p
			On t.pes_codigo = p.pes_codigo
	WHERE t.tec_codigo = ".$valRef." AND lan_checado == 0";
			
			$resultado = $this->conexao->selecionar($sql);
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