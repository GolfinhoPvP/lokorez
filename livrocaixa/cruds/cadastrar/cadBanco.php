<?php
	include("cadBancoInclude.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link href="../../scripts/css/geral.css" rel="stylesheet" type="text/css" />
		<link href="../../scripts/css/banco.css" rel="stylesheet" type="text/css" />
		
		<script type="text/javascript" language="javascript" src="../../scripts/javascript/funcoes.js"></script>
		<script type="text/javascript" language="javascript" src="../../scripts/javascript/banco.js"></script>
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
		<div id="confirmar"></div>
		<form id="cadastrar" name="cadastrar" method="post" action="cadBanco.php?cadastrar=sim" onsubmit="javascript: return validarCadastro();">
		  <div id="cadBan">
		    <div class="texto3" id="cadBanNom">Insira o nome do novo Banco: 
			    <input name="tfNomBan" type="text" class="textField1" id="tfNomBan" size="50" maxlength="50" onkeyup="javascript: validarForm('tfNomEmp');" />				
		    </div>
			<div id="cadBut">
	      <input name="btCad" type="submit" class="botao2" id="btCad" value="Cadastrar" /></div>
		  <div id="voltar" title="Voltar!" style="cursor:pointer" onclick="javascript: location.href = '<?php echo($voltar); ?>';"><img src="../../imagens/voltar.png" /></div>
		  </div>
		</form>
	</body>
</html>
