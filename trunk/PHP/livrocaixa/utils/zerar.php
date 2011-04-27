<?php
	$toRoot = "../";
	
	include_once($toRoot."beans/LancamentoServico.class.php");
	include_once($toRoot."dao/DAOLancamentoServico.class.php");
	include_once($toRoot."utils/ConectarMySQL.class.php");	
	include_once($toRoot."utils/funcoes.php");
	
	foreach($_GET as $nomeCampo => $valor){
		$comando = "\$".$nomeCampo."= antiSQL(isset(\$_GET['$nomeCampo']) ? '".$valor."' : NULL);";
		eval($comando);
	}
	
	$conexao 	= new ConectarMySql($toRoot);
	$bean 		= new LancamentoServico();
	$dao		= new DAOLancamentoServico($bean, $conexao);
	$bean 		= $dao->zerar($valRef);
	
	$conexao->fechar();
?>
<html>
	<head>
		<script type="text/javascript" language="javascript">
			window.onload = function(){
				setTimeout('window.close()',3000);
			}
		</script>
	</head>
	<body>
		<p>Lan&ccedil;amentos zerados com sucesso!</p>
	</body>
</html>