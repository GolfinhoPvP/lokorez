<?php
	session_start();
	
	if((isset($_SESSION["usuario"]) == NULL) && (isset($_SESSION["senha"]) == NULL))
		header("Location: admin.php");
	
	$message = NULL;
	$dateVisibility = "visible";
	$DCRVisibility 	= "invisible";
	$msgVisibility	= "invisible";
	
	if(isset($_GET["dir"])){
		switch($_GET["dir"]){
			case "true" : $message = "Cuidado, estas tabelas possivelmente já existem, continue as verificações.";
							break;
			case "false" : $message = "O sistema está pronto para receber as novas tabelas.";
							break;
		}
		$dateVisibility = "invisible";
		$msgVisibility	= "visible";
		$DCRVisibility 	= "visible";
	}
	
	if(isset($_GET["upl"])){
		switch($_GET["upl"]){
			case "true" : $message = "Arquivo upado com sucesso.";
							break;
			case "false" : $message = "Erro, arquivo não upado.";
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
				<input type="submit" name="Submit" value="Confirmar Data" />
				</label>
			  </form>
			</td>
		  </tr>
	</table>
		<table width="100%" class="<?php echo($DCRVisibility); ?>">
		  <tr>
			<td><form id="form2" name="form2" enctype="multipart/form-data" method="post" action="utils/Uploader.class.php">
			  <label> Enviar tabela DCR:
				<input name="archive" type="file" id="archive" size="50" />
			  </label>
			  <label>
			  <input name="submit1" type="submit" id="submit1" value="Enviar DCR" />
			  </label>
			</form></td>
		  </tr>
	</table>
	</body>
</html>
