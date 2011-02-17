<?php
	include("altSolicitacaoInclude.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link href="../../scripts/css/geral.css" rel="stylesheet" type="text/css" />
		<link href="../../scripts/css/solicitacao.css" rel="stylesheet" type="text/css" />
		
		<script type="text/javascript" language="javascript" src="../../scripts/javascript/funcoes.js"></script>
		<script type="text/javascript" language="javascript" src="../../scripts/javascript/solicitacao.js"></script>
		<?php
			if($tirarAlerta == "sim")
				echo('	<script type="text/javascript" language="javascript" >
							window.onload = function(){
								top.frames["telaSistema"].document.getElementById("alerta").style.visibility = "hidden";
							}
						</script>'
				);
		?>
	</head>
	
	<body>
		<?php
			if($alterar == true){
				$tipo = "pag";
				include($toRoot."includes/confirmar.php");
				echo('<div title="Voltar"><img style="cursor:pointer" onclick="javascript: window.location = \'../pesquisar/pesSolicitacao.php\';" src="../../imagens/voltar.png" /></div>');
				die();
			}else{
				echo('<div id="confirmar"></div>');
			}
		?>
		<form id="alterar" name="alterar" method="post" action="altSolicitacao.php?alterar=sim" onsubmit="javascript: return validarAlteracao();">
		  <div id="cadSol">
		  		<input name="valRef" type="text" id="valRef" value="<?php echo($bean->codigo); ?>" style="visibility:hidden"/>
			  <div class="texto3" id="cadSolDes">Descri&ccedil;&atilde;o: 
	            <input name="tfDes" readonly="readonly" type="text" class="textField1" id="tfDes" size="75" maxlength="100" value="<?php echo($bean->descricao); ?>"/>
		    </div>
			  <div class="texto3" id="cadSolVen">Vencimento: 
		        <input name="tfVen" readonly="readonly" type="text" class="textField1" id="tfVen" size="15" maxlength="10" value="<?php echo($bean->vencimento); ?>"/>
		    </div>
			  <div class="texto3" id="cadSolVal">Valor: R$
		        <input name="tfVal" readonly="readonly" type="text" class="textField1" id="tfVal" size="30" maxlength="15" value="<?php echo($bean->valor); ?>"/>
		    </div>
			<div class="texto3" id="cadSolCDB">C&oacute;digo de barras: 
		      <input name="tfCDB" readonly="readonly" type="text" class="textField1" id="tfCDB" size="75" maxlength="200" value="<?php echo($bean->codigoBarras); ?>"/>
		    </div>
			<div class="texto3" id="altValPag">Valor pago: R$
		        <input name="tfVal2" type="text" class="textField1" id="tfVal2" size="30" maxlength="15" onkeyup="javascript: validarForm('tfVal2');" value="<?php echo($bean->valor); ?>"/>
		    </div>
			<div id="altSolBut">
	      <input name="btSol" type="submit" class="botao2" id="btSol" value="Pagar" />
			</div>
		  </div>
		</form>
	</body>
</html>
