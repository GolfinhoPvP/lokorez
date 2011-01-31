<?php
	include("cadEmpresaInclude.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link href="../../scripts/css/geral.css" rel="stylesheet" type="text/css" />
		<link href="../../scripts/css/lancamento.css" rel="stylesheet" type="text/css" />
		
		<script type="text/javascript" language="javascript" src="../../scripts/javascript/funcoes.js"></script>
		<script type="text/javascript" language="javascript" src="../../scripts/javascript/lancamento.js"></script>
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
		<form id="cadastrar" name="cadastrar" method="post" action="cadEmpresa.php?cadastrar=sim" onsubmit="javascript: return validarCadastro();">
		<div id="CadLan">
			<div class="texto3" id="cadLanCod">Código: 
		  <input type="text" class="textField1" size="15" readonly="readonly" maxlength="12" />
		  </div>
			<div class="texto3" id="cadLanPlaCon">Plano de conta: 
			  <select name="slPlaCon" id="slPlaCon">
				<?php
					include($toRoot."utils/getPlanoContaSL.php");
				?>
			  </select>
		  </div>
			<div class="texto3" id="cadLanPro">Produto: 
			  <select name="slPro" id="slPro">
				<?php
					include($toRoot."utils/getProdutoSL.php");
				?>
			  </select>
		  </div>
			<div id="cadEmpBut">
			  <input name="btCad" type="submit" class="botao2" id="btCad" value="Cadastrar" /></div>
		  </div>
		</form>
	</body>
</html>
