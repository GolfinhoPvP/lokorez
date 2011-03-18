<div id="modLan">
	<div class="textLan1" id="modLanCod">Técnico: <span class="texto1"><?php echo($bean->tecDescricao); ?></span></div>
	<div class="textLan1" id="modLanDat">Classe: <span class="texto1"><?php echo($bean->claDescricao); ?></span></div>
	<div class="textLan1" id="modLanPC">Vendas, total: R$ <span class="texto1"><?php echo(inverterValor($bean->sumLanc)); ?></span></div>
	<div class="textLan1" id="modLanPro">Nome completo: <span class="texto1"><?php echo($bean->pesNome); ?></span></div>
	<div class="textLan1" id="modLanSer">CPF: <span class="texto1"><?php echo($bean->pesCPF); ?></span></div>
	<div class="textLan1" id="modLanFP">Porcentagem: <span class="texto1"><?php echo(inverterValor($bean->claPorcentagem)); ?>%</span></div>
	<div class="textLan1" id="modLanTec">Valor do check: R$ <span class="texto1"><?php echo(inverterValor($bean->valor)); ?></span></div>
	<div class="textLan1" id="modLanAss">Assinatura:______________________________________________________</div>
</div>
