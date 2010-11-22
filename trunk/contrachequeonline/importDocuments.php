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
			case "true" : $message = "Cuidado, estas tabelas possivelmente j� existem, continue as verifica��es.";
							$_SESSION["dir"] = "show";
							break;
			case "false" : $message = "O sistema est� pronto para receber as novas tabelas.";
							break;
		}
		$dateVisibility = "invisible";
		$msgVisibility	= "visible";
		$DCRVisibility 	= "visible";
		$cadcalcVisibility = "visible";
	}
	
	if(isset($_GET["upl"])){
		switch($_GET["upl"]){
			case "true" : $message = "Arquivo upado com sucesso.";
							break;
			case "false" : $message = "Erro, arquivo n�o upado.";
							break;
			case "yet" : $message = "Ok, arquivo j� upado.";
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
	if(isset($_SESSION["dir"])== "show"){
		$dateVisibility = "invisible";
		$_SESSION["dir"] = "hide";
	}
	
	if(isset($_SESSION["dcr"])== "show"){
		$DLTVisibility = "visible";
		$_SESSION["dcr"] = "hide";
	}
	
	if(isset($_SESSION["dlt"])== "show"){
		$DLTVisibility = "invisible";
		$especialVisibility = "visible";
		$_SESSION["dlt"] = "hide";
	}
	
	if(isset($_SESSION["especial"])== "show"){
		$especialVisibility = "invisible";
		$eventosVisibility = "visible";
		$_SESSION["eventos"] = "hide";
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
				document.data.tfDate.value = getUserDate();
			}
		</script>
	</head>
	
	<body>
		<table width="97">
		  <tr>
			<td width="114"><form id="desconect" name="desconect" method="post" action="actions/Logout.class.php">
			  <label>
			  <input name="logout" type="submit" id="logout" value="Desconectar" />
			  </label>
			</form></td>
		  </tr>
	</table>
		<table width="100%" class="<?php echo($msgVisibility); ?>">
          <tr>
            <td>Mensagem: <?php echo($message); ?></td>
          </tr>
        </table>
		<table width="100%" class="<?php echo($dateVisibility); ?>">
		  <tr>
			<td width="324">Confirme a data de valida&ccedil;&atilde;o das tabelas: 
			  <form id="data" name="data" method="post" action="utils/DateVerifier.class.php">
				<label>
				  <input name="tfDate" type="text" id="tfDate" size="12" maxlength="10" />
				</label>
				<label>
				<input name="confirmDate" type="submit" id="confirmDate" value="Confirmar Data" />
				</label>
			  </form>
			</td>
		  </tr>
	</table>
		<table width="100%" class="<?php echo($DCRVisibility); ?>">
		  <tr>
			<td><form id="dcr" name="dcr" enctype="multipart/form-data" method="post" action="utils/Uploader.class.php">
			  <label> Enviar tabela DCR:
				<input name="archive" type="file" id="archive" size="50" />
				<input name="table" type="text" id="table" style="visibility:hidden" value="dcr" size="5" maxlength="3"/>
			  </label>
			  <label>
			  <input name="submitDCR" type="submit" id="submitDCR" value="Enviar DCR" />
			  </label>
			</form></td>
		  </tr>
	</table>
	    <table width="100%" class="<?php echo($DLTVisibility); ?>">
          <tr>
            <td><form id="DLT" name="DLT" enctype="multipart/form-data" method="post" action="utils/Uploader.class.php">
                <label> Enviar tabela DLT:
                  <input name="archive" type="file" id="archive" size="50" />
                <input name="table" type="text" id="table" style="visibility:hidden" value="dlt" size="5" maxlength="3"/>
                </label>
                <label>
                <input name="submitDLT" type="submit" id="submitDLT" value="Enviar DLT" />
                </label>
            </form></td>
          </tr>
        </table>
	    <table width="100%" class="<?php echo($especialVisibility); ?>">
          <tr>
            <td><form id="especial" name="especial" enctype="multipart/form-data" method="post" action="utils/Uploader.class.php">
                <label> Enviar tabela Especial:
                  <input name="archive" type="file" id="archive" size="50" />
                <input name="table" type="text" id="table" style="visibility:hidden" value="especial" size="5" maxlength="3"/>
                </label>
                <label>
                <input name="submitEspecial" type="submit" id="submitEspecial" value="Enviar Especial" />
                </label>
            </form></td>
          </tr>
        </table>
		<table width="100%" class="<?php echo($eventosVisibility); ?>">
          <tr>
            <td><form id="eventos" name="eventos" enctype="multipart/form-data" method="post" action="utils/Uploader.class.php">
                <label> Enviar tabela Eventos:
                  <input name="archive" type="file" id="archive" size="50" />
                <input name="table" type="text" id="table" style="visibility:hidden" value="eventos" size="5" maxlength="3"/>
              </label>
                <label>
                <input name="submitEventos" type="submit" id="submitEventos" value="Enviar Eventos" />
                </label>
            </form></td>
          </tr>
        </table>
		<a href="#" onclick="javascript: show('formFolha');"><br />
		Adicionar ep�cie de folha. </a>
		<table id="formFolha" width="100%" border="0" class="invisible">
          <tr>
            <td><form id="folha" name="folha" method="post" action="utils/FolhaSaver.class.php">
              <label>
              Nome:
              <input name="tfNome" type="text" id="tfNome" size="30" maxlength="30" />
              , descri&ccedil;&atilde;o: 
              </label>
              <label>
              <input name="tdDescricao" type="text" id="tdDescricao" size="50" maxlength="50" />
              </label>
              <label>
              <input type="submit" name="Submit" value="Salvar Folha" />
              </label>
            </form><br /></td>
          </tr>
        </table>
	</p>
		<div><table width="100%" class="<?php echo($cadcalcVisibility); ?>">
          <tr>
            <td><form id="cadcalc" name="cadcalc" enctype="multipart/form-data" method="post" action="utils/Uploader.class.php">
              <label> Esp&eacute;cie da Tabela:
              <select name="select">
                <option>Escolha</option>
				<?php
					$result = $connect->execute("SELECT nome FROM Folhas");
					
					while($row = mysql_fetch_assoc($result)) {
						echo("<option>".$row["nome"]."</option>");
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
		<table width="100%" class="<?php echo($cadcalcVisibility); ?>">
          <tr>
            <td><form id="calculo" name="calculo" enctype="multipart/form-data" method="post" action="utils/Uploader.class.php">
              <label> Esp&eacute;cie da Tabela:
              <select name="select">
                <option>Escolha</option>
				<?php
					$result = $connect->execute("SELECT nome FROM Folhas");
					
					while($row = mysql_fetch_assoc($result)) {
						echo("<option>".$row["nome"]."</option>");
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
        </table></div>
	</body>
</html>
<?php //$connect->close(); ?>