<?php
	require_once("utils/Connect.class.php");
	include_once("beans/Variables.class.php");
	
	$variables = new Variables();
	$connect = new Connect($variables->dbHost, $variables->dbUser, $variables->dbPassword, $variables->dbName);
	$connect->start();
	
	session_start();
	
	if((isset($_SESSION["usuario"]) == NULL) && (isset($_SESSION["senha"]) == NULL) && (isset($_SESSION["nivel"]) == NULL)){
		header("Location: admin.php");
		die();
	}
	
	if($_SESSION["nivel"] != 1){
		header("Location: admin.php");
		die();
	}
	
	$message = NULL;
	$msgVisibility	= "hidden";
	
	if(isset($_GET["dir"])){
		switch($_GET["dir"]){
			case "false" : $message = "Possivelmente a data que foi passada n�o � uma data v�lida, nada foi feito!";
							break;
			case "true" : $message = "O sistema est� pronto para receber as novas tabelas.";
							$_SESSION["dir"] = "true";
							break;
			case "yet" : $message = "Cuidado, estas tabelas possivelmente j� existem, continue as verifica��es.";
							$_SESSION["dir"] = "true";
							break;
							
			case "erro" : $message = "N�O INSERIDO - Valide primeiro a data das tabelas!!!";
							break;
		}
		$msgVisibility	= "visible";
	}
	
	if(isset($_GET["upl"])){
		switch($_GET["upl"]){
			case "true" : $message = "Arquivo upado com sucesso.";
							break;
			case "false" : $message = "Erro, arquivo n�o upado.";
							break;
			case "yet" : $message = "Ok, arquivo '".strtoupper($_GET["tab"]).".DBF' j� upado.";
							break;
		}
		$msgVisibility	= "visible";
	}
	
	if(isset($_GET["sigin"])){
		switch($_GET["sigin"]){
			case "true" : $message = "Novo usu�rio adicionado com sucesso!.";
							break;
			case "false" : $message = "Usu�rio n�o adicionado!!!.";
							break;
			case "yet" : $message = "Usu�rio j� adicionado!.";
							break;
		}
		$msgVisibility	= "visible";
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>FMS - Contracheque On-line</title>
		
		<style type="text/css">
		   @import url("css/general.css");
		   @import url("css/admin.css");
		</style>
		
		<script language="javascript" src="javascript/functions.js" type="text/javascript"></script>
		<script language="javascript" type="text/javascript">
			window.onload = function(){
				diff = ((screen.width - 950)/2);
				document.getElementById("userFrame").style.left = diff+"px";
		
				dir = upl = tab = null;
				
				var vars = new String(document.location.search);
				if(vars.length > 0){
					vars = vars.substr(1);
					list = vars.split("&");
					for(x=0; x < list.length; x++){
						listAux = list[x].split("=");
						eval(listAux[0]+" = '"+listAux[1]+"';");
					}
				}
				
				if(dir != null){
					tableShowManager("divBoxCadCalc", false);
				}else if(tab != null){
					if(tab == "dcr"){
						tableShowManager("divBoxDCR", false);
					}else if(tab == "dlt"){
						tableShowManager("divBoxDLT", false);
					}else if(tab == "especial"){
						tableShowManager("divBoxEspecial", false);
					}else if(tab == "eventos"){
						tableShowManager("divBoxEventos", false);
					}else if(tab == "folha"){
						tableShowManager("divBoxFolha", false);
					}else if(tab == "calculo" || tab == "cadastro"){
						tableShowManager("divBoxCadCalc", false);
					}
				}else{
					tableShowManager("divBoxData", false);
				}
			}
			
			function tableShowManager(t, n){
				if(document.getElementById("pMSG").innerHTML == "" || n == true){
					document.getElementById("divBoxMessageAdmin").style.visibility 	= "hidden";
				}
				document.getElementById("divBoxAddAdmin").style.visibility  	= "hidden";
				document.getElementById("divBoxData").style.visibility  		= "hidden";
				document.getElementById("divBoxDCR").style.visibility  			= "hidden";
				document.getElementById("divBoxDLT").style.visibility  			= "hidden";
				document.getElementById("divBoxEspecial").style.visibility  	= "hidden";
				document.getElementById("divBoxEventos").style.visibility  		= "hidden";
				document.getElementById("divBoxFolha").style.visibility  		= "hidden";
				document.getElementById("divBoxCadCalc").style.visibility  		= "hidden";
				
				document.getElementById(t).style.visibility  = "visible"
			}
		</script>
	</head>
	
	<body>
	<p align="center" class="wordsLabel2">Area do Administrador</p>
	<div id="userFrame">
<div id="divBoxData">
  <table width="825" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="74"><img src="images/box_l.png" /></td>
      <td width="558" background="images/box_c.png">
        <table width="100%" height="182">
          <tr>
            <td width="640"><p class="wordsLabel2">Confirme a data para valida&ccedil;&atilde;o das tabelas: </p>
                <p>
                  <span class="words1">Obs:. A data &eacute; muito importante, principalmente o m&ecirc;s e o ano,  que em hip&oacute;tese alguma podem estar errados!<br />
                  Obs:. O dia n&atilde;o &eacute; usado para efeito de c&aacute;lculos, por isso insignificante. </span></p>
              <form id="date" name="date" method="post" action="utils/DateVerifier.class.php" onsubmit="javascript: return dateVerifier('date')">
                  <label>
                  <select name="slDate" id="slDate">
				  	<option value="0" selected="selected">---</option>
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
                  de</label>
                  <input name="tfDate" type="text" id="tfDate" size="6" maxlength="4" onkeydown="javascript: return onlyNums('tfDate', event);"/>
                  
                  <label>
                  <input name="confirmDate" type="submit" id="confirmDate" value="Confirmar Data" />
                  </label>
              </form></td>
          </tr>
        </table>
      <br /></td>
      <td width="193"><img src="images/box_r.png" /></td>
    </tr>
  </table>
</div>

<div id="divBoxDCR">
  <table width="864" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="74"><img src="images/box_l.png" /></td>
      <td width="597" background="images/box_c.png">
        <table width="100%">
          <tr>
            <td><span class="wordsLabel2">Arquivo DCR.DBF </span><br />
              <br />
                <span class="words1">Caso o campo de busca for deixado em branco e o bot&atilde;o &quot;Enviar DCR&quot; seja pressionado, significa que a tabela j&aacute; foi inserida. <br />
                </span>
                <form id="dcr" name="dcr" enctype="multipart/form-data" method="post" action="utils/Uploader.class.php">
                  <span class="words1">
                  <label class="words2"> Enviar tabela DCR:</label>
                  </span>
                  <label>
                  <input name="archive" type="file" id="archive" size="50" />
                  <input name="table" type="text" id="table" style="visibility:hidden" value="dcr" size="5" maxlength="3"/>
                  </label>
                  <label>
                  <br />
                  <br />
                  <input name="submitDCR" type="submit" id="submitDCR" value="Enviar DCR" />
                  </label>
              </form></td>
          </tr>
        </table>
      <br /></td>
      <td width="193"><img src="images/box_r.png" /></td>
    </tr>
  </table>
</div>

<div id="divBoxDLT">
  <table width="863" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="74"><img src="images/box_l.png" /></td>
      <td width="596" background="images/box_c.png">
        <table width="100%">
          <tr>
            <td> <span class="wordsLabel2">Arquivo DLT.DBF </span><br />
              <br />
              <span class="words1">Caso o campo de busca for deixado em branco e o bot&atilde;o &quot;Enviar DLT &quot; seja pressionado, significa que a tabela j&aacute; foi inserida. </span><br />
                <form id="DLT" name="DLT" enctype="multipart/form-data" method="post" action="utils/Uploader.class.php">
                  <label> <span class="words1">Enviar tabela DLT:</span>
                  <input name="archive" type="file" id="archive" size="50" />
                  <input name="table" type="text" id="table" style="visibility:hidden" value="dlt" size="5" maxlength="3"/>
                  </label>
                  <label>
                  <br />
                  <br />
                  <input name="submitDLT" type="submit" id="submitDLT" value="Enviar DLT" />
                  </label>
              </form></td>
          </tr>
        </table>
      <br /></td>
      <td width="193"><img src="images/box_r.png" /></td>
    </tr>
  </table>
</div>

<div id="divBoxEspecial">
  <table width="867" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="74"><img src="images/box_l.png" /></td>
      <td width="600" background="images/box_c.png">
        <table width="100%">
          <tr>
            <td><span class="wordsLabel2">Arquivo ESPECIAL.DBF <br />
              </span><br />
              <span class="words1">Caso o campo de busca for deixado em branco e o bot&atilde;o &quot;Enviar Especial &quot; seja pressionado, significa que a tabela j&aacute; foi inserida. </span><br />
                <form id="especial" name="especial" enctype="multipart/form-data" method="post" action="utils/Uploader.class.php">
                  <label> <span class="words2">Enviar tabela Especial:</span>
                  <input name="archive" type="file" id="archive" size="50" />
                  <input name="table" type="text" id="table" style="visibility:hidden" value="especial" size="5" maxlength="3"/>
                  </label>
                  <label>
                  <br />
                  <br />
                  <input name="submitEspecial" type="submit" id="submitEspecial" value="Enviar Especial" />
                  </label>
              </form></td>
          </tr>
        </table>
      <br /></td>
      <td width="193"><img src="images/box_r.png" /></td>
    </tr>
  </table>
</div>

<div id="divBoxEventos">
  <table width="862" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="74"><img src="images/box_l.png" /></td>
      <td width="595" background="images/box_c.png">
        <table width="100%">
          <tr>
            <td><span class="wordsLabel2">Arquivo EVENTOS.DBF </span><br />
              <br />
              <span class="words1">Caso o campo de busca for deixado em branco e o bot&atilde;o &quot;Enviar Eventos &quot; seja pressionado, significa que a tabela j&aacute; foi inserida. </span><br />
                <form id="eventos" name="eventos" enctype="multipart/form-data" method="post" action="utils/Uploader.class.php">
                  <label> <span class="words2">Enviar tabela Eventos:</span>
                  <input name="archive" type="file" id="archive" size="50" />
                  <input name="table" type="text" id="table" style="visibility:hidden" value="eventos" size="5" maxlength="3"/>
                  </label>
                  <label>
                  <br />
                  <br />
                  <input name="submitEventos" type="submit" id="submitEventos" value="Enviar Eventos" />
                  </label>
              </form></td>
          </tr>
        </table>
      <br /></td>
      <td width="193"><img src="images/box_r.png" /></td>
    </tr>
  </table>
</div>

<div id="divBoxFolha">
  <table width="692" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="74"><img src="images/box_l.png" /></td>
      <td width="425" background="images/box_c.png">
        <table id="formFolha" width="101%" border="0">
          <tr>
            <td height="26"><form id="folha" name="folha" method="post" action="utils/FolhaSaver.class.php" onsubmit="javascript: return folhaValider('folha')">
                <label><span class="wordsLabel2">Adicionar esp&eacute;cie de Folhas. </span><br />
                <br /> 
                <span class="words2">Nome:
                  <input name="tfNome" type="text" id="tfNome" size="30" maxlength="30" />
                  , <br />
                descri&ccedil;&atilde;o: </span></label>
                <span class="words2">
                <label>                </label>
                </span>
                <label>
                <input name="tdDescricao" type="text" id="tdDescricao" size="50" maxlength="50" />
                </label>
                <label>
                <br />
                <br />
                <input type="submit" name="Submit" value="Salvar Folha" />
                </label>
            </form></td>
          </tr>
        </table>
      <br /></td>
      <td width="193"><img src="images/box_r.png" /></td>
    </tr>
  </table>
</div>

<div id="divBoxAddAdmin">
  <table width="825" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="74"><img src="images/box_l.png" /></td>
      <td width="514" background="images/box_c.png">
	  <form id="adminSigin" name="adminSigin" method="post" action="actions/Sigin.class.php" onsubmit="javascript: return adminSiginValider('adminSigin')">
        <table width="100%" border="0">
          <tr>
            <td colspan="2"><div align="center" class="wordsLabel2">Adicionar novo usu&aacute;rio administrador. </div></td>
          </tr>
          <tr>
            <td width="146" class="words1"><div align="right">Nome de usu&aacute;rio:</div></td>
            <td width="371"><input name="tfUserName" type="text" id="tfUserName" size="25" maxlength="50" /></td>
          </tr>
          <tr>
            <td class="words1"><div align="right">Informe a senha:</div></td>
            <td><input name="tfPassword" type="password" id="tfPassword" size="25" maxlength="50" /></td>
          </tr>
          <tr>
            <td class="words1"><div align="right">Confirme a senha: </div></td>
            <td><label>
              <input name="tfPassword2" type="password" id="tfPassword2" size="25" maxlength="50" />
            </label></td>
          </tr>
          <tr>
            <td class="words1"><div align="right">N&iacute;vel: 
              </div></td>
            <td><label>
            <select name="slNivel" size="1" id="slNivel">
              <option value="---" selected="selected">---</option>
              <option value="1">Contracheque</option>
              <option value="2">Cadastro</option>
            </select>
            </label></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><input name="btSigin" type="submit" id="btSigin" value="Cadastrar" /></td>
          </tr>
        </table>
		</form>
      <br /></td>
      <td width="237"><img src="images/box_r.png" /></td>
    </tr>
  </table>
</div>

<div id="divBoxCadCalc">
  <table width="863" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="74"><img src="images/box_l.png" /></td>
      <td width="596" align="center" valign="middle" background="images/box_c.png"><table width="100%">
            <tr>
              <td><form id="cadcalc" name="cadcalc" enctype="multipart/form-data" method="post" action="utils/Uploader.class.php">
                  <label> <span class="words1"><span class="wordsLabel2">Arquivo</span>
                  <select name="select">
                    <option>Escolha</option>
                    <?php
					$result = $connect->execute("SELECT nome FROM Folhas");
					
					while($row = mysql_fetch_assoc($result)) {
						echo("<option>".$row["nome"]."</option>");
					}
					?>
                  </select>
                  <span class="wordsLabel2">_CAD.DBF</span><br />
                    Enviar tabela Cadastro:</span>
                  <input name="archive" type="file" id="archive" size="50" />
                    <input name="table" type="text" id="table" style="visibility:hidden" value="cadastro" size="5" maxlength="3"/>
                  </label>
                  <label>
                  <input name="submitCadastro" type="submit" id="submitCadastro" value="Enviar Cadastro" />
                  </label>
              </form></td>
            </tr>
          </table>
		  <table width="100%">
            <tr>
              <td><form id="calculo" name="calculo" enctype="multipart/form-data" method="post" action="utils/Uploader.class.php">
                  <label> <span class="words1"><span class="wordsLabel2"><br />
                  Arquivo</span>
                  <select name="select">
                    <option>Escolha</option>
                    <?php
					$result = $connect->execute("SELECT nome FROM Folhas");
					
					while($row = mysql_fetch_assoc($result)) {
						echo("<option>".$row["nome"]."</option>");
					}
				?>
                  </select>
                  <span class="wordsLabel2">_CAL.DBF </span><br />
                  Enviar tabela C&aacute;lculo:</span>
                  <input name="archive" type="file" size="50" />
                    <input name="table" type="text" id="table" style="visibility:hidden" value="calculo" size="5" maxlength="3"/>
                  </label>
                  <label>
                  <input name="submitCalculo" type="submit" id="submitCalcalculo" value="Enviar C&aacute;lculo" />
                  </label>
              </form></td>
            </tr>
          </table>
      </td>
      <td width="193"><img src="images/box_r.png" /></td>
    </tr>
  </table>
</div>

<div id="divBoxMessageAdmin" style="visibility:<?php echo($msgVisibility); ?>">
  <table width="99%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="21"><img src="images/box2_l.png" width="21" height="50" /></td>
      <td width="630" align="left" valign="top" background="images/box2_c.png">
      <p id="pMSG" class="alert"><?php echo($message); ?></p>
      </td>
      <td width="36"><img src="images/box2_r.png" width="36" height="50" /></td>
    </tr>
  </table>
</div>

<div id="divBut"  style="cursor:pointer" onclick="location.href='actions/Logout.class.php'">
<span class="wordsLabel">Desconectar </span><img src="images/desconectar.png" width="36" height="36" /></div>
  <div id="divMenu" class="wordsLabel">  
    <p onclick="javascript: tableShowManager('divBoxAddAdmin', true);" style="cursor:pointer">-&gt; Novo Admin </p>
    <p onclick="javascript: tableShowManager('divBoxData', true);" style="cursor:pointer">-&gt; Validar Data</p>
    <p onclick="javascript: tableShowManager('divBoxDCR', true);" style="cursor:pointer">-&gt; DCR</p>
    <p onclick="javascript: tableShowManager('divBoxDLT', true);" style="cursor:pointer">-&gt; DLT</p>
    <p onclick="javascript: tableShowManager('divBoxEspecial', true);" style="cursor:pointer">-&gt; Especial</p>
    <p onclick="javascript: tableShowManager('divBoxEventos', true);" style="cursor:pointer">-&gt; Eventos</p>
    <p onclick="javascript: tableShowManager('divBoxFolha', true);" style="cursor:pointer">-&gt; Folha</p>
    <p onclick="javascript: tableShowManager('divBoxCadCalc', true);" style="cursor:pointer">-&gt; Tabelas de C&aacute;lculo e Cadastro  </p>
	<a href="cadastroFolha.php">-&gt;Cadastrar Servidor </a>
    <a href="show.php">SHOW</a>
  </div>
  <div id="divLabelAdmin" class="wordsLabel">
  <p align="center">Funda&ccedil;&atilde;o Municipal de Saude - FMS</p>
  </div>
</div>
	</body>
</html>
<?php //$connect->close(); ?>