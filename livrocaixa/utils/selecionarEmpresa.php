<?php
	include("selecionarEmpresaInclude.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link href="../scripts/css/geral.css" rel="stylesheet" type="text/css" />
		<link href="../scripts/css/selecionarEmpresa.css" rel="stylesheet" type="text/css" />
		
		<script type="text/javascript" language="javascript" src="../scripts/javascript/funcoes.js"></script>
	</head>
	
	<body>
		<?php
			if($selecionar == "nao"){
				$tipo = "fal";
				include($toRoot."includes/negar.php");
			}else if($selecionar == "ok"){
				$tipo = "sel";
				include($toRoot."includes/confirmar.php");
			}else{
				echo('<div id="confirmar"></div>');
			}
		?>
		<div id="confirmar"></div>
		<form id="cadastrar" name="cadastrar" method="post" action="selecionarEmpresa.php?selecionar=sim" onsubmit="javascript: return validarForm('slEmp');">
				<div class="texto3" id="selEmpRel">Empresa relacionada: 
				<select name="slEmp" class="textField1" id="slEmp">
				<?php
					include($toRoot."utils/getEmpresaSL.php");
				?>
				</select>
	  	  </div>
			    <div id="selEmpBut">
	      <input name="btSel" type="submit" class="botao2" id="btSel" value="Selecionar" />
	      </div>
		</form>
	</body>
</html>
