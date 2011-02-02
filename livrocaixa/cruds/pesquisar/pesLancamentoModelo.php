<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<link href="../../scripts/css/geral.css" rel="stylesheet" type="text/css" />
		<link href="../../scripts/css/lancamento.css" rel="stylesheet" type="text/css" />
	</head>
	
	<body>
		<div id="modLan">
			<div id="modLanCod">Código: <?php echo($bean->codigo); ?></div>
			<div id="modLanPC">Plano de conta: <?php echo($bean->planoConta); ?></div>
			<div id="modLanPro">Produto: <?php echo($bean->produto); ?></div>
			<div id="modLanSer">Serviço: <?php echo($bean->servico); ?></div>
			<div id="modLanFP">Forma de pagamento: <?php echo($bean->formaPagamento); ?></div>
			<div id="modLanTec">Técnico: <?php echo($bean->tecnico); ?></div>
			<div id="modLanQua">Quantidade: <?php echo($bean->quantidade); ?></div>
			<div id="modLanVal">Valor: <?php echo($bean->valor); ?></div>
		</div>
	</body>
</html>
