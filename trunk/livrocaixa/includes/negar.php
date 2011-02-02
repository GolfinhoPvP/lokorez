<?php
	switch($tipo){
		case "log" : $mensagem = "Nome de usuário ou senha incorreto!"; break;
		case "mas" : $mensagem = "Muito cuidado com este nome de usuário e senha!"; break;
		case "alt" : $mensagem = "A alteração não foi realizada!"; break;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	    <link href="<?php echo($toRoot); ?>scripts/css/avisos.css" rel="stylesheet" type="text/css" />
	</head>
	
	<body>
		<div id="confirmar">
			<div id="avisEsquerda" style="background-image:url(<?php echo($toRoot); ?>imagens/box_neg_1.png)"></div>
			<div id="avisCentro" style="background-image:url(<?php echo($toRoot); ?>imagens/box_neg_2.png)"><?php echo($mensagem); ?></div>
			<div id="avisDireita" style="background-image:url(<?php echo($toRoot); ?>imagens/box_neg_3.png)"></div>
		</div>
	</body>
</html>
