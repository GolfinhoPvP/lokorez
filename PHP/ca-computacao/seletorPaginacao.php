<?php
	//selecionar como e quais resultados mostrar	
	echo("Exibindo do ");
	echo(($ponteiroInicial+1)." ao ");
	if($ponteiroFinal > $quantidadeElementos ){
		echo($quantidadeElementos);
	}else{
		echo($ponteiroFinal+1);
	}
	echo(" de $quantidadeElementos notas.");
	$contador = 1;
	if($quantidadePagina > 1){
		echo(" -- Mostrando p&aacute;gina $pagina. -> ");
		while($contador <= $quantidadePagina){
			echo "<span style=\"cursor:pointer\" onclick=\"javascript: carregaPagina('telaNota.php?pagina=$contador','telaNota');\"><strong>|  ".$contador."  |</strong></span>";
			$contador++;
		}
	}
	mysql_free_result($resultado);
?>

