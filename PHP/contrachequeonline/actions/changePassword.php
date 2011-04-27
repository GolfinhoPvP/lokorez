<?php
	session_start();
	
	if((isset($_SESSION["user"]) == NULL) && (isset($_SESSION["userPass"]) == NULL))
		header("Location: admin.php");
		
	include_once("../beans/Variables.class.php");
	require_once("../utils/Connect.class.php");
	
	$variables = new Variables();
	$connect = new Connect($variables->dbHost, $variables->dbUser, $variables->dbPassword, $variables->dbName);
		
	$oldPass 	= $connect->antiInjection(isset($_POST["tfOldPass"]) ? $_POST["tfOldPass"] : NULL);
	$newPass1 	= $connect->antiInjection(isset($_POST["tfNewPass1"]) ? $_POST["tfNewPass1"] : NULL);
	$newPass2 	= $connect->antiInjection(isset($_POST["tfNewPass2"]) ? $_POST["tfNewPass2"] : NULL);
	
	if(strcmp($newPass1, $newPass2) == 0){
		$newPass1 = base64_encode($newPass1);
		$oldPass = base64_encode($oldPass);
	}else{
		$connect->close();
		header("Location: ../index.php?pass=false");
		die();
	}
	
	if(!$connect->start())
				echo("Impossible to star connection in Sigin.");
				
	if(!($result = $connect->execute("SELECT * FROM Cadastros WHERE matricula = '".$_SESSION["user"]."' AND senha = '".$oldPass."'")))
				echo("Impossible to execute MySQL query.");
				
	if($connect->counterResult($result) > 0){
		$connect->execute("UPDATE Cadastros SET senha='".$newPass1."' WHERE matricula = '".$_SESSION["user"]."'");
		$_SESSION["userPass"] = $newPass1;
		$connect->close();
		header("Location: ../index.php?pass=true");
		die();
	}
	
	$connect->close();
	header("Location: ../index.php?pass=false");
	die();
?>
