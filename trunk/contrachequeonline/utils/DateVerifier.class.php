<?php
	session_start();
	
	class DateVerifier{
	
		private $dateUser = NULL;
		private $uploadDirectory = "../uploads/";
		private $dirName = NULL;
		
		function __construct(){
			//receinving and striping the variables
			$this->dateUser = isset($_POST["tfDate"]) ? $_POST["tfDate"] : NULL;
			$this->dirName = $this->dirNameMake();
			
			$temp = explode("-",$this->dateUser);
			if(!checkdate($temp[1],$temp[0],$temp[2])){
				header("Location: ../importDocuments.php?dir=false");
				die();
			}
			if($this->dirVerifier($this->dirName)){
				header("Location: ../importDocuments.php?dir=yet");
			}else{
				mkdir($this->uploadDirectory.$this->dirName, 0777);
				header("Location: ../importDocuments.php?dir=true");
			}
			$_SESSION["path"] = $this->dirName;
			$_SESSION["day"] = $this->dateUser;
			die();
		}
		
		function dirVerifier($dir){
			return is_dir($this->uploadDirectory.$dir);
		}
		
		function dirNameMake(){
			//12-12-1212
			$month	= substr($this->dateUser, -7, -5);
			$year	= substr($this->dateUser, -4);
			return $year."-".$month;
		}
	}
	
	new DateVerifier();
?>
