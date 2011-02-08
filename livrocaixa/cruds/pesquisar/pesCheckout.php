<?php
	include("pesCheckoutInclude.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link href="../../scripts/css/geral.css" rel="stylesheet" type="text/css" />
		<link href="../../scripts/css/checkout.css" rel="stylesheet" type="text/css" />
		
		<script type="text/javascript" language="javascript" src="../../scripts/javascript/funcoes.js"></script>
		<script type="text/javascript" language="javascript" src="../../scripts/javascript/checkout.js"></script>
		<script type="text/javascript" language="javascript">
			<!--
			width	= 600;
			height 	= 200;
			left 	= 150;
			top 	= 100;
			URL 	= "pesCheckoutModelo.php?slTec=<?php echo($slTec); ?>";
			window.onload = function(){
				<?php if($pesquisar == "sim") 
						echo('window.open(URL,"promo", "width="+width+", height="+height+", top="+top+", left="+left+", scrollbars=no, status=no, toolbar=no, location=no, directories=no, menubar=no, resizable=no, fullscreen=no");');
				?>
			}
		</script>
	</head>
	
	<body>
		<div id="confirmar"></div>
		<form id="cadastrar" name="cadastrar" method="post" action="pesCheckout.php?pesquisar=sim" onsubmit="javascript: return validarPesquisar();">
		  <div id="pesCheckOut">
		  	<div class="texto3" id="pesCheckOutRef">Tecnico: 
			  <select class="textField1" name="slTec" id="slTec">
				<?php
					include($toRoot."utils/getTecnicoSL.php");
				?>
		    </select>
		  </div>
		    <div id="pesCheckOutBut">
	      <input name="btSol" type="submit" class="botao2" id="btSol" value="Gerar Check-Saida" />
			</div>
		  </div>
		</form>
	</body>
</html>
