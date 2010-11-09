<?php
	echo ($_POST);
	die();
	class Updater{
		function __construct(){
			foreach($_POST as $fieldName => $value){
   				$comand = "\$".$fieldName."='".$value."';";
   				eval($comand);
			} 
		}
		
		for($x=0; $x<$numRows; $x++){
			for($y=0; $y<$numFields; $y++){
				$str = "tf$x$y";
				eval("\$aux = \"$$str\";");
				$DB[$x][$y] = $aux;
			}
			$str = "checkbox$x";
			eval("\$opt = \"$$str\";");
			if($opt = "yes"){
				$DB[$x][$$numFields] = $opt;
			}
		}
	}
	
	new Updater();
?>