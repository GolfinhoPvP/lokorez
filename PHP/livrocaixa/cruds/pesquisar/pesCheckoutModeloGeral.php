<?php
	$toRoot = "../../";
	
	include_once($toRoot."beans/Checkout.class.php");
	include_once($toRoot."dao/DAOCheckout.class.php");
	include_once($toRoot."utils/ConectarMySQL.class.php");	
	include_once($toRoot."utils/funcoes.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<link href="../../scripts/css/checkout.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" language="javascript">
			window.onunload = function(){
				opcao = confirm("Muito cuidado, você deve zerar os checks! aperte OK para zerar!");
				if(!opcao){
					alert("Você não zerou os check, eles voltarão a aparecer em consultas futuras!");
				}
			}
		</script>
	</head>
	
	<body>
	<div id="imprimirGeral" title="Imprimir!" onclick="javascript: window.print();" style="cursor:pointer"></div>
	<div id="zerarGeral" title="Zerar" onclick="javascript: location.href = '../../utils/zerar.php?valRef=0'" style="cursor:pointer"></div>
	<div id="corpo">
	<?php
		$conexao 	= new ConectarMySql($toRoot);
		$bean 		= new Checkout($tfNom, $tfCPF, $tfRG);
		$dao		= new DAOCheckout($bean, $conexao);
		$array 		= $dao->getCheckoutLista();
		if($array != NULL){
			foreach($array as $temp){
				$bean = $temp;
				if($bean != NULL){
					include("pesCheckoutModeloGeralInclude.php");
				}
			}
		}
	?>
	</div>
	</body>
</html>
