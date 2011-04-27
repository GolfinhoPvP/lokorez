<?php
	include("cadLancamentoInclude.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link href="../../scripts/css/geral.css" rel="stylesheet" type="text/css" />
		<link href="../../scripts/css/lancamento.css" rel="stylesheet" type="text/css" />
		
		<script type="text/javascript" language="javascript" src="../../scripts/javascript/ajax.js"></script>
		<script type="text/javascript" language="javascript" src="../../scripts/javascript/funcoes.js"></script>
		<script type="text/javascript" language="javascript" src="../../scripts/javascript/lancamento.js"></script>
	</head>
	
	<body>
		<?php
			if($cadastrar == true){
				$tipo = "lan";
				include($toRoot."includes/confirmar.php");
			}else{
				echo('<div id="confirmar"></div>');
			}
		?>
		<div id="alterar"></div>
		<div id="carregando"></div>
		<div id="confirmar"></div>
		<div id="linhaProduto"></div>
		<div id="linhaServico"></div>
		<form id="cadastrar" name="cadastrar" method="post" action="cadLancamento.php?cadastrar=sim" onsubmit="javascript: return validarCadastro();">
		<div id="CadLan">
			<div class="texto3" id="cadLanCod">Código: 
		  <input name="tfCod" type="text" class="textField1" id="tfCod" size="15" value="<?php echo($chave); ?>" maxlength="12" readonly="readonly" />
		  </div>
		  <div class="texto3" id="cadLanOrdSer">Ordem de Servi&ccedil;o: 
		    <input name="tfOrdSer" type="text" class="textField1" id="tfOrdSer" size="25" maxlength="50"  onkeyup="javascript: validarForm('tfOrdSer');"/>
		  </div>
			<div class="texto3" id="cadLanPlaCon">Plano de conta: 
			  <select class="textField1" name="slPlaCon" id="slPlaCon">
				<?php
					include($toRoot."utils/getPlanoContaSL.php");
				?>
			  </select>
			  <span style="cursor:pointer" onclick="javascript: location.href = 'cadPlanoConta.php';"><img src="../../imagens/add.png" />Cadastrar novo plano conta!</span>
		  </div>
			<div class="texto3" id="cadLanPro">Produto: 
			  <select class="textField1" name="slPro" id="slPro" onchange="javascript: carregarProduto();">
				<?php
					include($toRoot."utils/getProdutoSL.php");
				?>
			  </select>
			  <span style="cursor:pointer" onclick="javascript: location.href = 'cadProduto.php';"><img src="../../imagens/add.png" />Cadastrar novo produto!</span>
		  </div>
		  <div class="texto3" id="cadLanModelo">Modelo: 
		  <input name="tfMod" type="text" class="textField1" id="tfMod" size="30" maxlength="25" readonly="readonly" />
		  </div>
		  <div class="texto3" id="cadLanValCom">R$: 
		    <input name="tfVal1" type="text" class="textField1" id="tfVal1" size="15" maxlength="15" onkeyup="javascript: validarForm('tfVal1');" />
		  </div>
		  <div class="texto3" id="cadLanQua">Quantidade: 
		    <input name="tfQua" type="text" class="textField1" id="tfQua" value="1" size="15" maxlength="15" onkeyup="javascript: validarForm('tfQua');" />
		  </div>
		  <div class="texto3" id="cadLanValPro">
	      Total produto R$:
	      <input name="tfValPro" type="text" class="textField1" id="tfValPro" size="15" maxlength="15" onkeyup="javascript: validarForm('tfValPro');" onfocus="javascript: calcularValorProduto('tfValPro');" /></div>
		  <div class="texto3" id="cadLanSer">Serviço: 
			  <select class="textField1" name="slSer" id="slSer">
				<?php
					include($toRoot."utils/getServicoSL.php");
				?>
		    </select>
			<span style="cursor:pointer" onclick="javascript: location.href = 'cadServico.php';"><img src="../../imagens/add.png" />Cadastrar novo servi&ccedil;o!</span>
		  </div>
		  <div class="texto3" id="cadLanValSer">Valor do servi&ccedil;o R$: 
		    <input name="tfValSer" type="text" class="textField1" id="tfValSer" size="15" maxlength="15" onkeyup="javascript: validarForm('tfValSer');"/>
		  </div>
		  <div class="texto3" id="cadLanTec">T&eacute;cnico: 
			  <select class="textField1" name="slTec" id="slTec">
				<?php
					include($toRoot."utils/getTecnicoSL.php");
				?>
		    </select>
			<span style="cursor:pointer" onclick="javascript: location.href = 'cadTecnico.php';"><img src="../../imagens/add.png" />Cadastrar novo t&eacute;cnico!</span>
		  </div>
		  <div class="texto3" id="cadLanForPag">Forma de pagamento: 
			  <select class="textField1" name="slForPag" id="slForPag">
				<?php
					include($toRoot."utils/getFormaPagamentoSL.php");
				?>
		    </select>
			<span style="cursor:pointer" onclick="javascript: location.href = 'cadFormaPagamento.php';"><img src="../../imagens/add.png" />Cadastrar nova forma de pagamento!</span>
		  </div>
		  <div class="texto3" id="cadLanValTot">Valor total RS: 
		    <input name="tfValTot" type="text" class="textField1" id="tfValTot" size="15" maxlength="15" onfocus="javascript: calcularValorTotal('tfValTot');" onkeyup="javascript: validarForm('tfValTot');"/>
		  </div>
		  <div class="texto3" id="cadLanDesc">Desconto RS: 
		    <input name="tfValDesc" type="text" class="textField1" id="tfValDesc" onkeyup="javascript: validarForm('tfValDesc');" value="0" size="15" maxlength="15"/>
		  </div>
			<div id="cadBut">
		  <input name="btCad" type="submit" class="botao2" id="btCad" value="Lan&ccedil;ar" />
			</div>
		  </div>
		</form>
	</body>
</html>
