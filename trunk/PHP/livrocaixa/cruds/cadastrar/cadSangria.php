<?php
	include("cadSangriaInclude.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link href="../../scripts/css/geral.css" rel="stylesheet" type="text/css" />
		<link href="../../scripts/css/sangria.css" rel="stylesheet" type="text/css" />
		
		<script type="text/javascript" language="javascript" src="../../scripts/javascript/funcoes.js"></script>
		<script type="text/javascript" language="javascript" src="../../scripts/javascript/sangria.js"></script>
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
		<form id="cadastrar" name="cadastrar" method="post" action="cadSangria.php?cadastrar=sim" onsubmit="javascript: return validarCadastro();">
		  <div id="cadSan">
		  	<div class="texto3" id="cadSanSelTipo">
				Selecione o tipo da sangria:
				<select name="slTipo" class="textField1" id="slTipo" onchange="javascript: alternar();">
					<?php
					include($toRoot."utils/getTipoSL.php");
					?>
			    </select>
			</div>
			  <div class="texto3" id="cadSanNumEnv" style="visibility:hidden">N&uacute;mero do envelope : 
			    <input name="tfNumEnv" type="text" class="textField1" id="tfNumEnv" size="75" maxlength="150" onkeyup="javascript: validarForm('tfNumEnv');" />				
		    </div>
				<div class="texto3" id="cadSanBan" style="visibility:hidden">
				Selecione o banco:
				<select name="slBancRef" class="textField1" id="slBancRef">
					<?php
					include($toRoot."utils/getBancoSL.php");
					?>
			    </select> 
			<span style="cursor:pointer" onclick="javascript: location.href = 'cadBanco.php';"><img src="../../imagens/add.png" />Adicionar novo banco</span> </div>
				<div class="texto3" id="cadSanData">Data : 
			    <input name="tfData" type="text" value="<?php echo(getData()); ?>" class="textField1" id="tfData" size="15" maxlength="10" onkeyup="javascript: validarForm('tfData');" />				
		    </div>
				<div class="texto3" id="cadSanVal">Valor : 
			    <input name="tfVal" type="text" class="textField1" id="tfVal" size="15" maxlength="15" onkeyup="javascript: validarForm('tfVal');" />				
		    </div>
			    <div id="cadEmpBut">
	      <input name="btCad" type="submit" class="botao2" id="btCad" value="Cadastrar" /></div>
		  </div>
		</form>
	</body>
</html>
