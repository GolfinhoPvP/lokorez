<?php
	include("cadLancamentoInclude.php");
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
		<div id="alterar"></div>
		<div id="confirmar"></div>
		<form id="cadastrar" name="cadastrar" method="post" action="cadLancamento.php?cadastrar=sim" onsubmit="javascript: return validarCadastro();">
		<div id="CadLan">
			<div class="texto3" id="cadLanCod">Código: 
		  <input name="tfCod" type="text" class="textField1" id="tfCod" size="15" maxlength="12" readonly="readonly" />
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
		  <div class="texto3" id="cadLanMod">Modelo: 
		  <input name="tfMod" type="text" class="textField1" id="tfMod" size="30" maxlength="25" readonly="readonly" />
		  </div>
		  <div class="texto3" id="cadLanValCom">Valor: 
		  <input name="tfVal1" type="text" class="textField1" id="tfVal1" size="15" maxlength="15" />
		  </div>
		  <div class="texto3" id="cadLanSer">Serviço: 
			  <select name="slSer" id="slSer">
				<?php
					include($toRoot."utils/getServicoSL.php");
				?>
		    </select>
		  </div>
		  <div class="texto3" id="cadLanVal2">Valor2: 
		  <input name="tfVal2" type="text" class="textField1" id="tfVal2" size="15" maxlength="15" />
		  </div>
		  <div class="texto3" id="cadLanForPag">Forma de pagamento: 
			  <select name="slForPag" id="slForPag">
				<?php
					include($toRoot."utils/getFormaPagamentoSL.php");
				?>
		    </select>
		  </div>
		  <div class="texto3" id="cadLanTec">Tecnico: 
			  <select name="slTec" id="slTec">
				<?php
					include($toRoot."utils/getTecnicoSL.php");
				?>
		    </select>
		  </div>
			<div id="cadEmpBut">
		  <input name="btCad" type="submit" class="botao2" id="btCad" value="Cadastrar" /></div>
		  </div>
		</form>
	</body>
</html>
