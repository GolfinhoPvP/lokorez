<?php
	include("pesLancamentoInclude.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link href="../../scripts/css/geral.css" rel="stylesheet" type="text/css" />
		<link href="../../scripts/css/lancamento.css" rel="stylesheet" type="text/css" />
		
		<script type="text/javascript" language="javascript" src="../../scripts/javascript/funcoes.js"></script>
		<script type="text/javascript" language="javascript" src="../../scripts/javascript/lancamento.js"></script>
	</head>
	
	<body>
		<?php
			if($pesquisar == true){
				$tipo = "pes";
				include($toRoot."includes/confirmar.php");
			}else{
				echo('<div id="confirmar"></div>');
			}
		?>
		<div id="alterar"></div>
		<div id="carregando"></div>
		<div id="confirmar"></div>
		<form id="pesquisar" name="pesquisar" method="post" action="pesLancamento.php?pesquisar=sim" onsubmit="javascript: return validarPesquisa();">
		<div id="PesLan"></div>
		</form>
	</body>
</html>