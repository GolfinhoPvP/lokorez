<?php
	require_once("utils/Connect.class.php");
	include_once("beans/Variables.class.php");
	
	$variables = new Variables();
	$connect = new Connect($variables->dbHost, $variables->dbUser, $variables->dbPassword, $variables->dbName);
	$connect->start();
	
	session_start();
	
	if((isset($_SESSION["usuario"]) == NULL) && (isset($_SESSION["senha"]) == NULL) && (isset($_SESSION["nivel"]) > 2)){
		header("Location: admin.php");
		die();
	}
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
		<script language="javascript" type="text/javascript">
			function showReference(id1, id2, val){
				valList = val.split(":");
				for(x=0; x<valList.length; x++){
					if(document.getElementById(id1).value == valList[x]){
						document.getElementById(id2).className = "visible";
						break;
					}else{
						document.getElementById(id2).className = "invisible";
					}
				}
			}
			function getCityes(from, to){
				loadContent("utils/getCityes.php?uf="+document.getElementById(from).value, to);
			}
			function hideAutoComplete(time){
				setTimeout("document.getElementById('autoComplete').style.visibility = 'hidden'",time);
			}
			function getSource(source, target){
				text = document.getElementById(target).value;
				if(((text.length % 3) == 0) || target == "slCidade"  || target == "slUFEnd"){
					div = document.getElementById("autoComplete");
					t = document.getElementById(target);
					div.style.top =  (findPosY(t)+3)+"px";
					div.style.left = (findPosX(t)+2)+"px";
					div.style.visibility = "visible";
					uf = document.getElementById("slUFEnd").value;
					cep = document.getElementById("tfCEP").length < 10 ? "%" : document.getElementById("tfCEP").value;
					bairro = urlencode(document.getElementById("tfBairro").value);
					logradouro = urlencode(document.getElementById("tfTipoLog").value);
					cidade = urlencode(document.getElementById("slCidade").value);
					
					loadContent("utils/"+source+".php?uf="+uf+"&cep="+cep+"&cidade="+cidade+"&bairro="+bairro+"&logradouro="+logradouro+"&text="+text, "autoComplete");
				}
			}
			function setLogradouto(id, target){
				document.getElementById(target).value = document.getElementById(id).innerHTML;
				document.getElementById("tfEndID").value = id;
				hideAutoComplete(0);
			}
			function setaFoco(elemento, e)  {
				var evento 	= (window.event) ? event : e;
				var keyCode = evento.keyCode ? evento.keyCode : evento.which ? evento.which : evento.charCode;
				if (keyCode == 13) {  
					var i;  
					for (i = 0; i < elemento.form.elements.length; i++)  
						if (elemento == elemento.form.elements[i])  
							break;  
					i = (i + 1) % elemento.form.elements.length;  
					elemento.form.elements[i].focus();  
					evento.preventDefault();  
					return false;  
				}  
				return false;  
			}
		</script>
</head>
	
