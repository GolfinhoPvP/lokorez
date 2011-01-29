<?php
	include("cadProdutoInclude.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link href="../../scripts/css/geral.css" rel="stylesheet" type="text/css" />
		<link href="../../scripts/css/produto.css" rel="stylesheet" type="text/css" />
		
		<script type="text/javascript" language="javascript" src="../../scripts/javascript/funcoes.js"></script>
		<script type="text/javascript" language="javascript" src="../../scripts/javascript/produto.js"></script>
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
		<form id="cadastrar" name="cadastrar" method="post" action="cadProduto.php?cadastrar=sim" onsubmit="javascript: return validarCadastro();">
				<div class="texto3" id="cadProEmpRel">Empresa relacionada: 
				<select name="slEmp" class="textField1" id="slEmp">
				<?php
					include($toRoot."utils/getEmpresasSL.php");
				?>
				</select>
		  	</div>
			  <div class="texto3" id="cadProDes">Descri&ccedil;&atilde;o do produto: 
	          <input name="tfDes" type="text" class="textField1" id="tfDes" size="75" maxlength="150" onkeyup="javascript: validarForm('tfDes');" />
			  </div>
			  <div class="texto3" id="cadProMod">Modelo:
			    <input name="tfMod" type="text" class="textField1" id="tfMod" size="30" maxlength="25" onkeyup="javascript: validarForm('tfMod');"/>
			  </div>
		      <div class="texto3" id="cadProValVen">Valor de venda : 
		        <input name="tfVal" type="text" class="textField1" id="tfVal" size="30" maxlength="15" onkeyup="javascript: validarForm('tfVal');"/>
			  </div>
<div id="cadCliBut">
	      <input name="btCad" type="submit" class="botao2" id="btCad" value="Cadastrar" /></div>
		</form>
	</body>
</html>
