<?php
	class DateVerifier{
		private $dateUser;
		private $uploadDirectory = "../uploads/"
		function __construct(){
			//receinving and striping the variables
			$this->dateUser = isset($_POST["tfDate"]) ? $_POST["tfDate"] : NULL;
		}
	}
?>