<body>
	<div id="loading">	</div>
	<div id="autoComplete" class="words3">	</div>
	<form id="form1" name="form1" method="post" action="">
		<div class="wordsLabel" id="nome">Nome:
		     <input name="tfNome" type="text" id="tfNome" size="100" maxlength="100" onkeydown="javascript: setaFoco(this, event);" />
	     	<span class="alert">*</span>
	  </div>
		 <div id="cartTrab">
		 	<div class="wordsLabel" id="cartTrabVal">Carteira de trabalho:
		  		<input name="tfCartTrab" type="text" id="tfCartTrab" size="45" maxlength="50" onkeydown="javascript: setaFoco(this, event);" />
			</div>
			<div class="wordsLabel" id="cartTrabSer">S&eacute;rie: 
		  		<input name="tfSerie" type="text" id="tfSerie" size="10" maxlength="10" onkeydown="javascript: setaFoco(this, event);" />
			</div>
			<div class="wordsLabel" id="cartTrabUF">UF: 
			  <select name="lmUF" id="lmUF" onkeydown="javascript: setaFoco(this, event);">
				<option selected="selected" value="---">---</option>
				<?php
					$result = $connect->execute("SELECT uf FROM tb_estados");
					while($row = mysql_fetch_assoc($result)) {
						echo("<option value=".$row["uf"].">".$row["uf"]."</option>");
					}
				?>
			  </select>
		   </div>
			<div class="wordsLabel" id="cartTrabDat">Data de emiss&atilde;o: 
				  <input name="tfDatEmisCartTrab" type="text" id="tfDatEmisCartTrab" size="10" maxlength="10" onkeydown="javascript: setaFoco(this, event);" />
				<span class="alert">	    ex: 14/04/1988</span>			</div>
		</div>
		<div id="pes">
			<div class="wordsLabel" id="pesSex">
			  Sexo:
			  <select name="slSexo" id="slSexo" onchange="javascript: showReference('slSexo','CartRes','M');">
				<option value="---" selected="selected">-----------</option>
				<option value="M">Masculino</option>
				<option value="F">Feminino</option>
			  </select>
			<span class="alert">* </span>
		  </div>
			<div class="wordsLabel" id="pesEstCiv">
			  Estado civil: 
			  <select name="slEstadCis" id="slEstadCis" onchange="javascript: showReference('slEstadCis','nomConj','C:V');">
				<option value="---" selected="selected">--------------</option>
				<option value="S">Solteiro&ordf;</option>
				<option value="C">Casado&ordf;</option>
				<option value="D">Divorciado&ordf;</option>
				<option value="V">Vi&uacute;vo&ordf;</option>
			  </select>
			<span class="alert">* </span>
		  </div>
	  </div>
	  
	  <!-- RESERVISTA -->
	  <div id="CartRes" class="visible">
		<div class="wordsLabel" id="CartResVal">Carteira de reservista: 
		  <input name="txCartRes" type="text" id="txCartRes" size="25" maxlength="25" />
        <span class="alert">* </span></div>
		<div class="wordsLabel" id="CartResCSM">CSM: 
		  <input name="tfCSM" type="text" id="tfCSM" size="15" maxlength="15" />
	    </div>
		<div class="wordsLabel" id="CartResRM">RM:
          <input name="tfRM" type="text" id="tfRM" size="15" maxlength="15" />
        </div>
	  </div>
	  <!-- RESERVISTA -->
	  <div id="pisPasep" >
		<div class="wordsLabel" id="pisPasepVal" >PIS/PASEP (NIT): 
		  <input name="tfNIT" type="text" id="tfNIT" size="20" maxlength="20" />
        <span class="alert">*</span></div>
		<div class="wordsLabel" id="pisPasepDat" >Data de emiss&atilde;o:
          <input name="tfDatEmisNIT" type="text" id="tfDatEmisNIT" size="10" maxlength="10" />
        <span class="alert"> ex: 14/04/1988</span></div>
	  </div>
	  <div id="docs" >
		<div class="wordsLabel" id="docsCPF">CPF: 
		  <input name="tfCPF" type="text" id="tfCPF" size="14" maxlength="14" />
	    <span class="alert">	    * ex: XXX.XXX.XXX-XX </span></div>
		<div class="wordsLabel" id="docsRG">RG: 
	    <input name="tfRG" type="text" id="tfRG" size="20" maxlength="20" /></div>
		<div class="wordsLabel" id="docsOrgExp">Org&atilde;o expedidor: 
		  <input name="tfOrgExep" type="text" id="tfOrgExep" size="20" maxlength="20" />
        <span class="alert">*</span></div>
		<div class="wordsLabel" id="docsDat">Data de emiss&atilde;o:
        <input name="tfDatEmisRG" type="text" id="tfDatEmisRG" size="10" maxlength="10" /><span class="alert"> ex: 14/04/1988</span></div>
	  </div>
		<div id="titEle">
			<div class="wordsLabel" id="titEleVal">T&iacute;tulo eleitoral: <input name="tfTitEleit" type="text" id="tfTitEleit" size="15" maxlength="15" />
	      <span class="alert">*</span></div>
			<div class="wordsLabel" id="titEleZon">Zona/Se&ccedil;&atilde;o: <input name="tfZonSec" type="text" id="tfZonSec" size="8" maxlength="8" />
	      <span class="alert">*</span></div>
		<div class="wordsLabel" id="titEleUF">UF:
          <select name="slUFTitEleit" id="slUFTitEleit">
            <option selected="selected" value="---">---</option>
            <?php
				$result = $connect->execute("SELECT uf FROM tb_estados");
				while($row = mysql_fetch_assoc($result)) {
					echo("<option value=".$row["uf"].">".$row["uf"]."</option>");
				}
			?>
          </select>
          <span class="alert">*</span></div>
	  </div>
		<div id="nat">
		  <div class="wordsLabel" id="natDat">Data de nascimento:  
          <input name="tfDatNasc" type="text" id="tfDatNasc" size="10" maxlength="10" />
        <span class="alert">* ex: 14/04/1988</span></div>
		<div class="wordsLabel" id="natUF">UF:
          <select name="slUFDatNasc" id="slUFDatNasc" onchange="javascript: getCityes('slUFDatNasc', 'slNatural');">
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
		  <select name="slNatural" id="slNatural">
		    <option value="---" selected="selected">----------------------------</option>
	      </select>
	      <span class="alert">*</span></div>
	  </div>
		<div class="wordsLabel" id="nomPai">Nome do pai: 
	    <input name="tfNomePai" type="text" id="tfNomePai" size="100" maxlength="100" />
      <span class="alert">*</span></div>
		<div class="wordsLabel" id="nomMae">Nome da m&atilde;e:
        <input name="tfNomeMae" type="text" id="tfNomeMae" size="100" maxlength="100" />
      <span class="alert">*</span></div>
	  </tr>
	  <div id="nomConj" class="wordsLabel">Nome do c&ocirc;njuge:
      <input name="tfNomeConj" type="text" id="tfNomeConj" size="100" maxlength="100" /></div>
	  </tr>
	  <tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	  </tr>
	  <tr>
		<td colspan="2"><label>UF:
            <select name="slUFEnd" id="slUFEnd" onchange="javascript: getCityes('slUFEnd', 'slCidade');">
              <option selected="selected" value="---">---</option>
              <?php
				$result = $connect->execute("SELECT uf FROM tb_estados");
				while($row = mysql_fetch_assoc($result)) {
					echo("<option value=".$row["uf"].">".$row["uf"]."</option>");
				}
			?>
            </select>
            <span class="alert">*</span></label></td>
		<td colspan="2"><label>Cidade:
            <select name="slCidade" id="slCidade">
              <option value="---" selected="selected">----------------------------</option>
            </select>
            <span class="alert">*</span></label></td>
		<td colspan="4"><label>Cep:
            <input name="tfCEP" type="text" id="tfCEP" size="9" maxlength="9" />
