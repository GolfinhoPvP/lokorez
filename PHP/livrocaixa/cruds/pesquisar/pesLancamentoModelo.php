<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<link href="../../scripts/css/geral.css" rel="stylesheet" type="text/css" />
		<link href="../../scripts/css/lancamento.css" rel="stylesheet" type="text/css" />
	</head>
	
	<body>
		<div id="modLan" style="background:url(../../imagens/lancamento_<?php echo($cor); ?>.gif); background-repeat:no-repeat;">
			<div class="textLan1" id="modLanCod">Código: <span class="texto1"><?php echo($bean->lanCodigo); ?></span></div>
			<div class="textLan1" id="modLanDat">Data: <span class="texto1"><?php echo($bean->lanDatahora); ?></span></div>
			<div class="textLan1" id="modLanPC">Plano de conta: <span class="texto1"><?php echo($bean->pcDescricao); ?></span></div>
			<div id="modLanPro">Produto: <span class="texto1"><?php echo($bean->proDescricao); ?></span></div>
			<div class="textLan1" id="modLanSer">Serviço: <span class="texto1"><?php echo($bean->serDescricao); ?></span></div>
			<div class="textLan1" id="modLanFP">Forma de pagamento: <span class="texto1"><?php echo($bean->forDescricao); ?></span></div>
			<div class="textLan1" id="modLanTec">Técnico: <span class="texto1"><?php echo($bean->tecDescricao); ?></span></div>
			<div class="textLan1" id="modLanQua">Quantidade: <span class="texto1"><?php echo($bean->lanQuantidade); ?></span></div>
			<div class="textLan1" id="modLanVal" align="center">Valor<br />
		    R$ <span class="texto2"><?php echo($bean->lanValor); ?></span></div>
	</div>
	</body>
</html>
