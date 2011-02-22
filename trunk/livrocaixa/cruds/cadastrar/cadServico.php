<?php
	include("cadServicoInclude.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link href="../../scripts/css/geral.css" rel="stylesheet" type="text/css" />
		<link href="../../scripts/css/servico.css" rel="stylesheet" type="text/css" />
		
		<script type="text/javascript" language="javascript" src="../../scripts/javascript/funcoes.js"></script>
		<script type="text/javascript" language="javascript" src="../../scripts/javascript/servico.js"></script>
	</head>
	
	<body>
		<?php
			if($cadastrar == true){
				$tipo = "cad";
				include($toRoot."includes/confirmar.php");
			}else{
				echo('<div id="confirmar"></div>');
			}
		?>
		<form id="cadastrar" name="cadastrar" method="post" action="cadServico.php?cadastrar=sim" onsubmit="javascript: return validarCadastro();">
			<div id="cadSer">
			  <div class="texto3" id="cadSerDes">Insira o nome do novo Servi&ccedil;o : 
		      <input name="tfDes" type="text" class="textField1" id="tfDes" size="75" maxlength="100" onkeyup="javascript: validarForm('tfDes');" /></div>
				<div id="cadCliBut">
    <input name="btCad" type="submit" class="botao2" id="btCad" value="Cadastrar" /></div>
	<div id="voltar" title="Voltar!" style="cursor:pointer" onclick="javascript: location.href = '<?php echo($voltar); ?>';"><img src="../../imagens/voltar.png" /></div>
		  </div>
		</form>
	</body>
</html>
