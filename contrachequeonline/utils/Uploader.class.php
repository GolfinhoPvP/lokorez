<?php
	class Uploader{
		private $archive;
		private $path = "../uploads/";
		
		function __construct($dir){
			$this->archive = isset($_FILES["archive"]) ? $_FILES["archive"] : NULL;
			$this->path = $this->path.$dir;
		}
	
		function upload(){
		
			empty($this->archive) ? return false;
			extensionVerifier() ? return false;
			maxSize()  ? return false;
			
			$arquivo1 = $arquivo;
			
			formatArchive();
			
			move_uploaded_file($this->archive['tmp_name'],$this->path) ? return true : return false;
		}
		
		function sizeVerifier(){
			if ($this->archive["size"] > 1024 * 1024) {
				$size = round(($this->archive["size"] / 1024 / 1024), 2);
				$unit = "MB";
			} else if ($this->archive["size"] > 1024) {
				$size = round(($this->archive["size"] / 1024), 2);
				$unit = "KB";
			} else {
				$size = $this->archive["size"];
				$unit = "Bytes";
			}
			return $size." ".$unit;
 		}
		
		function formatArchive(){
			$lowName = strtolower($this->archive["name"]);
			$chars = array("ç","~","^","]","[","{","}",";",":","´",",",">","<","-","/","|","@","$","%","ã","â","á","à","é","è","ó","ò","+","=","*","&","(",")","!","#","?","`","ã"," ","©");
			$newName = str_replace($chars,"",$lowName);
			$this->path = $this->path.$newName;
		}
		
		function maxSize(){
			if($this->archive["size"] > 5242880) { //Limit: 5MB
				return false;
			}
			return true;
 		}
		
		function extensionVerifier(){
			if (!eregi(".dbf", $this->archive["name"])){
				return false;
			}
			return true;
		}
	}
	
	$up = new Uploader($_SESSION["path"]);
	
	$up->upload() ? header("Location: ../importDocuments.php?upl=true") : header("Location: ../importDocuments.php?upl=false");
?>
