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
		   @import url("css/admin.css");
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
		</script>
</head>
	
<body>
	<div id="loading">	</div>
	<div id="autoComplete" class="words3">	</div>
	<form id="form1" name="form1" method="post" action="">
	<table width="100%" border="0" cellpadding="0" cellspacing="1" class="wordsLabel">
	  <tr>
		<td colspan="8">Nome:
		      <input name="tfNome" type="text" id="tfNome" size="100" maxlength="100" />
		      <span class="alert">*	    </span></td>
	  </tr>
	  <tr>
		<td colspan="2" >Carteira de trabalho:
		  <label>
		  <input name="tfCartTrab" type="text" id="tfCartTrab" size="25" maxlength="25" />
	    </label></td>
		<td colspan="2">S&eacute;rie: 
		  <label>
		  <input name="tfSerie" type="text" id="tfSerie" size="10" maxlength="10" />
	    </label></td>
		<td colspan="2">UF: 
		  <label>
		  <select name="lmUF" id="lmUF">
		    <option selected="selected" value="---">---</option>
			<?php
				$result = $connect->execute("SELECT uf FROM tb_estados");
				while($row = mysql_fetch_assoc($result)) {
					echo("<option value=".$row["uf"].">".$row["uf"]."</option>");
				}
			?>
	      </select>
	    </label></td>
		<td colspan="2">Data de emiss&atilde;o: 
		  <label>
		  <input name="tfDatEmisCartTrab" type="text" id="tfDatEmisCartTrab" size="10" maxlength="10" />
	    <span class="alert">	    ex: 14/04/1988</span></label></td>
	  </tr>
	  <tr>
		<td colspan="2">Sexo: 
		  <label>
		  <select name="slSexo" id="slSexo" onchange="javascript: showReference('slSexo','CartRes','M');">
		    <option value="---" selected="selected">-----------</option>
		    <option value="M">Masculino</option>
		    <option value="F">Feminino</option>
	      </select>
        <span class="alert">* </span></label></td>
		<td colspan="2">Estado civil: 
		  <label>
		  <select name="slEstadCis" id="slEstadCis" onchange="javascript: showReference('slEstadCis','nomConj','C:V');">
		    <option value="---" selected="selected">--------------</option>
		    <option value="S">Solteiro&ordf;</option>
		    <option value="C">Casado&ordf;</option>
		    <option value="D">Divorciado&ordf;</option>
		    <option value="V">Vi&uacute;vo&ordf;</option>
	      </select>
        <span class="alert">* </span></label></td>
		<td width="4%">&nbsp;</td>
		<td width="20%">&nbsp;</td>
		<td width="5%">&nbsp;</td>
		<td width="18%">&nbsp;</td>
	  </tr>
	  <!-- RESERVISTA -->
	  <tr id="CartRes" class="invisible">
		<td colspan="2">Carteira de reservista: 
		  <label>
		  <input name="txCartRes" type="text" id="txCartRes" size="25" maxlength="25" />
        <span class="alert">* </span></label></td>
		<td colspan="2">CSM: 
		  <label>
		  <input name="tfCSM" type="text" id="tfCSM" size="15" maxlength="15" />
	    </label></td>
		<td colspan="2">RM:
          <label>
          <input name="tfRM" type="text" id="tfRM" size="15" maxlength="15" />
          </label></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	  </tr><!-- RESERVISTA -->
	  <tr>
		<td colspan="2">PIS/PASEP (NIT): 
		  <label>
		  <input name="tfNIT" type="text" id="tfNIT" size="20" maxlength="20" />
	      <span class="alert">*</span></label></td>
		<td colspan="4">Data de emiss&atilde;o:
          <label>
          <input name="tfDatEmisNIT" type="text" id="tfDatEmisNIT" size="10" maxlength="10" />
          <span class="alert"> ex: 14/04/1988</span></label></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	  </tr>
	  <tr>
		<td colspan="4">CPF: 
		  <label>
		  <input name="tfCPF" type="text" id="tfCPF" size="14" maxlength="14" />
	    <span class="alert">	    * ex: XXX.XXX.XXX-XX </span></label></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	  </tr>
	  <tr>
		<td colspan="3">RG: 
		  <label>
		  <input name="tfRG" type="text" id="tfRG" size="20" maxlength="20" />
	      <span class="alert">*</span></label></td>
		<td colspan="3">Org&atilde;o expedidor: 
		  <label>
		  <input name="tfOrgExep" type="text" id="tfOrgExep" size="20" maxlength="20" />
	      <span class="alert">*</span></label></td>
		<td colspan="2">Data de emiss&atilde;o:
          <label>
          <input name="tfDatEmisRG" type="text" id="tfDatEmisRG" size="10" maxlength="10" />
          <span class="alert"> ex: 14/04/1988</span></label></td>
	  </tr>
	  <tr>
		<td colspan="2">T&iacute;tulo eleitoral: 
		  <label>
		  <input name="tfTitEleit" type="text" id="tfTitEleit" size="15" maxlength="15" />
	      <span class="alert">*</span></label></td>
		<td colspan="2">Zona/Se&ccedil;&atilde;o: 
		  <label>
		  <input name="tfZonSec" type="text" id="tfZonSec" size="8" maxlength="8" />
	      <span class="alert">*</span></label></td>
		<td colspan="2">UF:
          <label>
          <select name="slUFTitEleit" id="slUFTitEleit">
            <option selected="selected" value="---">---</option>
            <?php
				$result = $connect->execute("SELECT uf FROM tb_estados");
				while($row = mysql_fetch_assoc($result)) {
					echo("<option value=".$row["uf"].">".$row["uf"]."</option>");
				}
			?>
          </select>
          <span class="alert">*</span></label></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	  </tr>
	  <tr>
		<td width="7%">&nbsp;</td>
		<td width="22%">&nbsp;</td>
		<td width="11%">&nbsp;</td>
		<td width="13%">&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	  </tr>
	  <tr>
		<td colspan="2">Data de nascimento:  
		  <label>
          <input name="tfDatNasc" type="text" id="tfDatNasc" size="10" maxlength="10" />
        <span class="alert">*</span>           <span class="alert"> ex: 14/04/1988</span></label></td>
		<td colspan="2">UF:
          <label>
          <select name="slUFDatNasc" id="slUFDatNasc" onchange="javascript: getCityes('slUFDatNasc', 'slNatural');">
            <option selected="selected" value="---">---</option>
            <?php
				$result = $connect->execute("SELECT uf FROM tb_estados");
				while($row = mysql_fetch_assoc($result)) {
					echo("<option value=".$row["uf"].">".$row["uf"]."</option>");
				}
			?>
          </select>
          <span class="alert">*</span></label></td>
		<td colspan="4">Naturalidade: 
		  <label>
		  <select name="slNatural" id="slNatural">
		    <option value="---" selected="selected">----------------------------</option>
	      </select>
	      <span class="alert">*</span></label></td>
	  </tr>
	  <tr>
		<td colspan="8">Nome do pai: 
	    <input name="tfNomePai" type="text" id="tfNomePai" size="100" maxlength="100" />
	    <span class="alert">*</span></td>
	  </tr>
	  <tr>
		<td colspan="8">Nome da m&atilde;e:
        <input name="tfNomeMae" type="text" id="tfNomeMae" size="100" maxlength="100" />
        <span class="alert">*</span></td>
	  </tr>
	  <tr id="nomConj" class="invisible">
		<td colspan="8">Nome do c&ocirc;njuge:
        <input name="tfNomeConj" type="text" id="tfNomeConj" size="100" maxlength="100" /></td>
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
		<td height="17">&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
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
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	  </tr>
    </table>
	</form>
</body>
</html>
