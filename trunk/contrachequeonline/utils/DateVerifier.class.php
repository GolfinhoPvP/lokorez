<?php
	class DateVerifier{
	
		private $dateUser = NULL;
		private $uploadDirectory = "../uploads/";
		private $dirName = NULL;
		
		function __construct(){
			//receinving and striping the variables
			$this->dateUser = isset($_POST["tfDate"]) ? $_POST["tfDate"] : NULL;
			$this->dirName = $this->dirNameMake();
			if($this->dirVerifier($this->dirName)){
				header("Location: ../importDocuments.php?dir=true");
				die();
			}else{
				mkdir($this->uploadDirectory.$this->dirName, 0777);
				header("Location: ../importDocuments.php?dir=false");
				die();
			}
		}
		
		function dirVerifier($dir){
			return is_dir($this->uploadDirectory.$dir);
		}
		
		function dirNameMake(){
			//12-12-1212
			$month	= substr($this->dateUser, 3, -5);
			$year	= substr($this->dateUser, 6, 9);
			return $year."-".$month;
		}
	}
	
	new DateVerifier();
?>
