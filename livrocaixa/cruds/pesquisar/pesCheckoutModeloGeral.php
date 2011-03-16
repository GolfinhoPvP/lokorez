<?php
	$toRoot = "../../";
	
	include_once($toRoot."beans/Checkout.class.php");
	include_once($toRoot."dao/DAOCheckout.class.php");
	include_once($toRoot."utils/ConectarMySQL.class.php");	
	include_once($toRoot."utils/funcoes.php");
	
	foreach($_GET as $nomeCampo => $valor){
		$comando = "\$".$nomeCampo."= antiSQL(isset(\$_GET['$nomeCampo']) ? '".$valor."' : NULL);";
		eval($comando);
	}
	
	$conexao 	= new ConectarMySql($toRoot);
	$bean 		= new Checkout($tfNom, $tfCPF, $tfRG);
	$dao		= new DAOCheckout($bean, $conexao);
	$bean 		= $dao->getCheckout($slTec);
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
		<div id="modLan">
			<div class="textLan1" id="modLanCod">Técnico: <span class="texto1"><?php echo($bean->tecDescricao); ?></span></div>
			<div class="textLan1" id="modLanDat">Classe: <span class="texto1"><?php echo($bean->claDescricao); ?></span></div>
			<div class="textLan1" id="modLanPC">Vendas, total: R$ <span class="texto1"><?php echo($bean->sumLanc); ?></span></div>
			<div class="textLan1" id="modLanPro">Nome completo: <span class="texto1"><?php echo($bean->pesNome); ?></span></div>
			<div class="textLan1" id="modLanSer">CPF: <span class="texto1"><?php echo($bean->pesCPF); ?></span></div>
			<div class="textLan1" id="modLanFP">Porcentagem: <span class="texto1"><?php echo($bean->claPorcentagem); ?>%</span></div>
			<div class="textLan1" id="modLanTec">Valor do check: R$ <span class="texto1"><?php echo($bean->valor); ?></span></div>
			<div class="textLan1" id="modLanAss">Assinatura:______________________________________________________</div>
	</div>
	<div id="imprimir" title="Imprimir!" onclick="javascript: window.print();" style="cursor:pointer"></div>
	<div id="zerar" title="Zerar" onclick="javascript: location.href = '../../utils/zerar.php?valRef=<?php echo($bean->tecCodigo);?>'" style="cursor:pointer"></div>
	</body>
</html>