</label></td>
	  </tr>
	  <tr>
		<td colspan="4"><label>Bairro: 
		    <input name="tfBairro" type="text" id="tfBairro" size="40" maxlength="60" onkeyup="javascript: getSource('getBairro','tfBairro');" onblur="javascript: hideAutoComplete(300);"/>
		</label></td>
		<td colspan="4">Tipo de logradouro: 
		  <label>
          <input name="tfTipoLog" type="text" id="tfTipoLog" size="40" maxlength="50" onkeyup="javascript: getSource('getLogradouro','tfTipoLog');" onblur="javascript: hideAutoComplete(300);"  autocomplete="off"/>
          </label></td>
	  </tr>
	  <tr>
		<td colspan="6">Endere&ccedil;o: 
		  <label>
		  <input name="tfEnd" type="text" id="tfEnd" size="100" maxlength="150" onkeyup="javascript: getSource('getEndereco','tfEnd');" onblur="javascript: hideAutoComplete(300);"  autocomplete="off"/>
	    </label></td>
		<td colspan="2"><label class="invisible">
		  <input name="tfEndID" type="text" id="tfEndID" size="2" maxlength="25" />
		</label></td>
	  </tr>
	  <tr>
		<td colspan="8">&nbsp;</td>
	  </tr>
    </table>
	<div class="wordsLabel" id="numCas">Número: 
	  <input name="tfNumCas" type="text" id="tfNumCas" size="10" maxlength="10" />
	</div>
	<div class="wordsLabel" id="quadra">Quadra: 
	  <input name="tfQuadra" type="text" id="tfQuadra" size="10" maxlength="10" />
	</div>
	<div class="wordsLabel" id="fone">Fone: 
	  <input name="tfFone" type="text" id="tfFone" size="15" maxlength="12" />
	</div>
	<div class="wordsLabel" id="redDesMes">Reside desde: 
	  <select name="slResDesMes" id="slResDesMes">
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
	  <input name="tfResDesAno" type="text" id="tfResDesAno" size="7" maxlength="4" />
	</div>
	<div id="cartAbilit">
	  <div class="wordsLabel" id="cartAbilitVal">Carteira de habilitação: 
		  <input name="tfCartAbilitVal" type="text" id="tfCartAbilitVal" size="50" maxlength="50" />
	  </div>
	  <div class="wordsLabel" id="cartAbilitCat">Categoria: 
		<select name="slCartAbilitCat" id="slCartAbilitCat">
		  <option value="---">----</option>
		  <option value="1">A</option>
		  <option value="2">B</option>
		  <option value="3">AB</option>
		  <option value="4">C</option>
		  <option value="5">D</option>
		  <option value="6">E</option>
	    </select></div>
	</div>
	<div id="regProf">
		<div class="wordsLabel" id="regProfVal">Registro profissional: 
		  <input name="tfReg" type="text" id="tfCartAbilitVal" size="33" maxlength="30" />
	  </div>
		<div class="wordsLabel" id="regProfSig">Sigla: 
		  <input name="tfCartAbilitVal" type="text" id="tfCartAbilitVal" size="5" maxlength="5" />
		</div>
		<div class="wordsLabel" id="regProfReg">Região: 
		  <input name="tfCartAbilitVal" type="text" id="tfCartAbilitVal" size="10" maxlength="10" />
		</div>
	</div>
	<div id="grauInst">
	  <div class="wordsLabel" id="grauInstVal">Grau de instru&ccedil;&atilde;o: 
		  <input name="tfCartAbilitVal" type="text" id="tfCartAbilitVal" size="50" maxlength="50" />
	  </div>
		<div class="wordsLabel" id="grauInstNiv">Forma&ccedil;&atilde;o: 
		  <select name="slCartAbilitCat" id="slCartAbilitCat">
		  <option value="---" selected="selected">----</option>
		  <option value="1">Sem forma&ccedil;&atilde;o</option>
		  <option value="2">Fundamental</option>
		  <option value="3">M&eacute;dio</option>
		  <option value="4">Superior</option>
		  <option value="5">Mestre</option>
		  <option value="6">Doutor</option>
		  <option value="7">PHD</option>
          </select></div>
	</div>
	<div id="banco">
		<div class="wordsLabel" id="bancoVal">Banco: 
		  <input name="tfReg" type="text" id="tfCartAbilitVal" size="33" maxlength="30" />
	  </div>
		<div class="wordsLabel" id="bancoAge">Ag&ecirc;ncia: 
		  <input name="tfCartAbilitVal" type="text" id="tfCartAbilitVal" size="10" maxlength="15" />
	  </div>
		<div class="wordsLabel" id="bancoCon">Conta: 
		  <input name="tfCartAbilitVal" type="text" id="tfCartAbilitVal" size="10" maxlength="15" />
	  </div>
	</div>
	<div id="certCivil">
		<div class="wordsLabel" id="certCivilVal">Certidão civil: 
		  <input name="tfReg" type="text" id="tfCartAbilitVal" size="10" maxlength="10" />
	  </div>
		<div class="wordsLabel" id="certCivilTerNum">Termo N°: 
		  <input name="tfCartAbilitVal" type="text" id="tfCartAbilitVal" size="10" maxlength="10" />
	  </div>
		<div class="wordsLabel" id="certCivilFol">Folha: 
		  <input name="tfCartAbilitVal" type="text" id="tfCartAbilitVal" size="10" maxlength="10" />
	  </div>
		<div class="wordsLabel" id="certCivilLiv">Livro: 
		  <input name="tfCartAbilitVal" type="text" id="tfCartAbilitVal" size="10" maxlength="10" />
		</div>
	</div>
	  <div class="wordsLabel" id="vincFund">V&iacute;nculo com a funda&ccedil;&atilde;o: 
		  <input name="tfCartAbilitVal" type="text" id="tfCartAbilitVal" size="50" maxlength="50" />
	  </div>
	  <div class="wordsLabel" id="origCesDisp">Origem com a cess&atilde;o/disposi&ccedil;&atilde;o: 
		  <input name="tfCartAbilitVal" type="text" id="tfCartAbilitVal" size="50" maxlength="50" />
	  </div>
	  <div class="wordsLabel" id="cargContra">Cargo contratado: 
		  <input name="tfCartAbilitVal" type="text" id="tfCartAbilitVal" size="50" maxlength="50" />
	  </div>
	  <div class="wordsLabel" id="funcExer">Fun&ccedil;&atilde;o que exerce : 
		  <input name="tfCartAbilitVal" type="text" id="tfCartAbilitVal" size="50" maxlength="50" />
	  </div>
	  <div id="local">
		<div class="wordsLabel" id="localUni">Local/Unidade: 
		  <input name="tfReg" type="text" id="tfCartAbilitVal" size="33" maxlength="30" />
	  </div>
		<div class="wordsLabel" id="localMicro">Micro &aacute;rea : 
		  <input name="tfCartAbilitVal" type="text" id="tfCartAbilitVal" size="10" maxlength="15" />
	  </div>
		<div class="wordsLabel" id="localEquip">Equip&eacute; PSF : 
		  <input name="tfCartAbilitVal" type="text" id="tfCartAbilitVal" size="10" maxlength="15" />
	  </div>
	</div>
	</form>
</body>
</html>
