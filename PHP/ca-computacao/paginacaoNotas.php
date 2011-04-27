<?php
	function formatarData($string){
			/*pronto, agora a DATA/HORA do PC , esta armazenada nesta variavel no formato timestamp (AAAA-MM-DD HH:ii:ss).
			agora vamos decompor esta variavel..*/
			
			$mes = substr($string,5,2);
			$dia = substr($string,8,2);
			$ano = substr($string,0,4);
			$hora = substr($string,11,2);
			$minutos = substr($string,14,2);
			$segundos = substr($string,17,4);
			
			switch($mes){
				case 01 : $mes = "janeiro"; break;
				case 02 : $mes = "fevereiro"; break;
				case 03 : $mes = "março"; break;
				case 04 : $mes = "abril"; break;
				case 05 : $mes = "maio"; break;
				case 06 : $mes = "junho"; break;
				case 07 : $mes = "julho"; break;
				case 08 : $mes = "agosto"; break;
				case 09 : $mes = "setembro"; break;
				case 10 : $mes = "outubro"; break;
				case 11 : $mes = "novembro"; break;
				case 12 : $mes = "dezembro"; break;
			}
			
			return $dia." de ".$mes." de ".$ano." as ".$hora.":".$minutos.":".$segundos;
	}


	$numEl = 10;
	
	if(!isset($_GET['pagina'])){
		$pagina = 1;
	}else{
		$pagina = $_GET['pagina'];
	}

	//conexão com o banco de dados
	include("conexao.php");
	
	//contando os elementos
	$expressao = "SELECT * FROM tome_nota WHERE categoria = 1 order by idTomeNota desc";
	$resultado = mysql_query($expressao);
	$quantidadeElementos = mysql_num_rows($resultado);

	//contador de paginas
	$quantidadePagina = $quantidadeElementos / $numEl;
	if(($quantidadeElementos % $numEl) != 0){
		$quantidadePagina++;
	}
	$quantidadePagina = (int) $quantidadePagina;
	
	//mostrar resultados
	$ponteiroInicial = ($numEl * $pagina) - $numEl;
	$ponteiroFinal = ($numEl * $pagina) - 1;
	
	for($x=0; $x<$ponteiroInicial; $x++){
		mysql_fetch_array($resultado);
	}
	
	for($x=0; $x<$numEl; $x++){
			if(!($linha = mysql_fetch_array($resultado))){
				break;
			}
			
			$idPessoa = $linha['idPessoa'];

			if($idPessoa != 0){
				$expressao = "SELECT * FROM aluno WHERE idPessoa = '$idPessoa'";
				$resultado2 = mysql_query($expressao);
				$linha2 = mysql_fetch_array($resultado2);
				$usuario = $linha2["usuario"];
				$situacao = $linha2["situacao"];
			}else{
				$usuario = "Anônimo";
				$situacao = 0;
			}
			
			$data = formatarData($linha["data"]);
			$mens = str_replace("\r\n", "<br/>", $linha["nota"]);
			
			switch($situacao){
				case 0 : echo('<table class="largura" id="notinhaNda"'); $classe = ""; break;
				case 1 : echo('<table class="largura" id="notinhaAlu"'); $classe = "Aluno"; break;
				case 2 : echo('<table class="largura" id="notinhaSec"'); $classe = "Secretário(a)"; break;
				case 3 : echo('<table class="largura" id="notinhaPre"'); $classe = "Presidente(a)"; break;
				case 4 : echo('<table class="largura" id="notinhaPro"'); $classe = "Professor(a)"; break;
				
			}
			echo(' width="100%" border="0"><tr><td idclass="notinha" width="44%" class="simples_3">Postado por: ');
			echo($usuario);
			echo('</td><td id="notinha" width="38%" class="simples_3">, no dia '); 
			echo($data);
			echo('</td><td id="notinha" width="18%" class="simples_3">');
			echo($classe);
			echo('</td></tr><tr><td id="notinha" colspan="3" class="simples_5">'); 
			echo($mens);
			echo('</td></tr></table><br/>');
	}
	mysql_close($conexao);
?>
