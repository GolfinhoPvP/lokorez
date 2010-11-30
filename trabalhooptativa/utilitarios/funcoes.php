<?php
	include_once("../classes/Conexao.class.php");
	
	function geradorProtocolo(){
		$conector = new Conexao();
		/* função getdate() retorna um ARRAY com todos os elementos de data e tempo, para tu saber cada indice do array olha aquele site php.net*/
		$data = getdate();
		
		$protocolo = $data["year"].$data["mon"].$data["mday"].rand(0,9).rand(0,9).rand(0,9);
		
		if($conector->contadorDeResultado("SELECT * FROM ra WHERE protocolo='$protocolo'") > 0){
			/* Aqui a nossa velha recursividade, lembra não é?!*/
			$protocolo = geradorProtocolo();
		}
		/* aqui eu concateno tudo que eu eu quero, a função rand() tá fácil*/
		return $protocolo;
	}
?>
