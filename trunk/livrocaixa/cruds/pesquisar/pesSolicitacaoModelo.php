<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<link href="../../scripts/css/geral.css" rel="stylesheet" type="text/css" />
		<link href="../../scripts/css/solicitacao.css" rel="stylesheet" type="text/css" />
	</head>
	
	<body>
	<div id="modLan" style="background:url(../../imagens/solicitacao_<?php echo($cor); ?>.gif); background-repeat:no-repeat;">
			<div class="textLan1" id="modLanCod">Descri&ccedil;&atilde;o: <span class="texto1"><?php echo($bean->descricao); ?></span></div>
			<div class="textLan1" id="modLanDat">Data de vencimento: <span class="texto1"><?php echo($bean->vencimento); ?></span></div>
			<div class="textLan1" id="modLanFP">C&oacute;digo de barras: <span class="texto1"><?php echo($bean->codigoBarras); ?></span></div>
			<div class="textLan1" id="modLanQua">Valor: <span class="texto1"><?php echo($bean->valor); ?></span></div>
			<div id="modPagar"  title="Pagar est&aacute; solicita&ccedil;&atilde;o!" onclick="javascript: location.href = '../alterar/altSolicitacao.php?valRef=<?php echo($bean->codigo);?>'" style="cursor:pointer"></div>
	</div>
	</body>
</html>
