<?php
	class Updater{
		function __construct(){
			foreach($_POST as $fieldName => $value){
   				$comand = "\$".$fieldName."='".$value."';";
   				eval($comand);
			} 
		}
		
		for($x=0; $x<$numRows; $x++){
			for($y=0; $y<$numFields; $y++){
				$DB[$x][$y] = $tf.$x.$y;
			}
		}
	}
	
	new Updater();
?>