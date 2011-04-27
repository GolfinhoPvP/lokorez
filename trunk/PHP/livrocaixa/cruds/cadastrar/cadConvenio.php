<?php
	include("cadConvenioInclude.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link href="../../scripts/css/geral.css" rel="stylesheet" type="text/css" />
		<link href="../../scripts/css/convenio.css" rel="stylesheet" type="text/css" />
		
		<script type="text/javascript" language="javascript" src="../../scripts/javascript/funcoes.js"></script>
		<script type="text/javascript" language="javascript" src="../../scripts/javascript/convenio.js"></script>
		<script type="text/javascript" language="javascript">
			window.onload = function(){
				alternar();
			}
		</script>
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
		<div id="cadCliGer">
		<form id="cadastrar" name="cadastrar" method="post" action="cadConvenio.php?cadastrar=sim" onsubmit="javascript: return validarCadastro();">
		  <div id="cadCliPes">
		  	<div id="cadCli">
			  <div class="texto3" id="cadCliNomUsu">Descri&ccedil;a&otilde; do conv&ecirc;nio: 
	            <input name="tfNomUsu" type="text" class="textField1" id="tfNomUsu" size="75" maxlength="150" onkeyup="javascript: validarForm('tfNomUsu');"/>
		    </div>
		    </div>
			  <div class="texto3" id="cadCliPesNom">Nome: 
		      <input name="tfNom" type="text" class="textField1" id="tfNom" size="75" maxlength="150" onkeyup="javascript: validarForm('tfNom');" /></div>
			  <div class="texto3" id="cadCliPesRG">RG: 
		      <input name="tfRG" type="text" class="textField1" id="tfRG" size="30" maxlength="30" onkeyup="javascript: validarForm('tfRG');"/>
			  </div>
		      <div class="texto3" id="cadCliPesCPF">CPF: 
		      <input name="tfCPF" type="text" class="textField1" id="tfCPF" size="30" maxlength="14" onkeyup="javascript: validarForm('tfCPF');"/>
			  </div>
		  </div>
		  <div id="cadCliTel">
		  	<div class="texto3" id="cadCliTelNum">Telefone: 
	  	    <input name="tfFonNum" type="text" class="textField1" id="tfFonNum" size="30" maxlength="12" onkeyup="javascript: validarForm('tfFonNum');"/>
		  	</div>
			  <div class="texto3" id="cadCliTelNot">Nota: 
		      <input name="tfFonNot" type="text" class="textField1" id="tfFonNot" size="30" maxlength="30" onkeyup="javascript: validarForm('tfFonNot');"/>
		    </div>
		  </div>
		  <div id="cadCliEml">
		  	<div class="texto3" id="cadCliEmlURL">Email: <input name="tfEmlURL" type="text" class="textField1" id="tfEmlURL" size="30" maxlength="50" onkeyup="javascript: validarForm('tfEmlURL');"/>
		  	</div>
			  <div class="texto3" id="cadCliEmlNot">Nota: 
		      <input name="tfEmlNot" type="text" class="textField1" id="tfEmlNot" onkeyup="javascript: validarForm('tfEmlNot');" size="30" maxlength="50"/>
		    </div>
		  </div>
		  <div id="cadCliBut">
	      <input name="btCad" type="submit" class="botao2" id="btCad" value="Cadastrar" /></div>
		</form>
	</div>
	</body>
</html>
