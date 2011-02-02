<?php
	include("cadTecnicoInclude.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link href="../../scripts/css/geral.css" rel="stylesheet" type="text/css" />
		<link href="../../scripts/css/tecnico.css" rel="stylesheet" type="text/css" />
		
		<script type="text/javascript" language="javascript" src="../../scripts/javascript/funcoes.js"></script>
		<script type="text/javascript" language="javascript" src="../../scripts/javascript/tecnico.js"></script>
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
		<form id="cadastrar" name="cadastrar" method="post" action="cadTecnico.php?cadastrar=sim" onsubmit="javascript: return validarCadastro();">
			<div id="cadTecPes">
			  <div class="texto3" id="cadTecPesNom">Nome: <input name="tfNom" type="text" class="textField1" id="tfNom" size="75" maxlength="150" onkeyup="javascript: validarForm('tfNom');" /></div>
			  <div class="texto3" id="cadTecPesRG">RG: 
		      <input name="tfRG" type="text" class="textField1" id="tfRG" size="30" maxlength="30" onkeyup="javascript: validarForm('tfRG');"/>
			  </div>
		      <div class="texto3" id="cadTecPesCPF">CPF: 
		      <input name="tfCPF" type="text" class="textField1" id="tfCPF" size="30" maxlength="14" onkeyup="javascript: validarForm('tfCPF');"/>
			  </div>
		  </div>
		  <div id="cadTecTel">
		  	<div class="texto3" id="cadTecTelNum">Telefone: 
	  	    <input name="tfFonNum" type="text" class="textField1" id="tfFonNum" size="30" maxlength="12" onkeyup="javascript: validarForm('tfFonNum');"/>
		  	</div>
			  <div class="texto3" id="cadTecTelNot">Nota: 
		      <input name="tfFonNot" type="text" class="textField1" id="tfFonNot" size="30" maxlength="30" onkeyup="javascript: validarForm('tfFonNot');"/>
		    </div>
		  </div>
		  <div id="cadTecEml">
		  	<div class="texto3" id="cadTecEmlURL">Email: <input name="tfEmlURL" type="text" class="textField1" id="tfEmlURL" size="30" maxlength="50" onkeyup="javascript: validarForm('tfEmlURL');"/>
		  	</div>
			  <div class="texto3" id="cadTecEmlNot">Nota: 
		      <input name="tfEmlNot" type="text" class="textField1" id="tfEmlNot" size="30" maxlength="50" onkeyup="javascript: validarForm('tfEmlNot');"/>
		    </div>
		  </div>
		  <div id="cadTec">
			  <div class="texto3" id="cadTecCla">Classe:
			    <select name="slCla" class="textField1" id="slCla">
					<?php
							include($toRoot."utils/getClasseSL.php");
					  ?>
		        </select>
			</div>
			  <div class="texto3" id="cadTecDes">Descri&ccedil;&atilde;o: 
		        <input name="tfDes" type="text" class="textField1" id="tfDes" size="50" maxlength="50" onkeyup="javascript: validarForm('tfDes');"/>
		    </div>
		  </div>
		  <div id="cadTecBut">
	      <input name="btCad" type="submit" class="botao2" id="btCad" value="Cadastrar" /></div>
		</form>
	</body>
</html>
