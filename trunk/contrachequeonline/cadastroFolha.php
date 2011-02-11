<?php
	include_once("cadastroFolhaInclude.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>Cadastro Tempor&aacute;rio</title>
		<style type="text/css">
		   @import url("css/general.css");
		   @import url("css/cadastro.css");
		</style>
		<script language="javascript" src="javascript/functions.js" type="text/javascript"></script>
		<script language="javascript" src="javascript/ajax.js" type="text/javascript"></script>
		<script language="javascript" src="javascript/cadastro.js" type="text/javascript"></script>
	</head>
		
	<body>
		<div id="loading">	</div>
		<div id="autoComplete" class="words3">	</div>
		<form id="form1" name="form1" method="post" action="cadastroFolha.php?cadastrar=sim" onsubmit="javascript: return validarCadastro();">
			<div class="wordsLabel" id="nome">Nome:
				 <input name="tfNomeServ" type="text" id="tfNomeServ" size="100" maxlength="100" onkeyup="javascript: validarForm('tfNomeServ');" onkeydown="javascript: setaFoco(this, event);" />
				<span class="alert">*</span>
		  </div>
			 <div id="cartTrab">
				<div class="wordsLabel" id="cartTrabVal">Carteira de trabalho:
					<input name="tfCartTrab" type="text" id="tfCartTrab" size="45" maxlength="50" onkeyup="javascript: validarForm('tfCartTrab');" onkeydown="javascript: setaFoco(this, event);" />
			   </div>
				<div class="wordsLabel" id="cartTrabSer">S&eacute;rie: 
					<input name="tfCartTrabSerie" type="text" id="tfCartTrabSerie" size="10" maxlength="10" onkeyup="javascript: validarForm('tfCartTrabSerie');" onkeydown="javascript: setaFoco(this, event);" />
			   </div>
				<div class="wordsLabel" id="cartTrabUF">UF: 
				  <select name="slCartTrabUf" id="slCartTrabUf" onkeydown="javascript: setaFoco(this, event);">
					<option selected="selected" value="---">---</option>
					<?php
						$result = $connect->execute("SELECT * FROM estados");
						while($row = mysql_fetch_assoc($result)) {
							echo("<option value=".$row["est_codigo"].">".$row["est_sigla"]."</option>");
						}
					?>
				  </select>
			   </div>
				<div class="wordsLabel" id="cartTrabDat">Data de emiss&atilde;o: 
					  <input name="tfCartTrabDatEmis" type="text" id="tfCartTrabDatEmis" size="10" maxlength="10" onkeyup="javascript: validarForm('tfCartTrabDatEmis');" onkeydown="javascript: setaFoco(this, event);" />
			   <span class="alert">	    ex: 14/04/1988</span>			</div>
		  </div>
			<div id="pes">
				<div class="wordsLabel" id="pesSex">
				  Sexo:
				  <select name="slSexo" id="slSexo" onchange="javascript: showReference('slSexo','CartRes','1');"  onkeydown="javascript: setaFoco(this, event);" >
					<option value="---" selected="selected">-----------</option>
					<?php
						$result = $connect->execute("SELECT * FROM sexo");
						while($row = mysql_fetch_assoc($result)) {
							echo("<option value=".$row["sex_codigo"].">".utf8_encode($row["sex_descricao"])."</option>");
						}
					?>
				  </select>
				<span class="alert">* </span>
			  </div>
				<div class="wordsLabel" id="pesEstCiv">
				  Estado civil: 
				  <select name="slEstadCivi" id="slEstadCivi" onchange="javascript: showReference('slEstadCivi','nomConj','2:4');"  onkeydown="javascript: setaFoco(this, event);" >
					<option value="---" selected="selected">--------------</option>
					<?php
						$result = $connect->execute("SELECT * FROM estado_civil");
						while($row = mysql_fetch_assoc($result)) {
							echo("<option value=".$row["est_civ_codigo"].">".utf8_encode($row["est_civ_descricao"])."</option>");
						}
					?>
				  </select>
				<span class="alert">* </span>
			  </div>
		  </div>
		  
		  <!-- RESERVISTA -->
		  <div id="CartRes" class="visible">
			<div class="wordsLabel" id="CartResVal">Carteira de reservista: 
			  <input name="tfCartRes" type="text" id="tfCartRes" size="25" maxlength="25" onkeyup="javascript: validarForm('tfCartRes');" onkeydown="javascript: setaFoco(this, event);" />
			<span class="alert">* </span></div>
			<div class="wordsLabel" id="CartResCSM">CSM: 
			  <input name="tfCartResCSM" type="text" id="tfCartResCSM" size="15" maxlength="15" onkeyup="javascript: validarForm('tfCartResCSM');" onkeydown="javascript: setaFoco(this, event);" />
			</div>
			<div class="wordsLabel" id="CartResRM">RM:
			  <input name="tfCartResRM" type="text" id="tfCartResRM" size="15" maxlength="15" onkeyup="javascript: validarForm('tfCartResRM');" onkeydown="javascript: setaFoco(this, event);" />
			</div>
		  </div>
		  <!-- RESERVISTA -->
		  <div id="pisPasep" >
			<div class="wordsLabel" id="pisPasepVal" >PIS/PASEP (NIT): 
			  <input name="tfNIT" type="text" id="tfNIT" size="20" maxlength="20" onkeyup="javascript: validarForm('tfNIT');" onkeydown="javascript: setaFoco(this, event);" />
			<span class="alert">*</span></div>
			<div class="wordsLabel" id="pisPasepDat" >Data de emiss&atilde;o:
			  <input name="tfNITDatEmis" type="text" id="tfNITDatEmis" size="10" maxlength="10" onkeyup="javascript: validarForm('tfNITDatEmis');" onkeydown="javascript: setaFoco(this, event);" />
			<span class="alert"> ex: 14/04/1988</span></div>
		  </div>
		  <div id="docs" >
			<div class="wordsLabel" id="docsCPF">CPF: 
			  <input name="tfCPF" type="text" id="tfCPF" size="14" maxlength="14" onkeyup="javascript: validarForm('tfCPF');" onkeydown="javascript: setaFoco(this, event);" />
			<span class="alert">	    * ex: XXX.XXX.XXX-XX </span></div>
			<div class="wordsLabel" id="docsRG">RG: 
			<input name="tfRG" type="text" id="tfRG" size="20" maxlength="20" onkeyup="javascript: validarForm('tfRG');" onkeydown="javascript: setaFoco(this, event);" /></div>
			<div class="wordsLabel" id="docsOrgExp">Org&atilde;o expedidor: 
			  <input name="tfRGOrgExep" type="text" id="tfRGOrgExep" size="20" maxlength="20" onkeyup="javascript: validarForm('tfRGOrgExep');" onkeydown="javascript: setaFoco(this, event);" />
			<span class="alert">*</span></div>
			<div class="wordsLabel" id="docsDat">Data de emiss&atilde;o:
			<input name="tfRGDatEmis" type="text" id="tfRGDatEmis" size="10" maxlength="10" onkeyup="javascript: validarForm('tfRGDatEmis');" onkeydown="javascript: setaFoco(this, event);" />
			<span class="alert"> ex: 14/04/1988</span></div>
		  </div>
			<div id="titEle">
				<div class="wordsLabel" id="titEleVal">T&iacute;tulo eleitoral: 
				  <input name="tfTitEleit" type="text" id="tfTitEleit" size="15" maxlength="15" onkeyup="javascript: validarForm('tfTitEleit');" onkeydown="javascript: setaFoco(this, event);" />
			  <span class="alert">*</span></div>
			<div class="wordsLabel" id="titEleUF">UF:
			  <select name="slTitEleitUF" id="slTitEleitUF" onkeydown="javascript: setaFoco(this, event);" >
				<option selected="selected" value="---">---</option>
				<?php
					$result = $connect->execute("SELECT uf FROM tb_estados");
					while($row = mysql_fetch_assoc($result)) {
						echo("<option value=".$row["uf"].">".$row["uf"]."</option>");
					}
				?>
			  </select>
			  <span class="alert">*</span></div>
			  <div class="wordsLabel" id="titEleZon">Zona/Se&ccedil;&atilde;o: 
				  <input name="tfTitEleitZonSec" type="text" id="tfTitEleitZonSec" size="8" maxlength="8" onkeyup="javascript: validarForm('tfTitEleitZonSec');" onkeydown="javascript: setaFoco(this, event);" />
			  <span class="alert">*</span></div>
		  </div>
			<div id="nat">
			  <div class="wordsLabel" id="natDat">Data de nascimento:  
			  <input name="tfDatNasc" type="text" id="tfDatNasc" size="10" maxlength="10" onkeyup="javascript: validarForm('tfDatNasc');" onkeydown="javascript: setaFoco(this, event);" />
			<span class="alert">* ex: 14/04/1988</span></div>
			<div class="wordsLabel" id="natUF">UF:
			  <select name="slDatNascUF" id="slDatNascUF" onchange="javascript: getCityes('slUFDatNasc', 'slNatural');" onkeydown="javascript: setaFoco(this, event);" >
				<option selected="selected" value="---">---</option>
				<?php
					$result = $connect->execute("SELECT uf FROM tb_estados");
					while($row = mysql_fetch_assoc($result)) {
						echo("<option value=".$row["uf"].">".$row["uf"]."</option>");
					}
				?>
			  </select>
			  <span class="alert">*</span></div>
			<div class="wordsLabel" id="natNat">Naturalidade: 
			  <select name="slDatNascNatural" id="slDatNascNatural" onkeydown="javascript: setaFoco(this, event);" >
				<option value="---" selected="selected">----------------------------</option>
			  </select>
			  <span class="alert">*</span></div>
		  </div>
			<div class="wordsLabel" id="nomPai">Nome do pai: 
			<input name="tfNomePai" type="text" id="tfNomePai" size="100" maxlength="100" onkeyup="javascript: validarForm('tfNomePai');" onkeydown="javascript: setaFoco(this, event);" />
		  <span class="alert">*</span></div>
			<div class="wordsLabel" id="nomMae">Nome da m&atilde;e:
			<input name="tfNomeMae" type="text" id="tfNomeMae" size="100" maxlength="100" onkeyup="javascript: validarForm('tfNomeMae');" onkeydown="javascript: setaFoco(this, event);" />
		  <span class="alert">*</span></div>
		  <div id="nomConj" class="wordsLabel">Nome do c&ocirc;njuge:
		  <input name="tfNomeConj" type="text" id="tfNomeConj" size="100" maxlength="100" onkeyup="javascript: validarForm('tfNomeConj');" onkeydown="javascript: setaFoco(this, event);" />
		  </div>
	
		  <div id="end">
			<div class="wordsLabel" id="endUF">UF:
				<select name="slEndUF" id="slEndUF" onchange="javascript: getCityes('slUFEnd', 'slCidade');" onkeydown="javascript: setaFoco(this, event);" >
				  <option selected="selected" value="---">---</option>
				  <?php
					$result = $connect->execute("SELECT uf FROM tb_estados");
					while($row = mysql_fetch_assoc($result)) {
						echo("<option value=".$row["uf"].">".$row["uf"]."</option>");
					}
				?>
			  </select>
			<span class="alert">*</span></div>
				<div class="wordsLabel" id="endCid">Cidade:
				<select name="slEndCida" id="slEndCida" onkeydown="javascript: setaFoco(this, event);" >
				  <option value="---" selected="selected">----------------------------</option>
				</select>
			<span class="alert">*</span>			</div><div class="wordsLabel" id="endCep">Cep:
				<input name="tfEndCEP" type="text" id="tfEndCEP" size="9" maxlength="9" onkeyup="javascript: validarForm('tfEndCEP');" onkeydown="javascript: setaFoco(this, event);" />
				<span class="alert">*</span>			</div>
				<div class="wordsLabel" id="endBai">Bairro: 
				<input name="tfEndBairro" type="text" id="tfEndBairro" size="40" maxlength="60" onkeyup="javascript: getSource('getBairro','tfBairro');" onblur="javascript: hideAutoComplete(300);" onkeydown="javascript: setaFoco(this, event);" />
			<span class="alert">*</span>		</div>
			<div class="wordsLabel" id="endTPL">Tipo de logradouro: 
			  <input name="tfEndTipLog" type="text" id="tfEndTipLog" size="40" maxlength="50" onkeyup="javascript: getSource('getLogradouro','tfTipoLog');" onblur="javascript: hideAutoComplete(300);"  autocomplete="off" onkeydown="javascript: setaFoco(this, event);" />
			<span class="alert">*</span>        </div>
		  <div class="wordsLabel" id="endEnd">Endere&ccedil;o: 
			  <input name="tfEndereco" type="text" id="tfEndereco" size="100" maxlength="150" onkeydown="javascript: setaFoco(this, event);" onkeyup="javascript: getSource('getEndereco','tfEndereco');" onblur="javascript: hideAutoComplete(300);"  autocomplete="off"/>
			<span class="alert">*</span>	    </div>
			<div id="endInv" class="invisible">
			  <input name="tfEndID" type="text" id="tfEndID" size="2" maxlength="25" onkeyup="javascript: validarForm('tfEndID');" onkeydown="javascript: setaFoco(this, event);" />
			</div>
			<div class="wordsLabel" id="numCas">Número: 
		  <input name="tfEndNumCas" type="text" id="tfEndNumCas" size="10" maxlength="10" onkeyup="javascript: validarForm('tfEndNumCas');" onkeydown="javascript: setaFoco(this, event);" />
		  <span class="alert">*</span>	</div>
		<div class="wordsLabel" id="quadra">Quadra: 
		  <input name="tfEndQuad" type="text" id="tfEndQuad" size="10" maxlength="10" onkeyup="javascript: validarForm('tfEndQuad');" onkeydown="javascript: setaFoco(this, event);" />
		</div>
		<div class="wordsLabel" id="fone">Fone: 
		  <input name="tfEndFone" type="text" id="tfEndFone" size="15" maxlength="12" onkeyup="javascript: validarForm('tfEndFone');" onkeydown="javascript: setaFoco(this, event);" />
		  <span class="alert">*</span>	</div>
		<div class="wordsLabel" id="redDesMes">Reside desde: 
		  <select name="slEndResDesMes" id="slEndResDesMes" onkeydown="javascript: setaFoco(this, event);" >
		  <option value="---">-------------</option>
		  <option value="1">janeiro</option>
		  <option value="2">fevereiro</option>
		  <option value="3">mar&ccedil;o</option>
		  <option value="4">abril</option>
		  <option value="5">maio</option>
		  <option value="6">junho</option>
		  <option value="7">julho</option>
		  <option value="8">agosto</option>
		  <option value="9">setembro</option>
		  <option value="10">outubro</option>
		  <option value="11">novembro</option>
		  <option value="12">dezembro</option>
		  </select>
	</div>
		<div class="wordsLabel" id="redDesAno">/
		  <input name="tfEndResDesAno" type="text" id="tfEndResDesAno" size="7" maxlength="4" onkeyup="javascript: validarForm('tfEndResDesAno');" onkeydown="javascript: setaFoco(this, event);" />
		</div>
		</div>
		<div id="cartAbilit">
		  <div class="wordsLabel" id="cartAbilitVal">Carteira de habilitação: 
			  <input name="tfCartAbilit" type="text" id="tfCartAbilit" size="50" maxlength="50" onkeyup="javascript: validarForm('tfCartAbilit');" onkeydown="javascript: setaFoco(this, event);" />
		  </div>
		  <div class="wordsLabel" id="cartAbilitCat">Categoria: 
			<select name="slCartAbilitCat" id="slCartAbilitCat" onkeydown="javascript: setaFoco(this, event);" >
			  <option value="---">----</option>
			    <?php
					$result = $connect->execute("SELECT * FROM categoria");
					while($row = mysql_fetch_assoc($result)) {
						echo("<option value=".$row["cat_categoria"].">".$row["cat_categoria"]."</option>");
					}
				?>
		  </select></div>
		</div>
		<div id="regProf">
			<div class="wordsLabel" id="regProfVal">Registro profissional: 
			  <input name="tfRegProf" type="text" id="tfCartAbilitVal" size="33" maxlength="30" onkeyup="javascript: validarForm('tfRegProf');" onkeydown="javascript: setaFoco(this, event);" />
		  </div>
			<div class="wordsLabel" id="regProfSig">Sigla: 
			  <input name="tfRegProfSigla" type="text" id="tfRegProfSigla" size="5" maxlength="5" onkeyup="javascript: validarForm('tfRegProfSigla');" onkeydown="javascript: setaFoco(this, event);" />
		  </div>
			<div class="wordsLabel" id="regProfReg">Região: 
			  <input name="tfRegProfRegi" type="text" id="tfRegProfRegi" size="10" maxlength="10" onkeyup="javascript: validarForm('tfRegProfRegi');" onkeydown="javascript: setaFoco(this, event);" />
		  </div>
		</div>
		<div id="grauInst">
		  <div class="wordsLabel" id="grauInstVal">Grau de instru&ccedil;&atilde;o:
				<select name="slGrauInst" id="slGrauInst" onkeydown="javascript: setaFoco(this, event);" >
			  <option value="---" selected="selected">----</option>
			  <option value="1">Sem forma&ccedil;&atilde;o</option>
			  <option value="2">Fundamental</option>
			  <option value="3">M&eacute;dio</option>
			  <option value="4">Superior</option>
			  <option value="5">Mestre</option>
			  <option value="6">Doutor</option>
			  <option value="7">PHD</option>
		  </select>
		  <span class="alert">*</span>	  </div>
			<div class="wordsLabel" id="grauInstNiv">Forma&ccedil;&atilde;o: 
			<input name="tfFormac" type="text" id="tfFormac" size="50" maxlength="50" onkeyup="javascript: validarForm('tfFormac');" onkeydown="javascript: setaFoco(this, event);" />
		  <span class="alert">*</span>	  </div>
		</div>
		<div id="banco">
			<div class="wordsLabel" id="bancoVal">Banco: 
			  <input name="tfBanc" type="text" id="tfCartAbilitVal" size="33" maxlength="30" onkeyup="javascript: validarForm('tfCartAbilitVal');" onkeydown="javascript: setaFoco(this, event);" />
		  </div>
			<div class="wordsLabel" id="bancoAge">Ag&ecirc;ncia: 
			  <input name="tfBancAgen" type="text" id="tfBancAgen" size="10" maxlength="15" onkeyup="javascript: validarForm('tfBancAgen');" onkeydown="javascript: setaFoco(this, event);" />
		  </div>
			<div class="wordsLabel" id="bancoCon">Conta: 
			  <input name="tfBancCont" type="text" id="tfBancCont" size="10" maxlength="15" onkeyup="javascript: validarForm('tfBancCont');" onkeydown="javascript: setaFoco(this, event);" />
		  </div>
		</div>
		<div id="certCivil">
			<div class="wordsLabel" id="certCivilVal">Certidão civil: 
			  <input name="tfCertCiv" type="text" id="tfCartAbilitVal" size="10" maxlength="10" onkeyup="javascript: validarForm('tfCertCiv');" onkeydown="javascript: setaFoco(this, event);" />
		  </div>
			<div class="wordsLabel" id="certCivilTerNum">Termo N°: 
			  <input name="tfCertCivTermo" type="text" id="tfCertCivTermo" size="10" maxlength="10" onkeyup="javascript: validarForm('tfCertCivTermo');" onkeydown="javascript: setaFoco(this, event);" />
		  </div>
			<div class="wordsLabel" id="certCivilFol">Folha: 
			  <input name="tfCertCivFolha" type="text" id="tfCertCivFolha" size="10" maxlength="10" onkeyup="javascript: validarForm('tfCertCivFolha');" onkeydown="javascript: setaFoco(this, event);" />
		  </div>
			<div class="wordsLabel" id="certCivilLiv">Livro: 
			  <input name="tfCertCivLivro" type="text" id="tfCertCivLivro" size="10" maxlength="10" onkeyup="javascript: validarForm('tfCertCivLivro');" onkeydown="javascript: setaFoco(this, event);" />
		  </div>
		</div>
		  <div class="wordsLabel" id="vincFund">V&iacute;nculo com a funda&ccedil;&atilde;o: 
			  <input name="tfVincFund" type="text" id="tfVincFund" size="50" maxlength="50" onkeyup="javascript: validarForm('tfVincFund');" onkeydown="javascript: setaFoco(this, event);" />
		  <span class="alert">*</span>	  </div>
		  <div class="wordsLabel" id="origCesDisp">Origem com a cess&atilde;o/disposi&ccedil;&atilde;o: 
			  <input name="tfDispos" type="text" id="tfDispos" size="50" maxlength="50" onkeyup="javascript: validarForm('tfDispos');" onkeydown="javascript: setaFoco(this, event);" />
		  <span class="alert">*</span>	  </div>
		  <div class="wordsLabel" id="cargContra">Cargo contratado: 
			  <input name="tfCargCont" type="text" id="tfCargCont" size="50" maxlength="50" onkeyup="javascript: validarForm('tfCargCont');" onkeydown="javascript: setaFoco(this, event);" />
		  <span class="alert">*</span>	  </div>
		  <div class="wordsLabel" id="funcExer">Fun&ccedil;&atilde;o que exerce : 
			  <input name="tfFuncExer" type="text" id="tfFuncExer" size="50" maxlength="50" onkeyup="javascript: validarForm('tfFuncExer');" onkeydown="javascript: setaFoco(this, event);" />
		  <span class="alert">*</span>	  </div>
		  <div id="local">
			<div class="wordsLabel" id="localUni">Local/Unidade: 
			  <input name="tfUnid" type="text" id="tfCartAbilitVal" size="33" maxlength="30" onkeyup="javascript: validarForm('tfUnid');" onkeydown="javascript: setaFoco(this, event);" />
			<span class="alert">*</span>	  </div>
			<div class="wordsLabel" id="localMicro">Micro &aacute;rea : 
			  <input name="tfUnidMicAre" type="text" id="tfUnidMicAre" size="10" maxlength="15" onkeyup="javascript: validarForm('tfUnidMicAre');" onkeydown="javascript: setaFoco(this, event);" />
		  </div>
			<div class="wordsLabel" id="localEquip">Equip&eacute; PSF : 
			  <input name="tfUnidPSF" type="text" id="tfUnidPSF" size="10" maxlength="15" onkeyup="javascript: validarForm('tfUnidPSF');" onkeydown="javascript: setaFoco(this, event);" />
		  </div>
		</div>
		<div id="botao">
		  <input name="btCad" type="submit" id="btCad" value="Cadastrar" />
		</div>
		</form>
	</body>
</html>