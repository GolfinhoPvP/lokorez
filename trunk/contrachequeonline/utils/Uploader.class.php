<?php
	session_start();
	require_once("Handler.class.php");
	
	class Uploader{
		private $archive = NULL;
		private $path = "../uploads/";
		private $tableID = NULL;
		private $folhaType = NULL;
		
		function __construct($dir){
			$this->archive = isset($_FILES["archive"]) ? $_FILES["archive"] : NULL;
			$this->tableID = isset($_POST["table"]) ? $_POST["table"] : NULL;
			$this->folhaType = isset($_POST["select"]) ? $_POST["select"] : NULL;
			$this->path = $this->path.$dir;
			if(!$this->archive["name"]){
				header("Location: ../importDocuments.php?upl=yet&tab=$this->tableID");
				die();
			}
		}
		
		function __get($name){
			return $this->$name;
		}
	
		function upload(){
		
			if(empty($this->archive))
				return false;
			
			if($this->extensionVerifier())
				return false;
				
			if($this->maxSize())
				return false;
			
			$arquivo1 = $arquivo;
			
			$this->formatArchive();
			
			if(move_uploaded_file($this->archive['tmp_name'],$this->path))
				return true;
			else
				return false;
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
			$this->path = $this->path."/".$newName;
		}
		
		function maxSize(){
			if($this->archive["size"] > 5242880) //Limit: 5MB
				return true;
			return false;
 		}
		
		function extensionVerifier(){
			if (!stristr(".dbf", $this->archive["name"]))
				return false;
			return true;
		}
	}
	
	$up = new Uploader($_SESSION["path"]);
	$up->upload() ? new Handler($up->tableID, $up->path, $up->folhaType) : header("Location: ../importDocuments.php?upl=false");
?>
