<?php
	session_start();
	$_SESSION["usuario"] 	= NULL;
	$_SESSION["senha"] 		= NULL;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>FMS - Contracheque Online</title>
	</head>
		
	<body>
		<?php
			if(isset($_GET["sigin"]) == "true"){
				echo('<p>Cadastro efetivado!</p>');
			}elseif(isset($_GET["sigin"]) == "false"){
				echo('<p>Cadastro n�o efetivado!</p>');
			}elseif(isset($_GET["login"]) == "false"){
				echo('<p>Login n�o efetivado!</p>');
			}
		?>
		<p>&Aacute;rea administrativa</p>
		<p>Conectar ao sistema:
		</p>
		<form id="form1" name="form1" method="post" action="actions/Login.class.php">
			  <label>
				Nome de usu&aacute;rio:
				<input name="tfUserName" type="text" id="tfUserName" size="25" maxlength="50" />
				<br />
				Senha:
			  </label>
			  <label>
			  <input name="tfPassword" type="password" id="tfPassword" size="25" maxlength="50" />
			  </label>
		      <p>
		        <label>
		        <input name="btLogin" type="submit" id="btLogin" value="Conectar"/>
		        </label>
	      </p>
		</form>
	</body>
</html>