<?php
	include("cadSolicitacaoInclude.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link href="../../scripts/css/geral.css" rel="stylesheet" type="text/css" />
		<link href="../../scripts/css/solicitacao.css" rel="stylesheet" type="text/css" />
		
		<script type="text/javascript" language="javascript" src="../../scripts/javascript/funcoes.js"></script>
		<script type="text/javascript" language="javascript" src="../../scripts/javascript/solicitacao.js"></script>
	</head>
	
	<body>
		<?php
			if($cadastrar == true){
				$tipo = "sol";
				include($toRoot."includes/confirmar.php");
			}else{
				echo('<div id="confirmar"></div>');
			}
		?>
		<div id="confirmar"></div>
		<form id="cadastrar" name="cadastrar" method="post" action="cadSolicitacao.php?cadastrar=sim" onsubmit="javascript: return validarCadastro();">
		  <div id="cadSol">
			  <div class="texto3" id="cadSolDes">Descri&ccedil;&atilde;o: 
	            <input name="tfDes" type="text" class="textField1" id="tfDes" size="75" maxlength="100" onkeyup="javascript: validarForm('tfDes');"/>
		    </div>
			  <div class="texto3" id="cadSolVen">Vencimento: 
		        <input name="tfVen" type="text" class="textField1" id="tfVen" size="15" maxlength="10" onkeyup="javascript: validarForm('tfVen');"/>
		    </div>
			  <div class="texto3" id="cadSolVal">Valor: R$
		        <input name="tfVal" type="text" class="textField1" id="tfVal" size="30" maxlength="15" onkeyup="javascript: validarForm('tfVal');"/>
		    </div>
			<div class="texto3" id="cadSolCDB">C&oacute;digo de barras: 
		      <input name="tfCDB" type="text" class="textField1" id="tfCDB" size="75" maxlength="200" onkeyup="javascript: validarForm('tfCDB');"/>
		    </div>
			<div id="cadSolBut">
	      <input name="btSol" type="submit" class="botao2" id="btSol" value="Solicitar" />
			</div>
		  </div>
		</form>
	</body>
</html>
