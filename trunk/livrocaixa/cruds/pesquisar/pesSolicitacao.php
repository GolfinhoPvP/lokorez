<?php
	include("pesSolicitacaoInclude.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link href="../../scripts/css/geral.css" rel="stylesheet" type="text/css" />
		<link href="../../scripts/css/solicitacao.css" rel="stylesheet" type="text/css" />
		
		<script type="text/javascript" language="javascript" src="../../scripts/javascript/funcoes.js"></script>
		<script type="text/javascript" language="javascript" src="../../scripts/javascript/solicitacao.js"></script>
	</head>
	
	<body>
		<?php
			$cor = "azul";
			if(sizeof($matriz) != 0){
				echo("bla");
				foreach($matriz as $array){
					$bean = $array;
					include("pesSolicitacaoModelo.php");
					$cor = $cor == "azul" ? "vermelho" : "azul";
				}
			}else{
				$tipo = "pag";
				include($toRoot."includes/negar.php");
			}
		?>
	</body>
</html>
