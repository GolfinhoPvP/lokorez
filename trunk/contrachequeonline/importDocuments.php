<?php
	require_once("utils/Connect.class.php");
	include_once("beans/Variables.class.php");
	
	$variables = new Variables();
	$connect = new Connect($variables->dbHost, $variables->dbUser, $variables->dbPassword, $variables->dbName);
	$connect->start();
	
	session_start();
	
	if((isset($_SESSION["usuario"]) == NULL) && (isset($_SESSION["senha"]) == NULL))
		header("Location: admin.php");
	
	$message = NULL;
	$dateVisibility = "visible";
	$DCRVisibility 	= "invisible";
	$msgVisibility	= "invisible";
	$DLTVisibility	= "invisible";
	$especialVisibility	= "invisible";
	$eventosVisibility	= "invisible";
	$cadcalcVisibility = "invisible";
	
	if(isset($_GET["dir"])){
		switch($_GET["dir"]){
			case "false" : $message = "Possivelmente a data que foi passada não é uma data válida, nada foi feito!";
							break;
			case "true" : $message = "O sistema está pronto para receber as novas tabelas.";
							$_SESSION["cadcal"] = "show";
							$dateVisibility = "invisible";
							$DCRVisibility 	= "visible";
							//$cadcalcVisibility = "visible";
							break;
			case "yet" : $message = "Cuidado, estas tabelas possivelmente já existem, continue as verificações.";
							$_SESSION["dir"] = "show";
							$_SESSION["cadcal"] = "show";
							$dateVisibility = "invisible";
							$DCRVisibility 	= "visible";
							//$cadcalcVisibility = "visible";
							break;
		}
		$msgVisibility	= "visible";
	}
	
	if(isset($_GET["upl"])){
		switch($_GET["upl"]){
			case "true" : $message = "Arquivo upado com sucesso.";
							break;
			case "false" : $message = "Erro, arquivo não upado.";
							break;
			case "yet" : $message = "Ok, arquivo já upado.";
							break;
		}
		$msgVisibility	= "visible";
	}
	
	if(isset($_GET["sigin"])){
		switch($_GET["sigin"]){
			case "true" : $message = "Novo usuário adicionado com sucesso!.";
							break;
			case "false" : $message = "Usuário não adicionado!!!.";
							break;
			case "yet" : $message = "Usuário já adicionado!.";
							break;
		}
		$msgVisibility	= "visible";
	}
	
	if(isset($_GET["tab"])){
		switch($_GET["tab"]){
			case "dcr" 		: $_SESSION["dcr"] = "show";
							break;
			case "dlt" : $_SESSION["dlt"] = "show";
							break;
							
			case "especial" : $_SESSION["especial"] = "show";
							break;
							
			case "eventos" : $_SESSION["eventos"] = "show";
							break;
		}
	}
	if(isset($_SESSION["dir"]) == "show"){
		$dateVisibility 	= "invisible";
		$_SESSION["dir"] 	= "hide";
	}
	
	if(isset($_SESSION["dcr"]) == "show"){
		$DCRVisibility 		= "invisible";
		$DLTVisibility 		= "visible";
		$_SESSION["dcr"] 	= "hide";
	}
	
	if(isset($_SESSION["dlt"]) == "show"){
		$DLTVisibility 		= "invisible";
		$especialVisibility = "visible";
		$_SESSION["dlt"] 	= "hide";
	}
	
	if(isset($_SESSION["especial"]) == "show"){
		$especialVisibility 	= "invisible";
		$eventosVisibility 		= "visible";
		$_SESSION["especial"]	= "hide";
	}
	
	if(isset($_SESSION["eventos"]) == "show"){
		$eventosVisibility 		= "invisible";
		$DCRVisibility 			= "visible";
		$_SESSION["eventos"] 	= "hide";
	}
	
	if(isset($_SESSION["cadcal"]) == "show"){
		$cadcalcVisibility 		= "visible";
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>FMS - Contracheque On-line</title>
		
		<style type="text/css">
		   @import url("css/general.css");
		</style>
		
		<script language="javascript" src="javascript/functions.js" type="text/javascript"></script>
		<script language="javascript" type="text/javascript">
			window.onload = function(){
				document.date.tfDate.value = getUserDate();
			}
		</script>
	</head>
	
	<body>
		<table width="100%" border="0">
          <tr>
            <td width="24">&nbsp;</td>
            <td width="793" bgcolor="#0000FF"><div align="center" class="words1">&Aacute;rea Administrativa </div></td>
            <td width="97" bgcolor="#0000FF"><table width="97">
              <tr>
                <td width="114"><form id="desconect" name="desconect" method="post" action="actions/Logout.class.php">
                    <label>
                    <input name="logout" type="submit" id="logout" value="Desconectar" />
                    </label>
                </form></td>
              </tr>
            </table></td>
            <td width="27">&nbsp;</td>
          </tr>
          <tr>
            <td class="words2">&nbsp;</td>
            <td colspan="2" bgcolor="#0099FF" class="words2">
				<form id="adminSigin" name="adminSigin" method="post" action="actions/Sigin.class.php" onsubmit="javascript: return adminSiginValider('adminSigin')">
					  <table width="91%" border="0">
						<tr>
						  <td width="152">&nbsp;</td>
						  <td width="653"><div align="center">Para adicionar novo usu&aacute;rio administrador. </div></td>
						</tr>
						<tr>
						  <td><div align="right">Nome de usu&aacute;rio:</div></td>
						  <td><input name="tfUserName" type="text" id="tfUserName" size="25" maxlength="50" /></td>
						</tr>
						<tr>
						  <td><div align="right">Informe a senha:</div></td>
						  <td><input name="tfPassword" type="password" id="tfPassword" size="25" maxlength="50" /></td>
						</tr>
						<tr>
						  <td><div align="right">Confirme a senha: </div></td>
						  <td><label>
							<input name="tfPassword2" type="password" id="tfPassword2" size="25" maxlength="50" />
						  </label></td>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						  <td><input name="btSigin" type="submit" id="btSigin" value="Cadastrar" /></td>
						</tr>
					  </table>
				</form></td>
            <td class="words2">&nbsp;</td>
          </tr>
          <tr>
            <td class="words2">&nbsp;</td>
            <td colspan="2" bgcolor="#00CCFF" class="words2"><table width="81%" class="<?php echo($msgVisibility); ?>">
              <tr>
                <td>Mensagem: <p class="alert"><?php echo($message); ?></p></td>
              </tr>
            </table></td>
            <td class="words2">&nbsp;</td>
          </tr>
          <tr>
            <td class="words2">&nbsp;</td>
            <td colspan="2" bgcolor="#0099FF" class="words2"><table width="88%" class="<?php echo($dateVisibility); ?>">
              <tr>
                <td width="781"><p>Confirme a data para valida&ccedil;&atilde;o das tabelas: </p>
                  <p><span class="alert">Obs:. Esta data &eacute; referente a validade das tabelas, n&atilde;o ao dia atual.<br />
                  Exemplo: Se as tabelas forem do mes de abril de 2008, insira uma data qualquer do mes de abril de 2008 ex: 14-04-2008 </span><br />
  Obs:. A data &eacute; muito importante, principalmente o m&ecirc;s e o ano,  que em hip&oacute;tese alguma podem estar errados!<br />
  Obs:. O dia n&atilde;o &eacute; usado para efeito de c&aacute;lculos, por isso insignificante. </p>
                  <form id="date" name="date" method="post" action="utils/DateVerifier.class.php" onsubmit="javascript: return dateVerifier('date')">
                  <label>
                    <input name="tfDate" type="text" id="tfDate" size="12" maxlength="10" onkeydown="javascript: return dateValider('tfDate', event);"/>
                  </label>
                  <label>
                    <input name="confirmDate" type="submit" id="confirmDate" value="Confirmar Data" />
                  </label>
                </form></td></tr>
            </table></td>
            <td class="words2">&nbsp;</td>
          </tr>
          <tr>
            <td class="words2">&nbsp;</td>
            <td colspan="2" bgcolor="#0099FF" class="words2">
              <table width="88%" class="<?php echo($DCRVisibility); ?>">
              <tr>
                <td>
				Caso o campo de busca for deixado em branco e o bot&atilde;o &quot;Enviar DCR&quot; seja pressionado, significa que a tabela j&aacute; foi inserida. <br />
				<form id="dcr" name="dcr" enctype="multipart/form-data" method="post" action="utils/Uploader.class.php">
                  <label> Enviar tabela DCR:
                    <input name="archive" type="file" id="archive" size="50" />
                    <input name="table" type="text" id="table" style="visibility:hidden" value="dcr" size="5" maxlength="3"/>
                  </label>
                  <label>
                    <input name="submitDCR" type="submit" id="submitDCR" value="Enviar DCR" />
                  </label>
                 </form></td>
              </tr>
            </table></td><td class="words2">&nbsp;</td>
          </tr>
          <tr>
            <td class="words2">&nbsp;</td>
            <td colspan="2" bgcolor="#0099FF" class="words2">
              <table width="88%" class="<?php echo($DLTVisibility); ?>">
              <tr>
                <td>
				Caso o campo de busca for deixado em branco e o bot&atilde;o &quot;Enviar DLT &quot; seja pressionado, significa que a tabela j&aacute; foi inserida. <br />
				<form id="DLT" name="DLT" enctype="multipart/form-data" method="post" action="utils/Uploader.class.php">
                  <label> Enviar tabela DLT:
                    <input name="archive" type="file" id="archive" size="50" />
                    <input name="table" type="text" id="table" style="visibility:hidden" value="dlt" size="5" maxlength="3"/>
                  </label>
                  <label>
                    <input name="submitDLT" type="submit" id="submitDLT" value="Enviar DLT" />
                  </label>
                  </form></td>
              </tr>
            </table></td><td class="words2">&nbsp;</td>
          </tr>
          <tr>
            <td class="words2">&nbsp;</td>
            <td colspan="2" bgcolor="#0099FF" class="words2">
              <table width="88%" class="<?php echo($especialVisibility); ?>">
              <tr>
                <td>Caso o campo de busca for deixado em branco e o bot&atilde;o &quot;Enviar Especial &quot; seja pressionado, significa que a tabela j&aacute; foi inserida. <br /><form id="especial" name="especial" enctype="multipart/form-data" method="post" action="utils/Uploader.class.php">
                  <label> Enviar tabela Especial:
                    <input name="archive" type="file" id="archive" size="50" />
                    <input name="table" type="text" id="table" style="visibility:hidden" value="especial" size="5" maxlength="3"/>
                  </label>
                  <label>
                    <input name="submitEspecial" type="submit" id="submitEspecial" value="Enviar Especial" />
                  </label>
                  </form></td>
              </tr>
            </table></td><td class="words2">&nbsp;</td>
          </tr>
          <tr>
            <td class="words2">&nbsp;</td>
            <td colspan="2" bgcolor="#0099FF" class="words2">
              <table width="88%" class="<?php echo($eventosVisibility); ?>">
              <tr>
                <td>Caso o campo de busca for deixado em branco e o bot&atilde;o &quot;Enviar Eventos &quot; seja pressionado, significa que a tabela j&aacute; foi inserida. <br /><form id="eventos" name="eventos" enctype="multipart/form-data" method="post" action="utils/Uploader.class.php">
                  <label> Enviar tabela Eventos:
                    <input name="archive" type="file" id="archive" size="50" />
                    <input name="table" type="text" id="table" style="visibility:hidden" value="eventos" size="5" maxlength="3"/>
                  </label>
                  <label>
                    <input name="submitEventos" type="submit" id="submitEventos" value="Enviar Eventos" />
                  </label>
                  </form></td>
              </tr>
            </table></td><td class="words2">&nbsp;</td>
          </tr>
          <tr>
            <td class="words2">&nbsp;</td>
            <td colspan="2" bgcolor="#0099FF" class="words2"><a href="#" onclick="javascript: show('formFolha');">Adicionar epécie de folha. </a>
              <table id="formFolha" width="88%" border="0" class="invisible">
                <tr>
                  <td height="26">
				  <form id="folha" name="folha" method="post" action="utils/FolhaSaver.class.php" onsubmit="javascript: return folhaValider('folha')">
                      <label> Nome:
                        <input name="tfNome" type="text" id="tfNome" size="30" maxlength="30" />
                        , descri&ccedil;&atilde;o: </label>
                      <label>
                      <input name="tdDescricao" type="text" id="tdDescricao" size="50" maxlength="50" />
                      </label>
                      <label>
                      <input type="submit" name="Submit" value="Salvar Folha" />
                      </label>
                  </form></td>
                </tr>
            </table></td>
            <td class="words2">&nbsp;</td>
          </tr>

          <tr>
            <td class="words2">&nbsp;</td>
            <td colspan="2" bgcolor="#0099FF" class="words2"><div>
              <table width="88%" class="<?php echo($cadcalcVisibility); ?>">
                <tr>
                  <td><form id="cadcalc" name="cadcalc" enctype="multipart/form-data" method="post" action="utils/Uploader.class.php">
                      <label> Esp&eacute;cie da Folha:
                        <select name="select">
                        <option>Escolha</option>
                        <?php
					$result = $connect->execute("SELECT descricao FROM Folhas");
					
					while($row = mysql_fetch_assoc($result)) {
						echo("<option>".$row["descricao"]."</option>");
					}
				?>
                      </select>
                      <br />
                        Enviar tabela Cadastro:
                        <input name="archive" type="file" id="archive" size="50" />
                        <input name="table" type="text" id="table" style="visibility:hidden" value="cadastro" size="5" maxlength="3"/>
                      </label>
                      <label>
                      <input name="submitCadastro" type="submit" id="submitCadastro" value="Enviar Cadastro" />
                      </label>
                  </form></td>
                </tr>
              </table>
              <table width="88%" class="<?php echo($cadcalcVisibility); ?>">
                <tr>
                  <td><form id="calculo" name="calculo" enctype="multipart/form-data" method="post" action="utils/Uploader.class.php">
                      <label> Esp&eacute;cie da Folha:
                        <select name="select">
                        <option>Escolha</option>
                        <?php
					$result = $connect->execute("SELECT descricao FROM Folhas");
					
					while($row = mysql_fetch_assoc($result)) {
						echo("<option>".$row["descricao"]."</option>");
					}
				?>
                      </select>
                      <br />
                        Enviar tabela C&aacute;lculo:
                        <input name="archive" type="file" size="50" />
                        <input name="table" type="text" id="table" style="visibility:hidden" value="calculo" size="5" maxlength="3"/>
                      </label>
                      <label>
                      <input name="submitCalculo" type="submit" id="submitCalcalculo" value="Enviar C&aacute;lculo" />
                      </label>
                  </form></td>
                </tr>
              </table>
            </div></td>
            <td class="words2">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="4" bgcolor="#0000FF" class="words2">&nbsp;</td>
          </tr>
        </table>
	<a href="#" onclick="javascript: show('formFolha');"><br />
		</a>
		</p>
	</body>
</html>
<?php //$connect->close(); ?>
